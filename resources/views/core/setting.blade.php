@extends('shared.core.base')
@section('title', __('Edit Settings'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Settings') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6">
            <form action="{{ route('actions.core.settings') }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6">
                @csrf
                @method('patch')
                <neo-textbox type="number" label="{{ __('Rate') . ' (USD) (*)' }}" name="usd_rate"
                    value="{{ Core::getSetting('usd_rate') }}"></neo-textbox>
                <neo-textbox type="number" label="{{ __('Rate') . ' (EUR) (*)' }}" name="eur_rate"
                    value="{{ Core::getSetting('eur_rate') }}"></neo-textbox>
                <neo-select label="{{ __('Period') . ' (*)' }}" name="period">
                    @foreach (Core::periodList() as $period)
                        <neo-select-item value="{{ $period }}"
                            {{ $period == Core::getSetting('period') ? 'active' : '' }}>
                            {{ __(ucwords($period)) }}
                        </neo-select-item>
                    @endforeach
                </neo-select>
                <neo-textbox type="email" label="{{ __('Notification Email') . ' (*)' }}" name="notify_email"
                    value="{{ Core::getSetting('notify_email') }}"></neo-textbox>
                <neo-textbox type="email" label="{{ __('Contact Email') . ' (*)' }}" name="contact_email"
                    value="{{ Core::getSetting('contact_email') }}"></neo-textbox>
                <neo-textbox type="tel" label="{{ __('Contact Phone') . ' (*)' }}" name="contact_phone"
                    value="{{ Core::getSetting('contact_phone') }}"></neo-textbox>
                <neo-textbox type="email" label="{{ __('Print Email') . ' (*)' }}" name="print_email"
                    value="{{ Core::getSetting('print_email') }}"></neo-textbox>
                <neo-textbox type="tel" label="{{ __('Print Phone') . ' (*)' }}" name="print_phone"
                    value="{{ Core::getSetting('print_phone') }}"></neo-textbox>
                <neo-textbox label="{{ __('Instagram') }}" name="instagram"
                    value="{{ Core::getSetting('instagram') }}"></neo-textbox>
                <neo-textbox label="{{ __('Telegram') }}" name="telegram"
                    value="{{ Core::getSetting('telegram') }}"></neo-textbox>
                <neo-textbox label="{{ __('Facebook') }}" name="facebook"
                    value="{{ Core::getSetting('facebook') }}"></neo-textbox>
                <neo-textbox label="{{ __('Youtube') }}" name="youtube"
                    value="{{ Core::getSetting('youtube') }}"></neo-textbox>
                <neo-textbox label="{{ __('Tiktok') }}" name="tiktok"
                    value="{{ Core::getSetting('tiktok') }}"></neo-textbox>
                <neo-textbox label="{{ __('X') }}" name="x" value="{{ Core::getSetting('x') }}"></neo-textbox>
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
