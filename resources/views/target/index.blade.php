 @extends('target.layouts.app')
 @section('content')
 <body>
                <!-- Page content-->
                <div class="container-fluid px-5">
                    <h3 class="mt-4">Relasi</h13>
                    @auth
                    <p>relasi untuk</p>
                    <p>{{ Auth::user()->name }}</p>
                    @else
                    <p>login terlebih dahulu</p>
                    @endauth                    
                </div>
                <div class="container-fluid px-5">
                    <h3 class="mt-4">Surat Diterima</h13>
                    
                </div>
                <div class="container-fluid px-5">
                    <h3 class="mt-4">Surat Dikirim</h13>
                    
                </div>
                <div class="container-fluid px-5">
                    <h3 class="mt-4">Histogram </h13>
                    
                </div>
@endsection