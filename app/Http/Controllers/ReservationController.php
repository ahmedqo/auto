<?php

namespace App\Http\Controllers;

use App\Functions\Core;
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
        $data = Reservation::with('Client', 'Vehicle', 'Agency')->findorfail($id);
        return view('reservation.patch', compact('data'));
    }

    public function print_view($id)
    {
        $data = Reservation::with('Client', 'Vehicle', 'Agency')->findorfail($id);
        return view('reservation.print', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Reservation::with('Vehicle', 'Client', 'Agency')->where('company', Core::company()->id)->where('status', '!=', 'completed')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function filter_action(Request $Request)
    {
        $data = Reservation::with('Vehicle', 'Client', 'Agency')->where('company', Core::company()->id)->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'renter' => ['required', 'string'],
            'from_date' => ['required', 'date', 'after_or_equal:today'],
            'to_date' => ['required', 'date', 'after:from_date'],
            'from_time' => ['required', 'string'],
            'to_time' => ['required', 'string'],
            'vehicle' => ['required', 'integer'],
            'client' => ['required_if:renter,client', 'integer'],
            'agency' => ['required_if:renter,agency', 'integer'],
            'price' => ['required', 'numeric'],
            'starting_mileage' => ['required', 'numeric'],
            'return_mileage' => ['required', 'numeric'],
            'fuel' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $from = Carbon::parse($Request->from_date . ' ' . $Request->from_time);
        $to = Carbon::parse($Request->to_date . ' ' . $Request->to_time);
        $period = (int) ceil($from->diffInHours($to) / 24);
        $total = $period * $Request->price;

        $key = $Request->renter == 'client' ? 'agency' : 'client';

        $Request->merge([
            $key => null,
            'from' => $from,
            'to' => $to,
            'period' => $period,
            'total' => $total,
            'payment' => $Request->json,
            'status' => array_sum(json_decode($Request->json)) >= $total ? 'completed' : 'pending'
        ]);

        Reservation::create($Request->all());

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'renter' => ['required', 'string'],
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date', 'after:from_date'],
            'from_time' => ['required', 'string'],
            'to_time' => ['required', 'string'],
            'vehicle' => ['required', 'integer'],
            'client' => ['required_if:renter,client', 'integer'],
            'agency' => ['required_if:renter,agency', 'integer'],
            'price' => ['required', 'numeric'],
            'starting_mileage' => ['required', 'numeric'],
            'return_mileage' => ['required', 'numeric'],
            'fuel' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $from = Carbon::parse($Request->from_date . ' ' . $Request->from_time);
        $to = Carbon::parse($Request->to_date . ' ' . $Request->to_time);
        $period = (int) ceil($from->diffInHours($to) / 24);
        $total = $period * $Request->price;

        $key = $Request->renter == 'client' ? 'agency' : 'client';

        $Request->merge([
            $key => null,
            'from' => $from,
            'to' => $to,
            'period' => $period,
            'total' => $total,
            'payment' => $Request->json,
            'status' => array_sum(json_decode($Request->json)) >= $total ? 'completed' : 'pending'
        ]);

        $Reservation = Reservation::findorfail($id);
        $Reservation->update($Request->all());

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
