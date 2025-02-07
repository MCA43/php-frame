<?php

namespace App\Auth\Controller;

use App\Auth\Model\AuthModel;
use System\Engine\Controller;
use System\Engine\Request;

class AuthController extends Controller {

    use Request;

    protected $errors = [];

    public function loginForm(): void {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            header("Location: ". APP_URL ."dashboard");
        }
        if (isset($_COOKIE['remember'])) {
            $admin_info = json_decode($_COOKIE['remember'], true);
            $uniqCode = $admin_info["code_1"];
            $userCode = $admin_info["code_2"];
            if (!empty($uniqCode) && !empty($userCode)) {
                header("Location: ". APP_URL ."oturum-ac");
            }
        }
        $this->data["title"] = "Giriş Sayfası";
        echo $this->view("auth.login", $this->data);
    }

    public function login() {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            header("Location: ". APP_URL ."dashboard");
        }

        if ($this->server("REQUEST_METHOD") == "POST") {
            $email    = xss_clear($this->post("email"));
            $password = xss_clear($this->post("password"));

            $this->data["title"] = "Giriş Sayfası";

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $this->data['errors']['email'] = 'E-Posta Adresi Yanlış Biçimde Girilmiş.';
                echo $this->view("auth.login", $this->data);
                die();
            }
            $userModel = new AuthModel();
            $user = $userModel->getRows(['where' => ['email' => $email], 'return_type' => 'single']);
            if (!$user) {
                $this->data['errors']['message'] = 'Kullanıcı Bulunamadı';
                echo $this->view("auth.login", $this->data);
                die();
            }

            if (!isset($user['password']) || !password_verify($password, $user['password'])) {
                $this->data['errors']['message'] = 'Şifreniz Hatalı.';
                echo $this->view("auth.login", $this->data);
                die();
            }

            if (!$this->data['errors']) {
                $remember   = xss_clear($this->post('remember')) ?? null;
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $uniq_code  = $user['uniq_code'];
                $birlestir  = $ip_address.$uniq_code;
                $kripto     = sha1(md5($birlestir));
                if (isset($remember) && $remember == 'on') {
                    $cookieArray = ["code_1" => $user['uniq_code'], "code_2" => $user['user_code']];
                    $cookieArray = json_encode($cookieArray, JSON_UNESCAPED_UNICODE);
                    setcookie('remember', $cookieArray, time() + 3600 * 24 * 30, '/');
                }
                $userModel->update([
                    'last_login_date' => date('Y-m-d H:i:s'),
                    'user_code'       => $kripto,
                    'ip_address'      => $ip_address,
                    ], [
                        'id' => $user['id']
                    ]);
                unset($user['password']);
                unset($user['uniq_code']);
                unset($user['user_code']);
                $_SESSION['auth'] = true;
                $_SESSION['user'] = $user;
                header("Location: ". APP_URL ."dashboard");
            }

            echo $this->view("auth.login", $this->data);
        }
        header("Location: ". APP_URL ."giris");
    }

    public function lockScreenForm(): void {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            header("Location: ". APP_URL ."dashboard");
        }
        if (isset($_COOKIE['remember'])) {
            $admin_info = json_decode($_COOKIE['remember'], true);
            $uniqCode = $admin_info["code_1"];
            $userCode = $admin_info["code_2"];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            if (!empty($uniqCode) && !empty($userCode)) {
                $userModel = new AuthModel();
                $user = $userModel->getRows(['where' => ['uniq_code' => $uniqCode, 'user_code' => $userCode], 'return_type' => 'single']);
                if (!$user) {
                    header("Location: ". APP_URL ."cikis");
                    die();
                }
                if ($user['ip_address'] != $ip_address){
                    setcookie('remember', '', 0, '/');
                    $this->data['errors']['message'] = "IP Adresinizde Değişiklik Saptandı Güvenliğiniz İçin Tekrar Giriş Yapınız.";
                    echo $this->view("auth.login", $this->data);
                    die();
                }
                $this->data['user'] = $user;
                $this->data["title"] = "Oturum Açma Sayfası";
                echo $this->view("auth.lock-screen", $this->data);
                die();
            }
        }
        header("Location: ". APP_URL ."giris");
    }

    public function lockScreen(): void {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            header("Location: ". APP_URL ."dashboard");
        }
        if (isset($_COOKIE['remember'])) {
            $this->data["title"] = "Oturum Açma Sayfası";

            $password = xss_clear($this->post("password"));
            $admin_info = json_decode($_COOKIE['remember'], true);
            $uniqCode = $admin_info["code_1"];
            $userCode = $admin_info["code_2"];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            if (!empty($uniqCode) && !empty($userCode)) {
                $userModel = new AuthModel();
                $user = $userModel->getRows(['where' => ['uniq_code' => $uniqCode, 'user_code' => $userCode], 'return_type' => 'single']);
                if (!$user) {
                    header("Location: ". APP_URL ."cikis");
                    die();
                }
                if ($user['ip_address'] != $ip_address){
                    setcookie('remember', '', 0, '/');
                    $this->data['errors']['message'] = "IP Adresinizde Değişiklik Saptandı Güvenliğiniz İçin Tekrar Giriş Yapınız.";
                    echo $this->view("auth.login", $this->data);
                    die();
                }
                if (!isset($user['password']) || !password_verify($password, $user['password'])) {
                    $this->data['errors']['message'] = 'Şifreniz Hatalı.';
                    echo $this->view("auth.lock-screen", $this->data);
                    die();
                }

                if (!$this->data['errors']) {
                    $uniq_code  = $user['uniq_code'];
                    $birlestir  = $ip_address.$uniq_code;
                    $kripto     = sha1(md5($birlestir));
                    $userModel->update([
                        'last_login_date' => date('Y-m-d H:i:s'),
                        'user_code'       => $kripto,
                        'ip_address'      => $ip_address,
                    ], [
                        'id' => $user['id']
                    ]);
                    unset($user['password']);
                    unset($user['uniq_code']);
                    unset($user['user_code']);
                    $_SESSION['auth'] = true;
                    $_SESSION['user'] = $user;
                    header("Location: ". APP_URL ."dashboard");
                }

                echo $this->view("auth.lock-screen", $this->data);
            }
        }
        header("Location: ". APP_URL ."giris");
    }

    public function registerForm() {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            header("Location: ". APP_URL ."dashboard");
        }
        $this->data["title"] = "Kayıt Sayfası";
        echo $this->view("auth.register", $this->data);
    }

    public function register() {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            header("Location: ". APP_URL ."dashboard");
        }
    }

    public function logout() {
        if (!isset($_SESSION['auth'])) {
            session_destroy();
            setcookie('remember', '', 0, '/');
            header("Location: ". APP_URL ."giris");
        }
        unset($_SESSION['auth']);
        unset($_SESSION['user']);
        setcookie('remember', '', 0, '/');
        header("Location: ". APP_URL ."giris");
    }

    public function lock() {
        if (!isset($_SESSION['auth'])) {
            header("Location: ". APP_URL ."oturum-ac");
        }
        unset($_SESSION['auth']);
        unset($_SESSION['user']);
        header("Location: ". APP_URL ."oturum-ac");
    }


}
