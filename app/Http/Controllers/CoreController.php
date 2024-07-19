<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Alert;
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

        $reservations = Reservation::where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        })->get();

        $count = $reservations->count();
        $work = $reservations->sum('period');
        $money = $reservations->reduce(function ($carry, $res) {
            return $carry + array_sum(json_decode($res->payment));
        }, 0);
        $rest = $reservations->reduce(function ($carry, $res) {
            return $carry + ($res->total - array_sum(json_decode($res->payment)));
        }, 0);
        $charges = Charge::where(function ($query) use ($startDate, $endDate) {
            $query->where('updated_at', '<=', $endDate)
                ->where('updated_at', '>=', $startDate);
        })->get()->reduce(function ($carry, $charge) {
            return $carry + $charge->cost;
        }, 0);

        return view('core.index', compact('count', 'work', 'money', 'rest', 'charges', 'startDate', 'endDate'));
    }

    public function calendar_view()
    {
        return view('core.calendar');
    }

    public function setting_view()
    {
        return view('core.setting');
    }

    public function notification_view()
    {
        $data = Core::alerts(null);
        return view('core.notification', compact('data'));
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
            'payments' => array_slice($columns, 0),
            'creances' => array_slice($columns, 0),
        ];

        Reservation::where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        })->get()->groupBy(function ($model) {
            return Core::groupKey($model);
        })->each(function ($group, $key) use (&$data) {
            $group->each(function ($carry) use (&$data, &$key) {
                $pay = array_sum(json_decode($carry->payment));
                $data['creances'][$key] += $carry->total - $pay;
                $data['payments'][$key] += $pay;
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
                'payments' => array_values($data['payments']),
                'creances' => array_values($data['creances']),
            ]
        ]);
    }

    public function calendar_action()
    {
        $colors = [
            'completed' => '#22C55E',
            'pendding' => '#EAB308',
        ];

        $reservations =  Reservation::with('Client', 'Vehicle')->get()->map(function ($item) use (&$colors) {
            return [
                'start' => $item->from,
                'end' => $item->to,
                'title' => ucwords($item->Client->first_name . ' ' . $item->Client->last_name) . ' (' . ucwords($item->Vehicle->name) . ')',
                'color' => $colors[$item->status],
                'groupId' => 'reservation',
            ];
        });

        $alerts =  Alert::with('Vehicle')->get()->map(function ($item) {
            return [
                'start' => $item->date,
                'end' => $item->date,
                'title' => ucwords($item->name) . ' (' . ucwords($item->Vehicle->name) . ')',
                'color' => '#458cfe',
                'groupId' => 'alert',
            ];
        });

        return response()->json([
            'data' => $reservations->merge($alerts)
        ]);
    }

    public function most_action()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Reservation::with('Vehicle')->where(function ($query) use ($startDate, $endDate) {
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
