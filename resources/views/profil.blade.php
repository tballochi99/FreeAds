@extends('layouts.app')
@section('content')
@include('component.navbar_home')

<div class="container">
    <div class="card" style="border: 1px solid #e7e7e7; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div class="card-body">
            <h1 class="card-title">Mon profil</h1>
            <p class="card-text">Nom : {{ $user->name }}</p>
            <p class="card-text">Email : {{ $user->email }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary" style="background-color: #ffc107; border: none;">Modifier mon profil</a>
            @if(session()->has('success'))
                <div class="alert alert-success mt-3">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
