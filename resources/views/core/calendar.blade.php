@extends('shared.core.base')
@section('title', __('Calendar'))

@section('content')
    <div class="w-full flex flex-col gap-8">
        <div class="flex flex-col gap-2">
            <div class="flex flex-col items-center lg:flex-row lg:justify-between gap-2">
                <h2 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                    {{ __('Calendar') }}
                </h2>
                <div class="tools w-max flex gap-2">
                </div>
            </div>
            <div class="w-full aspect-video">
                <div id="calendar"></div>
                <div class="w-full aspect-video bg-x-white flex items-center justify-center">
                    <neo-loader></neo-loader>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/locales-all.global.min.js"></script>
    <script>
        CalendarInitializer({
            Data: "{{ route('actions.core.calendar') }}",
            Calendar: document.querySelector("#calendar")
        });
    </script>
@endsection
