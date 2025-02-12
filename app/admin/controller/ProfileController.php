<?php

namespace App\Admin\Controller;

use App\Admin\Model\UserModel;
use System\Engine\Controller;
use System\Engine\Request;

class ProfileController extends Controller {

    use Request;

    public function index(): void {
        if (!isset($_SESSION['auth']) && empty($_SESSION['auth']) && $_SESSION['auth'] != true) {
            get_view_alert('giris');
        }
        $this->data["title"] = 'Profil Sayfası...';

        $userModel = new UserModel();
        $user = $userModel->getRows(['where' => ['id' => $_SESSION['user']['id']], 'return_type' => 'single']);

        if (!$user) {
            get_error_alert("İşlem Başarısız!", "panel", "Kullanıcı Bilgileriniz Bulunamadı");
            die();
        }

        $this->data['user'] = $user;

        echo $this->view("admin.user.profile", $this->data);
        die();
    }

    public function update(): void {
        if (!isset($_SESSION['auth']) && empty($_SESSION['auth']) && $_SESSION['auth'] != true) {
            get_view_alert('giris');
        }
        if ($this->server("REQUEST_METHOD") == "POST") {
            if (isset($_POST['csrf'])) {
//                if ($_POST['csrf'] != $_SESSION['csrf']) {
//                    get_error_alert('İşlem Başarısız!', 'panel/kullanici/duzenle/'.$id, 'CSRF Token Hatalı yada Eksik');
//                    die();
//                }

                $userModel = new UserModel();
                $user = $userModel->getRows(['where' => ['id' => $_SESSION['user']['id']], 'return_type' => 'single']);
                if (!$user) {
                    get_error_alert("İşlem Başarısız!", "panel", "Kullanıcı Bilgileriniz Bulunamadı");
                    die();
                }
                $oldImage = $user['image'];
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
                if ($_FILES["image"]["name"] !== "") {
                    $file_name = convertToSEO(time() . '-' . $firstName . '-' . $lastName) . ".webp";
                    $image = upload_picture_noFit($_FILES["image"]["tmp_name"], "public/uploads/images/users", $file_name);
                    // Özel Boyutlandırılmış Olarak Kaydetmek İsterseniz Bu Functionu Kullanabilirsiniz.
                    // app/helpers/ImageHelper.php içerisinde değişiklikler yaparak functionu geliştirebilirsiniz
//                    $image = upload_picture($_FILES["image"]["tmp_name"], "public/uploads/images/users", 500, 500, $file_name);
                    if ($image) {
                        if (file_exists('public/uploads/images/users/' . $oldImage)) {
                            if ($user['image'] == "no_image.png" || $user['image'] == 'default-man.png' || $user['image'] == 'default-woman.png' || $user['image'] == 'default-user.png') {

                            } else {
                                unlink('public/uploads/images/users/' . $oldImage);
                            }
                        }
                        $userData["image"] = $file_name;
                    } else {
                        get_error_alert("İşlem Başarısız!", "panel", "Profil Resmi Yüklenirken Beklenmedik Bir Hata Oluştu.");
                        die();
                    }
                }

                $condition = ['id' => $user['id']];
                $update = $userModel->update($userData, $condition);
                if ($update) {
                    $user = $userModel->getRows(['where' => ['id' => $_SESSION['user']['id']], 'return_type' => 'single']);
                    unset($user['password']);
                    unset($user['uniq_code']);
                    unset($user['user_code']);
                    $_SESSION['user'] = $user;

                    $this->data['user'] = $userModel->get($user['id']);
                    set_log($this->data['user'], 'Profil Bilgilerini Güncelledi', LOG_UPDATE, 'PROFILE');

                    get_success_alert("İşlem Başarılı", "panel/profil", "Profil Bilgileriniz Güncellendi");
                    die();
                } else {
                    $this->data['status'] = 'error';
                    $this->data['message'] = '';
                    get_error_alert("İşlem Başarısız!", "panel", "Profil Bilgileri Güncellenirken Beklenmedik Bir Hata Oluştu.");
                }
            }
        }
        get_error_alert("İşlem Başarısız!", "panel", "Sadece POST İşlemi Yapılabilir.");
    }

}
