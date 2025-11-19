@extends('layouts.portfolio')

@section('title', 'Inicio')

@section('content')
    {{-- Hero Section --}}
    <livewire:portfolio.hero />

    {{-- Projects Section --}}
    <livewire:portfolio.projects />

    {{-- Skills Section --}}
    <livewire:portfolio.skills />

    {{-- About Section --}}
    <livewire:portfolio.about />

    {{-- Contact Section --}}
    <livewire:portfolio.contact />
   
@endsection