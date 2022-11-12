<?php
	require "./php/header.php";
?>
<html>
    <head>
        <title>Error</title>
        <?php
            get_css();
        ?>
    </head>
    <body>
        <div class="redBox">
            <h1>Error</h1>
        </div>
        <div class="errBody">
            <?php
            if(!isset($_GET['err'])){
                    echo "No error provided";
                    exit();
                }

                $err = $_GET['err'];
                echo "Error: $err";
            ?>
        </div>
        <br><br>
        <button onclick="location.href='index.php'" type="button" class="backButton">Home</button>
    </body>
</html>