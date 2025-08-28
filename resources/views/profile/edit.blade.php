@extends('target.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Judul Halaman --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold text-success">Edit Profil</h2>
                <small class="text-muted">Perbarui informasi akun Anda</small>
            </div>

            {{-- Kartu Form --}}
            <div class="card border-0 shadow rounded-4" style="background-color: #f5fdf7;">
                <div class="card-body p-4">
                    <form action="{{ route('edit.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
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
                                <input type="file" name="avatar" accept="image/*"
                                       class="form-control form-control-sm w-50 mx-auto"
                                       onchange="previewAvatar(event)">
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label text-success">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ old('name', Auth::user()->name) }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label text-success">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email', Auth::user()->email) }}" required>
                        </div>

                        {{-- Sekretaris --}}
                        <div class="mb-3">
                            <label for="sekretaris" class="form-label text-success">Sekretaris</label>
                            <select class="form-control" id="sekretaris" name="sekretaris" required>
                                <option value="" disabled {{ Auth::user()->sekretaris ? '' : 'selected' }}>- Pilih Sekretaris -</option>
                                @foreach($sekretaris as $data)
                                    <option value="{{ $data['id'] }}" {{ Auth::user()->sekretaris == $data['id'] ? 'selected' : '' }}>
                                        {{ $data['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Role (khusus admin) --}}
                        @if(Auth::user()->role === 'admin')
                        <div class="mb-3">
                            <label for="role" class="form-label text-success">Role</label>
                            <input type="text" class="form-control" id="role" name="role"
                                   value="{{ Auth::user()->role }}" readonly>
                        </div>
                        @endif

                        {{-- Tombol Aksi --}}
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

{{-- Daftar Atasan --}}
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow rounded-4" style="background-color: #f5fdf7;">
                <div class="card-body p-4">
                    <h5 class="text-success mb-3">Atasan</h5>
                    @forelse($atasan as $row)
                        <div class="d-flex align-items-center justify-content-between gap-3 p-3 mb-2 border rounded shadow-sm bg-light">
                            <div class="d-flex flex-column">
                                <strong class="text-dark fs-6">{{ $row['name'] }}</strong>
                                <small class="text-muted">{{ $row['email'] }}</small>
                            </div>
                            <form action="{{ route('profile.sekretaris', $row->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $row['name'] }}" name="name">
                                <input type="hidden" value="{{ $row['email'] }}" name="email">
                                <input type="hidden" value="0" name="sekretaris">
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-person-dash-fill me-1"></i> Berhenti
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada atasan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Daftar Surat --}}
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow rounded-4" style="background-color: #f5fdf7;">
                <div class="card-body p-4">
                    <h5 class="text-success mb-3">Daftar Surat</h5>
                    @forelse($surat as $row)
                        <div class="d-flex flex-column p-3 mb-2 border rounded shadow-sm bg-light">
                            <strong class="text-dark fs-6">
                                {{ $row['no_urut'] }}/{{ $row['kode_instansi'] }}/{{ $row['jenis_surat'] }}/{{ $row['bulan'] }}/{{ $row['tahun'] }}
                            </strong>
                            <small class="text-muted">{{ $row['perihal'] }}</small>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada surat.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Preview Avatar --}}
@push('scripts')
<script>
    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('previewImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush

@endsection
