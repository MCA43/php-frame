@extends('admin.layouts.main')

@section('title', $title ?? 'Kullanıcı Listesi')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h4 class="m-b-lg">
                Kullanıcı Listesi
                <a href="{{ base_url("panel/kullanici/ekle") }}" class="btn btn-success btn-sm btn-outline pull-right"><i class="fa fa-plus"></i> Yeni Ekle </a>
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget p-lg">
                @if(isset($status) && isset($message))
                    @if($status == 'success')
                        <div class="alert alert-success"> {{ $message }} </div>
                    @else
                        <div class="alert alert-danger"> {{ $message }} </div>
                    @endif
                @endif

                @if(isset($users) && count($users) > 0)
                    <table class="table table-striped table-hover table-bordered content-container">
                        <thead>
                            <th class="text-center"> #id </th>
                            <th class="text-center"> Kullanıcı Resmi </th>
                            <th class="text-center"> Kullanıcı Adı </th>
                            <th class="text-center"> Adı Soyadı </th>
                            <th class="text-center"> Mail Adresi </th>
                            <th class="text-center"> Durum </th>
                            <th class="text-center"> İşlemler </th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr id="user-{{ $user['id'] }}">
                                    <td class="text-center"> #{{ $user['id'] }} </td>
                                    <td class="text-center">
                                        <img src="{{ get_picture('users', $user['image']) }}" class="rounded" height="75" width="75" alt="kullanıcı resmi">
                                    </td>
                                    <td class="text-center"> {{ $user['userName'] }} </td>
                                    <td class="text-center"> {{ $user['fullName'] }} </td>
                                    <td class="text-center"> {{ $user['email'] }} </td>
                                    <td class="text-center">
                                        {!! $user['status'] == 'ACTIVE' ? '<span class="label label-success">Aktif</span>' : '<span class="label label-danger">Pasif</span>' !!}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ base_url('panel/kullanici/duzenle/'.$user['id']) }}" class="btn btn-sm btn-info btn-outline">
                                            <i class="fa fa-pencil-square-o"></i> Düzenle
                                        </a>
                                        <button data-id="{{ $user['id'] }}" class="btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Sil
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info m-t-md text-center">
                        <p> Burada Herhangi Bir Kayıt Bulunamadı. Eklemek İçin <a href="{{ base_url("panel/kullanici/ekle") }}"> Tıklayın. </a> </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {

            $(".content-container").on('click', '.remove-btn', function (e) {
                var data_id = $(this).data("id");
                Swal.fire({
                    title: "Sil",
                    text: "Silmek İstediğinize Emin misiniz?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Evet, Sil!',
                    cancelButtonText: 'Hayır'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {  },
                            type:"DELETE",
                            url:"{{ base_url("panel/kullanici/sil") }}",
                            data:{
                                csrf: '{{ $csrf }}',
                                id:data_id,
                            },
                            dataType: 'json', // Yanıtın JSON formatında olduğunu belirtin
                            success: function (result) {
                                if (result.status === 'success') {
                                    // Silme işlemi başarılı
                                    $("#user-" + result.id).remove();
                                    iziToast.success({
                                        timeout: 5000,
                                        title: 'İşlem Başarılı',
                                        message: result.message,
                                        position: 'topRight',
                                        color: '#00ff00'
                                    });

                                    var audio = new Audio('{{ uploads_url('audio/success.wav') }}');
                                    audio.play();
                                } else {
                                    // Silme işlemi başarısız
                                    iziToast.error({
                                        timeout: 5000,
                                        title: 'Hata',
                                        message: result.message,
                                        position: 'topRight',
                                        theme:dark,
                                        color: '#ff0000'
                                    });
                                    var audio = new Audio('{{ uploads_url('audio/error.wav') }}');
                                    audio.play();
                                }
                            },
                            error: function (xhr, status, error) {
                                // AJAX isteği başarısız oldu
                                iziToast.error({
                                    timeout: 5000,
                                    title: 'Hata',
                                    message: 'İstek sırasında bir hata oluştu: ' + error,
                                    position: 'topRight',
                                    theme:dark,
                                    color: '#ff0000'
                                });
                                var audio = new Audio('{{ uploads_url('audio/error.wav') }}');
                                audio.play();
                            }
                        })
                    }
                })
            });

        });
    </script>
@endsection