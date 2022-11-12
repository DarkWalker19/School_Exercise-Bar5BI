<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";

    is_user_admin();

    if(!isset($_POST['item']) || 
        !isset($_POST['price']) ||   
        !isset($_POST['supplier_id'])
    ) error("invalid_addItem_form");
    
    $item = $_POST['item'];
    $price = doubleval($_POST['price']); 
    $prepared = intval($_POST['prepared']); 
    $stock = isset($_POST['stock']) ? intval($_POST['stock']) : "null";
    $supplier_id = intval($_POST['supplier_id']);
    
    if($price<0.0){
        error("bad_price");
        exit();
    }
    if($stock<0){
        error("bad_stock");
        exit();
    }

    if($prepared == 0) $stock = "null";

    $db = get_db_connection();
    $query = "INSERT INTO menu_bar(
        item,
        price,
        prepared,
        stock,
        supplier_id
    ) VALUES
    (?, ?, ?, ?, ?)";
    $db->prepare($query)->execute([$item, $price, $prepared, $stock, $supplier_id]);
    header("Location: index.php");
?>