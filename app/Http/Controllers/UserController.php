<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserActivationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Vérifie si l'utilisateur doit activer son compte
        $user = User::where('email', $request->email)
            ->whereNotNull('activation_token')
            ->first();

        if ($user) {
            // Utilisateur existant mais non activé : réinitialise le jeton d'activation et renvoie un e-mail de confirmation
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->activation_token = Str::random(60);
            $user->save();

            Mail::to($user->email)->send(new UserActivationMail($user));
            session()->flash('success', 'Un e-mail de confirmation a été envoyé. Veuillez vérifier votre boîte de réception pour activer votre compte.');
        } else {
            // Nouvel utilisateur : crée un nouvel enregistrement dans la base de données
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->save();
            $user->activation_token = Str::random(60);
            $user->save();

            Mail::to($user->email)->send(new UserActivationMail($user));
            session()->flash('success', 'Inscription réussie ! Veuillez vérifier votre email pour activer votre compte.');
        }

        return redirect('/');
    }


    public function activate($token)
    {
        try {
            $user = User::where('activation_token', $token)->firstOrFail();
            $user->markEmailAsVerified();
            $user->activation_token = null;
            $user->save();

            return redirect('/login')->with('success', 'Votre compte a été activé avec succès.');
        } catch (ModelNotFoundException $e) {
            return redirect('/login')->with('error', 'Le token d\'activation est invalide ou expiré.');
        }
    }

    public function showProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('profil', compact('user'));
        } else {
            return redirect('login');
        }
    }

    public function editProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('edit_profile', compact('user'));
        } else {
            return redirect('login');
        }
    }
    public function updateProfile(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ];

            if ($request->filled('password')) {
                $rules['password'] = 'required|string|min:8|confirmed';
            }

            $request->validate($rules);

            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('profile.show')->with('success', 'Votre profil a été mis à jour avec succès.');
        } else {
            return redirect('login');
        }
    }
    public function deleteAccount()
    {
    if (Auth::check()) {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Votre compte a été supprimé avec succès.');
    } else {
        return redirect('login');
    }
}

}
