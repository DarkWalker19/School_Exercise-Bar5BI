<?php
    require "./php/header.php";
    require "./php/db_pdo.php";
    require_once "./php/error_page.php";

    is_user_admin(); 
?>
<html>
    <head>
        <title>Users</title>
        <?php
            get_css();
        ?>
    </head>
    <body>
        <div class="grBox"><h1>Registered Users</h1></div>
            <br>
            <div style="justify-content: center; display: grid;">
                <table>
                    <th>ID</th><th>User</th><th>Password</th><th>Is Admin</th>
                    <?php
                        $db = get_db_connection();
                        $res = $db->query("SELECT * FROM bar_user");
                        foreach($res->fetchAll() as $row){
                            $data = "";
                            for($i = 0; $i<$res->columnCount(); $i++){
                                $data .= "<td>" . $row[$i] . "</td>";
                            }
                            echo "<tr>$data</tr>";
                        }
                    ?>
                </table>
            </div>
        </body>
        <br>
        <button onclick="location.href='index.php'" type="button" class="backButton">Back</button>
    </body>
</html>