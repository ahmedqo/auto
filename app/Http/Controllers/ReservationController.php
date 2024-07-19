<?php

namespace App\Http\Controllers;

use App\Functions\Core;
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
        $data = Reservation::with('Client', 'Vehicle')->findorfail($id);
        return view('reservation.patch', compact('data'));
    }

    public function print_view($id)
    {
        $data = Reservation::findorfail($id);
        return view('reservation.print', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Reservation::with('Vehicle', 'Client')->where('status', '!=', 'completed')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function filter_action(Request $Request)
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
            'vehicle' => ['required', 'integer'],
            'client' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
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

        $Request->merge([
            'from' => $from,
            'to' => $to,
            'period' => $period,
            'total' => $total,
            'payment' => $Request->json,
            'status' => array_sum(json_decode($Request->json)) >= $total ? 'completed' : 'pendding'
        ]);

        Reservation::create(Core::fillable(Reservation::class, $Request));

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
            'vehicle' => ['required', 'integer'],
            'client' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
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

        $Request->merge([
            'from' => $from,
            'to' => $to,
            'period' => $period,
            'total' => $total,
            'payment' => $Request->json,
            'status' => array_sum(json_decode($Request->json)) >= $total ? 'completed' : 'pendding'
        ]);

        $Reservation = Reservation::findorfail($id);
        $Reservation->update(Core::fillable(Reservation::class, $Request));

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
