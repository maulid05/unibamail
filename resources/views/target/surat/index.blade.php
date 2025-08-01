@extends('target.layouts.app')

@section('content')
<div class="container-fluid px-4 mt-5">

    <!-- Heading -->
    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-envelope-paper-fill text-success fs-3 me-2"></i>
        <h2 class="fw-bold text-success mb-0">Daftar Surat</h2>
    </div>

    <!-- Card Wrapper -->
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-0">

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-success text-dark">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Informasi Surat</th>
                            <th style="width: 280px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surat as $row)
                        <tr>
                            <td class="fw-semibold">{{ $loop->iteration }}</td>
                            <td class="text-start">
                                <div class="fw-bold text-success">
                                    {{ $row['no_urut'] }}/{{ $row['kode_instansi'] }}/{{ $row['jenis_surat'] }}/{{ $row['bulan'] }}/{{ $row['tahun'] }}
                                </div>
                                <div class="text-muted small">
                                    {{ $row['perihal'] }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('surat.show', $row->id) }}" class="btn btn-outline-success btn-sm shadow-sm d-flex align-items-center gap-1">
                                        <i class="bi bi-eye-fill"></i> Lihat
                                    </a>
                                    <a href="{{ route('surat.edit', $row->id) }}" class="btn btn-outline-warning btn-sm shadow-sm d-flex align-items-center gap-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('surat.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm d-flex align-items-center gap-1">
                                            <i class="bi bi-trash3-fill"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                Tidak ada data surat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Optional Pagination -->
            {{-- <div class="mt-4 px-4">
                {{ $surat->links() }}
            </div> --}}

        </div>
    </div>
</div>
@endsection
