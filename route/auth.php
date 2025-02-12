<?php
global $router;

$router->get('/giris', [App\Auth\Controller\AuthController::class, 'loginForm'])->name('login');
$router->post('/giris', [App\Auth\Controller\AuthController::class, 'login'])->name('login');

$router->get('/oturum-ac', [App\Auth\Controller\AuthController::class, 'lockScreenForm'])->name('lockscreen');
$router->post('/oturum-ac', [App\Auth\Controller\AuthController::class, 'lockScreen'])->name('lockscreen');

$router->get('/kayit', [App\Auth\Controller\AuthController::class, 'registerForm'])->name('register');
$router->post('/kayit', [App\Auth\Controller\AuthController::class, 'register'])->name('register');

$router->get('/sifremi-unuttum', [App\Auth\Controller\PasswordController::class, 'passwordForgotForm'])->name('password.forgot');
$router->post('/sifremi-unuttum', [App\Auth\Controller\PasswordController::class, 'passwordForgot'])->name('password.forgot');

$router->get('/sifre-sifirla/{token}', [App\Auth\Controller\PasswordController::class, 'passwordResetForm'])->params(['[a-zA-Z0-9]+'])->name('password.reset');
$router->post('/sifre-sifirla', [App\Auth\Controller\PasswordController::class, 'passwordReset'])->name('password.reset');

$router->get('/email-dogrula', [App\Auth\Controller\VerificationController::class, 'index'])->name('verification.notice');
$router->get('/email-dogrula/{id}/{hash}', [App\Auth\Controller\VerificationController::class, 'index'])->name('verification.verify');

$router->get('/cikis', [App\Auth\Controller\AuthController::class, 'logout'])->name('logout');
$router->get('/oturumu-kilitle', [App\Auth\Controller\AuthController::class, 'lock'])->name('lock');