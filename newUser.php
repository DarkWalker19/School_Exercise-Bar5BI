<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";

    if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['rpassword']) || !isset($_SESSION['captcha'])) error("invalid_register_form");
    
    $user = $_POST['username'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];
    $captcha = $_POST['captcha'];

    if($captcha!=$_SESSION['captcha']){
        session_destroy();
        error("invalid_captcha");
    }

    if($password != $rpassword) error("bad_password");
    
    $db = get_db_connection();
    $query = "SELECT user FROM bar_user WHERE user = ?;";
    
    $result = $db->prepare($query);
    $result->execute([$user]);
    if($result->rowCount() == 1){
        error("existing_user");
    }

    $_SESSION['user'] = $user;
    $_SESSION['admin'] = false;
    $query = "INSERT INTO bar_user (user, password) VALUES (?, ?);";
    $db->prepare($query)->execute([$user, $password]);

    $query = "SELECT id FROM bar_user WHERE user = ?;";
    $result = $db->prepare($query);
    $result->execute([$user]);
    $data = $result->fetch();
    $_SESSION['user_id'] = $data[0];

    header("Location: index.php");
?>