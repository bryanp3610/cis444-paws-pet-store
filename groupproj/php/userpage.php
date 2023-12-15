<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" href="style.css" type="text/css">
  <title>User Page</title>
</head>
<body>

      <div class="navbar">
		<div class="logo">
			<a class="active" href='home.html'><img src="logo2.jpg" alt="logo" width='190.5px'
				height='104px' float='left';></a>
		</div>
		<div class="navcontainer">
			<a class="active" href='home.html'>Home</a>
			<a href="about.html">About Us</a>
			<a href="shop.html">Shop</a>
			<div class="lefts">
                <a href="cart.html"><img src="cart.jpg" alt="cart" width="30px" height="30px"></a>
                <a href="php/logoff.php">Log Out</button>
                
			</div>
		</div>
	<br><br><br><br><br><br>

    <br>

    </div>
    <p style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 30px;"><a href="home.html">Welcome <?php echo $_SESSION['email']?>! click shop to begin shopping !</a></p>

</body>
</html>