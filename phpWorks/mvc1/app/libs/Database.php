<?php

class Database extends PDO{
    
    public function __construct() {
        try {
            
            // dns выглядит так имя драйвера --- адресс --- имя базы данных
            parent::__construct('mysql:host='.DBMYHOST.';dbname='.DBNAME, DBUSER, DBPASS);
            
            
        }
        catch(PDOException $e) {
            echo 'Подключение не удалось: '.$e->getMessage();
            die;
        }
        
    }
}
