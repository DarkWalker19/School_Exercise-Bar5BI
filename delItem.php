<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";

    is_user_admin();
    
    if(!isset($_GET['id'])) error("invalid_delItem_form");
    
    $id = intval($_GET['id']);

    $db = get_db_connection();
    $query = "SELECT COUNT(*) FROM menu_bar WHERE id = ?";

    $result = $db->prepare($query);
    $result->execute([$id]);
    
    if($result->rowCount() == 0){
        error("invalid_id_onRemove");
    }
    else{
        $db->prepare("DELETE FROM menu_bar WHERE id = ?")->execute([$id]);

        header("Location: items.php");
    }
?>