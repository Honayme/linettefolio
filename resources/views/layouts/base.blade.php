<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Preconnect et DNS Prefetch pour les polices externes -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="dns-prefetch" href="//rsms.me">
        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        <!-- Fonts avec chargement asynchrone -->
        <link rel="preload" href="https://rsms.me/inter/inter.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="https://rsms.me/inter/inter.css"></noscript>

        <script>
            window.APP_URL = '{{ config('app.url') }}';
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SEO Meta Tags -->
        {!! seo()->render() !!}
    </head>

    <body>
    <div class="tokyo_tm_all_wrap" data-magic-cursor="show" data-enter="fadeInLeft" data-exit="">
        @yield('body')
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>
    </div>

    @livewireScriptConfig
    @stack('scripts')

    <script src="{{ asset('template/plugins.js') }}" defer></script>
    <script src="{{ asset('template/init.js') }}" defer></script>
    </body>
</html>
