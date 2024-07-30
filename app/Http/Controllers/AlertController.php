<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Alert;
use App\Models\Reservation;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class AlertController extends Controller
{
    public function index_view()
    {
        return view('alert.index');
    }

    public function store_view()
    {
        return view('alert.store');
    }

    public function patch_view($id)
    {
        $data = Alert::findorfail($id);
        return view('alert.patch', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Alert::with('Vehicle')->where('company', Core::company()->id)->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'consumable' => ['required', 'string'],
            'vehicle' => ['required', 'integer'],
            'threshold' => ['required', 'numeric'],
            'recurrence' => ['required', 'numeric'],
            'unit' => ['required', 'string'],
            'date' => ['required_unless:unit,mileage', 'date'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        if ($Request->unit === 'mileage') {
            $Reservation = Reservation::where('vehicle', $Request->vehicle)->orderBy('id', 'DESC')->first();
            $mileage = null;
            if ($Reservation) {
                $mileage = $Reservation->return_mileage ?? $Reservation->start_mileage;
            } else {
                $mileage = Vehicle::findorfail($Request->vehicle)->mileage;
            }

            $Request->merge([
                'viewed_at' => Carbon::parse(Carbon::today())->addDays(ceil(($Request->recurrence - $mileage) / Core::company()->mileage)),
                'threshold' => $Request->threshold / Core::company()->mileage
            ]);
        } else {
            $time = ['week' => 7, 'month' => 30, 'year' => 365,][$Request->unit] * $Request->recurrence;
            $date = Carbon::parse($Request->date);
            while ($date < Carbon::today()) $date->addDays($time);
            $Request->merge([
                'viewed_at' =>  $date,
            ]);
        }

        Alert::create($Request->all());

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'consumable' => ['required', 'string'],
            'vehicle' => ['required', 'integer'],
            'threshold' => ['required', 'numeric'],
            'recurrence' => ['required', 'numeric'],
            'unit' => ['required', 'string'],
            'date' => ['required_unless:unit,mileage', 'date'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        if ($Request->unit === 'mileage') {
            $Reservation = Reservation::where('vehicle', $Request->vehicle)->orderBy('id', 'DESC')->first();
            $mileage = null;
            if ($Reservation) {
                $mileage = $Reservation->return_mileage ?? $Reservation->start_mileage;
            } else {
                $mileage = Vehicle::findorfail($Request->vehicle)->mileage;
            }

            $Request->merge([
                'viewed_at' => Carbon::parse(Carbon::today())->addDays(ceil(($Request->recurrence - $mileage) / Core::company()->mileage)),
                'threshold' => $Request->threshold / Core::company()->mileage
            ]);
        } else {
            $time = ['week' => 7, 'month' => 30, 'year' => 365,][$Request->unit] * $Request->recurrence;
            $date = Carbon::parse($Request->date);
            while ($date < Carbon::today()) $date->addDays($time);
            $Request->merge([
                'viewed_at' =>  $date,
            ]);
        }

        $Alert = Alert::findorfail($id);
        $Alert->update($Request->all());

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Alert::findorfail($id)->delete();

        return Redirect::route('views.alerts.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}
