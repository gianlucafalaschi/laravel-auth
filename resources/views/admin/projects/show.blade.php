@extends('layouts.admin')

@section('content')
    <h1>Progetto singolo</h1>
    <h2>Nome Progetto: {{ $project->name }}</h2>
    {{-- messaggio di creazione progetto o modifica progetto --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <strong>ID:</strong> {{ $project->id }}
    </div>
    
    <div>
        <strong>Slug:</strong> {{ $project->slug }}
    </div>
    
    <div>
        <strong>Client name:</strong>:</strong> {{ $project->client_name }}
    </div>
    
    <div>
        <strong>Data creazione:</strong>:</strong> {{ $project->created_at }}
    </div>
   
    <div>
        <strong>Data modifica:</strong>:</strong> {{ $project->updated_at }}
    </div>

    @if ($project->summary)
        <p class="mt-3">Descrizione: {{ $project->summary }}</p>
    @endif

    <div class="d-flex gap-4">
        <div>
            <a class="btn btn-primary" href="{{ route('admin.projects.edit', ['project' => $project->id]) }}">Edit</a>
        </div>
        <div>
            <form action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
    

@endsection