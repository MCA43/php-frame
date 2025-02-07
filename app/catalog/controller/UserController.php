<?php

namespace App\Catalog\Controller;

use App\Catalog\Model\UserModel;
use System\Engine\Controller;
use System\Engine\Request;

class UserController extends Controller {

    use Request;

    public function list(): void {
        $this->data["title"] = "Kullanıcı Listeleme Sayfası...";

        $users = new UserModel();
        $this->data['users'] = $users->getRows();

        echo $this->view("catalog.user.list", $this->data);
    }

    public function add() {

    }

    public function save() {

    }

    public function edit($id = null) {

        if (!is_null($id) && is_numeric($id)) {
            $this->data["title"] = "Kullanıcı Düzenleme Sayfası...";

            $user = new UserModel();
            $this->data['user'] = $user->get($id);
//            $this->data['user'] = $user->getRows(['where' => ['userName' => 'MCA'], 'return_type' => 'single']);

            echo $this->view("catalog.user.edit", $this->data);
            die();
        }
        die('Hata');

    }

    public function update($id = null) {

        $post_id   = strip_tags(htmlspecialchars($_POST['id']));
        if(isset($_POST['csrf']) && !empty($id) && $id == $post_id) {
            if ($_POST['csrf'] != $_SESSION['csrf']) {
                die('CSRF Token Hatalı');
            }
            $firstName = xss_clear($this->post('firstName'));
            $lastName  = xss_clear($this->post('lastName'));
            $userName  = xss_clear($this->post('userName'));
            $email     = xss_clear($this->post('email'));

            $userData = [
                'firstName' => $firstName,
                'lastName'  => $lastName,
                'fullName'  => $firstName . ' ' . $lastName,
                'userName'  => $userName,
                'email'     => $email
            ];
            $condition = ['id' => $id];
            $user = new UserModel();
            $update = $user->update($userData, $condition);
            if ($update) {
                $this->data['status']  = 'success';
                $this->data['message'] = 'Kullanıcı Bilgileri Güncellendi.';
            }else{
                $this->data['status']  = 'error';
                $this->data['message'] = 'Kullanıcı Bilgileri Güncellenirtken Beklenmedik Bir Hata Oluştu.';
            }
            $this->data['user'] = $user->get($id);
            echo $this->view("catalog.user.edit", $this->data);
            die();
        }
        die('Hata');

    }

    public function delete() {}

}
