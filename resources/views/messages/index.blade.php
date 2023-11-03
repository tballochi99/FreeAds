@extends('layouts.app')
@include('component.navbar_home')

@section('content')
    <div class="container">
        <h1>Messages reçus</h1>

        <ul class="list-group">
            @foreach($messages as $message)
                <li class="list-group-item {{ $message->read_at ? 'read-message' : '' }}" style="border: 1px solid #e7e7e7;">
                    <a href="{{ route('messages.show', $message->id) }}" style="text-decoration: none; color: #333;">
                        {{ $message->sender->name }} - {{ $message->content }}
                    </a>
                    <span class="text-muted float-end">{{ $message->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
