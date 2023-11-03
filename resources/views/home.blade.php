@extends('layouts.app')

@section('content')
@include('component.navbar_home')
@if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
@endif
@if(session()->has('error'))
        <div class="alert alert-error">
            {{ session()->get('error') }}
        </div>
@endif
    <form action="{{ route('adds.search') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Rechercher une annonce...">
            <input type="number" name="min_price" class="form-control" placeholder="Prix min">
            <input type="number" name="max_price" class="form-control" placeholder="Prix max">
            <select name="sort" class="form-control">
                <option value="recent">Plus récent</option>
                <option value="oldest">Plus ancien</option>
                <option value="most_viewed">Les plus vues</option>
            </select>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" style="background-color: #ffc107;">Rechercher</button>
            </div>
        </div>
    </form>    
<h1>Liste des annonces</h1>
@if(isset($query))
    <h2>Résultats de recherche {{ $query ? "pour « $query »"  : ""  }} </h2>
    @if (count($adds) === 0)
        <p>Aucune annonce trouvée.</p>
    @endif
@endif

<div class="row">
    @foreach ($adds as $add)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                @if ($add->photos->isNotEmpty())
                <img src="{{ url(Storage::url($add->photos->first()->filename)) }}" class="card-img-top img-thumbnail" alt="Photo de l'annonce">
                @endif
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('adds.show', $add->id) }}">{{ $add->title }}</a>
                    </h5>
                    <p class="card-text">{{ $add->description }}</p>
                    <p class="card-text"><small class="text-muted">{{ $add->price }} €</small></p>
                    <p class="card-text">Posté par : {{ $add->user->name }}</p>
                    <p class="card-text">Date : {{ $add->created_at->format('d/m/Y') }}</p>
                   <p>Nombre de vues : {{ $add->views }}</p>
                   @if (Auth::check() && Auth::user()->id !== $add->user_id)
                   <a href="{{ route('messages.create', ['user_id' => $add->user_id]) }}" class="btn btn-primary" style="background-color: #ffc107; border: none;">Contacter l'annonceur</a>
               @endif
                    @if (Auth::check() && Auth::user()->id === $add->user_id)
                        <a href="{{ route('adds.edit', $add->id) }}" class="btn btn-primary" style="background-color: #ffc107; border: none;">Modifier</a>
                        <form action="{{ route('adds.destroy', $add->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
