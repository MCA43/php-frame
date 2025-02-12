@extends('admin.layouts.main')

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
                    @if(isset($status) && isset($message))
                        @if($status == 'success')
                            <div class="alert alert-success"> {{ $message }} </div>
                        @else
                            <div class="alert alert-danger"> {{ $message }} </div>
                        @endif
                    @endif
                    <form action="{{ base_url('panel/kullanici/guncelle/'.$user['id']) }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf" value="{{ $csrf }}">
                        <input type="hidden" name="id" value="{{ $user['id'] ?? '' }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userName"> Kullanıcı Adı </label>
                                    <input type="text" class="form-control" required name="userName"  value="{{ $user['userName'] ?? '' }}" id="userName" placeholder="Kullanıcı Adı">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> E-Posta </label>
                                    <input type="email" class="form-control" required name="email" value="{{ $user['email'] ?? '' }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-Posta Adresi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName"> Ad </label>
                                    <input type="text" class="form-control" required name="firstName" value="{{ $user['firstName'] ?? '' }}" id="firstName" placeholder="Ad">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName"> Soyad </label>
                                    <input type="text" class="form-control" required name="lastName" value="{{ $user['lastName'] ?? '' }}" id="lastName" placeholder="Soyad">
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-t-lg text-right">
                            <a href="{{ base_url('panel/kullanici/listesi') }}" type="submit" class="btn btn-danger btn-md btn-outline"><i class="fa fa-reply"></i> İptal </a>
                            <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-thumbs-o-up"></i> Güncelle </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection