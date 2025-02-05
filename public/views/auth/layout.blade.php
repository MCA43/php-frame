<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> @yield('title', 'Giriş | MCA Yazılım') </title>

    <!--  Favicon  -->
    <link rel="shortcut icon" type="image/x-icon" href="" />

    <!--  Plugins CSS/JS  -->
    <link rel="stylesheet" href="{{ APP_URL . 'public/assets/auth/plugins/bootstrap-5/css/bootstrap.min.css' }}">
    <link rel="stylesheet" href="{{ APP_URL . 'public/assets/auth/plugins/bootstrap-5/js/bootstrap.bundle.min.js' }}">
    <link rel="stylesheet" href="{{ APP_URL . 'public/assets/auth/plugins/fontawesome/css/all.min.css' }}"/>

    <!--  Custom CSS  -->
    <link rel="stylesheet" href="{{ APP_URL . 'public/assets/auth/css/custom.css' }}" >
    @yield('page_style')
</head>

<body onload="getTime()" id="loginPage">

<div class="container">
    @yield('content')
</div>

<!--  Plugins JS  -->
<script src="{{ APP_URL . 'public/assets/auth/plugins/jquery.min.js' }}" type="text/javascript"></script>
<script src="{{ APP_URL . 'public/assets/auth/plugins/bootstrap-5/js/bootstrap.min.js' }}" type="text/javascript"></script>
<script src="{{ APP_URL . 'public/assets/auth/plugins/vanilla-tilt.min.js' }}" type="text/javascript"></script>

<!--  Custom JS  -->
<script src="{{ APP_URL . 'public/assets/auth/js/custom.js' }}" type="text/javascript"></script>
@yield('page_script')

</body>
</html>
