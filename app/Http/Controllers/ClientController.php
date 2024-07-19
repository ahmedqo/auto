<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    public function index_view()
    {
        return view('client.index');
    }

    public function store_view()
    {
        return view('client.store');
    }

    public function patch_view($id)
    {
        $data = Client::findorfail($id);
        return view('client.patch', compact('data'));
    }

    public function scene_view($id)
    {
        $data = Client::with('Blacklist')->findorfail($id);

        [$startDate, $endDate, $columns] = Core::getDates();

        $reservations = Reservation::where('client', $id)->where(function ($query) use ($startDate, $endDate) {
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

        return view('client.scene', compact('data', 'count', 'work', 'money', 'rest', 'startDate', 'endDate'));
    }

    public function chart_action($id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = [
            'payments' => array_slice($columns, 0),
            'creances' => array_slice($columns, 0),
        ];

        Reservation::where('client', $id)
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
        $data = Client::with('Blacklist')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function search_reservations_action(Request $Request, $id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Reservation::with('Vehicle')->where('client', $id)->where('status', '!=', 'completed')->where(function ($query) use ($startDate, $endDate) {
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

        $data = Reservation::with('Vehicle')->where('client', $id)->where(function ($query) use ($startDate, $endDate) {
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'identity' => ['required', 'string', 'unique:clients'],
            'license_number' => ['required', 'string', 'unique:clients'],
            'phone' => ['required', 'string', 'unique:clients'],
            'identity_location' => ['required', 'string'],
            'license_location' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Client::create(Core::fillable(Client::class, $Request));

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'identity' => ['required', 'string', 'unique:clients,identity,' . $id],
            'license_number' => ['required', 'string', 'unique:clients,license_number,' . $id],
            'phone' => ['required', 'string', 'unique:clients,phone,' . $id],
            'identity_location' => ['required', 'string'],
            'license_location' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Client = Client::findorfail($id);
        $Client->update(Core::fillable(Client::class, $Request));

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Client::findorfail($id)->delete();

        return Redirect::route('views.clients.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}
