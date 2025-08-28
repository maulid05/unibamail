<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container-fluid px-4">
    <!-- Brand / Logo -->
    <a class="navbar-brand fw-bold text-success d-flex align-items-center" href="{{ route('dashboard') }}">
      <i class="bi bi-envelope-open-heart me-2"></i> UNIBAMAIL
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
      aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

        <!-- Dashboard (gabungan jika sama dengan relasi.index) -->
        <li class="nav-item">
          <a class="nav-link modern-link" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span class="d-none d-md-inline">Dashboard</span>
          </a>
        </li>

        <!-- Surat Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle modern-link" href="#" id="suratDropdown"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-envelope-paper"></i>
            <span class="d-none d-md-inline">Surat</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0"
              style="backdrop-filter: blur(6px); background: rgba(255,255,255,0.95);">
            <li>
              <a class="dropdown-item" href="{{ route('surat.index') }}">
                <i class="bi bi-collection"></i> Daftar Surat
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('surat.create') }}">
                <i class="bi bi-plus-circle"></i> Buat Surat
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('kirim.index') }}">
                <i class="bi bi-send"></i> Kirim Surat
              </a>
            </li>
          </ul>
        </li>

        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle modern-link" href="#" id="profileDropdown"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0"
              style="backdrop-filter: blur(6px); background: rgba(255,255,255,0.95);">
            <li>
              <a class="dropdown-item" href="{{ route('profile.edit') }}">
                <i class="bi bi-gear"></i> Edit Profile
              </a>
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Extra CSS -->
<style>
  .modern-link {
    transition: all 0.2s ease-in-out;
    border-radius: 8px;
    padding: 6px 12px !important;
  }
  .modern-link:hover {
    background-color: #e8f7ee;
    color: #198754 !important;
    transform: translateY(-1px);
  }
  .dropdown-item {
    transition: all 0.2s ease;
    border-radius: 6px;
    padding: 8px 14px;
  }
  .dropdown-item:hover {
    background-color: #e9f5ff;
    color: #0d6efd;
  }
</style>
