@extends('shared.core.base')
@section('title', __('Edit Settings'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Settings') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.core.settings') }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                @csrf
                @method('patch')
                <div class="w-full flex flex-row-reverse flex-wrap items-center justify-between lg:justify-around">
                    @php
                        $len = 2;
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
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Logo') }} (*)
                        </label>
                        <neo-imagetransfer name="company_logo" class="aspect-video lg:aspect-[16/4]"></neo-imagetransfer>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Period') }} (*)
                        </label>
                        <neo-select require placeholder="{{ __('Period') }} (*)" name="company_period">
                            @foreach (Core::periodList() as $period)
                                <neo-select-item value="{{ $period }}" {{ $period == $data->period ? 'active' : '' }}>
                                    {{ ucwords(__($period)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Mileage Per Day') }} (*)
                        </label>
                        <neo-textbox type="number" require placeholder="{{ __('Mileage Per Day') }} (*)"
                            name="company_mileage" value="{{ $data->mileage }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Name') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('Name') }} (*)" name="company_name"
                            value="{{ $data->name }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Ice') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('Ice') }} (*)" name="company_ice"
                            value="{{ $data->ice }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('License Number') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('License Number') }} (*)" name="company_license"
                            value="{{ $data->license }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="2" class="w-full hidden grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Email') }} (*)
                        </label>
                        <neo-textbox type="email" require placeholder="{{ __('Email') }} (*)" name="company_email"
                            value="{{ $data->email }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Phone') }} (*)
                        </label>
                        <neo-textbox type="tel" require placeholder="{{ __('Phone') }} (*)" name="company_phone"
                            value="{{ $data->phone }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('City') }} (*)
                        </label>
                        <neo-select require search placeholder="{{ __('City') }} (*)" name="company_city">
                            @foreach (Core::cityList() as $city)
                                <neo-select-item value="{{ $city }}" {{ $city == $data->city ? 'active' : '' }}>
                                    {{ ucwords(__($city)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Zipcode') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('Zipcode') }} (*)" name="company_zipcode"
                            value="{{ $data->zipcode }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Address') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('Address') }} (*)" name="company_address"
                            value="{{ $data->address }}"></neo-textbox>
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
        const imageTransfer = document.querySelector("neo-imagetransfer");
        imageTransfer.default = [{
            src: "{{ $data->Image->link }}"
        }];
        tabs();
    </script>
@endsection
