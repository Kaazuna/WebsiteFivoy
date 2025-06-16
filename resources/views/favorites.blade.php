<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Favorites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

</head>

<body class="bg-black text-white" style="background-color: black;">
    <div class="d-flex" style="height: 100vh; overflow: hidden;">
        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white p-3" style="width: 250px;">
            <a href="/dashboard" class="text-white h4 mb-4 d-block text-center"
                style="text-decoration:none"><b>FIVOY</b></a>
            <ul class="nav flex-column">
                <li class="nav-item mb-3 {{ Request::is('dashboard') ? 'bg-primary rounded-3' : '' }}"
                    style="width: 100%;">
                    <a href="/dashboard" class="nav-link text-white py-2 fs-6 d-flex align-items-center">
                        <i class="bi bi-film fs-5 me-3"></i> <b>Film</b>
                    </a>
                </li>
                <li class="nav-item mb-3 {{ Request::is('favorites') ? 'bg-primary rounded-3' : '' }}"
                    style="width: 100%;">
                    <a href="{{ session('user') ? '/favorites' : route('login') }}"
                        class="nav-link text-white py-2 fs-6 d-flex align-items-center">
                        <i class="bi bi-heart fs-5 me-3"></i> <b>Favorites</b>
                    </a>
                </li>
                <li class="nav-item mb-3 {{ Request::is('profile') ? 'bg-primary rounded-3' : '' }}"
                    style="width: 100%;">
                    <a href="{{ session('user') ? '/profile' : route('login') }}"
                        class="nav-link text-white py-2 fs-6 d-flex align-items-center">
                        <i class="bi bi-person fs-5 me-3"></i> <b>Account</b>
                    </a>
                </li>
            </ul>

            <div class="mt-auto">
                <a href="/logout" class="btn btn-danger w-100">Logout</a>
            </div>
        </div>
        <!-- Main Area (navbar + content) -->
        <div class="flex-grow-1 d-flex flex-column overflow-hidden">
            <!-- Top Navbar -->
            <nav class="navbar navbar-dark bg-black px-3">
                <div class="mx-auto" style="width: 700px;">
                    <form action="{{ route('favorites') }}" method="GET" class="position-relative" role="search">
                        <input class="form-control pe-5" type="search" name="search" placeholder="Search..."
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="position-absolute top-50 end-0 translate-middle-y me-3 border-0 bg-transparent text-secondary">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </nav>
            <!-- Main Content -->
            <div class="bg-black text-white px-5 pb-5" style="max-height: 90vh; overflow-y: auto;">
                <div class="my-4">
                    <h4 class="mb-4">{{ session('user')['name'] }}, Film yang di Sukai:</h4>

                    @if ($films->isEmpty())
                        <div class="alert alert-info">Kamu belum menyukai film apapun.</div>
                    @else
                        <div class="film-row d-flex gap-3 overflow-auto pb-3">
                            @foreach ($films as $film)
                                <div class="film-card flex-shrink-0" style="width: 150px;">
                                    <a href="{{ route('film.view', ['id' => $film->id]) }}">
                                        <img src="{{ asset('storage/' . $film->foto) }}" alt="Poster"
                                            class="img-fluid rounded bg-black"
                                            style="height: 200px; object-fit: contain;" />
                                    </a>
                                    <h6 class="mt-2 text-white text-center">{{ $film->judul }}</h6>
                                </div>
                            @endforeach
                        </div>

                    @endif
                </div>
            </div>

            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
