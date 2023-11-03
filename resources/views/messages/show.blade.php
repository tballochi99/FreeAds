@extends('layouts.app')
@include('component.navbar_home')
@section('content')
    <div class="container">
        <div class="card" style="border: 1px solid #e7e7e7; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <div class="card-header">
                Message de {{ $message->sender->name }}
            </div>
            <div class="card-body">
                <p>{{ $message->content }}</p>
            </div>
            <div class="card-footer">
                {{ $message->created_at->diffForHumans() }}
            </div>
        </div>

        <h2>Répondre à ce message</h2>

        <form action="{{ route('messages.store') }}" method="post">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}">
            <div class="mb-3">
                <label for="content" class="form-label">Message</label>
                <textarea class="form-control" name="content" id="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #ffc107; border: none;">Envoyer</button>
        </form>
    </div>
@endsection
