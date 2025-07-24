 @extends('target.layouts.app')
 @section('content')
 <body>
                <!-- Page content-->
                <div class="container-fluid px-5">
                    <h3 class="mt-5" >Relasi</h3>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    </div>
                    <table class="borderred table">
                        <thead>
                            <tr style="collspan:3">Diterima</tr>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Surat</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($terima as $row)
                            <tr class="">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @foreach($user as $data)
                                    @if ($data['id'] == $row['id_pengirim'])
                                        {{ $data['name'] }}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($surat as $n)
                                    @if ($n['id'] == $row['id_surat'])
                                        {{ $n['perihal'] }}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                  
                </div>
                
@endsection