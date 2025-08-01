<nav class="navbar navbar-expand-lg bg-success navbar-dark shadow-sm sticky-top" style="background: linear-gradient(90deg, #198754 0%, #157347 100%)">
    <div class="container-fluid px-4">
        <!-- Brand -->
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('surat.index') }}">
            <i class="bi bi-envelope-paper-heart-fill fs-4"></i>
            UNIBAMAIL
        </a>

        <!-- Tombol Kirim Surat -->
        <a href="{{ route('surat.create') }}" class="btn btn-outline-light me-3 d-none d-lg-block shadow-sm">
            <i class="bi bi-send-plus"></i> Kirim Surat
        </a>

        <!-- Hamburger Menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Menu -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="{{ route('kirim.index') }}">
                        <i class="bi bi-link-45deg"></i> Relasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="{{ route('relasi.index') }}">
                        <i class="bi bi-clock-history"></i> History
                    </a>
                </li>

                <!-- Auth Menu -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow rounded" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-gear-fill"></i> {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('Log Out') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ url('auth/google') }}" class="btn btn-outline-light d-flex align-items-center gap-2 shadow-sm">
                            <i class="bi bi-google"></i> Login with Google
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
