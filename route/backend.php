<?php
global $router;

$router->name('dashboard.index')->get('/dashboard', [App\Admin\Controller\BaseController::class, 'index']);