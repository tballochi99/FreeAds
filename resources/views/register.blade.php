@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="mb-4">Inscription</h1>
            <form action="{{ route('registration') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe :</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe :</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #ffc107; border: none;">S'inscrire</button>
            </form>
        </div>
    </div>
</div>

@endsection
