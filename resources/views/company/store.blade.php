@extends('shared.company.base')
@section('title', __('Subscribe'))

@section('content')
    <div class="flex flex-col gap-6">
        <h1 class="text-center text-2xl lg:text-4xl text-x-black font-x-thin">
            {{ __('Subscribe') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.companies.store') }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                @csrf
                <div class="w-full flex flex-row-reverse flex-wrap items-center justify-between lg:justify-around">
                    <button type="button" data-tabs="2"
                        class="flex items-center justify-center text-x-black font-x-huge text-lg px-4 py-2 bg-x-white rounded-x-thin outline outline-4 outline-x-light">
                        <span>{{ __('User') }}</span>
                        <svg class="block w-4 h-4 lg:w-8 lg:h-8 pointer-events-none" fill="currentcolor"
                            viewBox="0 -960 960 960">
                            <path d="M378-225 133-470l66-66 179 180 382-382 66 65-448 448Z" />
                        </svg>
                    </button>
                    <div class="flex-1 h-1 bg-x-light"></div>
                    <button type="button" data-tabs="1"
                        class="flex items-center justify-center text-x-black font-x-huge text-lg px-4 py-2 bg-x-white rounded-x-thin outline outline-4 outline-x-light active">
                        <span>{{ __('Company') }}</span>
                        <svg class="block w-4 h-4 lg:w-8 lg:h-8 pointer-events-none" fill="currentcolor"
                            viewBox="0 -960 960 960">
                            <path d="M378-225 133-470l66-66 179 180 382-382 66 65-448 448Z" />
                        </svg>
                    </button>
                </div>
                <div data-view="1" class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Name') }} (*)
                        </label>
                        <neo-textbox require placeholder="{{ __('Name') }} (*)" name="name"
                            value="{{ old('name') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Email') }} (*)
                        </label>
                        <neo-textbox type="email" require placeholder="{{ __('Email') }} (*)" name="company_email"
                            value="{{ old('company_email') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Phone') }} (*)
                        </label>
                        <neo-textbox type="tel" require placeholder="{{ __('Phone') }} (*)" name="company_phone"
                            value="{{ old('company_phone') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Address') }} (*)
                        </label>
                        <neo-textarea auto="false" require placeholder="{{ __('Address') }} (*)" name="address"
                            value="{{ old('address') }}" rows="2"></neo-textarea>
                    </div>
                </div>
                <div data-view="2" class="w-full hidden grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
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
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Email') }} (*)
                        </label>
                        <neo-textbox type="email" require placeholder="{{ __('Email') }} (*)" name="user_email"
                            value="{{ old('user_email') }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Phone') }} (*)
                        </label>
                        <neo-textbox type="tel" require placeholder="{{ __('Phone') }} (*)" name="user_phone"
                            value="{{ old('user_phone') }}"></neo-textbox>
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
        tabs();
    </script>
@endsection
