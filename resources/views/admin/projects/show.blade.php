@extends('admin.layouts.base')

@section('contents')

    <h1>Nome del progetto: {{ $project->name }}</h1>
    <h2>Cliente: {{ $project->client_name }}</h2>
    <h2>Data: {{ $project->date }}</h2>
    <h2>Categoria: {{ $project->type->name }}</h2>
    <h3>Tecnologie: {{ implode(', ', $project->technologies->pluck('name')->all()) }}</h3>
    {{-- <img src="{{ $project->cover_image }}" alt="{{ $project->name }}"> --}}
    @if ($project->image)
        <img src="{{ asset('storage/' . $project->image) }}" alt="">
    @endif
    <p>{{ $project->summary }}</p>

@endsection