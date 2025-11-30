# Layouts BALL Stack - Version Minimaliste

Version minimaliste et transposable des layouts `base.blade.php` et `app.blade.php` pour un projet BALL stack (Bootstrap, Alpine.js, Livewire, Laravel).

---

## Fichier : `resources/views/layouts/base.blade.php`

```blade
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

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        @yield('body')

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        @livewireScriptConfig
        @stack('scripts')
    </body>
</html>
```

---

## Fichier : `resources/views/layouts/app.blade.php`

```blade
@extends('layouts.base')

@section('body')

    {{-- PARTIALS PERSISTANTS --}}
    {{-- Ces composants ne seront rendus qu'une seule fois et ne changeront pas lors de la navigation SPA. --}}
    {{-- Le nom ('menu', 'mobile-menu') doit être unique pour chaque bloc @persist. --}}

    @persist('menu')
        {{-- <livewire:partials.menu /> --}}
    @endpersist

    @persist('mobile-menu')
        {{-- <livewire:partials.mobile-menu /> --}}
    @endpersist

    <main id="page"
          x-data="pageFx()"
          x-ref="page"
          x-init="init()"
          x-on:livewire:navigate.window="markNav()"
          x-show="shown"
          x-transition:enter.duration.400ms
          class="opacity-100">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <script>
        function pageFx() {
            return {
                shown: true,

                // Appelé au montage de CHAQUE page (après un swap Livewire)
                init() {
                    // Si on arrive via une navigation Livewire, on déclenche seulement un fade-in
                    if (window.__lwNav === true) {
                        this.shown = false;                // état initial (invisible)
                        this.$nextTick(() => { this.shown = true }) // déclenche le x-transition.opacity
                    } else {
                        // Chargement initial (hard load): pas d'animation
                        this.shown = true;
                    }
                },

                // Marqueur global persistant entre pages (car window est conservé)
                markNav() { window.__lwNav = true },
            }
        }
    </script>
@endsection
```

---

## Utilisation

Dans vos composants Livewire :

```php
public function render()
{
    return view('livewire.home')
        ->layout('layouts.app');
}
```
