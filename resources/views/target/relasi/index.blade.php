 @extends('target.layouts.app')
 @section('content')
 <body>
                <!-- Page content-->
                <div class="container-fluid px-5">
                    <h3 class="mt-5" >Relasi</h3>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <a class="btn btn-success btn-sm mt-3" href="{{ route('relasi.create') }}" style="text-transform: none;">
                        Tambah
                    </a>
                    </div>
                    <table class="borderred table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($relasi as $row)
                            <tr class="">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @foreach($user as $data)
                                    @if ($data['id'] == $row['id_penerima'])
                                        {{ $data['name'] }}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('relasi.destroy', $row->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            X
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                  
                </div>
                
@endsection