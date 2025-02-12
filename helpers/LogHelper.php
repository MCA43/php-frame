<?php

define('LOG_OTHER', 'other');
define('LOG_REGISTER', 'register');
define('LOG_LOGIN', 'login');
define('LOG_LOGOUT', 'logout');
define('LOG_SESSION_LOGIN', 'session_login');
define('LOG_SESSION_LOGOUT', 'session_logout');
define('LOG_VIEW', 'view');
define('LOG_ADD', 'add');
define('LOG_UPDATE', 'update');
define('LOG_DELETE', 'delete');
define('LOG_ERROR', 'error');
define('LOG_UPDATE_PASSWORD', 'update_password');
define('LOG_SEND_EMAIL', 'send_email');
define('LOG_RESET_PASSWORD', 'reset_password');
define('LOG_TRASH', 'trash');
define('LOG_TRASH_RECOVER', 'trash_recover');
define('LOG_STATUS_UPDATE', 'status');
define('LOG_PAYMENT', 'payment');


function set_log($user = null, $description = null, $action = 'other', $module="DEFAULT"){
    date_default_timezone_set('Europe/Istanbul');
    if ($user == null || $description == null){ return false; die(); }

    $data = [
        "user_id"       => $user['id'],
        "ip_address"    => $_SERVER['SERVER_ADDR'],
        "module"        => $module,
        "action"        => $action,
        "description"   => "<b>".$user['fullName']." (".$user['email'].") </b> | ".$description,
    ];

    $logModel = new \App\Admin\Model\LogModel;
    $log = $logModel->create($data);

    if ($log) {
        return true; die();
    }
    return false; die();
}

function get_log_action($action = null){
    if ($action == null){ return "hatalı"; }
    if ($action == LOG_OTHER) {
        return "<span class='label label-secondary'> Diğer </span>";
    }elseif ($action == LOG_LOGIN){
        return "<span class='label label-success'> Giriş </span>";
    }elseif ($action == LOG_LOGOUT){
        return "<span class='label label-danger'> Çıkış </span>";
    }elseif ($action == LOG_SESSION_LOGIN){
        return "<span class='label label-success'> Oturum Açma </span>";
    }elseif ($action == LOG_SESSION_LOGOUT){
        return "<span class='label label-danger'> Oturum Kilitleme </span>";
    }elseif ($action == LOG_VIEW){
        return "<span class='label label-info'> İnceleme </span>";
    }elseif ($action == LOG_ADD){
        return "<span class='label label-success'> Ekleme </span>";
    }elseif ($action == LOG_UPDATE){
        return "<span class='label label-primary'> Güncelleme </span>";
    }elseif ($action == LOG_DELETE){
        return "<span class='label label-danger'> Silme </span>";
    }elseif ($action == LOG_ERROR){
        return "<span class='label label-danger'> Hata </span>";
    }elseif ($action == LOG_REGISTER){
        return "<span class='label label-success'> Kayıt Olma </span>";
    }elseif ($action == LOG_UPDATE_PASSWORD){
        return "<span class='label label-dark'> Şifre Güncelleme </span>";
    }elseif ($action == LOG_RESET_PASSWORD){
        return "<span class='label label-dark'> Şifre Sıfırlama </span>";
    }elseif ($action == LOG_SEND_EMAIL){
        return "<span class='label label-dark'> Mail Gönderimi </span>";
    }elseif ($action ==LOG_TRASH){
        return "<span class='label label-warning'> Çöpe Taşıma </span>";
    }elseif ($action == LOG_TRASH_RECOVER){
        return "<span class='label label-warning'> Çöpten Çıkarma </span>";
    }elseif ($action == LOG_STATUS_UPDATE){
        return "<span class='label label-info'> Durum Güncelleme </span>";
    }elseif ($action == LOG_PAYMENT){
        return "<span class='label label-success'> Ödeme </span>";
    }else{
        return "<b class='text-danger'>".$action."</b>";
    }

}
