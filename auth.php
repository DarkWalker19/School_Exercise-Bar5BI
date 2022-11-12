<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";

    if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['captcha'])) error("invalid_login_form");
    
    $user = $_POST['username'];
    $password = $_POST['password'];
    $captcha = $_POST['captcha'];
    
    if($captcha!=$_SESSION['captcha']){
        session_destroy();
        error("invalid_captcha");
    }

    $db = get_db_connection();
    $query = "SELECT id, user, password, admin FROM bar_user WHERE user = ? AND password = ?;";
    
    $result = $db->prepare($query);
    $result->execute([$user, $password]);
    
    if($result->rowCount() == 0){
        error("wrong_credentials");
    }
    else{
        $row = $result->fetch();
        $_SESSION['user_id'] = $row[0];
        $_SESSION['user'] = $user;
        $isAdmin = $row[3]==1 ? true : false;

        if($isAdmin) $_SESSION['admin'] = true;
        else $_SESSION['admin'] = false;

        header("Location: index.php");
    }
?>