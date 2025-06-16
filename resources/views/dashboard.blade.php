<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <style>
        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
            user-select: none;
        }

        .scroll-btn:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .scroll-left {
            left: 0;
        }

        .scroll-right {
            right: 0;
        }

        .film-row {
            overflow-x: auto;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .film-row::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-black text-white">
    <div class="d-flex" style="height: 100vh; overflow: hidden;">
        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white d-flex flex-column p-3 position-fixed top-0 bottom-0" style="width: 250px;">
    <a href="/dashboard" class="text-white h4 mb-4 d-block text-center text-decoration-none">
        <b>FIVOY</b>
    </a>
    <ul class="nav flex-column">
        <li class="nav-item mb-3 {{ Request::is('dashboard') ? 'bg-primary rounded-3' : '' }}">
            <a href="/dashboard" class="nav-link text-white py-2 fs-6 d-flex align-items-center">
                <i class="bi bi-film fs-5 me-3"></i> <b>Film</b>
            </a>
        </li>
        <li class="nav-item mb-3 {{ Request::is('favorites') ? 'bg-primary rounded-3' : '' }}">
            <a href="{{ session('user') ? '/favorites' : route('login') }}"
               class="nav-link text-white py-2 fs-6 d-flex align-items-center">
                <i class="bi bi-heart fs-5 me-3"></i> <b>Favorites</b>
            </a>
        </li>
        <li class="nav-item mb-3 {{ Request::is('profile') ? 'bg-primary rounded-3' : '' }}">
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

        <!-- Main Area -->
        <div class="flex-grow-1 d-flex flex-column overflow-hidden" style="margin-left: 250px;">

            <!-- Top Navbar -->
            <nav class="navbar navbar-dark bg-black px-3">
                <div class="d-flex justify-content-start w-100">
                    @if(session()->has('user'))
                        <span class="fs-5 fw-semibold">Selamat Datang, {{ session('user.name') }}</span>
                    @endif
                    <form action="{{ route('dashboard') }}" method="GET" class="position-relative" style="max-width: 500px; width: 100%;">
                        <input type="search" name="search" class="form-control pe-5" placeholder="Search..." value="{{ request('search') }}">
                        <button type="submit"
                            class="btn position-absolute top-50 end-0 translate-middle-y me-3 p-0 border-0 bg-transparent text-secondary">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Content -->
            <div class="bg-black text-white px-4 pb-5" style="max-height: 90vh; overflow-y: auto;">
                @if(request()->has('search') && request('search') != '')
                    <h4 class="mb-3">Hasil Pencarian "{{ request('search') }}"</h4>
                    <div class="position-relative mb-5">
                        <button class="scroll-btn scroll-left"><i class="bi bi-chevron-left"></i></button>
                        <div class="film-row d-flex gap-3">
                            @forelse ($films as $film)
                                <div style="flex: 0 0 auto; width: 150px;">
                                    <a href="{{ route('film.view', ['id' => $film->id]) }}">
                                        <img src="{{ asset('storage/' . $film->foto) }}" alt="Poster"
                                            class="img-fluid rounded bg-black" style="height: 200px; object-fit: contain;" />
                                    </a>
                                    <h6 class="mt-2 text-white text-center">{{ $film->judul }}</h6>
                                </div>
                            @empty
                                <p>Tidak ada film ditemukan.</p>
                            @endforelse
                        </div>
                        <button class="scroll-btn scroll-right"><i class="bi bi-chevron-right"></i></button>
                    </div>
                @else
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Films</h4>
                        <a href="{{ route('films.all') }}" class="btn btn-outline-light btn-sm">Lihat</a>
                    </div>

                    <div class="position-relative mb-5">
                        <button class="scroll-btn scroll-left"><i class="bi bi-chevron-left"></i></button>
                        <div class="film-row d-flex gap-3">
                            @foreach ($films as $film)
                                <div style="flex: 0 0 auto; width: 150px;">
                                    <a href="{{ route('film.view', ['id' => $film->id]) }}">
                                        <img src="{{ asset('storage/' . $film->foto) }}" alt="Poster"
                                            class="img-fluid rounded bg-black" style="height: 200px; object-fit: contain;" />
                                    </a>
                                    <h6 class="mt-2 text-white text-center">{{ $film->judul }}</h6>
                                </div>
                            @endforeach
                        </div>
                        <button class="scroll-btn scroll-right"><i class="bi bi-chevron-right"></i></button>
                    </div>

                    @foreach ($genres as $genre)
                        <div class="d-flex justify-content-between align-items-center mb-9 mt-9">
                            <h4>{{ $genre->genre }} Movies</h4>
                            <a href="{{ route('genre.films', ['id' => $genre->id]) }}" class="btn btn-outline-light btn-sm">Lihat</a>
                        </div>
                        <div class="position-relative mb-5">
                            <button class="scroll-btn scroll-left"><i class="bi bi-chevron-left"></i></button>
                            <div class="film-row d-flex gap-3">
                                @forelse ($genre->films as $film)
                                    <div style="flex: 0 0 auto; width: 150px;">
                                        <a href="{{ route('film.view', ['id' => $film->id]) }}">
                                            <img src="{{ asset('storage/' . $film->foto) }}" alt="Poster"
                                                class="img-fluid rounded bg-black" style="height: 200px; object-fit: contain;" />
                                        </a>
                                        <h6 class="mt-2 text-white text-center">{{ $film->judul }}</h6>
                                    </div>
                                @empty
                                    <p>Genre ini belum memiliki film.</p>
                                @endforelse
                            </div>
                            <button class="scroll-btn scroll-right"><i class="bi bi-chevron-right"></i></button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.scroll-btn').forEach(button => {
            button.addEventListener('click', () => {
                const container = button.parentElement.querySelector('.film-row');
                const scrollAmount = 150;
                if (button.classList.contains('scroll-left')) {
                    container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                } else {
                    container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                }
            });
        });
    </script>
</body>

</html>
