<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";

    is_user_logged();

    if(!isset($_POST['item']) || !isset($_POST['quantity'])) error("invalid_addOrder_form");

    $item_id = $_POST["item"];
    $quantity = $_POST["quantity"];

    $orders_query = "INSERT INTO orders (item_id, quantity, user_id) VALUES ";

    $values = [];

    for($i = 0; $i<count($item_id); $i++){
        if(intval($quantity[$i])>0){
            $orders_query .= "(?, ?, '" . $_SESSION["user_id"] . "')";
            array_push($values, $item_id[$i], intval($quantity[$i]));
            if($i<count($item_id)-1){
                $orders_query .= ",";
            }
        }
    }

    $orders_query .= ";";

    $db = get_db_connection();
    $db->prepare($orders_query)->execute($values);

    header("Location: index.php");
?>