<?php

namespace App\Auth\Model;

use System\Engine\Model;

class AuthModel extends Model {

    public function __construct(){
        parent::__construct();
        $this->table = 'users';
    }

}
