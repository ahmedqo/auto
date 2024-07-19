<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Alert;
use App\Models\Charge;
use App\Models\Vehicle;
use App\Models\Image;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

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
        $data = Vehicle::with('Images')->findorfail($id);
        return view('vehicle.patch', compact('data'));
    }

    public function scene_view($id)
    {
        $data = Vehicle::with('Images')->findorfail($id);

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

        $now = Carbon::now();
        $alerts = Alert::where(function ($query) use ($now) {
            $date = $now->copy()->dayOfWeekIso + 1;
            $query->where('recurrence', 'week')
                ->whereRaw("DAYOFWEEK(DATE_ADD(date, INTERVAL threshold HOUR)) >= ?", [$date])
                ->WhereRaw("DAYOFWEEK(DATE_SUB(date, INTERVAL threshold HOUR)) <= ?", [$date]);
        })
            ->orWhere(function ($query) use ($now) {
                $date = $now->copy()->format('d H:i:s');
                $query->where('recurrence', 'month')
                    ->whereRaw("DATE_FORMAT(DATE_ADD(date, INTERVAL threshold HOUR), '%d %H:%i:%s') >= ?", [$date])
                    ->WhereRaw("DATE_FORMAT(DATE_SUB(date, INTERVAL threshold HOUR), '%d %H:%i:%s') <= ?", [$date]);
            })
            ->orWhere(function ($query) use ($now) {
                $date = $now->copy()->format('m-d H:i:s');
                $query->where('recurrence', 'year')
                    ->whereRaw("DATE_FORMAT(DATE_ADD(date, INTERVAL threshold HOUR), '%m-%d %H:%i:%s') >= ?", [$date])
                    ->WhereRaw("DATE_FORMAT(DATE_SUB(date, INTERVAL threshold HOUR), '%m-%d %H:%i:%s') <= ?", [$date]);
            })
            ->where('vehicle', $id)
            ->orderBy('Date', 'ASC')
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
        $data = Vehicle::with('Images')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function search_reservations_action(Request $Request, $id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Reservation::with('Client')->where('vehicle', $id)->where('status', '!=', 'completed')->where(function ($query) use ($startDate, $endDate) {
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

        $data = Reservation::with('Client')->where('vehicle', $id)->where(function ($query) use ($startDate, $endDate) {
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

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'name' => ['required', 'string', 'unique:vehicles'],
            'transmission' => ['required', 'string'],
            'passengers' => ['required', 'integer'],
            'milage' => ['required', 'numeric'],
            'doors' => ['required', 'integer'],
            'cargo' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'fuel' => ['required', 'string'],
            'images' => ['required', 'array'],
            'images.*' => ['required', 'image'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Request->merge([
            'slug' =>  Str::slug($Request->name),
        ]);

        Vehicle::create(Core::fillable(Vehicle::class, $Request));

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'name' => ['required', 'string', 'unique:vehicles,name,' . $id],
            'transmission' => ['required', 'string'],
            'passengers' => ['required', 'integer'],
            'milage' => ['required', 'numeric'],
            'doors' => ['required', 'integer'],
            'cargo' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'fuel' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Vehicle = Vehicle::findorfail($id);

        if ($Request->deleted && !$Request->hasFile('images') && $Vehicle->Images->count() == count($Request->deleted)) {
            return Redirect::back()->withInput()->with([
                'message' => __('The images field is required'),
                'type' => 'error'
            ]);
        }

        $Request->merge([
            'slug' =>  Str::slug($Request->name),
        ]);

        $Vehicle->update(Core::fillable(Vehicle::class, $Request));

        if ($Request->hasFile('images')) {
            foreach ($Request->file('images') as $Image) {
                Image::$FILE = $Image;
                $Vehicle->Images()->create();
            }
        }

        if ($Request->deleted) {
            foreach ($Request->deleted as $id) {
                Image::findorfail($id)->delete();
            }
        }

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
