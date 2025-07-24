<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Unibamail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            border-radius: 20px;
        }
        .btn-google {
            background-color: #fff;
            border: 1px solid #ddd;
            color: #444;
        }
        .btn-google:hover {
            background-color: #f1f1f1;
            border-color: #ccc;
        }
        .google-icon {
            width: 18px;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow p-4">
                <h4 class="text-center mb-3"><strong>UNIBAMAIL</strong> </h4>

                {{-- Flash Message (misal dari logout) --}}
                @if(session('message'))
                    <div class="alert alert-info text-center">
                        {{ session('message') }}
                    </div>
                @endif

                {{-- Tombol Google Login --}}
                <a href="{{ url('auth/google') }}" class="btn btn-google w-100 mb-3">
                    <img class="google-icon" src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="Google Logo">
                    Login with Google
                </a>

                <hr class="my-4">

                {{-- Tombol dummy login biasa (jika ada fitur ini) --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-success w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
