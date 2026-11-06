<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.head')

<body class="bg-paper text-ink antialiased">
    <div id="app">
        <x-navigation />
        <main>
            @yield('content')
        </main>
        <x-footer />
    </div>

    @livewireScripts
    @yield('especifico')
</body>

</html>
