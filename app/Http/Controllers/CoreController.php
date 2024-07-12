<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Charge;
use App\Models\Reservation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class CoreController extends Controller
{
    public function index_view()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $reservations = Reservation::where('status', 'completed')->where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        })->get();

        $count = $reservations->count();
        $work = $reservations->sum('period');
        $money = $reservations->sum('total');
        $charges = Charge::where(function ($query) use ($startDate, $endDate) {
            $query->where('updated_at', '<=', $endDate)
                ->where('updated_at', '>=', $startDate);
        })->get()->reduce(function ($carry, $charge) {
            return $carry + $charge->cost;
        }, 0);

        return view('core.index', compact('count', 'work', 'money', 'charges', 'startDate', 'endDate'));
    }

    public function calendar_view()
    {
        return view('core.calendar');
    }

    public function setting_view()
    {
        return view('core.setting');
    }

    public function setting_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'contact_email' => ['required', 'email'],
            'print_email' => ['required', 'email'],
            'notify_email' => ['required', 'email'],
            'contact_phone' => ['required', 'string'],
            'print_phone' => ['required', 'string'],
            'period' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        foreach ([
            'usd_rate',
            'eur_rate',
            'contact_email',
            'print_email',
            'notify_email',
            'contact_phone',
            'print_phone',
            'period',
            'instagram',
            'telegram',
            'facebook',
            'youtube',
            'tiktok',
            'x',
        ] as $type) {
            Setting::findBy($type)->update([
                'content' => $Request->input($type)
            ]);
        }

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function chart_action()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = [
            'charges' => array_slice($columns, 0),
            'canceled' => array_slice($columns, 0),
            'pendding' => array_slice($columns, 0),
            'confirmed' => array_slice($columns, 0),
            'completed' => array_slice($columns, 0),
        ];

        Reservation::select('id', 'status', 'from', 'to', 'price', 'total', 'updated_at')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('from', '<=', $endDate)
                    ->where('to', '>=', $startDate);
            })
            ->get()->groupBy('status')->each(function ($row, $key) use (&$data) {
                $row->groupBy(function ($model) {
                    return Core::groupKey($model);
                })->map(function ($group) {
                    return $group->sum(function ($carry) {
                        return $carry->total;
                    });
                })->each(function ($item, $col) use (&$data, &$key) {
                    $data[$key][$col] = $item;
                });
            });

        Charge::where(function ($query) use ($startDate, $endDate) {
            $query->where('updated_at', '<=', $endDate)
                ->where('updated_at', '>=', $startDate);
        })->get()->groupBy(function ($model) {
            return Core::groupKey($model);
        })->map(function ($group) {
            return $group->sum(function ($carry) {
                return $carry->cost;
            });
        })->each(function ($item, $key) use (&$data) {
            $data['charges'][$key] = $item;
        });

        return response()->json([
            'data' => [
                'keys' => array_keys($columns),
                'charges' => array_values($data['charges']),
                'canceled' => array_values($data['canceled']),
                'pendding' => array_values($data['pendding']),
                'confirmed' => array_values($data['confirmed']),
                'completed' => array_values($data['completed']),
            ]
        ]);
    }

    public function calendar_action()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $colors = [
            'completed' => '#22C55E',
            'pendding' => '#EAB308',
            'confirmed' => '#458CFE',
            'canceled' => '#EC4899',
        ];

        $reservations =  Reservation::select('id', 'client', 'vehicle', 'status', 'from', 'to', 'price', 'total', 'updated_at')->with('Client', "Vehicle")
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('from', '<=', $endDate)
                    ->where('to', '>=', $startDate);
            })
            ->get()->map(function ($item) use (&$colors) {
                return [
                    'start' => $item->from,
                    'end' => $item->to,
                    'title' => ucwords($item->Client->first_name . ' ' . $item->Client->last_name) . ' (' . ucwords($item->Vehicle->name_en) . ')',
                    'color' => $colors[$item->status],
                    'groupId' => 'reservation',
                ];
            });

        return response()->json([
            'data' => $reservations
        ]);
    }

    public function most_action()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Reservation::with('Vehicle')->where('status', 'completed')->where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        })->get()->groupBy('vehicle')->map(
            function ($group) {
                $Vehicle = $group->first()->Vehicle;
                $total = $group->sum('total');
                $period = $group->reduce(function ($carry, $item) {
                    return $carry + $item->period;
                }, 0);

                $id = $Vehicle->id;
                $storage = $Vehicle->Images[0]->storage;
                $price = $Vehicle->price;
                $name = $Vehicle->name;

                return compact('id', 'total', 'period', 'storage', 'name');
            }
        )->sortByDesc('total')->take(10)->toArray();

        return response()->json(['data' => array_values($data)]);
    }
}
