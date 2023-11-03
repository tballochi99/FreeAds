@extends('layouts.app')
@section('content')
@include('component.navbar_home')

<div class="container">
    <div class="card" style="border: 1px solid #e7e7e7; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div class="card-body">
            <h1 class="card-title">Modifier l'annonce</h1>
            <form action="{{ route('adds.update', $add->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Titre :</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $add->title }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $add->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="photos" class="form-label">Photos actuelles :</label>
                    <div class="row">
                        @foreach($photos as $photo)
                            <div class="col-md-4">
                                <img src="{{ url(Storage::url($photo->filename)) }}" alt="Photo de l'annonce" class="img-thumbnail">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" id="delete_photo_{{ $photo->id }}">
                                    <label class="form-check-label" for="delete_photo_{{ $photo->id }}">Supprimer cette photo</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label for="new_photos" class="form-label">Ajouter de nouvelles photos :</label>
                    <input type="file" class="form-control-file" id="new_photos" name="new_photos[]" multiple>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Prix :</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $add->price }}" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #ffc107; border: none;">Modifier l'annonce</button>
            </form>
        </div>
    </div>
</div>
@endsection
