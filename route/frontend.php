<?php
global $router;

$router->get('/', [App\Catalog\Controller\BaseController::class, 'index'])->name('catalog.index');


$router->get('/kullanici/listesi', [App\Catalog\Controller\AuthController::class, 'list'])->name('user.list');
$router->get('/kullanici/ekle', [App\Catalog\Controller\AuthController::class, 'add'])->name('user.add');
$router->post('/kullanici/ekle', [App\Catalog\Controller\AuthController::class, 'save'])->name('user.add');
$router->get('/kullanici/duzenle/{id}', [App\Catalog\Controller\AuthController::class, 'edit'])->params(['id' => '[0-9]+'])->name('user.edit');
$router->post('/kullanici/guncelle/{id}', [App\Catalog\Controller\AuthController::class, 'update'])->name('user.edit');
$router->delete('/kullanici/sil/{id}', [App\Catalog\Controller\AuthController::class, 'delete'])->name('user.delete');