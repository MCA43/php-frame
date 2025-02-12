@extends('catalog.layouts.main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-12">
            <div class="team-details position-relative">
                <div class="team-details-info d-flex align-items-center mb-50">
                    <div class="team-details-thumb">
                        <img src="{{ get_picture('system', 'favicon.ico') }}" alt="team">
                    </div>
                    <div class="team-details-content">
                        <span class="team-details-position tp-el-subtitle"> {{ $subTitle ?? 'Hızlı Bir Başlangıç İçin Doğru Seçim' }} </span>
                        <h1 class="team-details-title tp-el-title"> {{ $title ?? 'PHP Frame' }} </h1>
                        <div class="mt-3">
                            @if(isset($_SESSION['auth']) && $_SESSION['auth'] == true)
                                <a class="btn btn-outline-dark" href="{{ base_url('panel') }}">
                                    <i class="ri-home-heart-line"></i> Admin Paneli
                                </a>
                            @else
                                <a class="btn btn-outline-dark" href="{{ base_url('kayit') }}">
                                    <i class="ri-add-circle-line"></i> Kayıt Ol
                                </a>
                                <a class="btn btn-outline-dark" href="{{ base_url('giris') }}">
                                    <i class="ri-login-circle-line"></i> Giriş Yap
                                </a>
                            @endif
                        </div>
                        <div class="team-details-social ">
                            <a class="tp-el-social" target="_blank" href="elfesyaesen@gmail.com">
                                <i class="ri-mail-line"></i>
                            </a>
                            <a class="tp-el-social" target="_blank" href="https://github.com/elfesyaesen/php-frame/">
                                <i class="ri-github-fill"></i>
                            </a>
                            <a class="tp-el-social" target="_blank" href="https://www.youtube.com/@elfesyaesen">
                                <i class="ri-youtube-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="team-details-about">
                    <h2 class="team-details-about-title tp-el-bio-title"> {{ $about['title'] ?? "Başlamak İçin Yapmanız Gerekenler" }} </h2>
                    @if(isset($about['description']) && is_array($about['description']) && count($about['description']) > 0)
                        @foreach($about['description'] as $p)
                            <p class="tp-el-bio-des"> {!!$p !!} </p>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection