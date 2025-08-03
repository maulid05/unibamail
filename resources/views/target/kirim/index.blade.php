@extends('target.layouts.app')

@section('content')
<body>
    <div class="container-fluid px-5">
        <div class="mt-5">
            <h3 class="fw-bold mb-4 d-flex align-items-center gap-2 text-success">
                <i class="bi bi-send-check-fill fs-4"></i> Relasi Pengiriman Surat
            </h3>

            @if($data->isEmpty())
                <div class="alert alert-success shadow-sm border-start border-4 border-success">
                    <i class="bi bi-info-circle-fill"></i> Tidak ada data relasi tersedia.
                </div>
            @else
                <div class="row g-4">
                    @foreach($data as $row)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-success text-white fw-semibold d-flex align-items-center gap-2">
                                    <i class="bi bi-person-circle fs-5"></i> {{ $row['name'] }}
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('kirim.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_pengirim" value="{{ Auth::user()->id }}">
                                        @if($row['sekretaris'] && $row['sekretaris'] != Auth::user()->id )
                                        <input type="hidden" name="id_penerima" value="{{ $row['sekretaris'] }}">{{$row['sekretaris']}}
                                        @else
                                        <input type="hidden" name="id_penerima" value="{{ $row['id'] }}">{{$row['id']}}
                                        @endif
                                        <input type="hidden" name="posisi" value="0">

                                        <div class="mb-3 mt-2">
                                            <label for="id_surat" class="form-label text-success fw-semibold">Pilih Surat</label>
                                            <select name="id_surat" class="form-select form-select-sm border-success" required>
                                                <option value="" disabled selected>-- Pilih Surat --</option>
                                                @foreach($surat as $s)
                                                    <option value="{{ $s['id'] }}">
                                                        {{ $s['perihal'] }} / {{ $s['id'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success btn-sm d-flex justify-content-center align-items-center gap-2 shadow-sm" data-bs-toggle="tooltip" title="Kirim Surat">
                                                <i class="bi bi-send-plus-fill"></i> Kirim
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
    </div>
</body>
@endsection
