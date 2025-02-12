<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> @yield('title', 'Giriş Yap') | PHP Frame </title>

    <!--  Favicon  -->
    <link rel="shortcut icon" type="image/x-icon" href="" />

    <!--  Plugins CSS/JS  -->
    <link rel="stylesheet" href="{{ assets('modules/bootstrap-5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ assets('modules/bootstrap-5/js/bootstrap.bundle.min.js') }}">
    <link rel="stylesheet" href="{{ assets('modules/fontawesome/css/all.min.css') }}"/>

    <link rel="stylesheet" href="{{ assets("modules/sweetalert/sweetalert2.min.css") }}">
    <link rel="stylesheet" href="{{ assets("modules/izitoast/iziToast.min.css") }}">

    <!--  Custom CSS  -->
    <link rel="stylesheet" href="{{ assets('auth/css/custom.css') }}" >
    @yield('page_style')
</head>

<body onload="getTime()" id="loginPage">

<div class="container">

    @yield('content')

</div>

<!--  Plugins JS  -->
<script src="{{ assets('modules/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ assets('modules/bootstrap-5/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ assets('modules/vanilla-tilt.min.js') }}" type="text/javascript"></script>

<script src="{{ assets("modules/sweetalert/sweetalert2.all.min.js") }}"></script>
<script src="{{ assets("modules/izitoast/iziToast.min.js") }}"></script>

<!--  Custom JS  -->
<script src="{{ assets('auth/js/custom.js') }}" type="text/javascript"></script>
@include('auth.alert')
<script type="text/javascript">
    $(document).ready(function() {
        @if(isset($success) && !empty($success['message']))
        iziToast.success({
            timeout: 5000,
            title: 'İşlem Başarılı',
            message: '{{ $success['message'] }}',
            position: 'topRight',
            color: '#00ff00'
        })
        var audio = new Audio('{{ uploads_url("audios/success.wav") }}');
        audio.play();
        @endif
        @if(isset($errors) && !empty($errors['message']))
        iziToast.success({
            timeout: 5000,
            title: 'İşlem Başarısız',
            message: '{{ $errors['message'] }}',
            position: 'topRight',
            theme: 'dark',
            color: '#d51818'
        })
        var audio = new Audio('{{ uploads_url("audios/alert.wav") }}');
        audio.play();
        @endif
    });
</script>
@yield('page_script')

</body>
</html>
