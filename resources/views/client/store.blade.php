@extends('shared.core.base')
@section('title', __('New Client'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('New Client') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.clients.store') }}" method="POST"
                class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                @csrf
                <div class="w-full flex flex-row-reverse flex-wrap items-center justify-between lg:justify-around">
                    @php
                        $len = 5;
                    @endphp
                    @for ($i = $len; $i > 0; $i--)
                        <button type="button" data-tabs={{ $i }}
                            class="flex items-center justify-center text-x-black font-x-huge text-lg w-8 h-8 lg:w-14 lg:h-14 bg-x-white rounded-full outline outline-4 outline-x-light {{ $i == 1 ? 'active' : '' }}">
                            <span>{{ $i }}</span>
                            <svg class="block w-4 h-4 lg:w-8 lg:h-8 pointer-events-none" fill="currentcolor"
                                viewBox="0 -960 960 960">
                                <path d="M378-225 133-470l66-66 179 180 382-382 66 65-448 448Z" />
                            </svg>
                        </button>
                        @if ($i > 1)
                            <div class="flex-1 h-1 bg-x-light"></div>
                        @endif
                    @endfor
                </div>
                <div data-view="1" class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('First Name') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('First Name') }} (*)" name="first_name"
                            value="{{ old('first_name') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Last Name') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('Last Name') }} (*)" name="last_name"
                            value="{{ old('last_name') }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="2" class="w-full hidden grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Nationality') }} (*)
                        </label>
                        <neo-select search require placeholder="{{ __('Nationality') }} (*)" name="nationality">
                            @foreach (Core::nationList() as $nationality)
                                <neo-select-item value="{{ $nationality }}"
                                    {{ $nationality == (old('nationality') ?? 'moroccan') ? 'active' : '' }}>
                                    {{ ucwords(__($nationality)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Gender') }} (*)
                        </label>
                        <neo-select require placeholder="{{ __('Gender') }} (*)" name="gender">
                            @foreach (Core::genderList() as $gender)
                                <neo-select-item value="{{ $gender }}"
                                    {{ $gender == old('gender') ? 'active' : '' }}>
                                    {{ ucwords(__($gender)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Birth Date') }} (*)
                        </label>
                        <neo-datepicker require {{ !Core::lang('ar') ? 'full-day=3' : '' }}
                            placeholder="{{ __('Birth Date') }} (*)" name="birth_date" format="dddd dd mmmm yyyy"
                            value="{{ old('birth_date') }}"></neo-datepicker>
                    </div>
                </div>
                <div data-view="3" class="w-full hidden grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Identity Type') }} (*)
                        </label>
                        <neo-select require placeholder="{{ __('Identity Type') }} (*)" name="identity_type">
                            @foreach (Core::identityList() as $identity_type)
                                <neo-select-item value="{{ $identity_type }}"
                                    {{ $identity_type == old('identity_type') ? 'active' : '' }}>
                                    {{ ucwords(__($identity_type)) }}
                                </neo-select-item>
                            @endforeach
                        </neo-select>
                    </div>
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Identity') }} (*)
                        </label>
                        <neo-textbox require id="identity" placeholder="{{ __('Identity') }} (*)" name="identity"
                            value="{{ old('identity') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Identity Location') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('Identity Location') }} (*)" name="identity_location"
                            value="{{ old('identity_location') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Identity Production Date') }} (*)
                        </label>
                        <neo-datepicker require {{ !Core::lang('ar') ? 'full-day=3' : '' }}
                            placeholder="{{ __('Identity Production Date') }} (*)" name="identity_date"
                            format="dddd dd mmmm yyyy" value="{{ old('identity_date') }}"></neo-datepicker>
                    </div>
                </div>
                <div data-view="4" class="w-full hidden grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('License Number') }} (*)
                        </label>
                        <neo-textbox require id="license" placeholder="{{ __('License Number') }} (*)"
                            name="license_number" value="{{ old('license_number') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('License Location') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('License Location') }} (*)" name="license_location"
                            value="{{ old('license_location') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('License Production Date') }} (*)
                        </label>
                        <neo-datepicker require {{ !Core::lang('ar') ? 'full-day=3' : '' }}
                            placeholder="{{ __('License Production Date') }} (*)" name="license_date"
                            format="dddd dd mmmm yyyy" value="{{ old('license_date') }}"></neo-datepicker>
                    </div>
                </div>
                <div data-view="5" class="w-full hidden grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Phone') }} (*)
                        </label>
                        <neo-textbox require type="tel" placeholder="{{ __('Phone') }} (*)" name="phone"
                            value="{{ old('phone') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Email') }} (*)
                        </label>
                        <neo-textbox require type="email" placeholder="{{ __('Email') }} (*)" name="email"
                            value="{{ old('email') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Address') }} (*)
                        </label>
                        <neo-textarea require auto="false" placeholder="{{ __('Address') }} (*)" name="address"
                            value="{{ old('address') }}" rows="2"></neo-textarea>
                    </div>
                </div>
                <div class="w-full flex">
                    <neo-button type="button" id="next"
                        class="w-full lg:w-max lg:px-20 lg:ms-auto px-4 py-3 text-base lg:text-lg font-x-huge text-x-prime outline outline-2 border-x-prime hover:text-x-white focus-within:text-x-white transition-none"
                        outline>
                        <span>{{ __('Next') }}</span>
                    </neo-button>
                    <neo-button id="save"
                        class="w-full hidden lg:w-max lg:px-20 lg:ms-auto px-4 py-3 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                        <span>{{ __('Save') }}</span>
                    </neo-button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        [document.querySelector("#identity"), document.querySelector("#license")].forEach(el => {
            el.addEventListener("keyup", e => {
                e.target.value = e.target.value.replace(/\s*/g, '');
            });
        });
        tabs();
    </script>
@endsection
