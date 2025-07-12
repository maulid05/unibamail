 @extends('target.layouts.app')
 @section('content')
 <body>
                <!-- Page content-->
                <div class="container-fluid px-5">
                    <h3 class="mt-4">Relasi</h13>
                    @auth
                    
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    @else
                    <p>Anda belum login</p>
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