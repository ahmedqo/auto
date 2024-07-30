@extends('shared.core.base')
@section('title', __('New Agency'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('New Agency') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.agencies.store') }}" method="POST"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @csrf
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Name') }} (*)
                    </label>
                    <neo-textbox require placeholder="{{ __('Name') }} (*)" name="name"
                        value="{{ old('name') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Phone') }} (*)
                    </label>
                    <neo-textbox require type="tel" placeholder="{{ __('Phone') }} (*)" name="phone"
                        value="{{ old('phone') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Secondary Phone') }}
                    </label>
                    <neo-textbox type="tel" placeholder="{{ __('Secondary Phone') }}" name="secondary_phone"
                        value="{{ old('secondary_phone') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Email') }} (*)
                    </label>
                    <neo-textbox require type="email" placeholder="{{ __('Email') }} (*)" name="email"
                        value="{{ old('email') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Address') }} (*)
                    </label>
                    <neo-textarea require auto="false" placeholder="{{ __('Address') }} (*)" name="address"
                        value="{{ old('address') }}" rows="2"></neo-textarea>
                </div>
                <div class="w-full flex lg:col-span-2">
                    <neo-button id="save"
                        class="w-full lg:w-max lg:px-20 lg:ms-auto px-4 py-3 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                        <span>{{ __('Save') }}</span>
                    </neo-button>
                </div>
            </form>
        </div>
    </div>
@endsection
