@extends('shared.core.base')
@section('title', __('Edit Agency') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Agency') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.agencies.patch', $data->id) }}" method="POST"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Name') }} (*)
                    </label>
                    <neo-textbox require placeholder="{{ __('Name') }} (*)" name="name"
                        value="{{ $data->name }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Phone') }} (*)
                    </label>
                    <neo-textbox require type="tel" placeholder="{{ __('Phone') }} (*)" name="phone"
                        value="{{ $data->phone }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Secondary Phone') }}
                    </label>
                    <neo-textbox type="tel" placeholder="{{ __('Secondary Phone') }}" name="secondary_phone"
                        value="{{ $data->secondary_phone }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Email') }} (*)
                    </label>
                    <neo-textbox require type="email" placeholder="{{ __('Email') }} (*)" name="email"
                        value="{{ $data->email }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Address') }} (*)
                    </label>
                    <neo-textarea require auto="false" placeholder="{{ __('Address') }} (*)" name="address"
                        value="{{ $data->address }}" rows="2"></neo-textarea>
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
