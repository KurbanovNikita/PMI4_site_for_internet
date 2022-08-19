<?php

class productsModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add($data){
       $sth = $this->db->prepare(
               "INSERT INTO products (name, code, price, sections_id, active, description, p_img, d_img, imgs) "
               ." VALUE (:name, :code, :price, :sections_id, :active, :description, :p_img, :d_img, :imgs); "
       );
       //var_dump($data);
       $sth -> execute($data);
       //var_dump($sth->errorInfo());
       if ($sth->rowCount() > 0) {
           return $this->db->lastInsertId();
       } else {
           return false;
       }
    }

    public function edit($data){
        $sth = $this->db->prepare(
               "UPDATE products SET name = :name, code = :code, sections_id = :sections_id, active = :active, "
                ." price = :price, description = :description, p_img = :p_img, d_img = :d_img, imgs = :imgs WHERE id = :id;");
       //var_dump($data);
       $sth -> execute($data);
       //var_dump("errorInfo:",$sth->errorInfo());
       if ($sth->rowCount() > 0) {
           return true;
       } else {
           return false;
       }
    }
    
    public function deleteIMGS($imgs = array()) {
        if (count($imgs) > 0) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'].MAIN_PREFIX."/upload/{$imgs["p_img"]}")) {
                if (unlink($_SERVER['DOCUMENT_ROOT'].MAIN_PREFIX."/upload/{$imgs["p_img"]}")) {
                    echo "Удалить П фото удалось!";
                } else {
                    echo "Удалить П фото не удалось!"; 
                }
            }
            if (file_exists($_SERVER['DOCUMENT_ROOT'].MAIN_PREFIX."/upload/{$imgs["d_img"]}")) {
                if (unlink($_SERVER['DOCUMENT_ROOT'].MAIN_PREFIX."/upload/{$imgs["d_img"]}")) {
                    echo "Удалить Д фото удалось!";
                } else {
                    echo "Удалить Д фото не удалось!"; 
                }
            }
            $im = json_decode($imgs["imgs"]);
            foreach ($im as $m) {
                if (file_exists($_SERVER['DOCUMENT_ROOT'].MAIN_PREFIX."/upload/{$m}")) {
                    if (unlink($_SERVER['DOCUMENT_ROOT'].MAIN_PREFIX."/upload/{$m}")) {
                        echo "Удалить фото удалось!";
                    } else {
                        echo "Удалить фото не удалось!"; 
                    }
                }
            } 
        }
    }
    
    public function delete( $table, $attr, $value, $imgs = array()) {
        $sth = $this->db->prepare("DELETE FROM ".$table
                ." WHERE ".$attr." = ".$value);
        
        //var_dump($imgs);
        $sth -> execute(array());
        
        if ($sth->rowCount() > 0) {
            // удаляем фотки из папки
            self::deleteIMGS($imgs);
            return true;
        }else{
            return false;
        }
    }
}
