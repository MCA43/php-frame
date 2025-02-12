@extends('admin.layouts.main')

@section('content')

    <div class="row">
        <div class="col-md-9">
            <h4 class="m-b-lg">
                Profilinizi Düzenlemektesiniz
            </h4>
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
                    @if(isset($user) && !empty($user))
                        <form action="{{ base_url('panel/profil/guncelle') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="csrf" value="{{ $csrf }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ get_picture('users', $user['image']) }}" id="profile-image" alt="" width="170" height="170" class="img-responsive rounded">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label> Resim Seçin </label>
                                            <input type="file" name="image" id="upload-image" class="form-control">
                                        </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-t-lg text-right">
                                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-thumbs-o-up"></i> Güncelle </button>
                                <a href="{{ base_url("panel") }}" type="submit" class="btn btn-danger btn-md btn-outline"><i class="fa fa-reply"></i> İptal </a>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger">
                            Bilgileriniz Sistemden Alınamadı...
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {

            $('#upload-image').change(function () {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files['0'])
            });

        } );
    </script>
@endsection