<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') | Desarrollador Full Stack</title>
    @else
        <title>Portfolio | Desarrollador Full Stack</title>
    @endif

    <meta name="description"
        content="Portfolio personal de desarrollador de software especializado en Laravel, PHP, JavaScript y tecnologías web modernas.">
    <meta name="author" content="Tu Nombre">

    <meta property="og:type" content="website">
    <meta property="og:title" content="Portfolio - Desarrollador Full Stack">
    <meta property="og:description" content="Especializado en crear aplicaciones web modernas y escalables">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased">
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

    @livewireScripts
    @yield('scripts')
</body>

</html>