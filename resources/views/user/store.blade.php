@extends('shared.core.base')
@section('title', __('New User'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('New User') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form action="{{ route('actions.users.store') }}" method="POST"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @csrf
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('First Name') }} (*)
                    </label>
                    <neo-textbox placeholder="{{ __('First Name') }} (*)" name="first_name"
                        value="{{ old('first_name') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Last Name') }} (*)
                    </label>
                    <neo-textbox placeholder="{{ __('Last Name') }} (*)" name="last_name"
                        value="{{ old('last_name') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Email') }} (*)
                    </label>
                    <neo-textbox type="email" placeholder="{{ __('Email') }} (*)" name="email"
                        value="{{ old('email') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Phone') }} (*)
                    </label>
                    <neo-textbox type="tel" placeholder="{{ __('Phone') }} (*)" name="phone"
                        value="{{ old('phone') }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Gender') }}
                    </label>
                    <neo-select placeholder="{{ __('Gender') }}" name="gender">
                        @foreach (Core::genderList() as $gender)
                            <neo-select-item value="{{ $gender }}" {{ $gender == old('gender') ? 'active' : '' }}>
                                {{ ucwords(__($gender)) }}
                            </neo-select-item>
                        @endforeach
                    </neo-select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Birth Date') }}
                    </label>
                    <neo-datepicker {{ !Core::lang('ar') ? 'full-day=3' : '' }} placeholder="{{ __('Birth Date') }}"
                        name="birth_date" format="dddd dd mmmm yyyy" value="{{ old('birth_date') }}"></neo-datepicker>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Address') }}
                    </label>
                    <neo-textarea auto="false" placeholder="{{ __('Address') }}" name="address"
                        value="{{ old('address') }}" rows="2"></neo-textarea>
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
