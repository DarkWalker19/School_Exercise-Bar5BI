<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";
    is_user_logged();
?>
<html>
    <head>
        <title>New Order</title>
        <?php
            get_css();
        ?>
        <script>
            function generateNewOrder(){
                let order = 
                `<div class="order">
                    <label for="item">Item</label><br>
                    <select name="item[]" class="item" onchange="calculateTotal();">
                        <?php
                            $db = get_db_connection();
                            $res = $db->query("SELECT * FROM menu_bar");
                            foreach($res->fetchAll() as $row){
                                $data = "<option 
                                                class='item_" . $row[0] . 
                                            "' value='" . $row[0] . 
                                            "' cost='" . number_format($row[2], 2) . 
                                        "'>" . htmlspecialchars($row[1]) . " " . number_format($row[2], 2) . "€</option>";
                                echo $data;
                            }
                        ?>
                    </select><br>
                    <label for="quantity">Quantity</label><br>
                    <input type="number" name="quantity[]" class="quantity" onchange="calculateTotal();" oninput="calculateTotal();" value=1 min=0>
                </div>`;
                let div = document.createElement("div");
                let br = document.createElement("br");
                div.innerHTML = order;
                br.innerHTML = "<br>";
                document.getElementById("orders").appendChild(div.firstChild);
                document.getElementById("orders").appendChild(br.firstChild);
                calculateTotal();
            }
            function removeOrder(){
                if(document.getElementById("orders").childElementCount <= 2) return;
                let orders = document.getElementById("orders");
                orders.removeChild(orders.lastChild);
                orders.removeChild(orders.lastChild);
                calculateTotal();
            }
            function calculateTotal(){
                let total = 0
                let orders = document.getElementsByClassName("order");
                for(let i = 0; i<orders.length; i++){
                    let order = orders.item(i);
                    let item_id = order.getElementsByClassName("item").item(0).value;
                    let item_cost = parseFloat(order.getElementsByClassName("item_" + item_id).item(0).getAttribute("cost")).toFixed(2);
                    let quantity = parseInt(order.getElementsByClassName("quantity").item(0).value);

                    if(quantity>0 && item_cost>0) total += item_cost*quantity;
                }
                document.getElementById("total").innerHTML = total.toFixed(2);
            }
        </script>
    </head>
    <body onload="generateNewOrder();">
        <div class="grBox"><h1>New Order</h1></div>
        <br>
        <form action="addOrder.php" method="POST" class="form">
            <div class="wrapper">
                <div id="orders" class="itemBox">
                    <br>
                </div>
                <div class="buttonBox">
                    <br>
                    <input type="button" value="Add Order" onclick="generateNewOrder();" class="grButton">
                    <input type="button" value="Remove Order" onclick="removeOrder();" class="redButton">
                    <br>
                    <p>Total: <span id="total">0.00</span>€</p>
                    <input type="submit" value="Place Order" class="grButton">
                    <br><br>
                </div>
            </div>
        </form>
        <br>
        <button onclick="location.href='index.php'" type="button" class="backButton">Back</button>
    </body>
</html>