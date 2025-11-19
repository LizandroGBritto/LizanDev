@extends('layouts.portfolio')

@section('title', 'Inicio')

@section('content')
    {{-- Hero Section --}}
    <livewire:portfolio.hero />

    {{-- About Section --}}
    <livewire:portfolio.about />

    {{-- Skills Section --}}
    <livewire:portfolio.skills />

    {{-- Projects Section --}}
    <livewire:portfolio.projects />

    {{-- Contact Section --}}
    <livewire:portfolio.contact />
   
@endsection