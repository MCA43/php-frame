@extends('auth.layout')

@section('title', 'Oturum Aç')

@section('content')

    <div class="screen">

        <div class="wrapper" id="login-div" data-tilt>
            <div class="close-button" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                <i class="fa fa-times" style="font-size: 20px; color: #fff"></i>
            </div>

            <form action="{{ base_url('oturum-ac') }}" method="POST" id="form-lock-screen" class="mb-5">

                <h2> OTURUM AÇ </h2>

                <div>
                    <img src="{{ uploads_url('images/users/'.$user['image'] ?? 'default-user.png') }}" class="rounded-circle" width="150" height="150">
                    <p class="mt-2 mb-4 fs-5 text-white"> Hoşgeldin <span class="fw-bold text-info"> {{ $user['userName'] ?? '?' }} </span> </p>
                </div>

                <div class="input-field">
                    <input type="password" name="password" id="password" required minlength="8" maxlength="75">
                    <label> Şifreniz </label>
                </div>

                <button type="submit"> OTURUMU AÇ </button>
                <button type="submit" class="mt-2 logout-btn"> OTURUMU KAPAT </button>

            </form>
        </div>

        <div class="card" data-tilt id="welcome-div">
            <div class="lock-screen">
                <h1 class="my-2"> MCA YAZILIM </h1>
                <div id="clock" style="font-size: 50px; opacity: 100!important;" class="login-clock"></div>
                <h2 class="login-label">
                    <a href="#" class="login-link">
                        <p class="mb-1 mt-3 mb-4">
                            <img src="{{ uploads_url('images/users/'.$user['image'] ?? 'default-user.png') }}" class="rounded-circle" width="75" height="75">
                        </p>
                        <p class="yazi-bg mt-2"> OTURUM AÇ </p>
                    </a>
                </h2>
            </div>
        </div>

    </div>

@endsection