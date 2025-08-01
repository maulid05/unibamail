@extends('target.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="text-center mb-4">
                <h2 class="fw-bold text-success">Edit Profil</h2>
                <small class="text-muted">Perbarui informasi akun Anda</small>
            </div>

            <div class="card border-0 shadow rounded-4" style="background-color: #f5fdf7;">
                <div class="card-body p-4">

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Foto Profil --}}
                        <div class="text-center mb-4">
                            <img id="previewImage" 
                                 src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                                 class="rounded-circle shadow border border-3 border-success"
                                 width="130" height="130"
                                 style="object-fit: cover;">
                            <div class="mt-3">
                                <input type="file" name="avatar" accept="image/*" class="form-control form-control-sm w-50 mx-auto" onchange="previewAvatar(event)">
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label text-success">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label text-success">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                        </div>

                        {{-- Role (opsional tampil jika admin) --}}
                        @if(Auth::user()->role === 'admin')
                        <div class="mb-3">
                            <label for="role" class="form-label text-success">Role</label>
                            <input type="text" class="form-control" id="role" name="role" value="{{ Auth::user()->role }}" readonly>
                        </div>
                        @endif

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- Live Preview Image --}}
@push('scripts')
<script>
    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('previewImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
@endsection
