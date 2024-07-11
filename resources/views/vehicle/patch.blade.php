@extends('shared.core.base')
@section('title', __('Edit Vehicle') . ' #' . $data->id)
@section('styles')
    <link rel="stylesheet" href="{{ asset('js/editor/theme.min.css') }}?v={{ env('APP_VERSION') }}" />
@endsection

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Vehicle') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6">
            <form action="{{ route('actions.vehicles.patch', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-6">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Name') }} (*)
                    </label>
                    <neo-textbox placeholder="{{ __('Name') }} (*)" name="name_en"
                        value="{{ $data->name_en }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Price') }} (*)
                    </label>
                    <neo-textbox type="number" placeholder="{{ __('Price') }} (*)" name="price"
                        value="{{ $data->price }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Details') }}
                    </label>
                    <neo-textarea auto="false" placeholder="{{ __('Details') }}" name="details_en"
                        value="{{ $data->details_en }}" rows="4"></neo-textarea>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-6 lg:col-span-2">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Passengers') }} (*)
                        </label>
                        <neo-textbox type="number" placeholder="{{ __('Passengers') }} (*)" name="passengers"
                            value="{{ $data->passengers }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Doors') }} (*)
                        </label>
                        <neo-textbox type="number" placeholder="{{ __('Doors') }} (*)" name="doors"
                            value="{{ $data->doors }}"></neo-textbox>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm text-x-black font-x-thin">
                            {{ __('Cargo') }} (*)
                        </label>
                        <neo-textbox type="number" placeholder="{{ __('Cargo') }} (*)" name="cargo"
                            value="{{ $data->cargo }}"></neo-textbox>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Transmission') }} (*)
                    </label>
                    <neo-select placeholder="{{ __('Transmission') }} (*)" name="transmission">
                        @foreach (Core::transmissionList() as $transmission)
                            <neo-select-item value="{{ $transmission }}"
                                {{ $transmission == $data->transmission ? 'active' : '' }}>
                                {{ __(ucwords($transmission)) }}
                            </neo-select-item>
                        @endforeach
                    </neo-select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Fuel') }} (*)
                    </label>
                    <neo-select placeholder="{{ __('Fuel') }} (*)" name="fuel">
                        @foreach (Core::fuelList() as $fuel)
                            <neo-select-item value="{{ $fuel }}" {{ $fuel == $data->fuel ? 'active' : '' }}>
                                {{ __(ucwords($fuel)) }}
                            </neo-select-item>
                        @endforeach
                    </neo-select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Brand') }} (*)
                    </label>
                    <neo-autocomplete set-query="{{ 'name_' . Core::lang() }}" set-value="id"
                        placeholder="{{ __('Brand') }} (*)" name="brand" value="{{ $data->brand }}"
                        query="{{ $data->brand ? $data->Brand->{'name_' . Core::lang()} : null }}">
                    </neo-autocomplete>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Model') }} (*)
                    </label>
                    <neo-autocomplete set-query="{{ 'name_' . Core::lang() }}" set-value="id"
                        placeholder="{{ __('Model') }} (*)" name="model" value="{{ $data->model }}"
                        query="{{ $data->model ? $data->Model->{'name_' . Core::lang()} : null }}">
                    </neo-autocomplete>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Status') }} (*)
                    </label>
                    <neo-select placeholder="{{ __('Status') }} (*)" name="status">
                        @foreach (Core::statusList() as $status)
                            <neo-select-item value="{{ $status }}" {{ $status == $data->status ? 'active' : '' }}>
                                {{ __(ucwords($status)) }}
                            </neo-select-item>
                        @endforeach
                    </neo-select>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Images') }} (*)
                    </label>
                    <neo-imagetransfer name="images[]" multiple></neo-imagetransfer>
                </div>
                <div class="flex flex-col gap-1 lg:col-span-2">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Description') }}
                    </label>
                    <textarea id="description_en" name="description_en" placeholder="{{ __('Description') }}" rows="3">{{ trim($data->description_en) }}</textarea>
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

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/editor/rte.js') }}?v={{ env('APP_VERSION') }}"></script>
    <script type="text/javascript" src="{{ asset('js/editor/plugins/all_plugins.js') }}?v={{ env('APP_VERSION') }}">
    </script>
    <script src="{{ asset('js/editor/lang/rte-lang-' . app()->getLocale() . '.js') }}?v={{ env('APP_VERSION') }}">
    </script>
    <script>
        const imageTransfer = document.querySelector("neo-imagetransfer");
        imageTransfer.default = {!! $data->Images->map(function ($Image) {
            return ['id' => $Image->id, 'src' => $Image->Link];
        }) !!};
        VehicleInitializer([{
            Auto: document.querySelector("neo-autocomplete[name=brand]"),
            Link: "{{ route('actions.brands.search') }}"
        }, {
            Auto: document.querySelector("neo-autocomplete[name=model]"),
            Link: "{{ route('actions.models.search') }}"
        }], imageTransfer);
    </script>
@endsection
