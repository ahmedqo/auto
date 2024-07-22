@extends('shared.core.base')
@section('title', __('Edit Payment') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Payment') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Client') }}
                    </label>
                    <neo-textbox placeholder="{{ __('Client') }}" name="client"
                        value="{{ $data->client ? ucwords($data->Client->first_name . ' ' . $data->Client->last_name) . ($data->Client->Blacklist ? ' (blacklisted)' : '') : null }}"
                        disable>
                    </neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Total') }}
                    </label>
                    <neo-textbox placeholder="{{ __('Total') }}" name="total"
                        value="{{ Core::formatNumber($data->total) }}" disable></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Payment') }}
                    </label>
                    <neo-textbox placeholder="{{ __('Payment') }}" name="payment" class="hover:cursor-pointer" disable>
                        <svg slot="end" class="w-[1.2rem] h-[1.2rem] text-x-black pointer-events-none"
                            fill="currentColor" viewBox="0 -960 960 960">
                            <path
                                d="M210-74q-57.12 0-96.56-39.44Q74-152.88 74-210v-540q0-57.13 39.44-96.56Q152.88-886 210-886h277v136H210v540h540v-277h136v277q0 57.12-39.44 96.56Q807.13-74 750-74H210Zm208-250-94-94 332-332h-89v-136h319v319H750v-89L418-324Z" />
                        </svg>
                    </neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Creance') }}
                    </label>
                    <neo-textbox placeholder="{{ __('Creance') }}" name="creance" disable></neo-textbox>
                </div>
                <form action="{{ route('actions.payments.patch', $data->id) }}" method="POST"
                    enctype="multipart/form-data" class="lg:col-span-2">
                    @csrf
                    @method('patch')
                    <input type="hidden" id="json" name="json" value="{!! $data->payment !!}" />
                    <div class="w-full flex">
                        <neo-button
                            class="w-full lg:w-max lg:px-20 lg:ms-auto px-4 py-3 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                            <span>{{ __('Save') }}</span>
                        </neo-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <neo-overlay label="{{ __('Payment') }}">
        <div class="w-full grid grid-rows-1 grid-cols-1 p-6 lg:p-8 gap-6 lg:gap-8">
            <form id="cost" class="flex gap-6 lg:gap-8 flex-wrap">
                <neo-textbox type="number" placeholder="{{ __('Amount') }}" name="amount" value="{{ old('amount') }}"
                    class="w-0 flex-1"></neo-textbox>
                <neo-button
                    class="w-max py-2 px-6 text-x-white bg-x-prime rounded-x-thin hover:bg-opacity-80 focus:bg-opacity-80">
                    <svg class="block w-8 h-8 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M479.825-185q-18.45 0-31.637-12.625Q435-210.25 435-231v-203H230q-18.375 0-31.688-13.56Q185-461.119 185-479.86q0-20.14 13.312-32.64Q211.625-525 230-525h205v-205q0-19.775 13.358-32.388Q461.716-775 480.158-775t32.142 12.612Q526-749.775 526-730v205h204q18.8 0 32.4 12.675 13.6 12.676 13.6 32.316 0 19.641-13.6 32.825Q748.8-434 730-434H526v203q0 20.75-13.65 33.375Q498.699-185 479.825-185Z" />
                    </svg>
                </neo-button>
            </form>
            <div class="border border-x-shade rounded-x-thin overflow-auto">
                <table class="min-w-full rounded-x-thin">
                    <thead class="bg-x-light">
                        <tr>
                            <td class="w-[160px] ps-8 px-4 py-2 text-base font-x-huge text-x-black text-center">
                                {{ __('Amount') }}
                            </td>
                            <td></td>
                            <td class="w-[80px] pe-8 px-4 py-2 text-base font-x-huge text-x-black text-center">
                                {{ __('Action') }}
                            </td>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </neo-overlay>
@endsection

@section('scripts')
    <script>
        paymentInitializer();
    </script>
@endsection
