<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Models\Blacklist;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class BlacklistController extends Controller
{
    public function index_view()
    {
        return view('blacklist.index');
    }

    public function store_view()
    {
        return view('blacklist.store');
    }

    public function patch_view($id)
    {
        $data = Blacklist::findorfail($id);
        return view('blacklist.patch', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Blacklist::with('Client')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'client' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Blacklist::create(Core::fillable(Blacklist::class, $Request));

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'client' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Blacklist::findorfail($id)->update(Core::fillable(Blacklist::class, $Request));

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Blacklist::findorfail($id)->delete();

        return Redirect::route('views.blacklist.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}
