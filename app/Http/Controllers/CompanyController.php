<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Functions\Core;
use Illuminate\Http\Request;
use App\Functions\Mail as Mailer;
use App\Models\Image;
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

    public function patch_view()
    {
        $data = Core::company();
        return view('company.patch', compact('data'));
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'company_logo' => ['required', 'image'],
            'company_ice' => ['required', 'string'],
            'company_name' => ['required', 'string', 'unique:companies,name'],
            'company_city' => ['required', 'string'],
            'company_email' => ['required', 'email'],
            'company_phone' => ['required', 'string'],
            'company_address' => ['required', 'string'],
            'company_zipcode' => ['required', 'string'],
            'company_license' => ['required', 'string'],

            'admin_email' => ['required', 'email'],
            'admin_phone' => ['required', 'string'],
            'admin_last_name' => ['required', 'string'],
            'admin_first_name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Company = Company::create([
            'mileage' => 250,
            'period' => 'week',
            'ice' => $Request->company_ice,
            'name' => $Request->company_name,
            'city' => $Request->company_city,
            'email' => $Request->company_email,
            'phone' => $Request->company_phone,
            'address' => $Request->company_address,
            'zipcode' => $Request->company_zipcode,
            'license' => $Request->company_license,
        ]);

        User::create([
            'company' => $Company->id,
            'email' => $Request->admin_email,
            'phone' => $Request->admin_phone,
            'last_name' => $Request->admin_last_name,
            'password' => Hash::make(Str::random(20)),
            'first_name' => $Request->admin_first_name,
        ]);

        Mailer::reset($Request->admin_email);

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'company_ice' => ['required', 'string'],
            'company_name' => ['required', 'string', 'unique:companies,name,' . Core::company()->id],
            'company_city' => ['required', 'string'],
            'company_email' => ['required', 'email'],
            'company_phone' => ['required', 'string'],
            'company_address' => ['required', 'string'],
            'company_zipcode' => ['required', 'string'],
            'company_license' => ['required', 'string'],
            'company_period' => ['required', 'string'],
            'company_mileage' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Company = Core::company();
        $Company->update([
            'ice' => $Request->company_ice,
            'name' => $Request->company_name,
            'city' => $Request->company_city,
            'email' => $Request->company_email,
            'phone' => $Request->company_phone,
            'period' => $Request->company_period,
            'address' => $Request->company_address,
            'zipcode' => $Request->company_zipcode,
            'license' => $Request->company_license,
            'mileage' => $Request->company_mileage,
        ]);

        if ($Request->hasFile('company_logo')) {
            Image::$FILE = $Request->file('company_logo');
            $Company->Image->delete();
            $Company->Image()->create();
        }

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }
}
