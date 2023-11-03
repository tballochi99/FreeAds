@extends('layouts.app')
@include('component.navbar_home')

@section('content')
    <div class="container">
        <div class="card" style="border: 1px solid #e7e7e7; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <h1 class="card-title">Envoyer un message</h1>
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="receiver_id">Destinataire</label>
                        <select name="receiver_id" class="form-control" disabled>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $selected_user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="receiver_id" value="{{ $selected_user_id }}">
                    </div>

                    <div class="form-group">
                        <label for="content">Message</label>
                        <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #ffc107; border: none;">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
