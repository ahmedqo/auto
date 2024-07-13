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

        $reservations = Reservation::where('client', $id)->where('status', 'completed')->where(function ($query) use ($startDate, $endDate) {
            $query->where('from', '<=', $endDate)
                ->where('to', '>=', $startDate);
        })->get();

        $count = $reservations->count();
        $work = $reservations->sum('period');
        $money = $reservations->sum('total');

        return view('client.scene', compact('data', 'count', 'work', 'money', 'startDate', 'endDate'));
    }

    public function chart_action($id)
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = [
            'canceled' => array_slice($columns, 0),
            'pendding' => array_slice($columns, 0),
            'confirmed' => array_slice($columns, 0),
            'completed' => array_slice($columns, 0),
        ];

        Reservation::select('id', 'status', 'from', 'to', 'price', 'total', 'updated_at')
            ->where('client', $id)
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

        return response()->json([
            'data' => [
                'keys' => array_keys($columns),
                'canceled' => array_values($data['canceled']),
                'pendding' => array_values($data['pendding']),
                'confirmed' => array_values($data['confirmed']),
                'completed' => array_values($data['completed']),
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

    public function reservations_action(Request $Request, $id)
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
