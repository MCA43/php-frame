<?php

namespace App\Catalog\Controller;

use App\Catalog\Model\AuthModel;
use System\Engine\Controller;

class UserController extends Controller
{

    public function list(): void {
        $this->data["title"] = "Kullanıcı Listeleme Sayfası...";

        $users = new AuthModel();
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

            $user = new AuthModel();
            $this->data['user'] = $user->get($id);
//            $this->data['user'] = $user->getRows(['where' => ['userName' => 'MCA'], 'single']);

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
            $firstName = strip_tags(htmlspecialchars($_POST['firstName']));
            $lastName  = strip_tags(htmlspecialchars($_POST['lastName']));
            $userName  = strip_tags(htmlspecialchars($_POST['userName']));
            $email     = strip_tags(htmlspecialchars($_POST['email']));

            $userData = [
                'firstName' => $firstName,
                'lastName'  => $lastName,
                'fullName'  => $firstName . ' ' . $lastName,
                'userName'  => $userName,
                'email'     => $email
            ];
            $condition = ['id' => $id];
            $user = new AuthModel();
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
