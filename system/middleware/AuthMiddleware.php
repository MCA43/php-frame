<?php

namespace System\Middleware;

use System\Engine\Controller;

class AuthMiddleware extends Controller implements MiddlewareInterface {

    public function handle(?string $parameter): bool {
        if (!isset($_SESSION['auth']) && $_SESSION['auth'] !== true && !isset($_SESSION['user']['id'])) {
            header('location: ' . APP_URL . 'giris');
            return false;
        }

        return true;
    }

}
