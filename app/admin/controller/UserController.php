<?php

namespace App\Admin\Controller;

use App\Admin\Model\UserModel;
use System\Engine\Controller;
use System\Engine\Request;

class UserController extends Controller {

    use Request;

//    public function __construct() {
//        parent::__construct();
//    }

    public function list(): void {
        if (!isset($_SESSION['auth']) && empty($_SESSION['auth']) && $_SESSION['auth'] != true) {
            get_view_alert('giris');
            die();
        }
        $this->data["title"] = "Kullanıcı Listeleme Sayfası...";

        $users = new UserModel();
        $this->data['users'] = $users->getRows(['order_by' => 'created_at DESC']);

        echo $this->view("admin.user.list", $this->data);
    }

    public function add(): void {
        if (!isset($_SESSION['auth']) && empty($_SESSION['auth']) && $_SESSION['auth'] != true) {
            get_view_alert('giris');
            die();
        }
        $this->data["title"] = "Kullanıcı Ekleme Sayfası...";

        echo $this->view("admin.user.add", $this->data);
        die();
    }

    public function save() {
        if (!isset($_SESSION['auth']) && empty($_SESSION['auth']) && $_SESSION['auth'] != true) {
            get_view_alert('giris');
            die();
        }
        if ($this->server("REQUEST_METHOD") == "POST") {
//                if ($_POST['csrf'] != $_SESSION['csrf']) {
//                    get_error_alert('İşlem Başarısız!', 'panel/kullanici/duzenle/'.$id, 'CSRF Token Hatalı yada Eksik');
//                    die();
//                }
            $firstName   = xss_clear($this->post("firstName"));
            $lastName    = xss_clear($this->post("lastName"));
            $userName    = xss_clear($this->post("userName"));
            $email       = xss_clear($this->post("email"));
            $password    = xss_clear($this->post("password"));
            $re_password = xss_clear($this->post("re_password"));
            $gender      = xss_clear($this->post("gender"));

            $this->data["title"] = "Kullanıcı Ekleme Sayfası";

            if (empty($firstName) || empty($lastName) || empty($userName) || empty($email) || empty($password) || empty($re_password) || empty($gender)) {
                get_error_alert('İşlem Başarısız!', 'panel/kullanici/ekle', 'Lütfen Tüm Alanları Doldurun.');
                die();
            }
            if (!in_array($gender, ['man', 'woman'])){
                get_error_alert('İşlem Başarısız!', 'panel/kullanici/ekle', 'Lütfen Cinsiyetinizi Seçiniz.');
                die();
            }

            if (strlen($password) < 8){
                get_error_alert('İşlem Başarısız!', 'panel/kullanici/ekle', 'Şifreniz En Az 8 Karakter Olmalıdır.');
                die();
            }

            if ($password != $re_password){
                get_error_alert('İşlem Başarısız!', 'panel/kullanici/ekle', 'Şifreleriniz Eşleşmiyor.');
                die();
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                get_error_alert('İşlem Başarısız!', 'panel/kullanici/ekle', 'E-Posta Adresi Yanlış Biçimde Girilmiş.');
                die();
            }
            $userModel = new UserModel();
            $isEmail = $userModel->getRows(['where' => ['email' => $email], 'return_type' => 'single']);
            if ($isEmail) {
                get_error_alert('İşlem Başarısız!', 'panel/kullanici/ekle', 'Girdiğiniz E-Posta Adresi Daha Önce Kullanılmış.');
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
                'userName'  => $userName,
                'email'     => $email,
                'gender'    => $gender,
                'password'  => password_hash($password, PASSWORD_DEFAULT),
                'uniq_code' => $uniq_code,
                'user_code' => $user_code,
                'status'    => 'ACTIVE',
            ];
            $user = $userModel->create($userData);
            if (!$user) {
                get_error_alert('İşlem Başarısız!', 'panel/kullanici/ekle', 'Kullanıcı Eklenirken Hata Oluştu.');
                die();
            }
            $user = $userModel->getRows(['where' => ['email' => $email], 'return_type' => 'single']);
            set_log($_SESSION['user'], $user['fullName'].' Adlı Kullanıcıyı Ekledi', LOG_ADD, 'USER');
            get_success_alert('İşlem Başarılı', 'panel/kullanici/listesi', 'Kullanıcı Başarılı Bir Şekilde Eklendi.');
            die();
        }
        header("Location: ". APP_URL ."panel");
    }

    public function edit($id): void {
        if (!isset($_SESSION['auth']) && empty($_SESSION['auth']) && $_SESSION['auth'] != true) {
            get_view_alert('giris');
            die();
        }
        if (!is_null($id) && is_numeric($id)) {
            $this->data["title"] = "Kullanıcı Düzenleme Sayfası...";

            $userModel = new UserModel();
//            $this->data['user'] = $user->get($id);
            $user = $userModel->getRows(['where' => ['id' => $id], 'return_type' => 'single']);

            if (!$user) {
                get_error_alert('İşlem Başarısız!', 'panel/kullanici/listesi', 'Kullanıcı Bulunamadı.');
                die();
            }

            $this->data['user'] = $user;

            echo $this->view("admin.user.edit", $this->data);
            die();
        }
        get_error_alert('İşlem Başarısız!', 'panel/kullanici/listesi', 'Kullanıcı Bulunamadı.');
        die();

    }

    public function update($id) {

        $post_id   = xss_clear($_POST['id']);
        if ($this->server("REQUEST_METHOD") == "POST") {
            if (isset($_POST['csrf']) && !empty($id) && $id == $post_id) {
//                if ($_POST['csrf'] != $_SESSION['csrf']) {
//                    get_error_alert('İşlem Başarısız!', 'panel/kullanici/duzenle/'.$id, 'CSRF Token Hatalı yada Eksik');
//                    die();
//                }
                $firstName = xss_clear($this->post('firstName'));
                $lastName = xss_clear($this->post('lastName'));
                $userName = xss_clear($this->post('userName'));
                $email = xss_clear($this->post('email'));

                $userData = [
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'fullName' => $firstName . ' ' . $lastName,
                    'userName' => $userName,
                    'email' => $email
                ];
                $condition = ['id' => $id];
                $user = new UserModel();
                $update = $user->update($userData, $condition);
                if ($update) {
                    get_success_alert('İşlem Başarılı', 'panel/kullanici/duzenle/'.$id, 'Kullanıcı Bilgileri Güncellendi.');
                    die();
                } else {
                    get_error_alert('İşlem Başarısız!', 'panel/kullanici/duzenle/'.$id, 'Kullanıcı Bilgileri Güncellenirtken Beklenmedik Bir Hata Oluştu.');
                    die();
                }
            }
            get_error_alert('İşlem Başarısız!', 'panel/kullanici/duzenle/'.$id, 'Eksik yada Hatalı Bilgi Gönderdiniz');
            die();
        }
        get_error_alert('İşlem Başarısız!', 'panel/kullanici/duzenle/'.$id, 'Sadece POST İşlemi Yapılabilir');
        die();

    }

    public function delete() {
        if (!isset($_SESSION['auth']) && empty($_SESSION['auth']) && $_SESSION['auth'] != true) {
            header("Location: ". APP_URL ."panel");
        }

        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {

            $input = file_get_contents('php://input');
            parse_str($input, $data);

            // CSRF ve ID kontrolü
            if (isset($data['csrf']) && !empty($data['id']) && is_numeric($data['id'])) {
                $id = $data['id'];

                // Kullanıcıyı silme işlemi
                $userModel = new UserModel();
                $user = $userModel->getRows(['where' => ['id' => $id], 'return_type' => 'single']);

                if (!$user) {
                    // Kullanıcı bulunamadı
                    http_response_code(404); // Not Found
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Kullanıcı bulunamadı.'
                    ]);
                    die();
                }

                // Kullanıcıyı sil
                $delete = $userModel->delete(['id' => $id]);

                if ($delete) {
                    // Silme işlemi başarılı
                    http_response_code(200); // OK
                    echo json_encode([
                        'status' => 'success',
                        'id' => $id,
                        'message' => 'Kullanıcı başarıyla silindi.'
                    ]);
                    die();
                } else {
                    // Silme işlemi başarısız
                    http_response_code(500); // Internal Server Error
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Kullanıcı silinirken bir hata oluştu.'
                    ]);
                    die();
                }
            } else {
                // Geçersiz istek
                http_response_code(400); // Bad Request
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Geçersiz istek.'
                ]);
                die();
            }
        }

    }



}
