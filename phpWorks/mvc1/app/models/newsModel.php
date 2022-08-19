<?php

class newsModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function add($data, $table = "news", $content = "(title, code, category_id, description, p_img, d_img, text)", $d = "(:title, :code, :category_id, :description, :p_img, :d_img, :text)"){
       $sth = $this->db->prepare(
               "INSERT INTO ".$table." ".$content." "
               ." VALUE ".$d."; "
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
}
