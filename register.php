<?php
    require "./php/header.php";
    require "./php/captcha.php";
    is_user_already_logged();
?>
<html>
    <head>
        <title>Register</title>
        <?php
            get_css();
        ?>
    </head>
    <body>
        <div class="grBox"><h1>Register</h1></div>
        
        <form action="newUser.php" method="POST" class="form">
            <br>
            <div style="display: grid; justify-content: center;">
                <div class="authBox">
                    <br>
                    <label for="username">Username</label>
                    <input type="text" placeholder="Enter Username" name="username" required>
                    <br>
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter Password" name="password" required>
                    <br>
                    <label for="rpassword">Retype Password</label>
                    <input type="password" placeholder="Enter Password" name="rpassword" required>
                    <br><br>
                    <?php
                        $code = generate_field();
                        $_SESSION['captcha'] = $code;
                    ?>
                    <br><br>
                    <button type="submit">Register</button>
                    <p><a href="login.php">Already registered?</a></p>
                </div>
            </div>
        </form>
    </body>
</html>