@extends('shared.core.base')
@section('title', __('Users List'))

@section('content')
    <div class="flex flex-col gap-2">
        <neo-datavisualizer print search filter download title="{{ __('Users List') }}">
            <a slot="end" title="{{ __('Create') }}" href="{{ route('views.users.store') }}" aria-label="create_page_link"
                class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                    <path
                        d="M479.825-185q-18.45 0-31.637-12.625Q435-210.25 435-231v-203H230q-18.375 0-31.688-13.56Q185-461.119 185-479.86q0-20.14 13.312-32.64Q211.625-525 230-525h205v-205q0-19.775 13.358-32.388Q461.716-775 480.158-775t32.142 12.612Q526-749.775 526-730v205h204q18.8 0 32.4 12.675 13.6 12.676 13.6 32.316 0 19.641-13.6 32.825Q748.8-434 730-434H526v203q0 20.75-13.65 33.375Q498.699-185 479.825-185Z" />
                </svg>
            </a>
            @include('shared.page.print')
        </neo-datavisualizer>
    </div>
@endsection

@section('scripts')
    <script>
        TableVisualizer(document.querySelector("neo-datavisualizer"), "users", {
            Search: "{{ route('actions.users.search') }}",
            Patch: "{{ route('views.users.patch', 'XXX') }}",
            Clear: "{{ route('actions.users.clear', 'XXX') }}",
            Csrf: "{{ csrf_token() }}",
        });
    </script>
@endsection
