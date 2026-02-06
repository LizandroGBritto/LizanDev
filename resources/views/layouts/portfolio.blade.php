<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.head')

<body class="antialiased">
    <!-- Language Switcher -->
    @livewire('language-switcher')

    <div id="app">
        @include('partials.navigation')
        <main>
            @yield('content')
        </main>
    </div>

    @livewireScripts
    @include('partials.footer')
    @include('partials.scripts')
    @yield('especifico')
</body>

</html>
