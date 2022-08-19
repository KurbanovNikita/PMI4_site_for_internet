<?php

namespace Libs;

class Files {
    const d_path = __DIR__.'/../../upload/'; // default path
    const extension = array("jpg", "bmp", "png", "jpeg");
    
    static function uploadFile($file, $path, $article=""){
        
        $file_info = pathinfo($file['name']);
        
        // self так как в статической функции, поскольку объект этого класса по сути не создается
        if ($file_info['filename'] != "") {
            if (in_array($file_info["extension"], self::extension)) {

                if ($file["size"] <= MAX_UPLOAD_SIZE) {

                    $dir = self::d_path.$path;
                    // проверяем существует ли каталог
                    if (!file_exists($dir)){
                        mkdir($dir);
                    }

                    $new_name = md5($file_info['filename'].rand(999, 99999999)).".".$file_info["extension"]; // избавиться от повторяемых имен

                    while(file_exists($dir.'/'.$new_name)) {
                        // если файл существует пробуем переименовать
                       $new_name = md5($file_info['filename'].rand(999, 99999999)).".".$file_info["extension"]; // не забываем об расширении файла

                    }
                    // поскольку файл при загрузке через POST храниться во временной папке, то его необходмо оттуда перенести
                    if (move_uploaded_file($file['tmp_name'], $dir.'/'.$new_name)) {
                        return $path.'/'.$new_name;

                    } else {
                        return false;
                    }

                } else {
                    return false;
                }

            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }
    
    static function deletFile($fileName) {
        // d_path на конце со слешом, fileName формируется без слэша - важно это понимать
        if (file_exists(self::d_path.$fileName)) {
           unlink(self::d_path.$fileName);
           return true;
        } else {
            return false;
        }
    }
}
