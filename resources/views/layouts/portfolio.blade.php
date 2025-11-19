<!DOCTYPE html>
<html lang="es">

@include('partials.head')

<body class="antialiased">
    <div id="app">
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