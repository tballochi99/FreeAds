@component('mail::message')

# Bonjour {{ $user->name }},

Merci de vous être inscrit sur notre site. Veuillez cliquer sur le bouton ci-dessous pour activer votre compte.

@component('mail::button', ['url' => route('activate', $user->activation_token)])
Activer mon compte
@endcomponent


Merci,<br>
{{ config('app.name') }}
@endcomponent
