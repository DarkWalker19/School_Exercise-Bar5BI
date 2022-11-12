<?php
	require "./php/header.php";
    session_destroy();
?>
<html>
    <head>
        <title>Logout</title>
        <?php
            get_css();
        ?>
    </head>
    <body>
        <div class="grBox" style="font-size: 17px;">
            <p>You logged off correctly</p>
            <p>Go back to <button onclick="location.href='index.php'" type="button" class="backButton">Home</button></p>
        </div>
    </body>
</html>