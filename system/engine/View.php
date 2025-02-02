<?php

namespace System\engine;

use eftec\bladeone\BladeOne;

class View {
    public $blade;
    public function __construct() {

    }

    public function show(string $path, array $data = []) {
        $blade = new BladeOne(APP_ROOT . '/public/views' , APP_ROOT . '/public/cache', BladeOne::MODE_DEBUG);
        return $blade->run($path, $data);

    }
}
