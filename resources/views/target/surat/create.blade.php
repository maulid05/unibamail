@extends('target.layouts.app')

@section('content')
<div class="container py-5">
    <!-- Heading -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-success mb-1">Formulir Surat Baru</h2>
        <small class="text-muted">Lengkapi data surat dengan ringkas dan tepat</small>
    </div>

    <!-- Card Form -->
    <div class="card border-0 shadow-sm rounded-3 px-4 py-5" style="background-color: #f9fdfb;">
        <form action="{{ route('surat.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <!-- Nomor Surat -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-success">Nomor Surat</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="text" name="no_urut" value="{{ $no_urut }}" class="form-control" placeholder="No. Urut" required>
                    </div>
                    <div class="col">
                        <input type="text" name="kode_instansi" class="form-control" placeholder="Kode Instansi" required>
                    </div>
                    <div class="col">
                        <input type="text" name="jenis_surat" class="form-control" placeholder="Jenis Surat" required>
                    </div>
                    <div class="col">
                        <input type="text" name="bulan" value="{{ $bulan }}" class="form-control" placeholder="Bulan" required>
                    </div>
                    <div class="col">
                        <input type="text" name="tahun" value="{{ $tahun }}" class="form-control" placeholder="Tahun" required>
                    </div>
                </div>
            </div>

            <!-- Perihal -->
            <div class="mb-3">
                <label for="perihal" class="form-label text-success fw-semibold">Perihal</label>
                <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Contoh: Undangan Rapat Evaluasi" required>
            </div>

            <!-- Tanggal -->
            <div class="mb-3">
                <label for="tanggal" class="form-label text-success fw-semibold">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>

            <!-- Isi Surat -->
            <div class="mb-3">
                <label for="isi" class="form-label text-success fw-semibold">Isi Surat</label>
                <textarea name="isi" id="isi" rows="5" class="form-control" placeholder="Tulis isi surat secara ringkas dan jelas" required></textarea>
            </div>

            <!-- Hidden User ID -->
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg rounded-pill">
                    <i class="bi bi-save me-1"></i> Simpan Surat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
