<?php
global $router;

$router->get('/panel', [App\Admin\Controller\BaseController::class, 'index'])->name('dashboard.index')->middleware(['auth']);

$router->group(['prefix' => '/panel/kullanici', 'as' => 'dashboard.', 'middleware' => ['auth']], function () use ($router) {

    $router->get('/listesi', [\App\Admin\Controller\UserController::class, 'list'])->name('user.list');
    $router->get('/ekle', [\App\Admin\Controller\UserController::class, 'add'])->name('user.add');
    $router->post('/ekle', [\App\Admin\Controller\UserController::class, 'save'])->name('user.add');
    $router->get('/duzenle/{id}', [\App\Admin\Controller\UserController::class, 'edit'])->params(['id' => '[0-9]+'])->name('user.edit');
    $router->post('/guncelle/{id}', [\App\Admin\Controller\UserController::class, 'update'])->params(['id' => '[0-9]+'])->name('user.edit');
    $router->delete('/sil', [\App\Admin\Controller\UserController::class, 'delete'])->name('user.delete');

});

$router->get('/panel/profil', [App\Admin\Controller\ProfileController::class, 'index'])->name('profile.index')->middleware(['auth']);
$router->post('/panel/profil/guncelle', [App\Admin\Controller\ProfileController::class, 'update'])->name('profile.update')->middleware(['auth']);