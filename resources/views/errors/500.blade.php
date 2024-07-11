@extends('shared.guest.base')
@section('title', __('Something Went Wrong'))

@section('content')
    <img src="{{ asset('img/bg-500.webp') }}?v={{ env('APP_VERSION') }}" alt="{{ env('COMPANY_NAME') }} error 500 image"
        loading="lazy" width="100%" height="auto" class="block w-8/12 sm:w-7/12 lg:w-1/3 mx-auto pointer-events-none">
    <h1 class="uppercase font-x-huge text-x-black text-3xl lg:text-4xl text-center">
        {{ ucwords(__('Something Went Wrong')) }}
    </h1>
@endsection
