<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid d-flex align-items-center justify-content-between py-2 px-3 bg-white shadow-sm">
    <!-- LOGO -->
    <h3 class="mb-0 fw-bold px-2">UNIBAMAIL</h3>

    <!-- Sidebar Toggle -->
    <button class="btn btn-outline-primary me-3" id="sidebarToggle">Toggle Menu</button>

    <!-- Navbar Toggle (Mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto align-items-center">
            <!-- Link -->
            <li class="nav-item">
                <form method="GET" action="{{ route('relasi.index') }}">
                    <input type="text" name="search" placeholder="Cari produk..." value="{{ $search }}">
                    <button type="submit">Cari</button>
                </form>
            </li>

            <!-- Auth Dropdown -->
            <li class="nav-item dropdown">
                @auth
                    <!-- Dropdown Toggle -->
                    <a class="nav-link dropdown-toggle fw-semibold px-3" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu dropdown-menu-end shadow rounded" aria-labelledby="navbarDropdown">
                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}"
                            class="dropdown-item text-dark px-3 py-2 rounded hover:bg-light">
                            {{ __('Profile') }}
                        </a>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="dropdown-item text-danger px-3 py-2 rounded hover:bg-light">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Google Login -->
                    <a href="{{ url('auth/google') }}"
                        class="btn btn-outline-dark d-flex align-items-center gap-2 ms-3 px-3 py-2">
                        <i class="bi bi-google"></i> Login with Google
                    </a>
                @endauth
            </li>
        </ul>
    </div>
</div>
                </nav>