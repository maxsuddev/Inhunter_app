<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('storage/img/favicon.png')}}" rel="icon">
    <link href="{{ asset('storage/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


    <!-- Vendor CSS Files -->
    @vite(['resources/css/app.css'])


    <!-- Template Main CSS File -->
    @yield('style')
</head>

<body>


@include('panel.layouts.header')
@include('panel.layouts.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>@yield('page')</h1>
        @yield('nav-user')
    </div><!-- End Page Title -->
    @yield('content')
</main><!-- End #main -->

@include('panel.layouts.footer')


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
@vite(['resources/js/app.js'])

@yield('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
