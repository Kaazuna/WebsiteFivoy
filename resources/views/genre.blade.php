<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $genre->genre }} Movies</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <style>
        body {
            background-color: black;
            color: white;
        }
    </style>
</head>

<body>
<div class="d-flex" style="height: 100vh; overflow: hidden;">
    <!-- Sidebar -->
    <div class="sidebar text-white p-3">
        <a href="#" class="text-white p-3 h1" style="text-decoration:none"><b>FIVOY</b></a>
        <ul class="nav flex-column">
            <li class="nav-item mb-4" style="border-radius:25px; width:100%; max-width:300px;">
                <a href="/dashboard" class="nav-link text-white d-flex align-items-center">
                    <img src="{{ asset('images/filmm.png') }}" alt="film" width="60" height="60" class="me-2">
                    <h4><b>Film</b></h4>
                </a>
            </li>
            <li class="nav-item mb-4" style="border-radius:25px; width:100%; max-width:300px;">
                <a href="{{ session('user') ? '/libraries' : route('login') }}" class="nav-link text-white d-flex align-items-center">
                    <img src="{{ asset('images/history.png') }}" alt="film" width="60" height="60" class="me-2">
                    <h4><b>Libraries</b></h4>
                </a>
            </li>
            <li class="nav-item mb-4" style="border-radius:25px; width:100%; max-width:300px;">
                <a href="{{ session('user') ? '/favorites' : route('login') }}" class="nav-link text-white d-flex align-items-center">
                    <img src="{{ asset('images/favorites.png') }}" alt="film" width="60" height="60" class="me-2">
                    <h4><b>Favorites</b></h4>
                </a>
            </li>
            <li class="nav-item mb-4" style="border-radius:25px; width:100%; max-width:300px;">
                <a href="{{ session('user') ? '/profile' : route('login') }}" class="nav-link text-white d-flex align-items-center">
                    <img src="{{ asset('images/account1.png') }}" alt="film" width="60" height="60" class="me-2">
                    <h4><b>Account</b></h4>
                </a>
            </li>
        </ul>
        <div class="mt-auto">
            @if (session('user'))
                <a href="/logout" class="btn btn-danger w-100">Logout</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light w-100 mb-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light w-100">Register</a>
            @endif
        </div>
    </div>

    <!-- Main Area -->
    <div class="flex-grow-1 d-flex flex-column overflow-hidden">
        <nav class="navbar navbar-dark bg-black px-3">
            <div style="padding-right: 20px">
                @if (session()->has('user'))
                    <h3 style="color: white">Welcome, {{ session('user.name') }}</h3>
                @endif
            </div>
            <form action="{{ route('dashboard') }}" method="GET" class="d-flex flex-grow-1 me-3" role="search">
                <input class="form-control me-2" type="search" name="q" placeholder="Search..." value="{{ request('q') }}">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
            <a href=""><img src="{{ asset('images/account.png') }}" alt="Profile" class="rounded-circle" width="40" height="40"></a>
        </nav>

        <div class="content-area overflow-auto ps-5 pe-5 pt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2><b>{{ $genre->genre }} Movies</b></h2>
                <a href="/dashboard" class="btn btn-outline-light btn-sm">Back to Dashboard</a>
            </div>

            <div class="d-flex flex-wrap gap-4">
                @forelse ($films as $film)
                    <div class="d-flex bg-dark rounded p-2" style="width: 23%; min-width: 250px;">
                        <img src="{{ asset('storage/' . $film->foto) }}" alt="Poster" style="width: 100px; height: 150px; object-fit: cover; border-radius: 5px;">
                        <div class="ms-3 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="mb-2 text-white">{{ $film->judul }}</h6>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <a class="btn btn-light btn-sm" style="width: 100px" href="{{ session('user') ? route('film.view', ['id' => $film->id]) : route('login') }}">Read More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-white">No {{ $genre->genre }} movies found.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>