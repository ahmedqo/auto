<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Charge;
use App\Models\Vehicle;
use App\Models\Image;
use App\Models\Reservation;
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
        $data = Vehicle::with('Images', 'Brand', 'Model')->findorfail($id);
        return view('vehicle.patch', compact('data'));
    }

    public function scene_view($id)
    {
        $data = Vehicle::with('Images', 'Brand', 'Model')->findorfail($id);

        [$startDate, $endDate, $columns] = Core::getDates();

        $reservations = Reservation::where('vehicle', $id)->where('status', 'completed')->where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        })->get();

        $count = $reservations->count();
        $work = $reservations->sum('period');
        $money = $reservations->sum('total');
        $charges = Charge::where('vehicle', $id)->where(function ($query) use ($startDate, $endDate) {
            $query->where('updated_at', '<=', $endDate)
                ->where('updated_at', '>=', $startDate);
        })->get()->reduce(function ($carry, $charge) {
            return $carry + $charge->cost;
        }, 0);

        return view('vehicle.scene', compact('data', 'count', 'work', 'money', 'charges', 'startDate', 'endDate'));
    }

    public function chart_action($id)
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
            ->where('vehicle', $id)
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
                'canceled' => array_values($data['canceled']),
                'pendding' => array_values($data['pendding']),
                'confirmed' => array_values($data['confirmed']),
                'completed' => array_values($data['completed']),
            ]
        ]);
    }

    public function search_action(Request $Request)
    {
        $data = Vehicle::with('Images', 'Brand', 'Model')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function reservations_action(Request $Request, $id)
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
            'name_en' => ['required', 'string', 'unique:vehicles'],
            'transmission' => ['required', 'string'],
            'passengers' => ['required', 'integer'],
            'model' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'doors' => ['required', 'integer'],
            'cargo' => ['required', 'integer'],
            'brand' => ['required', 'integer'],
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

        Vehicle::create($Request->merge([
            'slug' =>  Str::slug($Request->name_en),
        ])->all());

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'name_en' => ['required', 'string', 'unique:vehicles,name_en,' . $id],
            'transmission' => ['required', 'string'],
            'passengers' => ['required', 'integer'],
            'model' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'doors' => ['required', 'integer'],
            'cargo' => ['required', 'integer'],
            'brand' => ['required', 'integer'],
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

        $Vehicle->update($Request->merge([
            'slug' =>  Str::slug($Request->name_en),
        ])->all());

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
