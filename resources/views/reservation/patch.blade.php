@extends('shared.core.base')
@section('title', __('Edit Reservation') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Reservation') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form require action="{{ route('actions.reservations.patch', $data->id) }}" method="POST"
                enctype="multipart/form-data" class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                @csrf
                @method('patch')
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
                <input type="hidden" id="json" name="json" value="{!! $data->payment !!}" />
                <input type="hidden" id="state" name="state" value='{!! $data->state !!}' />
                <div data-view="1" class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Client') }} (*)
                        </label>
                        <neo-autocomplete require set-query="name" set-value="id" placeholder="{{ __('Client') }} (*)"
                            name="client" value="{{ $data->client }}"
                            query="{{ $data->client ? ucwords($data->Client->first_name . ' ' . $data->Client->last_name) . ($data->Client->Blacklist ? ' (blacklisted)' : '') : null }}">
                        </neo-autocomplete>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Secondary Client') }}
                        </label>
                        <neo-autocomplete set-query="name" set-value="id" placeholder="{{ __('Secondary Client') }}"
                            name="secondary_client" value="{{ $data->secondary_client }}"
                            query="{{ $data->secondary_client ? ucwords($data->SClient->first_name . ' ' . $data->SClient->last_name) . ($data->SClient->Blacklist ? ' (blacklisted)' : '') : null }}">
                        </neo-autocomplete>
                    </div>
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Vehicle') }} (*)
                        </label>
                        <neo-autocomplete require set-query="name" set-value="id" placeholder="{{ __('Vehicle') }} (*)"
                            name="vehicle" value="{{ $data->vehicle }}"
                            query="{{ $data->vehicle ? $data->Vehicle->name : null }}">
                        </neo-autocomplete>
                    </div>
                    <div class="flex flex-col gap-1 lg:col-span-2">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Price') }} (*)
                        </label>
                        <neo-textbox require type="number" placeholder="{{ __('Price') }} (*)" name="price"
                            value="{{ Core::formatNumber($data->price) }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="2" class="hidden w-full grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Pick-up Date') }} (*)
                        </label>
                        <neo-datepicker require {{ !Core::lang('ar') ? 'full-day=3' : '' }}
                            placeholder="{{ __('Pick-up Date') }} (*)" name="from_date"
                            value="{{ $data->from ?? '#now' }}" format="dddd dd mmmm yyyy"></neo-datepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Pick-up Time') }} (*)
                        </label>
                        <neo-timepicker require placeholder="{{ __('Pick-up Time') }} (*)" name="from_time"
                            value="{{ Carbon::parse($data->from)->format('H:i') ?? '#now' }}"
                            format="HH:MM AA"></neo-timepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Pick-up Location') }}
                        </label>
                        <neo-textbox placeholder="{{ __('Pick-up Location') }}" name="pick_up"
                            value="{{ $data->pick_up }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="3" class="hidden w-full grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Drop-off Date') }} (*)
                        </label>
                        <neo-datepicker require {{ !Core::lang('ar') ? 'full-day=3' : '' }}
                            placeholder="{{ __('Drop-off Date') }} (*)" name="to_date" value="{{ $data->to ?? '#now+1' }}"
                            format="dddd dd mmmm yyyy"></neo-datepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Drop-off Time') }} (*)
                        </label>
                        <neo-timepicker require placeholder="{{ __('Drop-off Time') }} (*)" name="to_time"
                            value="{{ Carbon::parse($data->to)->format('H:i') ?? '#now' }}"
                            format="HH:MM AA"></neo-timepicker>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Drop-off Location') }}
                        </label>
                        <neo-textbox placeholder="{{ __('Drop-off Location') }}" name="drop_off"
                            value="{{ $data->drop_off }}"></neo-textbox>
                    </div>
                </div>
                <div data-view="4" class="hidden w-full grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
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
                        <neo-textbox placeholder="{{ __('Payment') }}" name="payment" class="hover:cursor-pointer"
                            disable>
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
                </div>
                <div data-view="5"
                    class="hidden w-full grid-rows-1 grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-8 items-start">
                    <div class="flex flex-col gap-1 lg:col-span-5">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Milage') }}
                        </label>
                        <neo-textbox placeholder="{{ __('Milage') }}" name="milage" disable></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1 lg:col-span-3">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('State') }}
                        </label>
                        <div class="w-full border border-x-shade rounded-x-thin bg-x-light p-2 lg:p-4">
                            <div class="w-full relative">
                                <img src="{{ asset('img/state.png') }}" class="block w-full" />
                                <svg viewBox="0 0 819.000000 476.000000" class="block w-full h-full absolute inset-0">
                                    <g transform="translate(0.000000,476.000000) scale(0.100000,-0.100000)"
                                        fill="transparent" stroke="none">
                                        @foreach (Core::pathList() as $key => $path)
                                            <path id="part-{{ $key + 1 * 100 }}" class="path cursor-pointer"
                                                d="{{ $path }}" />
                                        @endforeach
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:col-span-2 grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                        <div class="flex flex-col gap-1">
                            <label class="text-sm text-x-black font-x-thin">
                                {{ __('Damage') }}
                            </label>
                            <div class="flex gap-6 lg:gap-8 flex-wrap">
                                <neo-select placeholder="{{ __('Damage') }}" name="damage" class="w-0 flex-1">
                                    @foreach (array_keys(Core::stateList()) as $damage)
                                        <neo-select-item value="{{ $damage }}">
                                            {{ ucwords(__($damage)) }}
                                        </neo-select-item>
                                    @endforeach
                                </neo-select>
                                <neo-button id="add" type="button"
                                    class="w-max py-2 px-6 text-x-white bg-x-prime rounded-x-thin hover:bg-opacity-80 focus:bg-opacity-80">
                                    <svg class="block w-8 h-8 pointer-events-none" fill="currentcolor"
                                        viewBox="0 -960 960 960">
                                        <path
                                            d="M479.825-185q-18.45 0-31.637-12.625Q435-210.25 435-231v-203H230q-18.375 0-31.688-13.56Q185-461.119 185-479.86q0-20.14 13.312-32.64Q211.625-525 230-525h205v-205q0-19.775 13.358-32.388Q461.716-775 480.158-775t32.142 12.612Q526-749.775 526-730v205h204q18.8 0 32.4 12.675 13.6 12.676 13.6 32.316 0 19.641-13.6 32.825Q748.8-434 730-434H526v203q0 20.75-13.65 33.375Q498.699-185 479.825-185Z" />
                                    </svg>
                                </neo-button>
                            </div>
                        </div>
                        <div class="border border-x-shade rounded-x-thin overflow-auto">
                            <table class="min-w-full rounded-x-thin">
                                <thead class="bg-x-light">
                                    <tr>
                                        <td class="ps-8 px-4 py-2 text-base font-x-huge text-x-black">
                                            {{ __('Damages') }}
                                        </td>
                                        <td class="w-[80px] pe-8 px-4 py-2 text-base font-x-huge text-x-black text-center">
                                            {{ __('Action') }}
                                        </td>
                                    </tr>
                                </thead>
                                <tbody id="parts">
                                    <tr class="border-t border-t-x-shade">
                                        <td colspan="2" class="ps-8 p-4 text-lg text-x-black">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <span class="block w-10 h-6 rounded-x-thin"
                                                    style="background:#c8f6c8"></span>
                                                <span class="block">
                                                    {{ ucwords(__('good condition')) }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    <neo-overlay label="{{ __('Payment') }}">
        <div class="w-full grid grid-rows-1 grid-cols-1 p-6 lg:p-8 gap-6 lg:gap-8">
            <form id="cost" class="flex gap-6 lg:gap-8 flex-wrap">
                <neo-textbox type="number" placeholder="{{ __('Amount') }}" name="amount"
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
        ReservationInitializer({
            Client: "{{ route('actions.clients.search.all') }}",
            Vehicle: "{{ route('actions.vehicles.search') }}",
            Colors: {!! json_encode(Core::stateList()) !!}
        });
    </script>
@endsection
