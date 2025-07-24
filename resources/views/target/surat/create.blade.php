@extends('target.layouts.app')
@section('content')
<div class="container mt-5">
  <h3>Surat Baru</h3>
  <form action="{{ route('surat.store') }}" method="post">
    @csrf

    <div class="mb-3">
  <label class="form-label">No. Surat</label>
        <div class="row gx-2">
            <div class="col">
              <input type="text" value="{{ $no_urut }}" class="form-control" placeholder="Nomor Urut" id="no_urut" name="no_urut">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Kode Instansi" id="kode_instansi" name="kode_instansi">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Jenis Surat" id="jenis_surat" name="jenis_surat" >
            </div>
            <div class="col">
              <input type="text" value="{{ $bulan }}" class="form-control" placeholder="Bulan" id="bulan" name="bulan" >
            </div>
            <div class="col">
              <input type="text" value="{{ $tahun }}" class="form-control" placeholder="Tahun" id="tahun" name="tahun">
            </div>
        </div>
    </div>

    <div class="mb-3">
      <label for="perihal" class="form-label">Perihal</label>
      <input type="text" class="form-control" id="perihal" name="perihal" required>
    </div>

    <div class="mb-3">
      <label for="tanggal" class="form-label">Tanggal Pelaksanaan</label>
      <input type="date" class="form-control" id="tanggal" name="tanggal" required>
    </div>

    <div class="mb-3">
      <label for="isi" class="form-label">Isi Surat</label>
      <textarea class="form-control" id="isi" name="isi" rows="5" required></textarea>
    </div>
    <input type="hidden" class="hidden" name="user_id" value="{{ Auth::user()->id }}">

    <button type="submit" class="btn btn-success">Simpan Surat</button>
  </form>
</div>
@endsection