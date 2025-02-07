<?php

namespace System\Engine;

use eftec\bladeone\BladeOne;

class Controller
{
    use Response, Request;
    protected $data = null;
    public $view;
    public function __construct()
    {
        if (isset($_SESSION["csrf"])) {
            $this->data["csrf"] = $_SESSION["csrf"];
        } else {
            $this->data["csrf"] = $_SESSION["csrf"] = bin2hex(random_bytes(16));
        }

    }

    public function view(string $path, array $data = []) {
        $blade = new BladeOne(APP_ROOT . '/public/views' , APP_ROOT . '/public/cache', BladeOne::MODE_DEBUG);
        return $blade->run($path, $data);
    }
}
