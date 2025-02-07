<?php

namespace App\Admin\Controller;

use System\Engine\Controller;

class BaseController extends Controller
{
    public function index(): void {
        $this->data["title"] = 'Admin Sayfası...';

        echo $this->view("admin.index", $this->data);
    }
}
