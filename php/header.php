<?php
    session_start();
    require_once "error_page.php";

    function get_css(){
        echo "<link rel='icon' href='.\img\itis_logo.png'>";
        echo "<link rel='stylesheet' href='css/pages.css'>";
    }

    function is_user_logged(){
        if(!isset($_SESSION['user'])) error("user_not_logged_in");
        return;
    }

    function is_user_admin(){
        is_user_logged();
        if(!$_SESSION['admin']) error("not_admin");
        return;
    }

    function is_user_already_logged(){
        if(isset($_SESSION['user'])) header("Location: index.php");
    }
?>