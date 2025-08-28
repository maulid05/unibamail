@extends('target.layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 px-4 py-5 glass-card" style="max-width: 780px; margin:auto;">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-success mb-1">Buat Surat Baru</h2>
            <p class="text-muted small">Isi formulir berikut untuk membuat surat baru</p>
        </div>

        <!-- Form Surat -->
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
                <button type="submit" class="btn btn-gradient-success btn-lg rounded-pill">
                    <i class="bi bi-save me-1"></i> Simpan Surat
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Lampiran -->
<div class="modal fade" id="lampiranModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-success">
          <i class="bi bi-paperclip me-2"></i> Upload Lampiran
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('tempel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="surat_id" value="{{ session('surat_id') }}">
            <div class="mb-3">
                <label class="form-label text-success fw-semibold">Pilih File</label>
                <input type="file" name="lampiran" class="form-control rounded-3" required>
                <small class="text-muted">Format: PDF, DOCX, JPG (max 5MB)</small>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-gradient-success rounded-pill">
                    <i class="bi bi-upload me-1"></i> Upload Lampiran
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Styling -->
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    .btn-gradient-success {
        background: linear-gradient(135deg, #198754, #28a745);
        border: none;
        color: #fff;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-gradient-success:hover {
        background: linear-gradient(135deg, #157347, #1e7e34);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(25, 135, 84, 0.25);
    }
</style>

<!-- Script untuk auto buka modal -->
@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = new bootstrap.Modal(document.getElementById('lampiranModal'));
        modal.show();
    });
</script>
@endif

@endsection
