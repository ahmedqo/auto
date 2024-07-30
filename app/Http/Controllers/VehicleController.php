<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Alert;
use App\Models\Charge;
use App\Models\Vehicle;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function index_view()
    {
        return view('vehicle.index');
    }

    public function store_view()
    {
        return view('vehicle.store');
    }

    public function patch_view($id)
    {
        $data = Vehicle::findorfail($id);
        return view('vehicle.patch', compact('data'));
    }

    public function scene_view($id)
    {
        $data = Vehicle::findorfail($id);

        [$startDate, $endDate, $columns] = Core::getDates();

        $reservations = Reservation::where('vehicle', $id)->where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        })->get();

        $count = $reservations->count();
        $work = $reservations->sum('period');
        $money =  $reservations->reduce(function ($carry, $res) {
            return $carry + array_sum(json_decode($res->payment));
        }, 0);
        $rest =  $reservations->reduce(function ($carry, $res) {
            return $carry + ($res->total - array_sum(json_decode($res->payment)));
        }, 0);
        $charges = Charge::where('vehicle', $id)->where(function ($query) use ($startDate, $endDate) {
            $query->where('updated_at', '<=', $endDate)
                ->where('updated_at', '>=', $startDate);
        })->get()->reduce(function ($carry, $charge) {
            return $carry + $charge->cost;
        }, 0);

        $today = Carbon::today();
        $alerts = Alert::where('vehicle', $id)
            ->whereRaw("? BETWEEN DATE_SUB(viewed_at, INTERVAL threshold HOUR) AND viewed_at", [$today])
            ->get();

        return view('vehicle.scene', compact('alerts', 'data', 'count', 'work', 'money', 'rest', 'charges', 'startDate', 'endDate'));
    }

    public function chart_action($id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = [
            'charges' => array_slice($columns, 0),
            'payments' => array_slice($columns, 0),
            'creances' => array_slice($columns, 0),
        ];

        Reservation::where('vehicle', $id)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('from', '<=', $endDate)
                    ->where('to', '>=', $startDate);
            })
            ->get()->groupBy(function ($model) {
                return Core::groupKey($model);
            })->each(function ($group, $key) use (&$data) {
                $group->each(function ($carry) use (&$data, &$key) {
                    $pay = array_sum(json_decode($carry->payment));
                    $data['creances'][$key] += $carry->total - $pay;
                    $data['payments'][$key] += $pay;
                });
            });


        Charge::where('vehicle', $id)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('updated_at', '<=', $endDate)
                    ->where('updated_at', '>=', $startDate);
            })
            ->get()->groupBy(function ($model) {
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

    public function search_action(Request $Request)
    {
        $data = Vehicle::where('company', Core::company()->id)->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function search_reservations_action(Request $Request, $id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Reservation::with('Client', 'Agency')->where('vehicle', $id)->where('status', '!=', 'completed')->where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        });
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function filter_reservations_action(Request $Request, $id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Reservation::with('Client', 'Agency')->where('vehicle', $id)->where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        });
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function charges_action(Request $Request, $id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Charge::where('vehicle', $id)->where(function ($query) use ($startDate, $endDate) {
            $query->where('updated_at', '<=', $endDate)
                ->where('updated_at', '>=', $startDate);
        });
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function mileage_action($id)
    {
        $Reservation = Reservation::where('vehicle', $id)->orderBy('id', 'DESC')->first();
        return response()->json(['data' => ['mileage' => $Reservation ? $Reservation->return_mileage : null]]);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'circulation' => ['required', 'date'],
            'transmission' => ['required', 'string'],
            'passengers' => ['required', 'integer'],
            'mileage' => ['required', 'numeric'],
            'doors' => ['required', 'integer'],
            'cargo' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'fuel' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'horsepower' => ['required', 'string'],
            'horsepower_tax' => ['required', 'numeric'],
            'insurance' => ['required', 'string'],
            'insurance_cost' => ['required', 'numeric'],
            'registration' => ['required', 'string'],
            'year' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Vehicle::create($Request->all());

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'circulation' => ['required', 'date'],
            'transmission' => ['required', 'string'],
            'passengers' => ['required', 'integer'],
            'mileage' => ['required', 'numeric'],
            'doors' => ['required', 'integer'],
            'cargo' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'fuel' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'horsepower' => ['required', 'string'],
            'horsepower_tax' => ['required', 'numeric'],
            'insurance' => ['required', 'string'],
            'insurance_cost' => ['required', 'numeric'],
            'registration' => ['required', 'string'],
            'year' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Vehicle = Vehicle::findorfail($id);

        $Vehicle->update($Request->all());

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Vehicle::findorfail($id)->delete();

        return Redirect::route('views.vehicles.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}
