<?php

class Model {
    public function __construct() {
        $this->db = new Database;
    }
    
    // аргументы - из какой таблицы, сортировка, какие поля выбрать, фильтр
    public function getList($table, $order = "id asc", $select = "*", $filter = " 1=1") {
        if (is_array($select)) {
            $select = implode(", ", $select);
        }
        
        $sth = $this->db->prepare("SELECT ".$select." FROM ".$table
                ." WHERE ".$filter." ORDER BY ".$order);
        $sth -> execute(array());
        
        if ($sth->rowCount() > 0) {
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    
    public function delete( $table, $attr, $value) {
        $sth = $this->db->prepare("DELETE FROM ".$table
                ." WHERE ".$attr." = ".$value);
        $sth -> execute(array());
        
        if ($sth->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteIMGS($imgs = array()) {
        
    }
    
    public function getByID($id, $table, $select = "*") {
        if (is_array($select)) {
            $select = implode(", ", $select);
        }
        
        $sth = $this->db->prepare("SELECT ".$select." FROM ".$table
                ." WHERE id = :id LIMIT 1");
        $sth -> execute(array(":id" => $id));
        
        if ($sth->rowCount() > 0) {
            return $sth->fetchAll(PDO::FETCH_ASSOC)[0]; // возвращаем массив?
        }else{
            return false;
        }
    }
    
    public function search($q, $table, $attr, $select = "*", $logic = "OR") {
        if (is_array($select)) {
            $select = implode(", ", $select);
        }
        $where = array();
        foreach ($attr as $at) {
            $where[] = "`$at` LIKE '%$q%'";
        }
        $where = implode(" $logic ", $where); // объекиняем массив в строку
        //var_dump("SELECT ".$select." FROM ".$table." WHERE $where ;");
        $sth = $this->db->prepare("SELECT ".$select." FROM ".$table
                ." WHERE $where ;");
        $sth -> execute();
        
        if ($sth->rowCount() > 0) {
            return $sth->fetchAll(PDO::FETCH_ASSOC); // возвращаем массив
        }else{
            return false;
        }
    }
}


