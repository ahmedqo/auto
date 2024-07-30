<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Agency;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class AgencyController extends Controller
{
    public function index_view()
    {
        return view('agency.index');
    }

    public function store_view()
    {
        return view('agency.store');
    }

    public function patch_view($id)
    {
        $data = Agency::findorfail($id);
        return view('agency.patch', compact('data'));
    }

    public function scene_view($id)
    {
        $data = Agency::findorfail($id);

        [$startDate, $endDate, $columns] = Core::getDates();

        $reservations = Reservation::where('agency', $id)->where(function ($query) use ($startDate, $endDate) {
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

        return view('agency.scene', compact('data', 'count', 'work', 'money', 'rest', 'startDate', 'endDate'));
    }

    public function chart_action($id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = [
            'payments' => array_slice($columns, 0),
            'creances' => array_slice($columns, 0),
        ];

        Reservation::where('agency', $id)
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

        return response()->json([
            'data' => [
                'keys' => array_keys($columns),
                'payments' => array_values($data['payments']),
                'creances' => array_values($data['creances']),
            ]
        ]);
    }

    public function search_action(Request $Request)
    {
        $data = Agency::where('company', Core::company()->id)->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function search_all_action(Request $Request)
    {
        $data = Agency::orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function search_reservations_action(Request $Request, $id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Reservation::with('Vehicle')->where('agency', $id)->where('status', '!=', 'completed')->where(function ($query) use ($startDate, $endDate) {
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

        $data = Reservation::with('Vehicle')->where('agency', $id)->where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
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
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'unique:clients'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Agency::create($Request->all());

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'unique:clients,phone,' . $id],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Agency = Agency::findorfail($id);
        $Agency->update($Request->all());

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Agency::findorfail($id)->delete();

        return Redirect::route('views.agencies.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}
