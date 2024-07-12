@extends('shared.core.base')
@section('title', __('Edit Model') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Model') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade p-6 lg:p-8">
            <form action="{{ route('actions.models.patch', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="w-full grid grid-rows-1 grid-cols-1 gap-6 lg:gap-8">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Image') }} (*)
                    </label>
                    <neo-imagetransfer name="image" class="video"></neo-imagetransfer>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Name') }} (*)
                    </label>
                    <neo-textbox placeholder="{{ __('Name') }} (*)" name="name_en"
                        value="{{ $data->name_en }}"></neo-textbox>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm text-x-black font-x-thin">
                        {{ __('Description') }}
                    </label>
                    <neo-textarea auto="false" placeholder="{{ __('Description') }}" name="description_en"
                        value="{{ $data->description_en }}" rows="5"></neo-textarea>
                </div>
                <div class="w-full flex">
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
    <script>
        const imageTransfer = document.querySelector("neo-imagetransfer");
        imageTransfer.default = [{
            src: "{{ $data->Image->link }}"
        }];
    </script>
@endsection
