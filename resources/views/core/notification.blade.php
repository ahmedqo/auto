@extends('shared.core.base')
@section('title', __('Notifications'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Notifications') }}
        </h1>
        <div class="bg-x-white rounded-x-thin shadow-x-core border border-x-shade">
            <ul class="flex flex-col">
                @forelse($data as $alert)
                    <li
                        class="w-full block text-x-black text-base p-4 {{ $loop->index === 0 ? '' : 'border-t border-x-shade' }}">
                        "{{ ucwords($alert->name) }}" {{ __('On') }} {{ ucwords($alert->Vehicle->name) }}
                        {{ __('At') }} {{ $alert->date }}
                    </li>
                @empty
                    <li class="w-full block text-x-black font-x-huge text-base text-center px-4 py-8">
                        {{ __('No Data Found') }}
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection