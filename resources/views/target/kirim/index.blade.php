@extends('target.layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Judul Halaman -->
    <div class="mb-4">
        <h3 class="fw-bold d-flex align-items-center gap-2 text-success">
            <i class="bi bi-send-check-fill fs-3"></i> Relasi Pengiriman Surat
        </h3>
        <p class="text-muted">Kirim surat ke relasi yang tersedia melalui sistem UNIBAMAIL.</p>
    </div>

    <!-- Jika tidak ada data -->
    @if($data->isEmpty())
        <div class="alert alert-light shadow-sm border-start border-4 border-success">
            <i class="bi bi-info-circle-fill text-success"></i> Belum ada relasi yang tersedia.
        </div>
    @else
        <!-- Daftar Relasi -->
        <div class="row g-4">
            @foreach($data as $row)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm glass-card">
                        <!-- Header Card -->
                        <div class="card-header bg-gradient-success text-white fw-semibold d-flex align-items-center gap-2 rounded-top-4">
                            <i class="bi bi-person-circle fs-5"></i> {{ $row['name'] }}
                        </div>

                        <!-- Body Card -->
                        <div class="card-body">
                            <form action="{{ route('kirim.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_pengirim" value="{{ Auth::user()->id }}">
                                @if($row['sekretaris'] && $row['sekretaris'] != Auth::user()->id )
                                    <input type="hidden" name="id_penerima" value="{{ $row['sekretaris'] }}">
                                @else
                                    <input type="hidden" name="id_penerima" value="{{ $row['id'] }}">
                                @endif
                                <input type="hidden" name="posisi" value="0">

                                <!-- Pilih Surat -->
                                <div class="mb-3 mt-2">
                                    <label for="id_surat" class="form-label text-success fw-semibold">
                                        Pilih Surat
                                    </label>
                                    <select name="id_surat" class="form-select modern-select" required>
                                        <option value="" disabled selected>-- Pilih Surat --</option>
                                        @foreach($surat as $s)
                                            <option value="{{ $s['id'] }}">
                                                {{ $s['perihal'] }} / {{ $s['id'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tombol Kirim -->
                                <div class="d-grid">
                                    <button type="submit"
                                        class="btn btn-gradient-success d-flex justify-content-center align-items-center gap-2">
                                        <i class="bi bi-send-plus-fill"></i> Kirim Surat
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Style Modern -->
<style>
    /* Gradient hijau */
    .bg-gradient-success {
        background: linear-gradient(135deg, #198754, #28a745);
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
        box-shadow: 0 6px 18px rgba(25, 135, 84, 0.25);
    }

    /* Card transparan */
    .glass-card {
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .glass-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(25, 135, 84, 0.15);
    }

    /* Select modern */
    .modern-select {
        border: 1.5px solid #198754;
        border-radius: 10px;
        padding: 8px 12px;
        transition: all 0.2s ease-in-out;
    }
    .modern-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.2);
    }
</style>
@endsection
