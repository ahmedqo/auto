@extends('shared.core.base')
@section('title', __('Preview Client') . ' #' . $data->id)

@section('content')
    <div class="w-full flex flex-col gap-8">
        @if ($data->Blacklist)
            <div class="bg-red-400 text-x-white text-lg font-x-thin rounded-x-thin shadow-x-core border border-x-shade p-4">
                {{ __('This client is blacklisted') }}
                {{ $data->Blacklist->details ? __('due to') . ' "' . strtolower($data->Blacklist->details) . '"' : '' }}
            </div>
        @endif
        <div class="flex flex-col gap-2">
            <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                {{ __('Statistics') }}
            </h1>
            <ul class="w-full h-full grid grid-rows-1 grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                <li
                    class="w-full bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-4 flex gap-2 flex-col items-center lg:flex-row lg:flex-wrap col-span-2 lg:col-span-1">
                    <svg class="block w-10 h-10 pointer-events-none" style="color: #22C55E;" fill="currentcolor"
                        viewBox="0 -960 960 960">
                        <path
                            d="M222-340v-56H121v-121h202v-40H180q-24.28 0-41.64-16.8T121-615.94V-782q0-23.85 17.36-40.42Q155.72-839 180-839h42v-55h121v55h101v121H242v40h145q23.85 0 40.42 16.86Q444-644.27 444-620v166q0 23.85-16.58 40.92Q410.85-396 387-396h-44v56H222ZM573-75 380-269l91-90 102 102 216-214 90 90L573-75Z" />
                    </svg>
                    <div class="flex flex-1 flex-col items-center lg:items-end">
                        <h2 class="text-sm lg:text-base text-x-black font-x-thin">{{ __('Total') }}</h2>
                        <p class="text-base text-x-black text-opacity-50">
                            {{ Core::formatNumber($money) }} {{ Core::$UNIT }}
                        </p>
                    </div>
                </li>
                <li
                    class="w-full bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-4 flex gap-2 flex-col items-center lg:flex-row lg:flex-wrap">
                    <svg class="block w-10 h-10 pointer-events-none" style="color: #458cfe;" fill="currentcolor"
                        viewBox="0 -960 960 960">
                        <path
                            d="M210-34q-57.12 0-96.56-40.14Q74-114.28 74-170v-541q0-57.13 39.44-96.56Q152.88-847 210-847h15v-79h113v79h284v-79h113v79h15q57.13 0 96.56 39.44Q886-768.13 886-711v146q0 27.6-19.5 47.8-19.5 20.2-48 20.2T770-517.2q-20-20.2-20-47.8v-3H210v398h229q27.95 0 47.48 19.5Q506-131 506-102.5T486.48-54Q466.95-34 439-34H210Zm540.96 5q-87.58 0-149.27-61.73Q540-152.46 540-240.04q0-87.58 61.73-149.27Q663.46-451 751.04-451q87.58 0 149.27 61.73Q962-327.54 962-239.96q0 87.58-61.73 149.27Q838.54-29 750.96-29ZM818-133l39-41-77-77v-126h-57v148.72L818-133Z" />
                    </svg>
                    <div class="flex flex-1 flex-col items-center lg:items-end">
                        <h2 class="text-sm lg:text-base text-x-black font-x-thin">{{ __('Period') }}</h2>
                        <p class="text-base text-x-black text-opacity-50">
                            {{ $work }} {{ __('Days') }}
                        </p>
                    </div>
                </li>
                <li
                    class="w-full bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-4 flex gap-2 flex-col items-center lg:flex-row lg:flex-wrap">
                    <svg class="block w-10 h-10 pointer-events-none" style="color: #14B8A6;" fill="currentcolor"
                        viewBox="0 -960 960 960">
                        <path
                            d="M250-34q-74 0-125-51T74-209.53V-384h123v-542h690v716q0 74-51 125T711-34H250Zm461.5-136q16.5 0 28-11.36Q751-192.71 751-209.5V-790H333v406h338v174q0 17 12 28.5t28.5 11.5ZM373-610v-116h338v116H373Zm0 156v-116h338v116H373Z" />
                    </svg>
                    <div class="flex flex-1 flex-col items-center lg:items-end">
                        <h2 class="text-sm lg:text-base text-x-black font-x-thin">{{ __('Reservations') }}</h2>
                        <p class="text-base text-x-black text-opacity-50">
                            {{ $count }}
                        </p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="flex flex-col gap-2">
            <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                {{ __('General Info') }}
            </h1>
            <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Full Name') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ ucwords($data->first_name) }} {{ ucwords($data->last_name) }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Birth Date') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ $data->birth_date ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Nationality') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ ucwords($data->nationality ?? 'N/A') }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Identity') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ $data->identity ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Identity Type') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ ucwords($data->identity_type ?? 'N/A') }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('License Number') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ $data->license_number ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Gender') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ ucwords($data->gender ?? 'N/A') }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Phone') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ $data->phone ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Email') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ $data->email ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 lg:col-span-3">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Address') }}
                        </label>
                        <div
                            class="text-x-black font-x-thin text-base px-4 py-2 rounded-x-thin bg-x-light border border-x-shade">
                            {{ $data->address ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col items-center lg:flex-row lg:justify-between gap-2">
                <h2 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                    {{ __('Income Visualization') }}
                </h2>
                <div class="w-max flex gap-2">
                    <button id="printer" title="{{ __('Print') }}"
                        class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M741-701H220v-160h521v160Zm-17 236q18 0 29.5-10.812Q765-486.625 765-504.5q0-17.5-11.375-29.5T724.5-546q-18.5 0-29.5 12.062-11 12.063-11 28.938 0 18 11 29t29 11Zm-75 292v-139H311v139h338Zm92 86H220v-193H60v-264q0-53.65 36.417-91.325Q132.833-673 186-673h588q54.25 0 90.625 37.675T901-544v264H741v193Z" />
                        </svg>
                    </button>
                    <a id="download" download title="{{ __('Download') }}"
                        class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M253-138q-95 0-163.5-67.5T21-370q0-82 51-148t132-79q23-90 89-150t154-72v372l-78-80-49 49 161 163 161-163-48-49-78 80v-372q103 13 174 91t77 187v24q75 8 123.5 60.5T939-327q0 79-55 134t-134 55H253Z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div
                class="w-full aspect-video bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-4 relative overflow-hidden">
                <canvas id="line" class="w-full h-full"></canvas>
                <div class="w-full h-full absolute inset-0 bg-x-white flex items-center justify-center">
                    <neo-loader></neo-loader>
                </div>
            </div>
            <neo-printer>
                @include('shared.page.print')
                <h1 id="main-title">{{ __('Income Visualization') }}</h1>
                <p class="text-center text-x-black font-x-thin">
                    ({{ $startDate }} / {{ $endDate }})
                </p>
                <img id="chart-viewer">
            </neo-printer>
        </div>
        <neo-datavisualizer id="reservations" print search filter download title="{{ __('Reservations List') }}">
            @include('shared.page.print')
        </neo-datavisualizer>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        SceneInitializer({
            Search: [
                ["#reservations", "client_reservation",
                    "{{ route('actions.clients.reservations', $data->id) }}"
                ]
            ],
            Data: "{{ route('actions.clients.chart', $data->id) }}",
            Line: document.querySelector("#line"),
        });
    </script>
@endsection
