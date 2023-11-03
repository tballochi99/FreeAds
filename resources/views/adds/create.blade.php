@extends('layouts.app')
@section('content')
@include('component.navbar_home')

<div class="container">
    <div class="card" style="border: 1px solid #e7e7e7; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div class="card-body">
            <h1 class="card-title">Créer une annonce</h1>
            <form action="{{ route('adds.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Titre :</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="photos" class="form-label">Photos :</label>
                    <input type="file" class="form-control-file" id="photos" name="photos[]" multiple required>
                </div>        
                <div class="mb-3">
                    <label for="price" class="form-label">Prix :</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #ffc107; border: none;">Créer l'annonce</button>
            </form>
        </div>
    </div>
</div>
@endsection
