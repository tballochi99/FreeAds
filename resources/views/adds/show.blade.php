@extends('layouts.app')
@include('component.navbar_home')

@section('content')
    <div class="container">
        <div class="card" style="border: 1px solid #e7e7e7; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <h1 class="card-title">{{ $add->title }}</h1>
                <p>{{ $add->description }}</p>
                <p>{{ $add->price }} €</p>
                <p>Posté par : {{ $add->user->name }}</p>
                <p>Date : {{ $add->created_at->format('d/m/Y') }}</p>
                <p>Nombre de vues : {{ $add->views }}</p>
                <hr>
                <div class="row">
                    @foreach ($add->photos as $photo)
                        <div class="col-md-4 mb-3">
                            <img src="{{ url(Storage::url($photo->filename)) }}" class="img-thumbnail" alt="Photo de l'annonce">
                        </div>
                    @endforeach
                </div>
                @if (Auth::check() && Auth::user()->id !== $add->user_id)
                    <a href="{{ route('messages.create', ['user_id' => $add->user_id]) }}" class="btn btn-primary" style="background-color: #ffc107; border: none;">Contacter l'annonceur</a>
                @endif
                <a href="{{ route('home') }}" class="btn btn-primary" style="background-color: #ffc107; border: none;">Retour aux annonces</a>
            </div>
        </div>
    </div>
@endsection
