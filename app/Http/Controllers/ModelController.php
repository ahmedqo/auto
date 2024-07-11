<?php

namespace App\Http\Controllers;

use App\Models\Model;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ModelController extends Controller
{
    public function index_view()
    {
        return view('model.index');
    }

    public function store_view()
    {
        return view('model.store');
    }

    public function patch_view($id)
    {
        $data = Model::findorfail($id);
        return view('model.patch', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Model::with('Image')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'name_en' => ['required', 'string', 'unique:models'],
            'image' => ['required', 'image'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Model::create($Request->merge([
            'slug' =>  Str::slug($Request->name_en),
        ])->all());

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'name_en' => ['required', 'string', 'unique:models,name_en,' . $id],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Model = Model::findorfail($id);
        $Model->update($Request->merge([
            'slug' =>  Str::slug($Request->name_en),
        ])->all());

        if ($Request->hasFile('image')) {
            Image::$FILE = $Request->file('image');
            $Model->Image->delete();
            $Model->Image()->create();
        }

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Model::findorfail($id)->delete();

        return Redirect::route('views.models.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}
