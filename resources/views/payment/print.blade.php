@extends('shared.core.base')
@section('title', __('Preview Payment') . ' ' . $data->ref)

@php
    $payment = array_sum(json_decode($data->payment));
@endphp

@section('content')
    <div class="flex flex-col gap-2">
        <div class="flex flex-col items-center lg:flex-row lg:justify-between gap-2">
            <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                {{ __('Preview Payment') . ' ' . $data->ref }}
            </h1>
            <div class="w-max flex gap-2">
                <button id="printer" title="{{ __('Print') }}"
                    class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M741-701H220v-160h521v160Zm-17 236q18 0 29.5-10.812Q765-486.625 765-504.5q0-17.5-11.375-29.5T724.5-546q-18.5 0-29.5 12.062-11 12.063-11 28.938 0 18 11 29t29 11Zm-75 292v-139H311v139h338Zm92 86H220v-193H60v-264q0-53.65 36.417-91.325Q132.833-673 186-673h588q54.25 0 90.625 37.675T901-544v264H741v193Z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <div class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                <div class="w-full p-4 border border-x-x-black border-y-x-black relative">
                    <div class="w-max absolute left-1/2 -translate-x-1/2 -top-3">
                        <span
                            class="block w-max text-base font-x-thin bg-x-white border border-x-x-black border-y-x-black px-2">
                            {{ __('Vehicle Information') }}
                        </span>
                    </div>
                    <table class="w-full mt-2">
                        <tr>
                            <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                {{ __('Brand') }}
                            </td>
                            <td class="w-4 text-base text-x-black font-x-thin">:</td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Vehicle ? ucwords($data->Vehicle->brand) : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                {{ __('Registration') }}
                            </td>
                            <td class="w-4 text-base text-x-black font-x-thin">:</td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Vehicle ? strtoupper($data->Vehicle->registration) : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                {{ __('Pick-up Location') }}
                            </td>
                            <td class="w-4 text-base text-x-black font-x-thin">:</td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->pick_up ? ucwords($data->pick_up) : ucwords(Core::company()->address) . ' ' . ucwords(__(Core::company()->city)) . ' ' . Core::company()->zipcode }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                {{ __('Drop-off Location') }}
                            </td>
                            <td class="w-4 text-base text-x-black font-x-thin">:</td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->drop_off ? ucwords($data->drop_off) : ucwords(Core::company()->address) . ' ' . ucwords(__(Core::company()->city)) . ' ' . Core::company()->zipcode }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                {{ __('Date Hour') }}
                            </td>
                            <td class="w-4 text-base text-x-black font-x-thin">:</td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->from }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                {{ __('Date Hour') }}
                            </td>
                            <td class="w-4 text-base text-x-black font-x-thin">:</td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->to }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                {{ __('Rental Duration') }}
                            </td>
                            <td class="w-4 text-base text-x-black font-x-thin">:</td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->period }} {{ __('Days') }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="w-full flex flex-col lg:flex-row border border-x-x-black border-y-x-black">
                    <div
                        class="w-full p-4 border-b border-b-x-black lg:border-b-0 lg:border-e lg:border-e-x-black relative">
                        <div class="w-max absolute left-1/2 -translate-x-1/2 -top-3">
                            <span
                                class="block w-max text-base font-x-thin bg-x-white border border-x-x-black border-y-x-black px-2">
                                {{ __('Renter Driver') }}
                            </span>
                        </div>
                        <table class="w-full mb-2 lg:mb-0 mt-2">
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('First Name') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->Client ? ucwords($data->Client->first_name) : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Last Name') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->Client ? strtoupper($data->Client->last_name) : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Brith Date') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->Client ? $data->Client->birth_date : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('License Number') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->Client ? $data->Client->license_number : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Delivered On') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->Client ? $data->Client->license_date : 'N/A' }}
                                    <span class="inline-block w-max px-1 text-base text-x-black font-x-thin">
                                        {{ __('In') }}
                                    </span>
                                    {{ $data->Client ? $data->Client->license_location : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ $data->Client ? ucwords(__($data->Client->identity_type)) : 'N/A' }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->Client ? $data->Client->identity : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Delivered On') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->Client ? $data->Client->identity_date : 'N/A' }}
                                    <span class="inline-block w-max px-1 text-base text-x-black font-x-thin">
                                        {{ __('In') }}
                                    </span>
                                    {{ $data->Client ? $data->Client->identity_location : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Phone') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->Client ? $data->Client->phone : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Address') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->Client ? ucwords($data->Client->address) : 'N/A' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full p-4 relative">
                        <div class="w-max absolute left-1/2 -translate-x-1/2 -top-3 z-20">
                            <span
                                class="block w-max text-base font-x-thin bg-x-white border border-x-x-black border-y-x-black px-2">
                                {{ __('Second Driver') }}
                            </span>
                        </div>
                        @if (!$data->SClient)
                            <img src="{{ asset('img/mark.png') }}?v={{ env('APP_VERSION') }}"
                                class="w-full h-full absolute inset-0 z-10 object-center" />
                        @endif
                        <table class="w-full mt-2">
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('First Name') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->SClient ? ucwords($data->SClient->first_name) : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Last Name') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->SClient ? strtoupper($data->SClient->last_name) : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Brith Date') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->SClient ? $data->SClient->birth_date : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('License Number') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->SClient ? $data->SClient->license_number : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Delivered On') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->SClient ? $data->SClient->license_date : 'N/A' }}
                                    <span class="inline-block w-max px-1 text-base text-x-black font-x-thin">
                                        {{ __('In') }}
                                    </span>
                                    {{ $data->SClient ? $data->SClient->license_location : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ $data->SClient ? ucwords(__($data->SClient->identity_type)) : 'N/A' }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->SClient ? $data->SClient->identity : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Delivered On') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->SClient ? $data->SClient->identity_date : 'N/A' }}
                                    <span class="inline-block w-max px-1 text-base text-x-black font-x-thin">
                                        {{ __('In') }}
                                    </span>
                                    {{ $data->SClient ? $data->SClient->identity_location : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Phone') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->SClient ? $data->SClient->phone : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[180px] pe-1 text-base text-x-black font-x-thin">
                                    {{ __('Address') }}
                                </td>
                                <td class="w-4 text-base text-x-black font-x-thin">:</td>
                                <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                    {{ $data->SClient ? ucwords($data->SClient->address) : 'N/A' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="w-full border border-x-x-black border-y-x-black relative">
                    <div class="w-max absolute left-1/2 -translate-x-1/2 -top-3">
                        <span
                            class="block w-max text-base font-x-thin bg-x-white border border-x-x-black border-y-x-black px-2">
                            {{ __('Payments') }}
                        </span>
                    </div>
                    <div class="w-full flex items-end flex-col lg:flex-row pt-4">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <td class="text-base text-x-black font-x-thin pb-2 px-4 ps-8">
                                        #{{ __('Id') }}
                                    </td>
                                    <td class="w-[200px] text-base text-x-black font-x-thin pb-2 px-4 pe-8 text-center">
                                        {{ __('Amound') }}
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (json_decode($data->payment) as $value)
                                    <tr class="border-t border-t-x-black">
                                        <td class="text-base text-x-black py-2 px-4 ps-8">
                                            #{{ $loop->index + 1 }}
                                        </td>
                                        <td class="w-[200px] text-base text-x-black py-2 px-4 pe-8 text-center">
                                            {{ Core::formatNumber($value) }} {{ Core::$UNIT }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="border-t border-t-x-black">
                                        <td colspan="2" class="text-base text-x-black py-2 px-4 ps-8 pe-8 text-center">
                                            {{ __('No Payment Yet') }}
                                        </td>
                                    </tr>
                                @endforelse
                                <tr class="border-t border-t-x-black">
                                    <td class="text-base text-x-black py-2 px-4 ps-8 text-x-thin text-center">
                                        {{ __('Paid') }}
                                    </td>
                                    <td class="w-[200px] text-base text-x-black py-2 px-4 pe-8 text-center">
                                        {{ Core::formatNumber($payment) }} {{ Core::$UNIT }}
                                    </td>
                                </tr>
                                <tr class="border-t border-t-x-black">
                                    <td class="text-base text-x-black py-2 px-4 ps-8 text-x-thin text-center">
                                        {{ __('Total') }}
                                    </td>
                                    <td class="w-[200px] text-base text-x-black py-2 px-4 pe-8 text-center">
                                        {{ Core::formatNumber($data->total) }} {{ Core::$UNIT }}
                                    </td>
                                </tr>
                                <tr class="border-t border-t-x-black">
                                    <td class="text-base text-x-black py-2 px-4 ps-8 text-x-thin text-center">
                                        {{ __('Creance') }}
                                    </td>
                                    <td class="w-[200px] text-base text-x-black py-2 px-4 pe-8 text-center">
                                        {{ Core::formatNumber($data->total - $payment) }} {{ Core::$UNIT }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <neo-printer>
        <div class="w-full grid grid-rows-1 grid-cols-1 gap-6">
            <div>
                <div class="w-1/3 ms-auto flex gap-2 -mb-4 -mt-2">
                    <span class="text-x-black text-base font-x-thin">
                        {{ __('Contract N') }}:
                    </span>
                    <span class="text-base text-x-black text-opacity-70 font-x-thin">
                        {{ $data->ref }}
                    </span>
                </div>
            </div>
            <div class="w-full p-2 border border-x-x-black border-y-x-black relative">
                <div class="w-max absolute left-1/2 -translate-x-1/2 -top-3">
                    <span
                        class="block w-max text-base font-x-thin bg-x-white border border-x-x-black border-y-x-black px-2">
                        {{ __('Vehicle Information') }}
                    </span>
                </div>
                <table class="w-full mt-2">
                    <tr>
                        <td class="w-[180px] pe-1 text-sm text-x-black font-x-thin">
                            {{ __('Brand') }}
                        </td>
                        <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                        <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                            {{ $data->Vehicle ? ucwords($data->Vehicle->brand) : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="w-[180px] pe-1 text-sm text-x-black font-x-thin">
                            {{ __('Registration') }}
                        </td>
                        <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                        <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                            {{ $data->Vehicle ? strtoupper($data->Vehicle->registration) : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="w-[180px] pe-1 text-sm text-x-black font-x-thin">
                            {{ __('Pick-up Location') }}
                        </td>
                        <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                        <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                            {{ $data->pick_up ? ucwords($data->pick_up) : ucwords(Core::company()->address) . ' ' . ucwords(__(Core::company()->city)) . ' ' . Core::company()->zipcode }}
                        </td>
                    </tr>
                    <tr>
                        <td class="w-[180px] pe-1 text-sm text-x-black font-x-thin">
                            {{ __('Drop-off Location') }}
                        </td>
                        <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                        <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                            {{ $data->drop_off ? ucwords($data->drop_off) : ucwords(Core::company()->address) . ' ' . ucwords(__(Core::company()->city)) . ' ' . Core::company()->zipcode }}
                        </td>
                    </tr>
                    <tr>
                        <td class="w-[180px] pe-1 text-sm text-x-black font-x-thin">
                            {{ __('Date Hour') }}
                        </td>
                        <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                        <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                            {{ $data->from }}
                        </td>
                    </tr>
                    <tr>
                        <td class="w-[180px] pe-1 text-sm text-x-black font-x-thin">
                            {{ __('Date Hour') }}
                        </td>
                        <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                        <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                            {{ $data->to }}
                        </td>
                    </tr>
                    <tr>
                        <td class="w-[180px] pe-1 text-sm text-x-black font-x-thin">
                            {{ __('Rental Duration') }}
                        </td>
                        <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                        <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                            {{ $data->period }} {{ __('Days') }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="w-full flex border border-x-x-black border-y-x-black">
                <div class="w-full p-2 border-e border-e-black relative">
                    <div class="w-max absolute left-1/2 -translate-x-1/2 -top-3">
                        <span
                            class="block w-max text-base font-x-thin bg-x-white border border-x-x-black border-y-x-black px-2">
                            {{ __('Renter Driver') }}
                        </span>
                    </div>
                    <table class="w-full mt-2">
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('First Name') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client ? ucwords($data->Client->first_name) : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Last Name') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client ? strtoupper($data->Client->last_name) : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Brith Date') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client ? $data->Client->birth_date : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('License Number') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client ? $data->Client->license_number : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Delivered On') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client ? $data->Client->license_date : 'N/A' }}
                                <span class="inline-block w-max px-1 text-sm text-x-black font-x-thin">
                                    {{ __('In') }}
                                </span>
                                {{ $data->Client ? $data->Client->license_location : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ $data->Client ? ucwords(__($data->Client->identity_type)) : 'N/A' }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client ? $data->Client->identity : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Delivered On') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client ? $data->Client->identity_date : 'N/A' }}
                                <span class="inline-block w-max px-1 text-sm text-x-black font-x-thin">
                                    {{ __('In') }}
                                </span>
                                {{ $data->Client ? $data->Client->identity_location : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Phone') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client ? $data->Client->phone : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Address') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client ? ucwords($data->Client->address) : 'N/A' }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="w-full p-2 relative">
                    <div class="w-max absolute left-1/2 -translate-x-1/2 -top-3 z-20">
                        <span
                            class="block w-max text-base font-x-thin bg-x-white border border-x-x-black border-y-x-black px-2">
                            {{ __('Second Driver') }}
                        </span>
                    </div>
                    @if (!$data->SClient)
                        <img src="{{ asset('img/mark.png') }}?v={{ env('APP_VERSION') }}"
                            class="w-full h-full absolute inset-0 z-10 object-center" />
                    @endif
                    <table class="w-full mt-2">
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('First Name') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->SClient ? ucwords($data->SClient->first_name) : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Last Name') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->SClient ? strtoupper($data->SClient->last_name) : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Brith Date') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->SClient ? $data->SClient->birth_date : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('License Number') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->SClient ? $data->SClient->license_number : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Delivered On') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->SClient ? $data->SClient->license_date : 'N/A' }}
                                <span class="inline-block w-max px-1 text-sm text-x-black font-x-thin">
                                    {{ __('In') }}
                                </span>
                                {{ $data->SClient ? $data->SClient->license_location : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ $data->SClient ? ucwords(__($data->SClient->identity_type)) : 'N/A' }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->SClient ? $data->SClient->identity : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Delivered On') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->SClient ? $data->SClient->identity_date : 'N/A' }}
                                <span class="inline-block w-max px-1 text-sm text-x-black font-x-thin">
                                    {{ __('In') }}
                                </span>
                                {{ $data->SClient ? $data->SClient->identity_location : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Phone') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->SClient ? $data->SClient->phone : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[150px] pe-1 text-sm text-x-black font-x-thin">
                                {{ __('Address') }}
                            </td>
                            <td class="w-4 text-sm text-x-black font-x-thin">:</td>
                            <td class="text-sm text-x-black text-opacity-70 font-x-thin">
                                {{ $data->SClient ? ucwords($data->SClient->address) : 'N/A' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="w-full border border-x-x-black border-y-x-black relative">
                <div class="w-max absolute left-1/2 -translate-x-1/2 -top-3">
                    <span
                        class="block w-max text-base font-x-thin bg-x-white border border-x-x-black border-y-x-black px-2">
                        {{ __('Payments') }}
                    </span>
                </div>
                <div class="w-full flex items-end flex-col lg:flex-row pt-4">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <td class="text-base text-x-black font-x-thin pb-2 px-4 ps-8">
                                    #{{ __('Id') }}
                                </td>
                                <td class="w-[200px] text-base text-x-black font-x-thin pb-2 px-4 pe-8 text-center">
                                    {{ __('Amound') }}
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (json_decode($data->payment) as $value)
                                <tr class="border-t border-t-x-black">
                                    <td class="text-base text-x-black py-2 px-4 ps-8">
                                        #{{ $loop->index + 1 }}
                                    </td>
                                    <td class="w-[200px] text-base text-x-black py-2 px-4 pe-8 text-center">
                                        {{ Core::formatNumber($value) }} {{ Core::$UNIT }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-t border-t-x-black">
                                    <td colspan="2" class="text-base text-x-black py-2 px-4 ps-8 pe-8 text-center">
                                        {{ __('No Payment Yet') }}
                                    </td>
                                </tr>
                            @endforelse
                            <tr class="border-t border-t-x-black">
                                <td class="text-base text-x-black py-2 px-4 ps-8 text-x-thin text-center">
                                    {{ __('Paid') }}
                                </td>
                                <td class="w-[200px] text-base text-x-black py-2 px-4 pe-8 text-center">
                                    {{ Core::formatNumber($payment) }} {{ Core::$UNIT }}
                                </td>
                            </tr>
                            <tr class="border-t border-t-x-black">
                                <td class="text-base text-x-black py-2 px-4 ps-8 text-x-thin text-center">
                                    {{ __('Total') }}
                                </td>
                                <td class="w-[200px] text-base text-x-black py-2 px-4 pe-8 text-center">
                                    {{ Core::formatNumber($data->total) }} {{ Core::$UNIT }}
                                </td>
                            </tr>
                            <tr class="border-t border-t-x-black">
                                <td class="text-base text-x-black py-2 px-4 ps-8 text-x-thin text-center">
                                    {{ __('Creance') }}
                                </td>
                                <td class="w-[200px] text-base text-x-black py-2 px-4 pe-8 text-center">
                                    {{ Core::formatNumber($data->total - $payment) }} {{ Core::$UNIT }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('shared.page.print')
    </neo-printer>
@endsection

@section('scripts')
    <script>
        const trigger = document.querySelector("#printer"),
            printer = document.querySelector("neo-printer");

        trigger.addEventListener("click", () => printer.print());
        document.addEventListener("DOMContentLoaded", () => setTimeout(() => {
            printer.print();
        }, 500));
    </script>
@endsection
