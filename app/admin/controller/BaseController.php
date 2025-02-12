<?php

namespace App\Admin\Controller;

use App\Admin\Model\LogModel;
use App\Admin\Model\UserModel;
use System\Engine\Controller;

class BaseController extends Controller
{
    public function index(): void {
        $this->data["title"] = 'Admin Panel Sayfası...';

        $userModel = new UserModel();
        $this->data['userCount'] = $userModel->getRows(['return_type' => 'count']);

        $logModel = new LogModel();
        $this->data['logs'] = $logModel->getRows(['where' => ['user_id' => $_SESSION['user']['id']], 'order_by' => 'created_at DESC', 'return_type' => 'all']);

        echo $this->view("admin.index", $this->data);
    }
}
