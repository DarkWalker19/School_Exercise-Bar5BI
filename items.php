<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";

    is_user_logged();
?>
<html>
    <head>
        <title>Items</title>
        <?php
            get_css();
        ?>
    </head>
    <body>
        <div class="grBox"><h1>Items</h1></div>
        <br>
        <div style="justify-content: center; display: grid;">
            <table>
                <th>Item</th><th>Price</th><th>Is Prepared</th><th>Stock</th><th>Supplier</th>
                <?php
                    $db = get_db_connection();
                    $res = $db->query("SELECT menu_bar.id, item, price, prepared, stock, supplier.name FROM menu_bar INNER JOIN supplier ON (supplier_id = supplier.id)");
                    
                    foreach($res->fetchAll() as $row){
                        $data = "";
                        $row[1] = htmlspecialchars($row[1]);
                        $row[2] = number_format($row[2], 2) . "€";
                        $row[3] = $row[3] == "0" ? "No" : "Yes";
                        for($i = 1; $i<$res->columnCount(); $i++){
                            $data .= "<td>" . $row[$i] . "</td>";
                        }
                        if($_SESSION['admin']) $data .= "<td><button onClick='location.href=\"delItem.php?id=" . $row[0] . "\"' class='redButton'>Del</button></td>";
                        echo "<tr>$data</tr>";
                    }
                ?>
            </table>
        </div>
        <br>
        <button onclick="location.href='index.php'" type="button" class="backButton">Back</button>
    </body>
</html>