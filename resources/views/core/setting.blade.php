@extends('shared.core.base')
@section('title', __('Edit Settings'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Settings') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form action="{{ route('actions.core.settings') }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Period') }} (*)
                    </label>
                    <neo-select placeholder="{{ __('Period') }} (*)" name="period">
                        @foreach (Core::periodList() as $period)
                            <neo-select-item value="{{ $period }}"
                                {{ $period == Core::getSetting('period') ? 'active' : '' }}>
                                {{ __(ucwords($period)) }}
                            </neo-select-item>
                        @endforeach
                    </neo-select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Notification Email') }} (*)
                    </label>
                    <neo-textbox type="email" placeholder="{{ __('Notification Email') }} (*)" name="notify_email"
                        value="{{ Core::getSetting('notify_email') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Contact Email') }} (*)
                    </label>
                    <neo-textbox type="email" placeholder="{{ __('Contact Email') }} (*)" name="contact_email"
                        value="{{ Core::getSetting('contact_email') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Contact Phone') }} (*)
                    </label>
                    <neo-textbox type="tel" placeholder="{{ __('Contact Phone') }} (*)" name="contact_phone"
                        value="{{ Core::getSetting('contact_phone') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Print Email') }} (*)
                    </label>
                    <neo-textbox type="email" placeholder="{{ __('Print Email') }} (*)" name="print_email"
                        value="{{ Core::getSetting('print_email') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Print Phone') }} (*)
                    </label>
                    <neo-textbox type="tel" placeholder="{{ __('Print Phone') }} (*)" name="print_phone"
                        value="{{ Core::getSetting('print_phone') }}"></neo-textbox>
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
