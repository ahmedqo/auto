@extends('shared.core.base')
@section('title', __('Edit User') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit User') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6">
            <form action="{{ route('actions.users.patch', $data->id) }}" method="POST"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('First Name') }} (*)
                    </label>
                    <neo-textbox placeholder="{{ __('First Name') }} (*)" name="first_name"
                        value="{{ $data->first_name }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Last Name') }} (*)
                    </label>
                    <neo-textbox placeholder="{{ __('Last Name') }} (*)" name="last_name"
                        value="{{ $data->last_name }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Email') }} (*)
                    </label>
                    <neo-textbox type="email" placeholder="{{ __('Email') }} (*)" name="email"
                        value="{{ $data->email }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Phone') }} (*)
                    </label>
                    <neo-textbox type="tel" placeholder="{{ __('Phone') }} (*)" name="phone"
                        value="{{ $data->phone }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Gender') }}
                    </label>
                    <neo-select placeholder="{{ __('Gender') }}" name="gender">
                        @foreach (Core::genderList() as $gender)
                            <neo-select-item value="{{ $gender }}" {{ $gender == $data->gender ? 'active' : '' }}>
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
                        name="birth_date" format="dddd dd mmmm yyyy" value="{{ $data->birth_date }}"></neo-datepicker>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Address') }}
                    </label>
                    <neo-textarea placeholder="{{ __('Address') }}" name="address"
                        value="{{ $data->address }}"></neo-textarea>
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
