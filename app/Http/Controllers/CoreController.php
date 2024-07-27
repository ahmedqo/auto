<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Alert;
use App\Models\Charge;
use App\Models\Company;
use App\Models\Reservation;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class CoreController extends Controller
{
    public function index_view()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $reservations = Reservation::where('company', Core::company()->id)->where(function ($query) use ($startDate, $endDate) {
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
        $charges = Charge::where('company', Core::company()->id)->where(function ($query) use ($startDate, $endDate) {
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

    public function chart_action()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = [
            'charges' => array_slice($columns, 0),
            'payments' => array_slice($columns, 0),
            'creances' => array_slice($columns, 0),
        ];

        Reservation::where('company', Core::company()->id)->where(function ($query) use ($startDate, $endDate) {
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

        Charge::where('company', Core::company()->id)->where(function ($query) use ($startDate, $endDate) {
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

        $reservations =  Reservation::with('Client', 'Vehicle')->where('company', Core::company()->id)->get()->map(function ($item) use (&$colors) {
            return [
                'start' => $item->from,
                'end' => $item->to,
                'title' => ucwords($item->Client->first_name . ' ' . $item->Client->last_name) . ' (' . ucwords($item->Vehicle->registration) . ')',
                'color' => $colors[$item->status],
                'groupId' => 'reservation',
            ];
        });

        $dates = [
            'week' => 7,
            'month' => 30,
            'year' => 365,
        ];
        $alerts = collect([]);

        Alert::with('Vehicle')->where('company', Core::company()->id)->get()->map(function ($item) use (&$alerts, &$dates) {
            $data = [
                'title' => ucwords($item->Vehicle->brand) . ' ' . ucwords($item->Vehicle->model) . ' ' . $item->Vehicle->year . ' (' . strtoupper($item->Vehicle->registration) . ')',
                'color' => '#458cfe',
                'groupId' => 'alert',
            ];

            $alerts->push(
                array_merge([
                    'start' => $item->viewed_at,
                    'end' => $item->viewed_at
                ], $data),
            );

            if ($item->unit !== 'mileage')
                $alerts->push(
                    array_merge([
                        'start' => Carbon::parse($item->viewed_at)->subDays($item->recurrence * $dates[$item->unit]),
                        'end' => Carbon::parse($item->viewed_at)->subDays($item->recurrence * $dates[$item->unit])
                    ], $data),
                    array_merge([
                        'start' => Carbon::parse($item->viewed_at)->addDays($item->recurrence * $dates[$item->unit]),
                        'end' => Carbon::parse($item->viewed_at)->addDays($item->recurrence * $dates[$item->unit])
                    ], $data)
                );
        });

        return response()->json([
            'data' => $alerts->merge($reservations)
        ]);
    }

    public function most_action()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Reservation::with('Vehicle')->where('company', Core::company()->id)->where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        })->get()->groupBy('vehicle')->map(
            function ($group) {
                $Vehicle = $group->first()->Vehicle;
                $total = $group->sum('total');
                $period = $group->reduce(function ($carry, $item) {
                    return $carry + $item->period;
                }, 0);

                $vehicle =
                    ucwords($Vehicle->brand) . ' ' . ucwords($Vehicle->model) . ' ' . $Vehicle->year . ' (' . strtoupper($Vehicle->registration) . ')';
                $price = $Vehicle->price;
                $mileage = $period * Core::company()->mileage;

                return compact('total', 'period', 'mileage', 'vehicle');
            }
        )->sortByDesc('total')->take(10)->toArray();

        return response()->json(['data' => array_values($data)]);
    }
}
