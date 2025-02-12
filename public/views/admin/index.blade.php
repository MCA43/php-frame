@extends('admin.layouts.main')

@section('content')
    @php
        $admin = $_SESSION['user'];
    @endphp

    <section class="app-content">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="widget p-md clearfix">
                    <div class="pull-left">
                        <h3 class="widget-title"> PHP FRAME 'e Hoşgeldiniz </h3>
                        <small class="text-color"> Mücahit Cemal AY Tarafından Güncellendi </small>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="widget p-md clearfix">
                    <div class="pull-left">
                        <h3 class="widget-title"> Sisteme Kayıtlı Kullanıcılar </h3>
                        <small class="text-color">
                            <a href="{{ base_url('panel/kullanici/listesi') }}"> Kullanıcı Listesi </a>
                        </small>
                    </div>
                    <span class="pull-right fz-lg fw-500 counter" data-plugin="counterUp"> {{ $userCount ?? 0 }} </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="widget p-lg">
                    <div>
                        <h3 class="widget-title fz-lg text-primary m-b-lg"> PHP FRAME </h3>
                        <p class="m-b-lg">
                            <a href="http://github.com/elfesyaesen/php-frame/" target="_blank"> http://github.com/elfesyaesen/php-frame/ </a>
                            Adresindeki temel yapı üzerine geliştirilmiş başlangıç kiti.
                        </p>
                        <p class="fs-italic">
                            Hızlı bir şekilde proje geliştirmek için başlangıç kiti olarak hazırlandı.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="widget">
                    <header class="widget-header">
                        <h4 class="widget-title"> Log Kayıtları </h4>
                    </header>
                    <hr class="widget-separator"/>
                    <div class="widget-body">
                        @if(isset($logs) && count($logs) > 0)
                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th> Kullanıcı Adı </th>
                                        <th class="text-center"> IP Adresi </th>
                                        <th class="text-center"> Modül </th>
                                        <th class="text-center"> İşlem </th>
                                        <th> Açıklama </th>
                                        <th> Tarih </th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th> Kullanıcı Adı </th>
                                        <th class="text-center"> IP Adresi </th>
                                        <th class="text-center"> Modül </th>
                                        <th class="text-center"> İşlem </th>
                                        <th> Açıklama </th>
                                        <th> Tarih </th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($logs as $log)
                                            <tr>
                                                <td class="text-primary"> {{ $admin['fullName'] }} </td>
                                                <td class="text-center"> {{ $log['ip_address'] }} </td>
                                                <td class="text-center"> {{ $log['module'] }} </td>
                                                <td class="text-center"> {!! get_log_action($log['action']) !!} </td>
                                                <td> {!! $log['description'] !!} </td>
                                                <td> {{ get_date_time($log['created_at']) }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                Log Kaydı Bulunamadı
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

@endsection