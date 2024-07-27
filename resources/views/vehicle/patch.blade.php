@extends('shared.core.base')
@section('title', __('Edit Vehicle') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Vehicle') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.vehicles.patch', $data->id) }}" method="POST"
                enctype="multipart/form-data" class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                @csrf
                @method('patch')
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
                <div data-view="1" class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Registration') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('Registration') }} (*)" name="registration"
                            value="{{ $data->registration }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Year') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Year') }} (*)" name="year"
                            value="{{ $data->year }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Brand') }} (*)
                        </label>
                        <neo-select require search placeholder="{{ __('Brand') }} (*)" name="brand">
                            @foreach (array_keys(Core::brandList()) as $brand)
                                <neo-select-item value="{{ $brand }}" {{ $brand == $data->brand ? 'active' : '' }}>
                                    {{ ucwords(__($brand)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Model') }} (*)
                        </label>
                        <neo-select require search placeholder="{{ __('Model') }} (*)" name="model">
                            @foreach (Core::brandList()[$data->brand] as $model)
                                <neo-select-item value="{{ $model }}" {{ $model == $data->model ? 'active' : '' }}>
                                    {{ ucwords(__($model)) }}
                                </neo-select-item>
                            @endforeach
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
                                    {{ $transmission == $data->transmission ? 'active' : '' }}>
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
                            value="{{ $data->passengers }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Doors') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Doors') }} (*)" name="doors"
                            value="{{ $data->doors }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Cargo') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Cargo') }} (*)" name="cargo"
                            value="{{ $data->cargo }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="3" class="w-full hidden grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Circulation Date') }} (*)
                        </label>
                        <neo-datepicker require {{ !Core::lang('ar') ? 'full-day=3' : '' }}
                            placeholder="{{ __('Circulation Date') }} (*)" name="circulation"
                            value="{{ $data->circulation ?? '#now' }}" format="dddd dd mmmm yyyy"></neo-datepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Mileage') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Mileage') }} (*)" name="mileage"
                            value="{{ $data->mileage }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Price') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Price') }} (*)" name="price"
                            value="{{ $data->price }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="4" class="w-full hidden grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Fuel') }} (*)
                        </label>
                        <neo-select require placeholder="{{ __('Fuel') }} (*)" name="fuel">
                            @foreach (Core::fuelList() as $fuel)
                                <neo-select-item value="{{ $fuel }}" {{ $fuel == $data->fuel ? 'active' : '' }}>
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
                                    {{ $power == $data->horsepower ? 'active' : '' }}>
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
                            name="horsepower_tax" value="{{ $data->horsepower_tax }}"></neo-textbox>
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
                                    {{ $insurance == $data->insurance ? 'active' : '' }}>
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
                            name="insurance_cost" value="{{ $data->insurance_cost }}"></neo-textbox>
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
