<?php
    require "./php/header.php";
    require "./php/captcha.php";
    is_user_already_logged();
?>
<html>
    <head>
        <title>Login</title>
        <?php
            get_css();
        ?>
    </head>
    <body>
        <div class="grBox"><h1>Login</h1></div>
        <form action="auth.php" method="POST" class="form">
            <br>
            <div style="display: grid; justify-content: center;">
                <div class="authBox">
                    <br>
                    <label for="username">Username</label>
                    <input type="text" placeholder="Enter Username" name="username" required>
                    <br>
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter Password" name="password" required>
                    <br><br>
                    <?php
                        $code = generate_field();
                        $_SESSION['captcha'] = $code;
                    ?>
                    <br><br>
                    <button type="submit">Login</button>
                    <p><a href="register.php">Not registered?</a></p>
                </div>
            </div>
        </form>
    </body>
</html>