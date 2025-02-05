<?php

namespace App\Auth\Controller;

use App\Auth\Model\AuthModel;
use System\Engine\Controller;

class AuthController extends Controller
{

    public function loginForm(): void {
        $this->data["title"] = "Giriş Sayfası";

        echo $this->view("auth.login", $this->data);
    }

    public function login() {
        $this->data["title"] = "Giriş Sayfası";

        $users = new AuthModel();
        $this->data['users'] = $users->getRows();

        echo $this->view("auth.login", $this->data);
    }

    public function lockScreenForm(): void {
        $this->data["title"] = "Oturum Açma Sayfası";

        echo $this->view("auth.lock-screen", $this->data);
    }

    public function lockScreen(): void {
        $this->data["title"] = "Oturum Açma Sayfası";

        echo $this->view("auth.lock-screen", $this->data);
    }

    public function registerForm() {
        $this->data["title"] = "Kayıt Sayfası";
        echo $this->view("auth.register", $this->data);
    }

    public function register() {

    }

    public function logout() {

    }

    public function lock() {

    }


}
