@extends('admin.layouts.base')

@section('contents')

    <h1>{{ $type->name }}</h1>
    <p>{{ $type->description }}</p>

    <h2>Progetti associati in questa categoria</h2>

    <ul>
        @foreach ($type->projects as $project)
            <li><a href="{{ route('admin.projects.show', ['project' => $project]) }}">{{ $project->name }}</a></li>
        @endforeach
    </ul>

@endsection