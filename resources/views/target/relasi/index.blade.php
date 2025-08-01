@extends('target.layouts.app')

@section('content')
<div class="container ps-0 px-0 pt-5">
    <h3 class="mb-4 fw-semibold text-success">📂 Daftar Surat</h3>

    {{-- Custom CSS untuk hilangkan panah default accordion --}}
    <style>
        .accordion-button::after {
            display: none !important;
        }
    </style>

    <div class="accordion" id="accordionSurat">
        @php
            $categories = [
                'Diterima' => ['data' => $terima, 'tipe' => 'id_pengirim', 'icon' => 'inbox-fill'],
                'Dikirim' => ['data' => $kirim, 'tipe' => 'id_penerima', 'icon' => 'send-fill'],
                'Direvisi' => ['data' => $revisi, 'tipe' => 'id_penerima', 'icon' => 'pencil-square'],
                'Disetujui (ACC)' => ['data' => $acc, 'tipe' => 'id_penerima', 'icon' => 'check-circle-fill'],
            ];
        @endphp

        @foreach($categories as $label => $config)
        <div class="accordion-item border border-success-subtle mb-3 shadow-sm rounded-4 overflow-hidden">
            <h2 class="accordion-header" id="heading-{{ Str::slug($label) }}">
                <button class="accordion-button collapsed bg-success text-white fw-semibold py-3 px-4 d-flex justify-content-between align-items-center"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ Str::slug($label) }}"
                        aria-expanded="false" aria-controls="collapse-{{ Str::slug($label) }}"
                        style="position: relative; padding-right: 5rem;">
                    <span>
                        <i class="bi bi-{{ $config['icon'] }} me-2"></i> {{ $label }}
                    </span>
                    <span class="position-absolute end-0 me-4 text-white-50 fs-5">
                        {{ count($config['data']) }}
                    </span>
                </button>
            </h2>

            <div id="collapse-{{ Str::slug($label) }}" class="accordion-collapse collapse"
                 aria-labelledby="heading-{{ Str::slug($label) }}" data-bs-parent="#accordionSurat">
                <div class="accordion-body bg-success-subtle px-4 py-3 rounded-bottom-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle text-center m-0 bg-white rounded-3 overflow-hidden shadow-sm border">
                            <thead class="table-success text-dark">
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>{{ $config['tipe'] === 'id_pengirim' ? 'Pengirim' : 'Penerima' }}</th>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($config['data'] as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ optional($user->firstWhere('id', $row[$config['tipe']]))->name ?? '-' }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($row['updated_at'])->translatedFormat('d M Y, H:i') }}</td>
                                        <td>
                                            @php
                                                $suratData = $surat->firstWhere('id', $row['id_surat']);
                                            @endphp
                                            @if($suratData)
                                                <a href="{{ route('surat.show', $suratData->id) }}"
                                                   class="text-decoration-none text-success fw-semibold">
                                                    {{ $suratData->perihal }}
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-muted py-3">
                                            Belum ada data {{ strtolower($label) }}
                                        </td>
                                    </tr>
                                @endforelse

                                @if(count($config['data']) > 0)
                                    <tr>
                                        <td colspan="4" class="text-end text-success fw-semibold">
                                            Total: {{ count($config['data']) }} surat
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
