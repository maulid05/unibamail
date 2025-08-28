@extends('target.layouts.app')
@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg glass-card p-4" style="width: 420px;">
        <div class="text-center mb-3">
            <i class="bi bi-cloud-upload fs-1 text-success"></i>
            <h5 class="fw-bold mt-2">Upload Lampiran Surat</h5>
            <p class="text-muted small">Pilih file untuk ditempelkan ke surat</p>
        </div>

        <form action="{{ route('tempel.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <input class="form-control" type="file" name="file" id="formfile" multiple required>
                <input type="hidden" name="id_surat" value="{{ $id_surat->id }}">
            </div>

            <div class="d-grid">
                <button class="btn btn-gradient-success" type="submit">
                    <i class="bi bi-upload"></i> Upload
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Styling -->
<style>
    .glass-card {
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(25, 135, 84, 0.2);
    }
    .btn-gradient-success {
        background: linear-gradient(135deg, #198754, #28a745);
        border: none;
        color: #fff;
        font-weight: 500;
        border-radius: 12px;
        padding: 10px;
        transition: all 0.3s ease;
    }
    .btn-gradient-success:hover {
        background: linear-gradient(135deg, #157347, #1e7e34);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(25, 135, 84, 0.25);
    }
</style>
@endsection
