@extends('auth.layout')

@section('title', 'Giriş Yap')

@section('content')

    <div class="screen">

        <div class="wrapper" id="login-div" data-tilt>
            <div class="close-button" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                <i class="fa fa-times" style="font-size: 20px; color: #fff"></i>
            </div>

            <form action="{{ base_url('giris') }}" method="POST" id="form-lock-screen" class="mb-5">

                <h2> GİRİŞ YAP </h2>

                <div class="input-field">
                    <input type="email" name="email" id="email" required>
                    <label> E-Posta  </label>
                </div>

                <div class="input-field">
                    <input type="password" name="password" id="password" required minlength="8" maxlength="75">
                    <label> Şifre </label>
                </div>

                <div class="forget">
                    <label for="remember">
                        <input type="checkbox" checked name="remember" id="remember">
                        <p class="remember-text"> Beni Hatırla </p>
                    </label>
                    <a href="{{ APP_URL . 'sifremi-unuttum' }}">
                        <span> Şifreni Mi Unuttun? </span>
                    </a>
                </div>

                <button type="submit"> Giriş Yap </button>

                <div class="register">
                    <p>
                        Hesabın yok mu? Hemen
                        <a href="{{ APP_URL . 'kayit' }}" class="text-center mb-3 mt-5">
                            <span> Kayıt Ol </span>
                        </a>
                    </p>
                </div>

            </form>
        </div>

        <div class="card" data-tilt id="welcome-div">
            <div class="lock-screen">
                <h1 class="my-2"> MCA YAZILIM </h1>
                <div id="clock" style="font-size: 50px; opacity: 100!important;" class="login-clock"></div>
                <h2 class="login-label">
                    <a href="#" class="login-link">
                        <p class="mb-1 mt-3 mb-2"><i class="fa fa-lock"></i></p>
                        <p class="yazi-bg mt-2"> GİRİŞ YAP </p>
                    </a>
                </h2>
            </div>
        </div>

    </div>

@endsection