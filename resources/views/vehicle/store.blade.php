@extends('shared.core.base')
@section('title', __('New Vehicle'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('New Vehicle') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.vehicles.store') }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                @csrf
                <div class="w-full flex flex-row-reverse flex-wrap items-center justify-between lg:justify-around">
                    @php
                        $len = 5;
                    @endphp
                    @for ($i = $len; $i > 0; $i--)
                        <button type="button" data-tabs={{ $i }}
                            class="flex items-center justify-center text-x-black font-x-huge text-lg w-8 h-8 lg:w-14 lg:h-14 bg-x-white rounded-full outline outline-4 outline-x-light {{ $i == 1 ? 'active' : '' }}">
                            <span>{{ $i }}</span>
                            <svg class="block w-4 h-4 lg:w-8 lg:h-8 pointer-events-none" fill="currentcolor"
                                viewBox="0 -960 960 960">
                                <path d="M378-225 133-470l66-66 179 180 382-382 66 65-448 448Z" />
                            </svg>
                        </button>
                        @if ($i > 1)
                            <div class="flex-1 h-1 bg-x-light"></div>
                        @endif
                    @endfor
                </div>
                <div data-view="1" class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1 lg:col-span-3">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Registration Type') }} (*)
                        </label>
                        <neo-select require placeholder="{{ __('Registration Type') }} (*)" name="registration_type">
                            <neo-select-item value="WW" {{ 'WW' == old('registration_type') ? 'active' : '' }}>
                                WW
                            </neo-select-item>
                            <neo-select-item value="vehicle" {{ 'vehicle' == old('registration_type') ? 'active' : '' }}>
                                {{ __('Vehicle') }}
                            </neo-select-item>
                        </neo-select>
                    </div>
                    <div class="reg hidden flex-col gap-1 lg:col-span-3">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Registration Number') }} (*)
                        </label>
                        <div
                            class="{{ old('registration_type') == 'WW' ? 'flex' : 'hidden' }} ww overflow-hidden rounded-x-thin bg-x-light border border-x-shade">
                            <neo-textbox class="flex-1 border-0 rounded-none border-e border-e-x-shade end-text"
                                name="ww_start" value="WW" disable></neo-textbox>
                            <neo-textbox {{ old('registration_type') == 'WW' ? 'require' : '' }} type="number"
                                class="field flex-[2] border-0 rounded-none" placeholder="XXXXX (*)" name="ww_end"
                                value="{{ old('ww_end') }}"></neo-textbox>
                        </div>
                        <div
                            class="{{ old('registration_type') == 'vehicle' ? 'flex' : 'hidden' }} vehicle rounded-x-thin bg-x-light border border-x-shade">
                            <neo-textbox {{ old('registration_type') == 'vehicle' ? 'required' : '' }} type="number"
                                class="field flex-1 border-0 rounded-none rounded-s-x-thin" placeholder="XXXX (*)"
                                name="vv_start" value="{{ old('vv_start') }}"></neo-textbox>
                            <neo-select {{ old('registration_type') == 'vehicle' ? 'required' : '' }} placeholder="X (*)"
                                name="vv_middle" class="field flex-1 border-y-0 rounded-none">
                                @foreach (['ا', 'ب', 'د', 'ه', 'و', 'ط'] as $char)
                                    <neo-select-item value="{{ $char }}"
                                        {{ $char == old('vv_middle') ? 'active' : '' }}>
                                        {{ $char }}
                                    </neo-select-item>
                                @endforeach
                            </neo-select>
                            <neo-textbox {{ old('registration_type') == 'vehicle' ? 'required' : '' }} type="number"
                                class="field flex-1 border-0 rounded-none rounded-e-x-thin" placeholder="XX (*)"
                                name="vv_end" value="{{ old('vv_end') }}"></neo-textbox>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Year') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Year') }} (*)" name="year"
                            value="{{ old('year') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Brand') }} (*)
                        </label>
                        <neo-select require search placeholder="{{ __('Brand') }} (*)" name="brand">
                            @foreach (array_keys(Core::brandList()) as $brand)
                                <neo-select-item value="{{ $brand }}" {{ $brand == old('brand') ? 'active' : '' }}>
                                    {{ ucwords(__($brand)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Model') }} (*)
                        </label>
                        <neo-select {{ old('model') && old('brand') ? '' : 'disable' }} require search
                            placeholder="{{ __('Model') }} (*)" name="model">
                            @if (old('model') && old('brand'))
                                @foreach (Core::brandList()[old('brand')] as $model)
                                    <neo-select-item value="{{ $model }}"
                                        {{ $model == old('model') ? 'active' : '' }}>
                                        {{ ucwords(__($model)) }}
                                    </neo-select-item>
                                @endforeach
                            @endif
                        </neo-select>
                    </div>
                </div>
                <div data-view="2" class="w-full hidden grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Transmission') }} (*)
                        </label>
                        <neo-select require placeholder="{{ __('Transmission') }} (*)" name="transmission">
                            @foreach (Core::transmissionList() as $transmission)
                                <neo-select-item value="{{ $transmission }}"
                                    {{ $transmission == old('transmission') ? 'active' : '' }}>
                                    {{ ucwords(__($transmission)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Passengers') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Passengers') }} (*)" name="passengers"
                            value="{{ old('passengers') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Doors') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Doors') }} (*)" name="doors"
                            value="{{ old('doors') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Cargo') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Cargo') }} (*)" name="cargo"
                            value="{{ old('cargo') }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="3" class="w-full hidden grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Circulation Date') }} (*)
                        </label>
                        <neo-datepicker require {{ !Core::lang('ar') ? 'full-day=3' : '' }}
                            placeholder="{{ __('Circulation Date') }} (*)" name="circulation"
                            value="{{ old('circulation') ?? '#now' }}" format="dddd dd mmmm yyyy"></neo-datepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Mileage') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Mileage') }} (*)" name="mileage"
                            value="{{ old('mileage') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Price') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Price') }} (*)" name="price"
                            value="{{ old('price') }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="4" class="w-full hidden grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Fuel') }} (*)
                        </label>
                        <neo-select require placeholder="{{ __('Fuel') }} (*)" name="fuel">
                            @foreach (Core::fuelList() as $fuel)
                                <neo-select-item value="{{ $fuel }}" {{ $fuel == old('fuel') ? 'active' : '' }}>
                                    {{ ucwords(__($fuel)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Horse Power') }} (*)
                        </label>
                        <neo-select require placeholder="{{ __('Horse Power') }} (*)" name="horsepower">
                            @foreach (Core::powerList() as $power)
                                <neo-select-item value="{{ $power }}"
                                    {{ $power == old('horsepower') ? 'active' : '' }}>
                                    {{ ucwords(__($power)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Horse Power Tax') }} (*)
                        </label>
                        <neo-textbox require id="tax" type="number" placeholder="{{ __('Tax') }} (*)"
                            name="horsepower_tax" value="{{ old('horsepower_tax') }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="5" class="w-full hidden grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Insurance') }} (*)
                        </label>
                        <neo-select require placeholder="{{ __('Insurance') }} (*)" name="insurance">
                            @foreach (Core::insuranceList() as $insurance)
                                <neo-select-item value="{{ $insurance }}"
                                    {{ $insurance == old('insurance') ? 'active' : '' }}>
                                    {{ ucwords(__($insurance)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Insurance Cost') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Insurance Cost') }} (*)"
                            name="insurance_cost" value="{{ old('insurance_cost') }}"></neo-textbox>
                    </div>
                </div>
                <div class="w-full flex">
                    <neo-button type="button" id="next"
                        class="w-full lg:w-max lg:px-20 lg:ms-auto px-4 py-3 text-base lg:text-lg font-x-huge text-x-prime outline outline-2 border-x-prime hover:text-x-white focus-within:text-x-white transition-none"
                        outline>
                        <span>{{ __('Next') }}</span>
                    </neo-button>
                    <neo-button id="save"
                        class="w-full hidden lg:w-max lg:px-20 lg:ms-auto px-4 py-3 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                        <span>{{ __('Save') }}</span>
                    </neo-button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        VehicleInitializer();
    </script>
@endsection
