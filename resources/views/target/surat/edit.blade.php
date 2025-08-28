@extends('target.layouts.app')

@section('content')
<div class="container py-5">
    <!-- Heading -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-success mb-1">Edit Surat</h2>
        <small class="text-muted">Perbarui informasi surat atau tempelkan file baru</small>
    </div>

    <!-- Card Form -->
    <div class="card border-0 shadow-sm rounded-3 px-4 py-5" style="background-color: #f9fdfb;">
        <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Perihal -->
            <div class="mb-3">
                <label class="form-label text-success fw-semibold">Perihal</label>
                <input type="text" name="perihal" class="form-control" value="{{ $surat->perihal }}" required>
            </div>

            <!-- Tanggal -->
            <div class="mb-3">
                <label class="form-label text-success fw-semibold">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $surat->tanggal }}" required>
            </div>

            <!-- Isi Surat -->
            <div class="mb-3">
                <label class="form-label text-success fw-semibold">Isi Surat</label>
                <textarea name="isi" rows="5" class="form-control" required>{{ $surat->isi }}</textarea>
            </div>

            <!-- Tempel Lama -->
            <div class="mb-3">
                <label class="form-label text-success fw-semibold">Tempel Lama</label>
                <ul class="list-group">
                    @forelse($tempel as $file)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ asset($file->file) }}" target="_blank">{{ basename($file->file) }}</a>
                            <form action="{{ route('tempel.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Hapus tempel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Tidak ada tempel</li>
                    @endforelse
                </ul>
            </div>

            <!-- Upload Tempel Baru -->
            <div class="mb-3">
                <label class="form-label text-success fw-semibold">Tambahkan Tempel Baru</label>
                <input type="file" name="tempel[]" class="form-control" multiple>
                <small class="text-muted">Boleh lebih dari satu file</small>
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg rounded-pill">
                    <i class="bi bi-save me-1"></i> Perbarui Surat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
