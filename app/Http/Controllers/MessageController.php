<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Pour afficher la liste des messages reçus
    public function index()
    {
        $messages = auth()->user()->receivedMessages()->orderBy('created_at', 'desc')->get();
        return view('messages.index', compact('messages'));
    }


    // Pour afficher le formulaire d'envoi d'un nouveau message
    public function create(Request $request)
    {
        $selected_user_id = $request->input('user_id');

        if ($selected_user_id == auth()->id()) {
            return redirect()->route('home')->with('error', 'Vous ne pouvez pas vous envoyer de message à vous-même.');
        }

        $users = User::all();
        return view('messages.create', compact('users', 'selected_user_id'));
    }

    // Pour envoyer un nouveau message
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required'
        ]);

        $message = new Message([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->content
        ]);

        $message->save();

        return redirect()->route('home')->with('success', 'Message envoyé avec succès.');
    }


    // Pour lire un message reçu
    public function show(Message $message)
    {
        if ($message->receiver_id != auth()->id()) {
            return abort(403, 'Accès refusé');
        }

        if (!$message->read_at) {
            $message->read_at = now();
            $message->save();
        }

        return view('messages.show', compact('message'));
    }
}