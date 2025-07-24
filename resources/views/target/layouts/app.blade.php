<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />   
        <title>UnibaMail</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        @include('target.layouts.navbar')
        @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function () {
            const alertBox = document.getElementById('flash-message');
            if (alertBox) {
                alertBox.classList.remove('show');
                alertBox.classList.add('hide');
                setTimeout(() => alertBox.remove(), 500); // setelah fade out, hapus elemennya
            }
        }, 3000); // tampil 3 detik
    </script>
@endif

    @yield('content')
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- Tes Bootstrap JS -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Bootstrap JS Loaded 🚀");
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>