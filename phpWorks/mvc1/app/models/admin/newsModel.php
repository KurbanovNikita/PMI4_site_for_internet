<?php

class newsModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add($data){
       $sth = $this->db->prepare(
               "INSERT INTO news (title, code, category_id, description, p_img, d_img, text) "
               ." VALUE (:title, :code, :category_id, :description, :p_img, :d_img, :text); "
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
               "UPDATE news SET title = :title, code = :code, category_id = :category_id, "
                ." description = :description, p_img = :p_img, d_img = :d_img, text = :text WHERE id = :id;");
       var_dump($data);
       $sth -> execute($data);
       var_dump("errorInfo:",$sth->errorInfo());
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
