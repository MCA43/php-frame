<?php

namespace App\Catalog\Model;

use System\Engine\Model;

class UserModel extends Model {

    public function __construct(){
        parent::__construct();
        $this->table = 'users';
    }

    public function users(): array | false
    {
        $statement = $this->pdo->query('SELECT * FROM users');
        $response = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $response ?: [];
    }
}
