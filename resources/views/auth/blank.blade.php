@extends('shared.auth.base')
@section('title', __('Forgot Password'))

@section('content')
    <div class="w-full flex justify-center items-center p-4 lg:w-1/2">
        <div class="w-full lg:w-2/3 flex flex-col gap-4">
            <a href="{{ route('views.login.index') }}" class="block w-36 mx-auto" aria-label="login_page_link">
                <img src="{{ asset('img/logo.webp') }}?v={{ env('APP_VERSION') }}" alt="{{ env('COMPANY_NAME') }} logo image"
                    class="block w-full" width="500" height="349" loading="lazy" />
            </a>
            <form require action="{{ route('actions.blank.index') }}" method="POST"
                class="w-full flex flex-col gap-6 lg:gap-8 p-6 lg:p-8 bg-x-white rounded-x-huge shadow-x-core">
                <p class="text-base text-x-black">
                    {{ __('Forgot your password? No problem. Just tell us your email, and we will send you a link that will allow you to choose a new password') }}
                </p>
                @csrf
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Email') }}
                    </label>
                    <neo-textbox type="email" placeholder="{{ __('Email') }}" name="email"
                        value="{{ old('email') }}"></neo-textbox>
                </div>
                <neo-button
                    class="w-full px-4 py-3 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                    <span>{{ __('Send') }}</span>
                </neo-button>
            </form>
        </div>
    </div>
    <div style="background-image: url({{ asset('img/bg-blank.webp') }}?v={{ env('APP_VERSION') }})"
        alt="{{ env('COMPANY_NAME') }} blank background image"
        class="block bg-center bg-cover bg-no-repeat fixed w-full h-[100dvh] inset-0 z-[-1] lg:w-1/2 lg:relative">
        <div class="absolute inset-0 w-full h-full bg-x-black bg-opacity-30 backdrop-blur-sm"></div>
    </div>
@endsection
