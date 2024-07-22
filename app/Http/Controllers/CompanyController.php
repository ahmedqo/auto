<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Functions\Mail as Mailer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function store_view()
    {
        return view('company.store');
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'name' => ['required', 'string', 'unique:companies'],
            'address' => ['required', 'string'],
            'company_email' => ['required', 'email'],
            'company_phone' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'user_email' => ['required', 'email'],
            'user_phone' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        // dd([
        //     'passsword' => Hash::make(Str::random(20)),
        //     'first_name' => $Request->first_name,
        //     'last_name' => $Request->last_name,
        //     'email' => $Request->user_email,
        //     'phone' => $Request->user_phone,
        //     // 'company' => $Company->id,
        // ]);

        $Company = Company::create([
            'email' => $Request->company_email,
            'phone' => $Request->company_phone,
            'address' => $Request->address,
            'name' => $Request->name,
            'period' => 'week',
            'milage' => 250,
        ]);

        User::create([
            'password' => Hash::make(Str::random(20)),
            'first_name' => $Request->first_name,
            'last_name' => $Request->last_name,
            'email' => $Request->user_email,
            'phone' => $Request->user_phone,
            'company' => $Company->id,
        ]);

        Mailer::reset($Request->user_email);

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }
}
