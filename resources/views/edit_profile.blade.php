@extends('layouts.app')
@section('content')
@include('component.navbar_home')

<div class="container">
    <div class="card" style="border: 1px solid #e7e7e7; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div class="card-body">
            <h1 class="card-title">Modifier mon profil</h1>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe :</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Laissez vide pour ne pas modifier">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe :</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <input type="submit" class="btn btn-primary" value="Mettre à jour" style="background-color: #ffc107; border: none;">
            </form>

            <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3">Supprimer le compte</button>
            </form>
        </div>
    </div>
</div>

@endsection
