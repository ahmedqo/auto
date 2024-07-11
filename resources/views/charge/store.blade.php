@extends('shared.core.base')
@section('title', __('New Charge'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('New Charge') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6">
            <form action="{{ route('actions.charges.store') }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-2 gap-6">
                @csrf
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Vehicle') }} (*)
                    </label>
                    <neo-autocomplete set-query="{{ 'name_' . Core::lang() }}" set-value="id"
                        placeholder="{{ __('Vehicle') }} (*)" name="vehicle" value="{{ old('vehicle') }}"
                        query="{{ old('vehicle_name') }}">
                    </neo-autocomplete>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Name') }} (*)
                    </label>
                    <neo-textbox placeholder="{{ __('Name') }} (*)" name="name"
                        value="{{ old('name') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Cost') }} (*)
                    </label>
                    <neo-textbox type="number" placeholder="{{ __('Cost') }} (*)" name="cost"
                        value="{{ old('cost') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Details') }} (*)
                    </label>
                    <neo-textarea auto="false" placeholder="{{ __('Details') }}" name="details"
                        value="{{ old('details') }}" rows="8"></neo-textarea>
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
        ChargeInitializer({
            Search: "{{ route('actions.vehicles.search') }}"
        });
    </script>
@endsection
