<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";
?>
<html>
    <head>
        <title>Orders</title>
        <?php
            get_css();
        ?>
    </head>
    <body>
        <div class="grBox"><h1>Orders</h1></div>
        <br>
        <div style="justify-content: center; display: grid;">
            <table>
                <?php
                    if($_SESSION['admin']) adminData();
                    else userData();
                    
                    function adminData(){
                        $db = get_db_connection();
                        $res = $db->query("SELECT orders.id, menu_bar.item, orders.quantity, bar_user.user FROM orders INNER JOIN menu_bar ON (orders.item_id = menu_bar.id) INNER JOIN bar_user ON (orders.user_id = bar_user.id)");
                        echo "<table>";
                        echo "<th>ID</th><th>Item</th><th>Quantity</th><th>Made by</th>";
                        foreach($res->fetchAll() as $row){
                            $data = "";
                            for($i = 0; $i<$res->columnCount(); $i++){
                                $data .= "<td>" . $row[$i] . "</td>";
                            }
                            $data .= "<td><button onClick='location.href=\"doOrder.php?id=" . $row[0] . "\"' class='redButton'>Done</button></td>";
                            echo "<tr>$data</tr>";
                        }
                    }

                    function userData(){
                        $db = get_db_connection();
                        $res = $db->prepare("SELECT orders.id, menu_bar.item, orders.quantity FROM orders INNER JOIN menu_bar ON (orders.item_id = menu_bar.id) INNER JOIN bar_user ON (orders.user_id = bar_user.id) WHERE (bar_user.id = ?)");
                        $res->execute([$_SESSION["user_id"]]);
                        echo "<table>";
                        echo "<th>ID</th><th>Item</th><th>Quantity</th>";
                        foreach($res->fetchAll() as $row){
                            $data = "";
                            for($i = 0; $i<$res->columnCount(); $i++){
                                $data .= "<td>" . $row[$i] . "</td>";
                            }
                            echo "<tr>$data</tr>";
                        }
                    }
                ?>
            </table>
        </div>
        <br>
        <button onclick="location.href='index.php'" type="button" class="backButton">Back</button>
    </body>
</html>