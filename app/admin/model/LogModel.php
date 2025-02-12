<?php

namespace App\Admin\Model;

use System\Engine\Model;

class LogModel extends Model {

    public function __construct(){
        parent::__construct();
        $this->table = 'logs';
    }

}
