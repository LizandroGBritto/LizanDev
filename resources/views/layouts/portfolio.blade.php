<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.head')

<body class="antialiased">
    <!-- Language Switcher -->
    @livewire('language-switcher')

    <div id="app">
        <x-navigation />
        <main>
            @yield('content')
        </main>
    </div>

    @livewireScripts
    <x-footer />
    @yield('especifico')
</body>

</html>
