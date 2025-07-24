 @extends('target.layouts.app')
 @section('content')
 <body>
                <!-- Page content-->
                <div class="container-fluid px-5">
                    <a class="btn btn-success btn-sm mt-3" href="{{ route('surat.create') }}" style="text-transform: none;">
                        halaman surat
                    </a>
                    <table class="container table table-borderred">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Surat</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surat as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <h6>
                                        {{ $row['no_urut'] }}/
                                        {{ $row['kode_instansi'] }}/
                                        {{ $row['jenis_surat'] }}/
                                        {{ $row['bulan'] }}/
                                        {{ $row['tahun'] }}
                                    </h6>
                                    <p>{{ $row['perihal'] }}</p>

                                </td>
                                <td>
                                    <form action="{{ route('relasi.store') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" class="form-control" name="id_surat" value="{{ $row->id }}">
                                        <input type="hidden" class="form-control" name="id_pengirim" value="{{ Auth::user()->id }}">
                                        <div class="input-group">
                                            <!-- Dropdown untuk memilih ID -->
                                            <select name="id" class="form-select form-select-sm" required>
                                                <option value="" disabled selected>Pilih ID</option>
                                                @foreach ($tujuan as $row)
                                                    <option name="id_penerima" value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                                </select>
                                            <!-- Tombol Kirim -->
                                            <button type="submit" class="btn btn-primary btn-sm bi bi-send"> Kirim</button>
                                        </div>
                                    </form>
                                    <a href="{{ route('surat.edit', $row->id)}}" class="text-light btn btn-warning btn-sm bi bi-pen mt-2"> Edit</a>
                                    <a href="{{ route('surat.destroy', $row->id) }}" class="btn btn-danger btn-sm bi bi-trash mt-2"> Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                  
                </div>
                
@endsection