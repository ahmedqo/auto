@extends('shared.core.base')
@section('title', __('Payments List'))

@section('content')
    <div class="flex flex-col gap-2">
        <neo-datavisualizer print search filter download title="{{ __('Payments List') }}">
            @include('shared.page.print')
        </neo-datavisualizer>
    </div>
@endsection

@section('scripts')
    <script>
        TableVisualizer(document.querySelector("neo-datavisualizer"), "payments", {
            Search: "{{ route('actions.payments.search') }}",
            Patch: "{{ route('views.payments.patch', 'XXX') }}",
            Print: "{{ route('views.payments.print', 'XXX') }}",
            Csrf: "{{ csrf_token() }}",
        });
    </script>
@endsection
