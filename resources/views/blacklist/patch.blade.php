@extends('shared.core.base')
@section('title', __('Edit BlackList') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit BlackList') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form action="{{ route('actions.blacklist.patch', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Client') }} (*)
                    </label>
                    <neo-autocomplete set-query="name" set-value="id" placeholder="{{ __('Client') }} (*)" name="client"
                        value="{{ $data->client }}"
                        query="{{ $data->client ? ucwords($data->Client->first_name . ' ' . $data->Client->last_name) . ($data->Client->Blacklist ? ' (blacklisted)' : '') : null }}">
                    </neo-autocomplete>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Details') }}
                    </label>
                    <neo-textarea auto="false" placeholder="{{ __('Details') }}" name="details"
                        value="{{ $data->details }}" rows="8"></neo-textarea>
                </div>
                <div class="w-full flex">
                    <neo-button
                        class="w-full lg:w-max lg:px-20 lg:ms-auto px-4 py-3 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                        <span>{{ __('Save') }}</span>
                    </neo-button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        BlackListInitializer({
            Search: "{{ route('actions.clients.search') }}"
        });
    </script>
@endsection
