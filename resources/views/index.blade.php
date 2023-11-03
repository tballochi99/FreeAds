@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card" style="border: 1px solid #ffc107; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <div class="card-header text-center bg-white">
                    <img src="{{url('images/ads.png')}}" alt="FreeAds Logo" style="height: 125px;">
                </div>
                <div class="card-body text-center">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                    <h1 class="mb-5" style="color: #000000;">Bienvenue sur FreeAds</h1>
                    <div class="d-flex justify-content-center">
                        <a href="{{ url('register') }}" class="btn btn-primary me-3" style="background-color: #ffc107; border: none; color:#ffffff;">S'inscrire</a>
                        <a href="{{ url('login') }}" class="btn btn-secondary" style="background-color: #ffc107; border: none;color:#ffffff;">Connexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
