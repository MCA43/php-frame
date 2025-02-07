<?php

function assets(string $url) {
    if (!is_null($url)) {
        $new_url = APP_URL . 'public/assets/' . $url;
        return $new_url;
    }
    return false;
}

function uploads_url(string $url) {
    if (!is_null($url)) {
        $new_url = APP_URL . 'public/uploads/' . $url;
        return $new_url;
    }
    return false;
}

function xss_clear(string $data) {
    return strip_tags(htmlspecialchars(stripcslashes($data)));
}

function random_string(int $n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = random_int(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
