<?php
global $router;

$router->get('/dashboard', [App\Admin\Controller\BaseController::class, 'index'])->name('dashboard.index')->middleware(['auth']);