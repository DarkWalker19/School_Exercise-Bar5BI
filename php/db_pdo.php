<?php
    function get_db_connection(){
        require_once "error_page.php";

        $dbname = 'test';
        $dsn = "mysql:dbname=$dbname;host=127.0.0.1";
        $db_user = 'root';
        $db_password = '';
        
        try{
            $db = new PDO($dsn, $db_user, $db_password);
        } catch(PDOException $e) {
            error("PDO_Exception");
        }

        return $db;
    }
?>