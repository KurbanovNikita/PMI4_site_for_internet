<?php

class categoryModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function add($data){
       $sth = $this->db->prepare(
               "INSERT INTO category (name, code, depth_level, parent_id ) "
               ." VALUE (:name, :code, :depth_level, :parent_id); "
       );
       
       $sth -> execute($data);
       //var_dump($this->errorInfo());
       if ($sth->rowCount() > 0) {
           return $this->db->lastInsertId();
       } else {
           return false;
       }
    }
    
    public function edit($data){
        $sth = $this->db->prepare(
               "UPDATE category SET name = :name, code = :code, depth_level = :depth_level, parent_id = :parent_id WHERE id = :id;");
       
       $sth -> execute($data);
       //var_dump($this->errorInfo());
       if ($sth->rowCount() > 0) {
           return true;
       } else {
           return false;
       }
    }
    
}

