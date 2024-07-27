<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ Core::lang('ar') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="NOINDEX">
    <meta name="currency" content="{{ Core::$UNIT }}" />
    <meta name="mileage" content="{{ Core::company()->mileage }}" />
    @include('shared.base.styles', ['type' => 'admin'])
    @yield('styles')
    <title>@yield('title')</title>
</head>

<body close>
    <section id="neo-page-cover">
        <img src="{{ Core::company()->Image->Link }}" class="block w-48" width="500" height="349" />
    </section>
    <neo-wrapper class="bg-[#e9edef] flex flex-wrap">
        @include('shared.core.sidebar')
        <main class="w-full lg:w-0 lg:flex-1">
            @include('shared.core.topbar')
            <div class="p-4 lg:py-6 lg:px-8 container mx-auto">
                @yield('content')
            </div>
        </main>
    </neo-wrapper>
    <neo-toaster horisontal="end" vertical="end" class="full-size"></neo-toaster>
    @include('shared.base.scripts', ['type' => 'admin'])
    @yield('scripts')
</body>

</html>
