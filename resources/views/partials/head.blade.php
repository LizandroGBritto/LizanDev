<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') | LizanDev</title>
    @else
        <title>LizanDev | Desarrollador Full Stack</title>
    @endif

    <meta name="description"
        content="Portfolio personal de desarrollador de software especializado en Laravel, PHP, JavaScript y tecnologías web modernas.">
    <meta name="author" content="Lizandro Britto">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="LizanDev | Desarrollador Full Stack">
    <meta property="og:description"
        content="Portfolio personal del desarrollador de software Lizandro Britto, especializado en Laravel, PHP, JavaScript y tecnologías web modernas.">
    <meta property="og:image" content="{{ asset('images/social-preview.png') }}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="LizanDev | Desarrollador Full Stack">
    <meta property="twitter:description"
        content="Portfolio personal del desarrollador de software Lizandro Britto especializado en Laravel, PHP, JavaScript y tecnologías web modernas.">
    <meta property="twitter:image" content="{{ asset('images/social-preview.png') }}">

    <link rel="icon" type="image/png" href="{{ url('favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ url('favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ url('favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ url('favicon/site.webmanifest') }}" />
    <meta name="msapplication-TileColor" content="#7c3aed">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Spline 3D Viewer -->
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.11.6/build/spline-viewer.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>