<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller
{
    public function index_view()
    {
        return view('reservation.index');
    }

    public function store_view()
    {
        return view('reservation.store');
    }

    public function patch_view($id)
    {
        $data = Reservation::findorfail($id);
        return view('reservation.patch', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Reservation::with('Vehicle', 'Client')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'from_date' => ['required', 'date', 'after_or_equal:today'],
            'to_date' => ['required', 'date', 'after:from_date'],
            'from_time' => ['required', 'string'],
            'to_time' => ['required', 'string'],
            'status' => ['required', 'string'],
            'vehicle' => ['required', 'integer'],
            'client' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Vehicle = Vehicle::findorfail($Request->vehicle);
        $from = Carbon::parse($Request->from_date . ' ' . $Request->from_time);
        $to = Carbon::parse($Request->to_date . ' ' . $Request->to_time);
        $period = (int) ceil($from->diffInHours($to) / 24);
        $total = $period * $Vehicle->price;

        Reservation::create($Request->merge([
            'from' => $from,
            'to' => $to,
            'period' => $period,
            'total' => $total,
            'price' => $Vehicle->price,
        ])->all());

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'from_date' => ['required', 'date', 'after_or_equal:today'],
            'to_date' => ['required', 'date', 'after:from_date'],
            'from_time' => ['required', 'string'],
            'to_time' => ['required', 'string'],
            'status' => ['required', 'string'],
            'vehicle' => ['required', 'integer'],
            'client' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Vehicle = Vehicle::findorfail($Request->vehicle);
        $from = Carbon::parse($Request->from_date . ' ' . $Request->from_time);
        $to = Carbon::parse($Request->to_date . ' ' . $Request->to_time);
        $period = (int) ceil($from->diffInHours($to) / 24);
        $total = $period * $Vehicle->price;

        $Reservation = Reservation::findorfail($id);
        $Reservation->update($Request->merge([
            'from' => $from,
            'to' => $to,
            'period' => $period,
            'total' => $total,
            'price' => $Vehicle->price,
        ])->all());

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Reservation::findorfail($id)->delete();

        return Redirect::route('views.reservations.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}
