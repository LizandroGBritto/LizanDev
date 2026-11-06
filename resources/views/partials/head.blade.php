<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title') | LizanDev @else LizanDev | {{ __('Full Stack Developer') }} @endif</title>

    <meta name="description" content="{{ __('Personal portfolio of a software developer specialized in Laravel, PHP, JavaScript and modern web technologies.') }}">
    <meta name="author" content="Lizandro Britto">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="LizanDev | {{ __('Full Stack Developer') }}">
    <meta property="og:description" content="{{ __('Personal portfolio of a software developer specialized in Laravel, PHP, JavaScript and modern web technologies.') }}">
    <meta property="og:locale" content="{{ app()->getLocale() === 'es' ? 'es_ES' : 'en_US' }}">
    <meta name="twitter:card" content="summary">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <meta name="theme-color" content="#f3f7f4">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=familjen-grotesk:500,700%7Cfigtree:400,500,600,700%7Cjetbrains-mono:400,500&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
