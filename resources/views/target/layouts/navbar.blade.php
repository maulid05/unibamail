<nav class="navbar navbar-expand-lg bg-success navbar-dark shadow-sm">
    <div class="container-fluid px-3">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">UNIBAMAIL</a>

        <!-- Sidebar Toggle -->
        <a class="btn btn-outline-light me-2 d-none d-lg-inline" href="{{ route('surat.create') }}">Kirim surat</a>

        <!-- Mobile Navbar Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Nav Links -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kirim.index') }}">Relasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('surat.index') }}">History</a>
                </li>

                <!-- User Dropdown -->
                @auth
                    <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded" aria-labelledby="userDropdown">
                                 <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                                 </li>
                                 <li>
                            <form method="POST" action="{{ route('logout') }}">
                                 @csrf
                                 <button type="submit" class="dropdown-item text-danger">
                            {{ __('Log Out') }}
                                 </button>
                            </form>
                                 </li>
                            </ul>
                    </li>
                    @else
                    <li class="nav-item ms-3">
                        <a href="{{ url('auth/google') }}" class="btn btn-outline-light d-flex align-items-center gap-2">
                             <i class="bi bi-google"></i> Login with Google
                        </a>
                    </li>
                    @endauth

                </ul>
        </div>
    </div>
</nav>
