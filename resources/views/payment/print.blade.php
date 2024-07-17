@extends('shared.core.base')
@section('title', __('Preview Payment') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <div class="flex flex-col items-center lg:flex-row lg:justify-between gap-2">
            <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                {{ __('Preview Payment') . ' #' . $data->id }}
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
                <div class="w-full flex flex-col gap-4 lg:col-span-8">
                    <h2 class="text-xl text-x-black font-x-thin">
                        {{ __('Payments') }}
                    </h2>
                    <div class="border border-x-shade rounded-x-thin overflow-auto">
                        <table class="min-w-full rounded-x-thin">
                            <thead class="bg-x-light">
                                <tr>
                                    <td class="w-[20px] ps-8 px-4 py-2 text-base font-x-huge text-x-black text-center">
                                        {{ __('Id') }}
                                    </td>
                                    <td></td>
                                    <td class="w-[160px] pe-8 px-4 py-2 text-base font-x-huge text-x-black text-center">
                                        {{ __('Amount') }}
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(json_decode($data->payment) as $row)
                                    <tr class="border-t border-t-x-shade">
                                        <td class="w-[20px] ps-8 p-4 text-base font-x-huge text-x-black text-center">
                                            #{{ $loop->index + 1 }}
                                        </td>
                                        <td></td>
                                        <td class="w-[160px] pe-8 px-4 py-2 text-lg text-x-black text-center">
                                            {{ Core::formatNumber($row) }} {{ Core::$UNIT }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="border-t border-t-x-shade">
                                        <td colspan="3" class="px-8 py-4 text-lg text-x-black font-x-huge text-center">
                                            {{ __('No Data Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-4 lg:col-span-4 mt-10">
                    <div class="w-full flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-base text-x-black font-x-thin">
                                {{ __('Total') }}
                            </span>
                            <span class="text-xl text-x-black font-x-thin">
                                {{ Core::formatNumber($data->total) }} {{ Core::$UNIT }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-base text-x-black font-x-thin">
                                {{ __('Payment') }}
                            </span>
                            <span class="text-xl text-x-black font-x-thin">
                                {{ Core::formatNumber(array_sum(json_decode($data->payment))) }} {{ Core::$UNIT }}
                            </span>
                        </div>
                        <div class="h-px bg-x-shade"></div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-base text-x-black font-x-thin">
                                {{ __('Creance') }}
                            </span>
                            <span class="text-xl text-x-black font-x-thin">
                                {{ Core::formatNumber($data->total - array_sum(json_decode($data->payment))) }}
                                {{ Core::$UNIT }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <neo-printer>
        <h1 class="text-center text-3xl text-x-black font-x-thin mb-6">
            {{ __('Payment') . ' #' . $data->id }}
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
            <div class="w-full flex flex-col gap-4 col-span-8">
                <h2 class="text-xl text-x-black font-x-thin">
                    {{ __('Payments') }}
                </h2>
                <div class="border border-x-shade rounded-x-thin overflow-auto">
                    <table class="min-w-full rounded-x-thin">
                        <thead class="bg-x-light">
                            <tr>
                                <td class="w-[20px] ps-8 px-4 py-2 text-base font-x-huge text-x-black text-center">
                                    {{ __('Id') }}
                                </td>
                                <td></td>
                                <td class="w-[160px] pe-8 px-4 py-2 text-base font-x-huge text-x-black text-center">
                                    {{ __('Amount') }}
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(json_decode($data->payment) as $row)
                                <tr class="border-t border-t-x-shade">
                                    <td class="w-[20px] ps-8 p-4 text-base font-x-huge text-x-black text-center">
                                        #{{ $loop->index + 1 }}
                                    </td>
                                    <td></td>
                                    <td class="w-[160px] pe-8 px-4 py-2 text-lg text-x-black text-center">
                                        {{ Core::formatNumber($row) }} {{ Core::$UNIT }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-t border-t-x-shade">
                                    <td colspan="3" class="px-8 py-4 text-lg text-x-black font-x-huge text-center">
                                        {{ __('No Data Found') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-full flex flex-col gap-4 col-span-4 mt-10">
                <div class="w-full flex flex-col gap-4">
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-base text-x-black font-x-thin">
                            {{ __('Total') }}
                        </span>
                        <span class="text-xl text-x-black font-x-thin">
                            {{ Core::formatNumber($data->total) }} {{ Core::$UNIT }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-base text-x-black font-x-thin">
                            {{ __('Payment') }}
                        </span>
                        <span class="text-xl text-x-black font-x-thin">
                            {{ Core::formatNumber(array_sum(json_decode($data->payment))) }} {{ Core::$UNIT }}
                        </span>
                    </div>
                    <div class="h-px bg-x-shade"></div>
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-base text-x-black font-x-thin">
                            {{ __('Creance') }}
                        </span>
                        <span class="text-xl text-x-black font-x-thin">
                            {{ Core::formatNumber($data->total - array_sum(json_decode($data->payment))) }}
                            {{ Core::$UNIT }}
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
