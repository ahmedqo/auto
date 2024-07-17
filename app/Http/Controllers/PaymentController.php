<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Vehicle;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function index_view()
    {
        return view('payment.index');
    }

    public function patch_view($id)
    {
        $data = Reservation::with('Client', 'Vehicle')->findorfail($id);
        return view('payment.patch', compact('data'));
    }

    public function print_view($id)
    {
        $data = Reservation::findorfail($id);
        return view('payment.print', compact('data'));
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

    public function patch_action(Request $Request, $id)
    {
        $Reservation = Reservation::findorfail($id);

        $Request->merge([
            'payment' => $Request->json,
            'status' => array_sum(json_decode($Request->json)) >= $Reservation->total ? 'completed' : 'pendding'
        ]);

        $Reservation->update($Request->all());

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }
}
