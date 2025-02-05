@extends('catalog.layouts.main')

@section('content')

    <h1> {{ $title }} </h1>

    @if(isset($status) && isset($message))
        @if($status == 'success')
            <div class="alert alert-success"> {{ $message }} </div>
        @else
            <div class="alert alert-danger"> {{ $message }} </div>
        @endif
    @endif

    <form method="post" action="{{ APP_URL . 'kullanici/guncelle/' . $user['id'] }}">
        <div class="form-group">
            <label for="firstName"> Ad </label>
            <input type="text" class="form-control" name="firstName" value="{{ $user['firstName'] ?? '' }}" id="firstName" placeholder="Ad">
        </div>
        <div class="form-group">
            <label for="lastName"> Soyad </label>
            <input type="text" class="form-control" name="lastName" value="{{ $user['lastName'] ?? '' }}" id="lastName" placeholder="Soyad">
        </div>
        <div class="form-group">
            <label for="userName"> Kullanıcı Adı </label>
            <input type="text" class="form-control" name="userName" value="{{ $user['userName'] ?? '' }}" id="userName" placeholder="Kullanıcı Adı">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> E-Posta </label>
            <input type="email" class="form-control" name="email" value="{{ $user['email'] ?? '' }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <input type="hidden" name="csrf" value="{{ $csrf }}">
        <input type="hidden" name="id" value="{{ $user['id'] ?? '' }}">
        <button type="submit" class="btn btn-primary btn-lg"> Güncelle </button>
    </form>

@endsection