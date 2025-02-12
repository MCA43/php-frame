<?php
if (!function_exists('upload_picture')) {
    function upload_picture($file, $upload_path, $width, $height, $name) {
        require_once APP_ROOT . '/vendor/claviska/simpleimage/src/claviska/SimpleImage.php';
        if (!is_dir("{$upload_path}/{$width}x{$height}")) {
            mkdir("{$upload_path}/{$width}x{$height}");
        }
        $upload_error = false;
        try {
            $simpleImage = new \claviska\SimpleImage();
            $simpleImage
                ->fromFile($file)  // Resmi Yükleme İşlemi
                ->bestFit($width, $height, 'center')                // 200x200 Olarak yeniden boyutlandırır
                ->toFile("{$upload_path}/{$width}x{$height}/$name", null, 80);      // nereye ve hangi şekilde kaydedileceği

        } catch (Exception $err) {
            $error = $err->getMessage();
            $upload_error = true;
        }
        if ($upload_error) {
            echo $error;
        } else {
            return true;
        }
    }
}

if (!function_exists('upload_picture_noFit')) {
    function upload_picture_noFit($file, $upload_path, $name) {
        require_once APP_ROOT . '/vendor/claviska/simpleimage/src/claviska/SimpleImage.php';
        $upload_error = false;
        try {
            $simpleImage = new \claviska\SimpleImage();
            $simpleImage->fromFile($file)->toFile($upload_path . "/" . $name, "image/webp", 80);
        } catch (Exception $err) {
            $error = $err->getMessage();
            $upload_error = true;
        }
        if ($upload_error) {
            echo $error;
        } else {
            return true;
        }
    }
}

if (!function_exists('get_picture')) {
    function get_picture($path = "", $pitcure = "", $resulation = null) {
        if ($pitcure == "") {
            $pitcure = uploads_url("images/resim-yok.jpg");
        } else {
            if ($resulation != null) {
                if (file_exists("public/uploads/images/$path/$resulation/$pitcure")) {
                    $pitcure = uploads_url("images/$path/$resulation/$pitcure");
                } else {
                    $pitcure = uploads_url("images/resim-yok.jpg");
                }
            } else {
                if (file_exists("public/uploads/images/$path/$pitcure")) {
                    $pitcure = uploads_url("images/$path/$pitcure");
                } else {
                    $pitcure = uploads_url("images/resim-yok.jpg");
                }
            }
        }
        return $pitcure;
    }
}