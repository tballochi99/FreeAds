<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])
            ->whereNotNull('email_verified_at')
            ->first();

        if ($user) {

            if (Auth::attempt($credentials, $request->has('remember'))) {
                return redirect()->intended('home');
            }

            return redirect()->back()->with('error', 'Adresse e-mail ou mot de passe incorrect.');
        } else {
            return redirect()->back()->with('error', 'Compte invalide');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}