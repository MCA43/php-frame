<?php
global $router;

$router->get('/', [App\Catalog\Controller\BaseController::class, 'index'])->name('catalog.index');

$router->group(['prefix' => '/kullanici', 'middleware' => ['auth']], function () use ($router) {

    $router->get('/listesi', [App\Catalog\Controller\UserController::class, 'list'])->name('user.list');
    $router->get('/ekle', [App\Catalog\Controller\UserController::class, 'add'])->name('user.add');
    $router->post('/ekle', [App\Catalog\Controller\UserController::class, 'save'])->name('user.add');
    $router->get('/duzenle/{id}', [App\Catalog\Controller\UserController::class, 'edit'])->params(['id' => '[0-9]+'])->name('user.edit');
    $router->post('/guncelle/{id}', [App\Catalog\Controller\UserController::class, 'update'])->name('user.edit');
    $router->delete('/sil/{id}', [App\Catalog\Controller\UserController::class, 'delete'])->name('user.delete');

});
