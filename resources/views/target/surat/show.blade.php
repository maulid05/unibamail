@extends('target.layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <h2 class="fw-semibold text-success">📝 Detail Surat</h2>
        <p class="text-muted">Informasi lengkap mengenai surat yang telah dibuat</p>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-4" style="background-color: #f4fdf7;">
        <div class="card-body px-4 py-5">
            <div class="mb-3">
                <div class="d-flex align-items-start">
                    <i class="bi bi-envelope-paper text-success fs-5 me-3"></i>
                    <div>
                        <strong>No. Surat:</strong><br>
                        {{ $surat->no_urut }}/{{ $surat->kode_instansi }}/{{ $surat->jenis_surat }}/{{ $surat->bulan }}/{{ $surat->tahun }}
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex align-items-start">
                    <i class="bi bi-chat-left-text text-success fs-5 me-3"></i>
                    <div>
                        <strong>Perihal:</strong><br>
                        {{ $surat->perihal }}
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex align-items-start">
                    <i class="bi bi-calendar-event text-success fs-5 me-3"></i>
                    <div>
                        <strong>Tanggal Pelaksanaan:</strong><br>
                        {{ $surat->tanggal }}
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex align-items-start">
                    <i class="bi bi-file-earmark-text text-success fs-5 me-3"></i>
                    <div>
                        <strong>Isi Surat:</strong><br>
                        <div class="text-muted mt-1">{{ $surat->isi }}</div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="d-flex align-items-start">
                    <i class="bi bi-file-earmark-text text-success fs-5 me-3"></i>
                    <div>
                        <strong>Di Setujui oleh:</strong><br>
                        @foreach($qr as $setuju)
                        <div class="text-muted mt-1">
                           <img src="{{ asset('storage/' . $setuju['qrcode']) }}" alt="QR Code">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @foreach($file as $data)
                @if($data['id_surat'] == $surat->id)
                <div class="mb-3">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-paperclip text-success fs-5 me-3"></i>
                        <div>
                            <strong>File Lampiran:</strong><br>
                            <a href="{{ asset('storage/' . $data['file']) }}" target="_blank" class="text-decoration-underline link-success">
                                Klik untuk melihat lampiran
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            @if(Auth::user()->id == $surat->user_id)
            <div class="d-flex justify-content-end gap-2 flex-wrap mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                     <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                </a>
            </div>
            @else
            <div class="d-flex justify-content-end gap-2 flex-wrap mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                     <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                </a>
                @if($sekret)
                <form id="teruskan" action="{{ route('relasi.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="{{ $surat->id }}" name="id_surat">

                    <select name="id_pengirim" id="select-atasan" class="btn btn-outline-info btn-sm rounded-pill px-4 py-2" required>
                        <option value="" default selected>Dari : ___</option>
                        @foreach($balas as $user)
                        <option value="{{ $user['id'] }}"> Dari : 
                            {{ $user['name'] }} / {{ $user['id'] }}         
                        </option>
                        @endforeach
                    </select>

                    <select name="id_penerima" id="select-atasan" class="btn btn-outline-info btn-sm rounded-pill px-4 py-2" required>
                        <option value="" disabled selected>Ke : _____ </option>
                        @foreach($atasan as $user)
                        <option value="{{ $user['id'] }}">Ke :
                            {{ $user['name'] }} / {{ $user['id'] }}         
                        </option>
                        @endforeach
                    </select>

                    <select name="posisi" id="select-atasan" class="btn btn-outline-info btn-sm rounded-pill px-4 py-2" required>
                        <option value="" disabled selected>-- Status --</option>
                        <option value="0">Teruskan</option>
                        <option value="1">ACC</option>
                        <option value="2">Revisi</option>
                    </select>
                    
                    <button type="submit" class="btn btn-outline-success rounded-pill px-4 py-2">
                        <i class="bi bi-pencil-square me-2"></i> Kirim
                    </button>
                </form>
                @else
                <form action="{{ route('relasi.update', $id->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="2" name="posisi">
                    <button type="submit" class="btn btn-outline-warning rounded-pill px-4 py-2">
                        <i class="bi bi-pencil-square me-2"></i> Revisi
                    </button>
                </form>
                <form action="{{ route('relasi.update', $id->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="1" name="posisi">
                    <button type="submit" class="btn btn-outline-success rounded-pill px-4 py-2">
                        <i class="bi bi-pencil-square me-2"></i> ACC
                    </button>
                </form>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
