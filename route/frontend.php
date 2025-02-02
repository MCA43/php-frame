<?php
global $router;

$router->name('catalog.index')->get('/', [App\Catalog\Controller\BaseController::class, 'index']);