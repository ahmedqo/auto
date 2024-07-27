@extends('shared.core.base')
@section('title', __('Edit Alert') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Alert') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.alerts.patch', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Vehicle') }} (*)
                    </label>
                    <neo-autocomplete require set-query="name" set-value="id" placeholder="{{ __('Vehicle') }} (*)"
                        name="vehicle" value="{{ $data->vehicle }}"
                        query="{{ $data->vehicle ? ucwords($data->Vehicle->brand) . ' ' . ucwords($data->Vehicle->model) . ' ' . $data->Vehicle->year . ' (' . strtoupper($data->Vehicle->registration) . ')' : null }}">
                    </neo-autocomplete>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Consumable') }} (*)
                    </label>
                    <neo-select require search placeholder="{{ __('Consumable') }} (*)" name="consumable">
                        @foreach (Core::consList() as $key => $array)
                            <neo-select-group label=" {{ ucwords(__($key)) }}"></neo-select-group>
                            @foreach ($array as $consumable)
                                <neo-select-item value="{{ $consumable }}"
                                    {{ $consumable == $data->consumable ? 'active' : '' }}>
                                    {{ ucwords(__($consumable)) }}
                                </neo-select-item>
                            @endforeach
                            </neo-select-group>
                        @endforeach
                    </neo-select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Recurrence') }} (*)
                    </label>
                    <neo-textbox require type="number" placeholder="{{ __('Recurrence') }}  (*)" name="recurrence"
                        value="{{ $data->recurrence }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Unit') }} (*)
                    </label>
                    <neo-select require placeholder="{{ __('Unit') }} (*)" name="unit">
                        @foreach (array_merge(Core::periodList(), ['mileage']) as $unit)
                            <neo-select-item value="{{ $unit }}" {{ $unit == $data->unit ? 'active' : '' }}>
                                {{ ucwords(__($unit)) }}
                            </neo-select-item>
                        @endforeach
                    </neo-select>
                </div>
                <div class="{{ $data->unit == 'mileage' ? 'hidden' : 'flex' }} flex-col gap-1 lg:col-span-2 date">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Date') }} (*)
                    </label>
                    <neo-datepicker {{ $data->unit == 'mileage' ? '' : 'require' }}
                        {{ !Core::lang('ar') ? 'full-day=3' : '' }} placeholder="{{ __('Date') }} (*)" name="date"
                        value="{{ $data->date ?? '#now' }}" format="dddd dd mmmm yyyy"></neo-datepicker>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Threshold') }} (*)
                    </label>
                    <neo-textbox require type="number" placeholder="{{ __('Threshold') }}  (*)" name="threshold"
                        value="{{ $data->threshold * ($data->unit == 'mileage' ? Core::company()->mileage : 1) }}"></neo-textbox>
                </div>
                <div class="w-full flex lg:col-span-2">
                    <neo-button
                        class="w-full lg:w-max lg:px-20 lg:ms-auto px-4 py-3 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                        <span>{{ __('Save') }}</span>
                    </neo-button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        AlertInitializer({
            Vehicle: "{{ route('actions.vehicles.search') }}"
        });
    </script>
@endsection
