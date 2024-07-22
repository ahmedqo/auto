<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Functions\Mail as Mailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index_view()
    {
        return view('user.index');
    }

    public function store_view()
    {
        return view('user.store');
    }

    public function patch_view($id)
    {
        $data = User::findorfail($id);
        return view('user.patch', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = User::where('company', Core::company()->id)->orderBy('id', 'DESC');
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
            'email' => [
                'required', 'email',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('company', Core::company()->id);
                }),
            ],
            'phone' => [
                'required', 'string',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('company', Core::company()->id);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Request->merge(['password' =>  Hash::make(Str::random(20))]);

        User::create($Request->all());
        Mailer::reset($Request->email);

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
            'email' => [
                'required', 'email',
                Rule::unique('users')->where(function ($query) use ($id) {
                    return $query->where('company', Core::company()->id)->where('id', '!=', $id);
                }),

            ],
            'phone' => [
                'required', 'string',
                Rule::unique('users')->where(function ($query) use ($id) {
                    return $query->where('company', Core::company()->id)->where('id', '!=', $id);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        User::findorfail($id)->update($Request->all());

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        User::findorfail($id)->delete();

        return Redirect::route('views.users.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}
