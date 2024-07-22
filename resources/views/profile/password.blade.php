@extends('shared.core.base')
@section('title', __('Update Password'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Update Password') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.password.patch') }}" method="POST"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Old Password') }}
                    </label>
                    <neo-password require placeholder="{{ __('Old Password') }} (*)" name="old_password"
                        value="{{ old('old_password') }}"></neo-password>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('New Password') }}
                    </label>
                    <neo-password require placeholder="{{ __('New Password') }} (*)" name="new_password"
                        value="{{ old('new_password') }}"></neo-password>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Confirm Password') }}
                    </label>
                    <neo-password require placeholder="{{ __('Confirm Password') }} (*)" name="confirm_password"
                        value="{{ old('confirm_password') }}"></neo-password>
                </div>
                <div class="w-full flex lg:col-span-2">
                    <neo-button
                        class="w-full lg:w-max lg:px-20 lg:ms-auto px-4 py-3 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                        <span>{{ __('Save') }}</span>
                    </neo-button>
                </div>
            </form>
        </div>
    </div>
@endsection
