<?php
	require "./php/header.php";
?>
<html>
    <head>
        <title>Index</title>
		<?php
            get_css();
        ?>
    </head>
    <body>
		<div style="text-align: center;">
        <?php
			if(!isset($_SESSION['user'])){
				echo "<div class='redBox'><h1>You're not logged in!</h1></div>";
				echo "<br>";
				echo "<div>";
				echo "<div class='wrapper'>";
				echo "<div class='left'><button onclick=\"location.href='login.php'\" type=\"button\">Login</button></div>";
				echo "<div class='right'><button onclick=\"location.href='register.php'\" type=\"button\">Register</button></div>";
				echo "</div></div>";
			}
			else{
				echo "<div class='grBox'><h1>Benvenuto " . htmlspecialchars($_SESSION['user']) . "</h1></div>";
				echo "<br>";
				echo "<button onclick=\"location.href='items.php'\" type='button'>Items</button>";
				echo "<br><br>";
				echo "<button onclick=\"location.href='newOrder.php'\" type='button'>New Order</button>";
				echo "<br><br>";
				echo "<button onclick=\"location.href='orders.php'\" type='button'>Order list</button>";
				echo "<br><br>";
				if($_SESSION['admin']) {
					echo "<div class='wrapper' style='justify-content: center;'>";
					echo "<div class='grBox' style='padding: 5px;'>";
					echo "<details><summary>Admin Panel</summary>";
					echo "<br><button onclick=\"location.href='newItem.php'\" type='button'>Add new item</button>";
					echo "<br><br><button onclick=\"location.href='registeredUsers.php'\" type='button'>Registered Users</button>";
					echo "<br><br></details></div></div>";
				}
				echo "<br><button onclick=\"location.href='logout.php'\" type='button' class='backButton'>Logout</button>";
			}
		?>
		</div>
    </body>
</html>