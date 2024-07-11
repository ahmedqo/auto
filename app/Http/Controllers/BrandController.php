<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index_view()
    {
        return view('brand.index');
    }

    public function store_view()
    {
        return view('brand.store');
    }

    public function patch_view($id)
    {
        $data = Brand::findorfail($id);
        return view('brand.patch', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Brand::with('Image')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'name_en' => ['required', 'string', 'unique:brands'],
            'image' => ['required', 'image'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Brand::create($Request->merge([
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
            'name_en' => ['required', 'string', 'unique:brands,name_en,' . $id],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Brand = Brand::findorfail($id);
        $Brand->update($Request->merge([
            'slug' =>  Str::slug($Request->name_en),
        ])->all());

        if ($Request->hasFile('image')) {
            Image::$FILE = $Request->file('image');
            $Brand->Image->delete();
            $Brand->Image()->create();
        }

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Brand::findorfail($id)->delete();

        return Redirect::route('views.brands.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}
