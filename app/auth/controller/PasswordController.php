<?php

namespace App\Auth\Controller;

use App\Auth\Model\AuthModel;
use System\Engine\Controller;

class PasswordController extends Controller
{

    public function passwordResetForm($token = null): void {
        $this->data["title"] = "Şifre Sıfırlama Sayfası...";

        echo $this->view("auth.reset-password", $this->data);
    }

    public function passwordReset() {

    }

}
