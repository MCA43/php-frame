@extends('admin.layouts.main')

@section('title', $title ?? 'Kullanıcı Ekle')

@section('page_style')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-b-lg">
                Yeni Kullanıcı Ekle
            </h4>
        </div>
        <div class="col-md-3 text-right">
            <h4 class="m-b-sm"><a href="{{ base_url('panel/kullanici/listesi') }}"> <i class="fa fa-users"></i> Kullanıcılara Geri Dön </a></h4>
        </div>
        <div class="col-md-12">
            <div class="widget p-lg">
                <div class="widget-body">
                    <form action="{{ base_url('panel/kullanici/ekle') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf" value="{{ $csrf }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userName"> Kullanıcı Adı </label>
                                    <input type="text" class="form-control" required name="userName" id="userName" placeholder="Kullanıcı Adı">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> E-Posta </label>
                                    <input type="email" class="form-control" required name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-Posta Adresi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName"> Ad </label>
                                    <input type="text" class="form-control" required name="firstName" id="firstName" placeholder="Ad">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName"> Soyad </label>
                                    <input type="text" class="form-control" required name="lastName" id="lastName" placeholder="Soyad">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Şifreniz * </label>
                                    <input type="password" class="form-control" required min="8" max="75" placeholder="Şifre" name="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Şifre Tekrar * </label>
                                    <input type="password" name="re_password" required min="8" max="75" placeholder="Şifre Tekrarı" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label> Cinsiyet </label>
                                <select class="form-control" name="gender">
                                    <option value="man"> Erkek </option>
                                    <option value="woman"> Kadın </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-t-lg text-right">
                            <a href="{{ base_url('panel/kullanici/listesi') }}" type="submit" class="btn btn-danger btn-md btn-outline"><i class="fa fa-reply"></i> İptal </a>
                            <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-thumbs-o-up"></i> Ekle </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')

@endsection