@extends('catalog.layouts.main')

@section('content')

    <h1> {{ $title }} </h1>

    <table class="table table-inverse">
        <thead>
        <tr>
            <th> # </th>
            <th> Ad Soyad </th>
            <th> Kullanıcı Adı </th>
            <th> E-Posta </th>
            <th> Durum </th>
            <th> Eklenme </th>
            <th> Güncellenme </th>
            <th> İşlemler </th>
        </tr>
        </thead>
        <tbody>
            @if(isset($users) && count($users) > 0)
                @foreach($users as $user)
                    <tr>
                        <td> {{ $user['id'] }} </td>
                        <td> {{ $user['fullName'] }} </td>
                        <td> {{ $user['userName'] }} </td>
                        <td> {{ $user['email'] }} </td>
                        <td> {{ $user['status'] == 'ACTIVE' ? 'Aktif' : 'Pasif' }} </td>
                        <td> {{ $user['created_at'] }} </td>
                        <td> {{ $user['updated_at'] }} </td>
                        <td>
                            <a href="{{ APP_URL . 'kullanici/duzenle/'.$user['id'] }}" class="btn btn-sm btn-icon btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="{{ APP_URL . 'kullanici/sil/'.$user['id'] }}" class="btn btn-sm btn-icon btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@endsection