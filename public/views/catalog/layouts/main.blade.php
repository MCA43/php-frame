<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title', 'Sayfa Başlığı') </title>

    <link rel="shortcut icon" href="{{ get_picture('system', 'favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link rel="stylesheet" href="{{ assets('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ assets('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ assets('frontend/css/media.css') }}">

    <link rel="stylesheet" href="{{ assets('modules/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ assets('modules/izitoast/iziToast.min.css') }}">
</head>
<body>

<div class="team-section-1">
    <div class="container">
        @yield('content')
    </div>
</div>

<script src="{{ assets('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ assets('modules/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ assets('modules/izitoast/iziToast.min.js') }}"></script>
@include('catalog.layouts.alert')
@yield('page_script')

</body>
</html>