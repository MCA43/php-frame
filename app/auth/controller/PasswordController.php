<?php

namespace App\Auth\Controller;

use System\Engine\Controller;

class PasswordController extends Controller
{

    public function passwordForgotForm($token = null): void {
        $this->data["title"] = "Şifre Sıfırlama Sayfası...";

        echo $this->view("auth.forgot-password", $this->data);
    }

    public function passwordForgot() {

        get_warning_alert('Geliştirme Devam Ediyor', '', 'Bu Modül Henüz Yazılmadı!');
        die();

    }

    public function passwordResetForm($token = null): void {
        if (!isset($token) || !empty($token)) {
            $this->data["title"] = "Şifre Sıfırlama Sayfası...";

            echo $this->view("auth.reset-password", $this->data);
            die();
        }
        get_error_alert('İşlem Başarısız!', '', 'Token Bulunamadı');
        die();
    }

    public function passwordReset() {
        get_warning_alert('Geliştirme Devam Ediyor', '', 'Bu Modül Henüz Yazılmadı!');
        die();
    }

}
