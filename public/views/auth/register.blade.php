@extends('auth.layout')

@section('title', 'Kayıt Ol | MCA Yazılım')

@section('content')

    <div class="screen">

        <div class="wrapper" data-tilt>
            <div class="close-button" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                <i class="fa fa-times" style="font-size: 20px; color: #fff"></i>
            </div>

            <form action="" method="POST" id="form-lock-screen" class="mb-5">

                <h2> Kayıt Ol </h2>
                <p class="text-white mb-1"> Gerekli Alanları Doldurup Kayıt Olabilirsiniz. </p>

                <div class="input-field">
                    <input type="text" name="first_name" id="first-name" required>
                    <label> İsim  </label>
                </div>

                <div class="input-field">
                    <input type="text" name="last_name" id="last-name" required>
                    <label> Soyisim </label>
                </div>

                <div class="input-field">
                    <input type="email" name="email" id="email" required>
                    <label> E-Posta  </label>
                </div>

                <div class="input-field">
                    <input type="password" name="password" id="password" required minlength="8" maxlength="75">
                    <label> Şifre </label>
                </div>

                <div class="input-field">
                    <input type="password" name="re_password" id="re_password" required minlength="8" maxlength="75">
                    <label> Şifre Tekrar </label>
                </div>

                <div class="row mt-2 mb-4">
                    <div class="col-6">
                        <div class="form-check text-white">
                            <input class="form-check-input" type="radio" name="gender" id="gender-male" value="male" checked>
                            <label class="form-check-label" for="gender-male"> Erkek </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check text-white text-left">
                            <input class="form-check-input" type="radio" name="gender" id="gender-female" value="female">
                            <label class="form-check-label" for="gender-female"> Kadın </label>
                        </div>
                    </div>
                </div>

                <button type="submit"> Kayıt Ol </button>

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