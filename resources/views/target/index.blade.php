@extends('target.layouts.app')

@section('content')
<div class="container-fluid px-5">
    {{-- Info Hari Ini --}}
    <h3 class="mt-4 fw-bold text-success">📅 Info Hari Ini</h3>
    <div class="row g-4 mt-3">
        @if($datasuratterima && $datasuratterima->count())
            @foreach($datasuratterima as $item)
                @php
                    $suratData = $surat->firstWhere('id', $item->id_surat);
                @endphp
                @if($suratData)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 hover-card bg-light">
                            <div class="card-body">
                                <h5 class="card-title text-success fw-bold">{{ $suratData->perihal }}</h5>
                                <span class="badge bg-success">Surat Masuk</span>
                                <p class="card-text mt-2 text-muted small">Diterima hari ini</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @elseif($datasuratdikirim && $datasuratdikirim->count())
            @foreach($datasuratdikirim as $item)
                @php
                    $suratData = $surat->firstWhere('id', $item->id_surat);
                @endphp
                @if($suratData)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 hover-card bg-light">
                            <div class="card-body">
                                <h5 class="card-title text-success fw-bold">{{ $suratData->perihal }}</h5>
                                <span class="badge bg-success">Surat Dikirim</span>
                                <p class="card-text mt-2 text-muted small">Dikirim hari ini</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @elseif($dataatasan && $dataatasan->count())
            @foreach($dataatasan as $atasan)
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center h-100 hover-card bg-light">
                        <img src="{{ asset('storage/' . $atasan->avatar) }}" 
                             class="rounded-circle mt-3 border border-3 border-success"
                             style="width:80px; height:80px; object-fit:cover;" 
                             alt="avatar">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">{{ $atasan->name }}</h5>
                            <p class="card-text small text-muted">Atasan</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">Tidak ada info hari ini.</p>
        @endif
    </div>

    {{-- Terakhir Dihubungi --}}
    <h3 class="mt-5 fw-bold text-success">📞 Terakhir Dihubungi</h3>
    <div class="row g-4 mt-3">
        @foreach($terbaru as $hub)
            @php
                $userData = $user->firstWhere('id', $hub->id_pengirim);
            @endphp
            @if($userData)
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center h-100 hover-card bg-light">
                        <img src="{{ asset('storage/' . $userData->avatar) }}" 
                             class="rounded-circle mt-3 border border-3 border-success"
                             style="width:80px; height:80px; object-fit:cover;" 
                             alt="avatar">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">{{ $userData->name }}</h5>
                            <p class="card-text small text-muted">Pengirim terakhir</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- Surat Dikirim --}}
    <h3 class="mt-5 fw-bold text-success">📤 Surat Dikirim</h3>
    <div class="row g-4 mt-3">
        @foreach($terbaru as $hub)
            @php
                $suratData = $surat->firstWhere('id', $hub->id_surat);
            @endphp
            @if($suratData)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 hover-card bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">{{ $suratData->perihal }}</h5>
                            <span class="badge bg-success">Dikirim</span>
                            <p class="card-text mt-2 text-muted small">Hari ini</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

{{-- CSS tambahan untuk efek hover --}}
<style>
    .hover-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 128, 0, 0.2);
    }
</style>
@endsection
