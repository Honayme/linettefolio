@extends('layouts.base')

@section('body')

    {{-- 1. PARTIALS PERSISTANTS --}}
    {{-- Ces composants ne seront rendus qu'une seule fois et ne changeront pas lors de la navigation SPA. --}}
    {{-- Le nom ('preloader', 'menu') doit être unique pour chaque bloc @persist. --}}

    @persist('preloader')
    <livewire:partials.preloader />
    @endpersist

    @persist('mobile-menu')
    <livewire:partials.mobile-menu />
    @endpersist

    @persist('menu')
    <livewire:partials.menu />
    @endpersist


    {{-- 2. CONTENU PRINCIPAL AVEC TRANSITION --}}
    {{-- Cet élément <main> contient votre contenu qui change à chaque page. --}}
    {{-- Les classes de transition et wire:loading créent un effet de fondu (fade-out/fade-in). --}}
    <main>

        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset

    </main>

@endsection
