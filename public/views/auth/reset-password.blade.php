@extends('auth.layout')

@section('title', 'Şifre Sıfırla')

@section('content')

    <div class="screen">

        <div class="wrapper" data-tilt>
            <div class="close-button" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                <i class="fa fa-times" style="font-size: 20px; color: #fff"></i>
            </div>

            <form action="{{ base_url('sifre-sifirla') }}" method="POST" id="form-lock-screen" class="mb-5">

                <h2> Şifre Sıfırla </h2>
                <p class="text-white mb-1"> Şifrenizi Güvenli Bir Şekilde Sıfırlayabilirsiniz. </p>

                <div class="input-field">
                    <input type="email" name="email" id="email" required>
                    <label> E-Posta  </label>
                </div>

                <div class="input-field">
                    <input type="password" name="password" id="password" required minlength="8" maxlength="75">
                    <label> Yeni Şifre </label>
                </div>

                <div class="input-field">
                    <input type="password" name="re_password" id="re_password" required minlength="8" maxlength="75">
                    <label> Yeni Şifre Tekrar </label>
                </div>

                <button type="submit"> Şifre Sıfırla </button>

            </form>
        </div>

    </div>

@endsection