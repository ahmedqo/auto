@extends('shared.core.base')
@section('title', __('New Vehicle'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('New Vehicle') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form action="{{ route('actions.vehicles.store') }}" method="POST" enctype="multipart/form-data"
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
                <div data-view="1" class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Name') }} (*)
                        </label>
                        <neo-textbox placeholder="{{ __('Name') }} (*)" name="name"
                            value="{{ old('name') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Price') }} (*)
                        </label>
                        <neo-textbox type="number" placeholder="{{ __('Price') }} (*)" name="price"
                            value="{{ old('price') }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="2" class="w-full hidden grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Passengers') }} (*)
                        </label>
                        <neo-textbox type="number" placeholder="{{ __('Passengers') }} (*)" name="passengers"
                            value="{{ old('passengers') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Milage') }} (*)
                        </label>
                        <neo-textbox type="number" placeholder="{{ __('Milage') }} (*)" name="milage"
                            value="{{ old('milage') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Doors') }} (*)
                        </label>
                        <neo-textbox type="number" placeholder="{{ __('Doors') }} (*)" name="doors"
                            value="{{ old('doors') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Cargo') }} (*)
                        </label>
                        <neo-textbox type="number" placeholder="{{ __('Cargo') }} (*)" name="cargo"
                            value="{{ old('cargo') }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="3" class="w-full hidden grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Transmission') }} (*)
                        </label>
                        <neo-select placeholder="{{ __('Transmission') }} (*)" name="transmission">
                            @foreach (Core::transmissionList() as $transmission)
                                <neo-select-item value="{{ $transmission }}"
                                    {{ $transmission == old('transmission') ? 'active' : '' }}>
                                    {{ __(ucwords($transmission)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Fuel') }} (*)
                        </label>
                        <neo-select placeholder="{{ __('Fuel') }} (*)" name="fuel">
                            @foreach (Core::fuelList() as $fuel)
                                <neo-select-item value="{{ $fuel }}" {{ $fuel == old('fuel') ? 'active' : '' }}>
                                    {{ __(ucwords($fuel)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                </div>
                <div data-view="4" class="w-full hidden grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Details') }}
                        </label>
                        <neo-textarea auto="false" placeholder="{{ __('Details') }}" name="details"
                            value="{{ old('details') }}" rows="8"></neo-textarea>
                    </div>
                </div>
                <div data-view="5" class="w-full hidden grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Image') }} (*)
                        </label>
                        <neo-imagetransfer name="images[]" class="lg:col-span-2" multiple></neo-imagetransfer>
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
        tabs();
    </script>
@endsection
