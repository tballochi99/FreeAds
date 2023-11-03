<nav class="navbar navbar-expand-lg py-3" style="background-color: #fff; border-bottom: 1px solid #e7e7e7; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/ads.png') }}" alt="Logo" style="height: 50px;">
            <span class="ml-2" style="font-size: 1.3rem; font-weight: bold; color: #333;">FreeAds</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto align-items-center">
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.show') }}">Profil de {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adds.create') }}">Créer une annonce</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('messages.index') }}">
                            Messages
                            @php
                                $unreadCount = Auth::user()->receivedMessages()->whereNull('read_at')->count();
                            @endphp
                            @if ($unreadCount > 0)
                                <span class="badge" style="background-color:#ffc107">{{ $unreadCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="color: #333;">Déconnexion</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="color: #333;">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('registration') }}" style="color: #333;">Créer un compte</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
