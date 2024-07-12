@extends('shared.core.base')
@section('title', __('New Reservation'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('New Reservation') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form action="{{ route('actions.reservations.store') }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @csrf
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Client') }} (*)
                    </label>
                    <neo-autocomplete set-query="name" set-value="id" placeholder="{{ __('Client') }} (*)" name="client"
                        value="{{ old('client') }}" query="{{ old('client_name') }}">
                    </neo-autocomplete>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Vehicle') }} (*)
                    </label>
                    <neo-autocomplete set-query="{{ 'name_' . Core::lang() }}" set-value="id"
                        placeholder="{{ __('Vehicle') }} (*)" name="vehicle" value="{{ old('vehicle') }}"
                        query="{{ old('vehicle_name') }}">
                    </neo-autocomplete>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 lg:col-span-2">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Pick-up Date') }} (*)
                        </label>
                        <neo-datepicker full-day="3" placeholder="{{ __('Pick-up Date') }} (*)" name="from_date"
                            value="{{ old('from_date') ?? '#now' }}" format="mmm dd"></neo-datepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Pick-up Time') }} (*)
                        </label>
                        <neo-timepicker placeholder="{{ __('Pick-up Time') }} (*)" name="from_time"
                            value="{{ old('from_time') ?? '#now' }}" format="HH:MM AA"></neo-timepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Pick-up Location') }}
                        </label>
                        <neo-textbox placeholder="{{ __('Pick-up Location') }}" name="pick_up"
                            value="{{ old('pick_up') }}"></neo-textbox>
                    </div>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 lg:col-span-2">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Drop-off Date') }} (*)
                        </label>
                        <neo-datepicker full-day="3" placeholder="{{ __('Drop-off Date') }} (*)" name="to_date"
                            value="{{ old('to_date') ?? '#now+1' }}" format="mmm dd"></neo-datepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Drop-off Time') }} (*)
                        </label>
                        <neo-timepicker placeholder="{{ __('Drop-off Time') }} (*)" name="to_time"
                            value="{{ old('to_date') ?? '#now' }}" format="HH:MM AA"></neo-timepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Drop-off Location') }}
                        </label>
                        <neo-textbox placeholder="{{ __('Drop-off Location') }}" name="drop_off"
                            value="{{ old('drop_off') }}"></neo-textbox>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Price') }}
                    </label>
                    <neo-textbox placeholder="{{ __('Price') }}" name="price" value="{{ old('price') }}"
                        disable></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Total') }}
                    </label>
                    <neo-textbox placeholder="{{ __('Total') }}" name="total"
                        value="{{ old('total') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Status') }} (*)
                    </label>
                    <neo-select placeholder="{{ __('Status') }} (*)" name="status">
                        @foreach (Core::orderList() as $status)
                            <neo-select-item value="{{ $status }}" {{ $status == old('status') ? 'active' : '' }}>
                                {{ ucwords(__($status)) }}
                            </neo-select-item>
                        @endforeach
                    </neo-select>
                </div>
                <div class="w-full flex lg:col-span-2">
                    <neo-button
                        class="w-full lg:w-max lg:px-20 lg:ms-auto px-4 py-2 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                        <span>{{ __('Save') }}</span>
                    </neo-button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        ReservationInitializer({
            Client: "{{ route('actions.clients.search') }}",
            Vehicle: "{{ route('actions.vehicles.search') }}"
        });
    </script>
@endsection
