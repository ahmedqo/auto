@extends('shared.auth.base')
@section('title', __('Login'))

@section('content')
    <div style="background-image: url({{ asset('img/bg-login.webp') }}?v={{ env('APP_VERSION') }})"
        alt="{{ env('COMPANY_NAME') }} login background image"
        class="block bg-center bg-cover bg-no-repeat fixed w-full h-[100dvh] inset-0 z-[-1] lg:w-1/2 lg:relative">
        <div class="absolute inset-0 w-full h-full bg-x-black bg-opacity-30 backdrop-blur-sm"></div>
    </div>
    <div class="w-full flex justify-center items-center p-4 lg:w-1/2">
        <div class="w-full lg:w-2/3 flex flex-col gap-4">
            <a href="{{ route('views.login.index') }}" class="block w-36 mx-auto" aria-label="login_page_link">
                <img src="{{ asset('img/logo.webp') }}?v={{ env('APP_VERSION') }}" alt="{{ env('COMPANY_NAME') }} logo image"
                    class="block w-full" width="500" height="349" loading="lazy" />
            </a>
            <form action="{{ route('actions.login.index') }}" method="POST"
                class="w-full flex flex-col gap-4 lg:gap-6 p-4 lg:p-6 bg-x-white rounded-x-huge shadow-x-core">
                @csrf
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Email') }}
                    </label>
                    <neo-textbox type="email" placeholder="{{ __('Email') }}" name="email"
                        value="{{ old('email') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Password') }}
                    </label>
                    <neo-password placeholder="{{ __('Password') }}" name="password"
                        value="{{ old('password') }}"></neo-password>
                </div>
                <neo-button
                    class="w-full px-4 py-2 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                    <span>{{ __('Login') }}</span>
                </neo-button>
                <a href="{{ route('views.blank.index') }}" aria-label="forgot_page_link"
                    class="block -mt-2 w-max mx-auto outline-none text-x-acent font-x-huge text-sm hover:text-x-prime focus:text-x-prime focus-within:text-x-prime">
                    {{ __('Forgot your password?') }}
                </a>
            </form>
        </div>
    </div>
@endsection
