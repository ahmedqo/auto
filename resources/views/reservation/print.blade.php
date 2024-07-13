@extends('shared.core.base')
@section('title', __('Preview Reservation') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <div class="flex flex-col items-center lg:flex-row lg:justify-between gap-2">
            <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                {{ __('Preview Reservation') . ' #' . $data->id }}
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
            <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                <div class="w-full border border-x-shade rounded-x-thin flex flex-col gap-4 p-4 lg:col-span-6">
                    <h2 class="text-lg text-x-black font-x-huge">
                        {{ __('Billing From') }}
                    </h2>
                    <table>
                        <tr>
                            <td class="text-base text-x-black font-x-thin">
                                {{ __('Company') }}
                            </td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-base text-x-black font-x-thin">
                                {{ __('Email') }}
                            </td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-base text-x-black font-x-thin">
                                {{ __('Phone') }}
                            </td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-base text-x-black font-x-thin">
                                {{ __('Address') }}
                            </td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="w-full border border-x-shade bg-x-light rounded-x-thin flex flex-col gap-4 p-4 lg:col-span-6">
                    <h2 class="text-xl text-x-black font-x-thin">
                        {{ __('Billing To') }}
                    </h2>
                    <table>
                        <tr>
                            <td class="text-base text-x-black font-x-thin">
                                {{ __('Full Name') }}
                            </td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ ucwords($data->Client->first_name) }} {{ ucwords($data->Client->last_name) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-base text-x-black font-x-thin">
                                {{ __('Identity') }}
                            </td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client->identity_type ? '(' . ucwords($data->Client->identity_type) . ')' : '' }}
                                {{ $data->Client->identity }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-base text-x-black font-x-thin">
                                {{ __('License Number') }}
                            </td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client->license_number }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-base text-x-black font-x-thin">
                                {{ __('Phone') }}
                            </td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client->phone }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-base text-x-black font-x-thin">
                                {{ __('Address') }}
                            </td>
                            <td class="text-base text-x-black text-opacity-70 font-x-thin">
                                {{ $data->Client->address ?? 'N/A' }}
                            </td>
                        </tr>
                    </table>
                </div>
                @if ($data->Vehicle)
                    <div class="w-full flex flex-col gap-4 lg:col-span-8">
                        <h2 class="text-xl text-x-black font-x-thin lg:col-span-4">
                            {{ __('Vehicle Details') }}
                        </h2>
                        <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-x-black font-x-thin">
                                    {{ __('Name') }}
                                </label>
                                <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                    {{ ucwords($data->Vehicle->name_en) }}
                                </div>
                            </div>
                            @if ($data->Vehicle->Brand)
                                <div class="flex flex-col gap-1">
                                    <label class="text-sm text-x-black font-x-thin">
                                        {{ __('Brand') }}
                                    </label>
                                    <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                        {{ ucwords($data->Vehicle->Brand->name_en) }}
                                    </div>
                                </div>
                            @endif
                            @if ($data->Vehicle->Model)
                                <div class="flex flex-col gap-1">
                                    <label class="text-sm text-x-black font-x-thin">
                                        {{ __('Model') }}
                                    </label>
                                    <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                        {{ ucwords($data->Vehicle->Model->name_en) }}
                                    </div>
                                </div>
                            @endif
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-x-black font-x-thin">
                                    {{ __('Transmission') }}
                                </label>
                                <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                    {{ ucwords($data->Vehicle->transmission) }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-x-black font-x-thin">
                                    {{ __('Fuel') }}
                                </label>
                                <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                    {{ ucwords($data->Vehicle->fuel) }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-x-black font-x-thin">
                                    {{ __('Passengers') }}
                                </label>
                                <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                    {{ $data->Vehicle->passengers }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-x-black font-x-thin">
                                    {{ __('Doors') }}
                                </label>
                                <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                    {{ $data->Vehicle->doors }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-x-black font-x-thin">
                                    {{ __('Cargo') }}
                                </label>
                                <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                    {{ $data->Vehicle->cargo }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="w-full flex flex-col gap-4 lg:col-span-4">
                    <h2 class="text-xl text-x-black font-x-thin">
                        {{ __('Duration') }}
                    </h2>
                    <div class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Pick-up Date') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ $data->from }}
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Drop-off Date') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ $data->to }}
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Pick-up Location') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ $data->pick_up ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Drop-off Location') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ $data->drop_off ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-7 hidden lg:block"></div>
                <div class="w-full flex flex-col gap-4 lg:col-span-5 mt-10">
                    <div class="w-full flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-base text-x-black font-x-thin">
                                {{ __('Period') }}
                            </span>
                            <span class="text-lg text-x-black font-x-thin">
                                {{ $data->period }} {{ __('Days') }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-base text-x-black font-x-thin">
                                {{ __('Price Per Day') }}
                            </span>
                            <span class="text-lg text-x-black font-x-thin">
                                {{ Core::formatNumber($data->price) }} {{ Core::$UNIT }}
                            </span>
                        </div>
                        <div class="h-px bg-x-shade"></div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-lg text-x-black font-x-thin">
                                {{ __('Total') }}
                            </span>
                            <span class="text-xl text-x-black font-x-thin">
                                {{ Core::formatNumber($data->total) }} {{ Core::$UNIT }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <neo-printer>
        <h1 class="text-center text-3xl text-x-black font-x-thin mb-6">
            {{ __('Reservation') . ' #' . $data->id }}
        </h1>
        <div class="w-full grid grid-rows-1 grid-cols-12 gap-8 p-4">
            <div class="w-full border border-x-shade rounded-x-thin flex flex-col gap-4 p-4 col-span-6">
                <h2 class="text-lg text-x-black font-x-huge">
                    {{ __('Billing From') }}
                </h2>
                <table>
                    <tr>
                        <td class="text-base text-x-black font-x-thin">
                            {{ __('Company') }}
                        </td>
                        <td class="text-base text-x-black text-opacity-70 font-x-thin">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-base text-x-black font-x-thin">
                            {{ __('Email') }}
                        </td>
                        <td class="text-base text-x-black text-opacity-70 font-x-thin">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-base text-x-black font-x-thin">
                            {{ __('Phone') }}
                        </td>
                        <td class="text-base text-x-black text-opacity-70 font-x-thin">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-base text-x-black font-x-thin">
                            {{ __('Address') }}
                        </td>
                        <td class="text-base text-x-black text-opacity-70 font-x-thin">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="w-full border border-x-shade bg-x-light rounded-x-thin flex flex-col gap-4 p-4 col-span-6">
                <h2 class="text-xl text-x-black font-x-thin">
                    {{ __('Billing To') }}
                </h2>
                <table>
                    <tr>
                        <td class="text-base text-x-black font-x-thin">
                            {{ __('Full Name') }}
                        </td>
                        <td class="text-base text-x-black text-opacity-70 font-x-thin">
                            {{ ucwords($data->Client->first_name) }} {{ ucwords($data->Client->last_name) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-base text-x-black font-x-thin">
                            {{ __('Identity') }}
                        </td>
                        <td class="text-base text-x-black text-opacity-70 font-x-thin">
                            {{ $data->Client->identity_type ? '(' . ucwords($data->Client->identity_type) . ')' : '' }}
                            {{ $data->Client->identity }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-base text-x-black font-x-thin">
                            {{ __('License Number') }}
                        </td>
                        <td class="text-base text-x-black text-opacity-70 font-x-thin">
                            {{ $data->Client->license_number }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-base text-x-black font-x-thin">
                            {{ __('Phone') }}
                        </td>
                        <td class="text-base text-x-black text-opacity-70 font-x-thin">
                            {{ $data->Client->phone }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-base text-x-black font-x-thin">
                            {{ __('Address') }}
                        </td>
                        <td class="text-base text-x-black text-opacity-70 font-x-thin">
                            {{ $data->Client->address ?? 'N/A' }}
                        </td>
                    </tr>
                </table>
            </div>
            @if ($data->Vehicle)
                <div class="w-full flex flex-col gap-4 col-span-8">
                    <h2 class="text-xl text-x-black font-x-thin">
                        {{ __('Vehicle Details') }}
                    </h2>
                    <div class="w-full grid grid-rows-1 grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Name') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ ucwords($data->Vehicle->name_en) }}
                            </div>
                        </div>
                        @if ($data->Vehicle->Brand)
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-x-black font-x-thin">
                                    {{ __('Brand') }}
                                </label>
                                <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                    {{ ucwords($data->Vehicle->Brand->name_en) }}
                                </div>
                            </div>
                        @endif
                        @if ($data->Vehicle->Model)
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-x-black font-x-thin">
                                    {{ __('Model') }}
                                </label>
                                <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                    {{ ucwords($data->Vehicle->Model->name_en) }}
                                </div>
                            </div>
                        @endif
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Transmission') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ ucwords($data->Vehicle->transmission) }}
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Fuel') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ ucwords($data->Vehicle->fuel) }}
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Passengers') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ $data->Vehicle->passengers }}
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Doors') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ $data->Vehicle->doors }}
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Cargo') }}
                            </label>
                            <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                                {{ $data->Vehicle->cargo }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="w-full flex flex-col gap-4 col-span-4">
                <h2 class="text-xl text-x-black font-x-thin">
                    {{ __('Duration') }}
                </h2>
                <div class="w-full grid grid-rows-1 grid-cols-1 gap-4">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Pick-up Date') }}
                        </label>
                        <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                            {{ $data->from }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Drop-off Date') }}
                        </label>
                        <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                            {{ $data->to }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Pick-up Location') }}
                        </label>
                        <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                            {{ $data->pick_up ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Drop-off Location') }}
                        </label>
                        <div class="text-x-black font-x-thin text-base px-1 pb-px border-b border-x-shade">
                            {{ $data->drop_off ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-7 block"></div>
            <div class="w-full flex flex-col gap-4 col-span-5 mt-10">
                <div class="w-full flex flex-col gap-4">
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-base text-x-black font-x-thin">
                            {{ __('Period') }}
                        </span>
                        <span class="text-lg text-x-black font-x-thin">
                            {{ $data->period }} {{ __('Days') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-base text-x-black font-x-thin">
                            {{ __('Price Per Day') }}
                        </span>
                        <span class="text-lg text-x-black font-x-thin">
                            {{ Core::formatNumber($data->price) }} {{ Core::$UNIT }}
                        </span>
                    </div>
                    <div class="h-px bg-x-shade"></div>
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-lg text-x-black font-x-thin">
                            {{ __('Total') }}
                        </span>
                        <span class="text-xl text-x-black font-x-thin">
                            {{ Core::formatNumber($data->total) }} {{ Core::$UNIT }}
                        </span>
                    </div>
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
