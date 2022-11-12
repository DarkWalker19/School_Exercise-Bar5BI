<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";  
    is_user_admin();
?>
<html>
    <head>
        <title>New Item</title>
        <?php
            get_css();
        ?>
    </head>
    <body>
        <div class="grBox"><h1>New Item</h1></div>
        <br>
        <form action="addItem.php" method="POST" class="form">
            <div style="display: grid; justify-content: center;">
                <div class="itemBox">
                    <br>
                    <label for="item">Item</label><br>
                    <input type="text" id="item" name="item"><br>
                    <label for="price">Price</label><br>
                    <input type="number" id="price" name="price"><br>
                    <label for="prepared">Is Prepared</label><br>
                    <input type="checkbox" id="prepared" name="prepared"><br>
                    <label for="stock">Stock</label><br>
                    <input type="number" id="stock" name="stock"><br>
                    <label for="supplier_id">Supplier</label><br>
                    <select name="supplier_id" id="supplier_id">
                        <?php
                            $db = get_db_connection();
                            $res = $db->query("SELECT * FROM supplier");
                            foreach($res->fetchAll() as $row){
                                $data = "<option value='" . $row[0] .  "'>" . htmlspecialchars($row[1]) . "</option>";
                                echo $data;
                            }
                        ?>
                    </select><br><br>
                    <input type="submit" value="Submit" class="grButton">
                    <br><br>
                </div>
            </div>
        </form>
        <br>
        <button onclick="location.href='index.php'" type="button" class="backButton">Back</button>
    </body>
</html>