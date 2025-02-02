<?php

namespace System\Engine;

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

        $this->view = new View();
    }

    public function view(string $path, array $data = []) {

        return $this->view->show($path, $data);

        $view = APP_ROOT . '/view/' . mb_strtolower($path, 'UTF-8') . '.php';
        if (file_exists($view)) {
            extract($data);
            require_once($view);
        } else {
            throw new \Exception("view dosyası bulunamadı : " . $view);
        }
    }
}
