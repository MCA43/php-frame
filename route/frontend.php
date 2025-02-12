<?php
global $router;

$router->get('/', [App\Catalog\Controller\BaseController::class, 'index'])->name('catalog.index');
$router->get('/kurulum', [App\Catalog\Controller\BaseController::class, 'start'])->name('catalog.start');
$router->get('/404', [App\Catalog\Controller\BaseController::class, 'pageNotFound'])->name('page.notfound');
