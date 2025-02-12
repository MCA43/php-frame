@extends('auth.layout')

@section('title', 'Şifremi Unuttum')

@section('content')

    <div class="screen">

        <div class="wrapper" data-tilt>
            <div class="close-button" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                <i class="fa fa-times" style="font-size: 20px; color: #fff"></i>
            </div>

            <form action="{{ base_url('sifremi-unuttum') }}" method="POST" id="form-lock-screen" class="mb-5">

                <h2> Şifremi Unuttum </h2>

                <p class="text-white mb-1"> Şifrenizi mi unuttunuz? Sorun değil. </p>
                <p class="text-white mb-1"> E-Posta adresinizi girmeniz yeterli. </p>
                <p class="text-white mb-1"> Size yeni bir şifre seçmenizi sağlayacak bir şifre sıfırlama bağlantısını E-Postayla göndereceğiz. </p>

                <div class="input-field">
                    <input type="email" name="email" id="email" required>
                    <label> E-Posta  </label>
                </div>

                <button type="submit"> Şifre Sıfırlama Linki Al </button>

                <div class="register">
                    <p>
                        <a href="{{ APP_URL . 'giris' }}" class="text-center mb-3 mt-5">
                            Geri Dön <span> Giriş Yap </span>
                        </a>
                    </p>
                </div>

            </form>
        </div>

    </div>

@endsection