 @extends('target.layouts.app')
 @section('content')
 <body>
                <div class="container-fluid px-5">
                    <h3 class="mt-5" >Relasi</h3>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    </div>
                    <table class="borderred table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Tujuan</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr class="">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row['name'] }}</td>
                                <td>
                                    <form action="{{ route('kirim.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_pengirim" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="id_penerima" value="{{ $row['id'] }}">
                                        <input type="hidden" name="posisi" value="0">
                                        <div class="mb-3 d-flex">
                                          <select name="id_surat" id="id_surat" class="form-select" required>
                                              <option value="" disabled selected>-- Pilih Surat --</option>
                                              @foreach($surat as $data)
                                                  <option name="id_surat" value="{{ $data['id'] }}">{{ $data['perihal'] }}/ {{ $data['id'] }}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                    </td>
                                    <td>
                                    <button type="submit" class="btn btn-primary btn-sm bi bi-send"> Kirim</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                  
                </div>
                
@endsection