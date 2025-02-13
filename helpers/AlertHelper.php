<?php

function get_view_alert($url=null){
    $alert = array(
        "title"     => "Yetkisiz İşlem",
        "text"      => "Maalesef Bu Alanı Görüntüleme İznine Sahip Değilsiniz",
        "type"      => "warning",
        "position"  => "center",
        "audio"     => "warning.wav"
    );
    set_flash_data("alert", $alert);
    header("Location: ". base_url($url));
    die();
}

function get_write_alert($url=null){
    $alert = array(
        "title" => "Yetkisiz İşlem",
        "text" => "Maalesef Ekleme İznine Sahip Değilsiniz",
        "type" => "warning",
        "position" => "center",
        "audio"     => "warning.wav"
    );
    set_flash_data("alert", $alert);
    header("Location: ". base_url($url));
    die();
}

function get_update_alert($url=null){
    $alert = array(
        "title" => "Yetkisiz İşlem",
        "text" => "Maalesef Güncelleme Yapma İznine Sahip Değilsiniz",
        "type" => "warning",
        "position" => "center",
        "audio"     => "warning.wav"
    );
    set_flash_data("alert", $alert);
    header("Location: ". base_url($url));
    die();
}

function get_delete_alert($url=null){
    $alert = array(
        "title" => "Yetkisiz İşlem",
        "text" => "Maalesef Silme İznine Sahip Değilsiniz",
        "type" => "warning",
        "position" => "center",
        "audio"     => "warning.wav"
    );
    set_flash_data("alert", $alert);
    header("Location: ". base_url($url));
    die();
}

function get_success_alert($title="İşlem Başarılı", $url=null, $text=null, $audio = 'success.wav', $position="topRight"){
    $alert = array(
        "title"     => $title,
        "text"      => $text,
        "type"      => "success",
        "position"  => $position,
        "audio"     => $audio
    );
    set_flash_data("alert", $alert);
    header("Location: ". base_url($url));
    die();
}

function get_error_alert($title="İşlem Başarısız!", $url=null, $text=null, $audio = 'alert.wav', $position="topRight"){
    $alert = array(
        "title" => $title,
        "text" => $text,
        "type" => "error",
        "position"  => $position,
        "audio"     => $audio
    );
    set_flash_data("alert", $alert);
    header("Location: ". base_url($url));
    die();
}

function get_warning_alert($title="Sıkıntılı Bir Durum Var", $url=null, $text=null, $audio = 'warning.wav', $position="topRight"){
    $alert = array(
        "title" => $title,
        "text" => $text,
        "type" => "warning",
        "position"  => $position,
        "audio"     => $audio
    );
    set_flash_data("alert", $alert);
    header("Location: ". base_url($url));
    die();
}

function get_info_alert($title="Bilgilendirme", $url=null, $text=null, $audio = 'info.mp3', $position="topRight"){
    $alert = array(
        "title" => $title,
        "text" => $text,
        "type" => "info",
        "position"  => $position,
        "audio"     => $audio
    );
    set_flash_data("alert", $alert);
    header("Location: ". base_url($url));
    die();
}

function get_active_manager_alert($url=null){
    $alert = get_flash_data('alert');
    if (!empty($alert)){
        $alert = array(
            "title" => $alert["title"],
            "text" => $alert["text"],
            "type" => $alert["type"],
            "position" => $alert["position"],
            "audio" => $alert["audio"],
        );
    }else{
        $alert = array(
            "title" => "Zaten Giriş Yapmışsınız",
            "text" => "Başka Bir Hesaba Giriş Yapmak İstiyorsanız Önce Çıkış Yapmalısınız.",
            "type" => "info",
            "position" => "topCenter",
            "audio" => "info.mp3"
        );
    }
    set_flash_data("alert", $alert);
    header("Location: ". base_url($url));
    die();
}

function get_logout_alert($url=null){
    $alert = get_flash_data('alert');
    if (!empty($alert)){
        $alert = array(
            "title" => $alert["title"],
            "text"  => $alert["text"],
            "type"  => $alert["type"],
            "position" => $alert["position"],
            "audio" => $alert["audio"],
        );
    }else{
        $alert = array(
            "title" => "İşlem Başarılı",
            "text"  => "Güvenli Bir Şekilde Çıkış Yaptınız.",
            "type"  => "success",
            "position" => "topCenter",
            "alert" => "success.wav"
        );
    }
    set_flash_data("alert", $alert);
    header("Location: ". APP_URL .$url);
    die();
}