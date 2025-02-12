<?php

namespace App\Auth\Controller;

use App\Auth\Model\AuthModel;
use System\Engine\Controller;
use System\Engine\Request;

class AuthController extends Controller {

    use Request;

    protected $errors = [];

//    public function __construct() {
//        parent::__construct();
//    }

    public function loginForm(): void {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            get_active_manager_alert('panel'); die();
        }
        if (isset($_COOKIE['remember'])) {
            $admin_info = json_decode($_COOKIE['remember'], true);
            $uniqCode = $admin_info["code_1"];
            $userCode = $admin_info["code_2"];
            if (!empty($uniqCode) && !empty($userCode)) {
                get_info_alert('Hoşgeldiniz', 'oturum-ac', 'Oturum Açın');
                die();
            }
        }
        $this->data["title"] = "Giriş Sayfası";
        echo $this->view("auth.login", $this->data);
    }

    public function login() {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            get_active_manager_alert('panel'); die();
        }

        if ($this->server("REQUEST_METHOD") == "POST") {
            $email    = xss_clear($this->post("email"));
            $password = xss_clear($this->post("password"));

            $this->data["title"] = "Giriş Sayfası";

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                get_error_alert('İşlem Başarısız!', 'giris', 'E-Posta Adresi Yanlış Biçimde Girilmiş.');
                die();
            }
            $userModel = new AuthModel();
            $user = $userModel->getRows(['where' => ['email' => $email], 'return_type' => 'single']);
            if (!$user) {
                get_error_alert('İşlem Başarısız!', 'giris', 'Kullanıcı Bulunamadı.');
                die();
            }

            if (!isset($user['password']) || !password_verify($password, $user['password'])) {
                get_error_alert('İşlem Başarısız!', 'giris', 'Şifreniz Hatalı.');
                die();
            }


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
            set_log($user, 'Giriş Yaptı', LOG_LOGIN, 'AUTH');
            set_flash_data("welcome_user", [
                'image' => $user['image'],
                'name'  => $user['fullName'],
                'audio' => 'success.wav'
            ]);
            header("Location: ". APP_URL ."panel");
            die();

        }
        get_error_alert('İşlem Başarısız!', '', 'Sadece POST İşlemi Yapılabilir.');
    }

    public function lockScreenForm(): void {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            get_active_manager_alert('panel');
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
                    get_error_alert('İşlem Başarısız!', 'cikis', 'Kullanıcı Bulunamadı.');
                    die();
                }
                if ($user['ip_address'] != $ip_address){
                    setcookie('remember', '', 0, '/');
                    get_info_alert('Bilgilendirme', 'giris', 'IP Adresinizde Değişiklik Saptandı Güvenliğiniz İçin Tekrar Giriş Yapınız.');
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
            get_active_manager_alert('panel');
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
                    get_error_alert('İşlem Başarısız!', 'cikis', 'Kullanıcı Bulunamadı');
                    die();
                }
                if ($user['ip_address'] != $ip_address){
                    setcookie('remember', '', 0, '/');
                    get_info_alert('Bilgilendirme', 'giris', 'IP Adresinizde Değişiklik Saptandı Güvenliğiniz İçin Tekrar Giriş Yapınız.');
                    die();
                }
                if (!isset($user['password']) || !password_verify($password, $user['password'])) {
                    get_error_alert('İşlem Başarısız!', 'oturum-ac', 'Şifreniz Hatalı.');
                    die();
                }

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
                set_log($user, 'Oturum Açtı', LOG_SESSION_LOGIN, 'AUTH');
                set_flash_data("welcome_user", [
                    'image' => $user['image'],
                    'name'  => $user['fullName'],
                    'audio' => 'success.wav'
                ]);
                header("Location: ". APP_URL ."panel");
                die();
            }
        }
        get_error_alert('İşlem Başarısız!', '', 'Sadece POST İşlemi Yapılabilir.');
    }

    public function registerForm() {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
            get_active_manager_alert('panel');
        }
        $this->data["title"] = "Kayıt Sayfası";
        echo $this->view("auth.register", $this->data);
    }

    public function register() {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth'] == true) {
           get_active_manager_alert('panel');
        }
        if ($this->server("REQUEST_METHOD") == "POST") {
            $firstName   = xss_clear($this->post("first_name"));
            $lastName    = xss_clear($this->post("last_name"));
            $email       = xss_clear($this->post("email"));
            $password    = xss_clear($this->post("password"));
            $re_password = xss_clear($this->post("re_password"));
            $gender      = xss_clear($this->post("gender"));

            $this->data["title"] = "Kayıt Sayfası";

            if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($re_password) || empty($gender)) {
                get_error_alert('İşlem Başarısız!', 'kayit', 'Lütfen Tüm Alanları Doldurun.');
                die();
            }
            if (!in_array($gender, ['man', 'woman'])){
                get_error_alert('İşlem Başarısız!', 'kayit', 'Lütfen Cinsiyetinizi Seçiniz.');
                die();
            }

            if (strlen($password) < 8){
                get_error_alert('İşlem Başarısız!', 'kayit', 'Şifreniz En Az 8 Karakter Olmalıdır.');
                die();
            }

            if ($password != $re_password){
                get_error_alert('İşlem Başarısız!', 'kayit', 'Şifreleriniz Eşleşmiyor.');
                die();
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                get_error_alert('İşlem Başarısız!', 'kayit', 'E-Posta Adresi Yanlış Biçimde Girilmiş.');
                die();
            }
            $userModel = new AuthModel();
            $isEmail = $userModel->getRows(['where' => ['email' => $email], 'return_type' => 'single']);
            if ($isEmail) {
                get_error_alert('İşlem Başarısız!', 'kayit', 'E-Posta Adresi Daha Önce Kullanılmış.');
                die();
            }

            if ($gender == 'man') {
                $userImage = 'default-man.png';
            }elseif ($gender == 'woman'){
                $userImage = 'default-woman.png';
            }else{
                $userImage = 'default-user.png';
            }

            $uniq_code = random_string(24);
            $user_code = sha1(md5($_SERVER['SERVER_ADDR'].$uniq_code));
            $userData = [
                'image'     => $userImage,
                'role_id'   => 1,
                'firstName' => $firstName,
                'lastName'  => $lastName,
                'fullName'  => $firstName . ' ' . $lastName,
                'userName'  => convertToSEO($firstName.'-'.$lastName),
                'email'     => $email,
                'gender'    => $gender,
                'password'  => password_hash($password, PASSWORD_DEFAULT),
                'uniq_code' => $uniq_code,
                'user_code' => $user_code,
                'status'    => 'ACTIVE',
            ];
            $user = $userModel->create($userData);
            if (!$user) {
                get_error_alert('İşlem Başarısız!', 'kayit', 'Kayıt Yapılırken Beklenmedik Hata Oluştu.');
                die();
            }
            $user = $userModel->getRows(['where' => ['email' => $email], 'return_type' => 'single']);
            set_log($user, 'Kayıt Oldu', LOG_REGISTER, 'AUTH');
            get_success_alert('İşlem Başarılı', 'giris', 'Başarılı Bir Şekilde Kayıt Oldunuz. Giriş Yapabilirsiniz.');
            die();
        }
        header("Location: ". APP_URL ."giris");
    }

    public function logout() {
        if (!isset($_SESSION['auth'])) {
            session_destroy();
            setcookie('remember', '', 0, '/');
            header("Location: ". APP_URL ."giris");
        }
        set_log($_SESSION['user'], 'Çıkış Yaptı', LOG_LOGOUT, 'AUTH');
        unset($_SESSION['auth']);
        unset($_SESSION['user']);
        setcookie('remember', '', 0, '/');
        get_success_alert('İşlem Başarılı', 'giris', 'Güvenli Bir Şekilde Çıkış Yaptınız');
    }

    public function lock() {
        if (!isset($_SESSION['auth'])) {
            header("Location: ". APP_URL ."oturum-ac");
        }
        set_log($_SESSION['user'], 'Oturumu Kilitledi', LOG_SESSION_LOGOUT, 'AUTH');
        unset($_SESSION['auth']);
        unset($_SESSION['user']);
        get_success_alert('İşlem Başarılı', 'oturum-ac', 'Güvenli Bir Şekilde Oturumu Kilitlediniz');
    }


}
