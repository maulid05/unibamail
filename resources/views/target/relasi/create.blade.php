 @extends('target.layouts.app')
 @section('content')
 <body>
                <!-- Page content-->
                <div class="container-fluid px-5 mt-3">
                    <div class="d-flex gap-1 mt-5">
                        <h3 class="">Relasi</h3>
                        <p class="text-secondary mt-2">/tambah</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <a class="btn btn-success btn-sm mt-3" href="{{ route('relasi.index') }}" style="text-transform: none;">
                        Selesai
                    </a>
                    </div>
                    <table class="borderred table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Role</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $row)
                            <tr class="">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row['name'] }}</td>
                                <td>
                                    @foreach($role as $roles)
                                    @if ($roles['id'] == $row['role'])
                                        {{ $roles['Role'] }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('relasi.store') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="id_pengirim" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="id_penerima" value="{{ $row->id }}">
                                        <button class="btn btn-success btn-sm" type="submit">+</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                 
                </div>
                
@endsection