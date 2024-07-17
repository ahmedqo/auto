<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Alert;
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
        $data = Alert::with('Vehicle')->orderBy('id', 'DESC');
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
            'vehicle' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'threshold' => ['required', 'integer'],
            'recurrence' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Request->merge([
            'date' =>  Carbon::parse($Request->date . ' ' . $Request->time),
        ]);

        Alert::create(Core::fillable(Alert::class, $Request));

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'name' => ['required', 'string'],
            'vehicle' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'threshold' => ['required', 'integer'],
            'recurrence' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Request->merge([
            'date' =>  Carbon::parse($Request->date . ' ' . $Request->time),
        ]);

        $Alert = Alert::findorfail($id);
        $Alert->update(Core::fillable(Alert::class, $Request));

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
