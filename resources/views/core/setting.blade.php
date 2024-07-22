@extends('shared.core.base')
@section('title', __('Edit Settings'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Settings') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.core.settings') }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Period') }} (*)
                    </label>
                    <neo-select require placeholder="{{ __('Period') }} (*)" name="period">
                        @foreach (Core::periodList() as $period)
                            <neo-select-item value="{{ $period }}"
                                {{ $period == Core::company()->period ? 'active' : '' }}>
                                {{ ucwords(__($period)) }}
                            </neo-select-item>
                        @endforeach
                    </neo-select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Milage Per Day') }} (*)
                    </label>
                    <neo-textbox type="number" require placeholder="{{ __('Milage Per Day') }} (*)" name="milage"
                        value="{{ Core::company()->milage }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Company Name') }} (*)
                    </label>
                    <neo-textbox require placeholder="{{ __('Company Name') }} (*)" name="name"
                        value="{{ Core::company()->name }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Email') }} (*)
                    </label>
                    <neo-textbox type="email" require placeholder="{{ __('Email') }} (*)" name="email"
                        value="{{ Core::company()->email }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Phone') }} (*)
                    </label>
                    <neo-textbox type="tel" require placeholder="{{ __('Phone') }} (*)" name="phone"
                        value="{{ Core::company()->phone }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Address') }} (*)
                    </label>
                    <neo-textarea auto="false" require placeholder="{{ __('Address') }} (*)" name="address"
                        value="{{ Core::company()->address }}" rows="2"></neo-textarea>
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
