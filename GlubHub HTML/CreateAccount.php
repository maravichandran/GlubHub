<?php

echo "<link rel='stylesheet' type='text/css' href='GlubHub_Stylesheet.css'>";
echo "<script src='Slogans.js'></script>";

echo "<div class='title_block'>";
echo"<img src='http://www.megaicons.net/static/img/icons_sizes/8/178/256/animals-fish-icon.png'/>";
echo"<h1>Glub<span style='color:#e33809'>Hub</span></h1>";
echo "</div>";
echo"<div class='slogan_block' style='background-color:#f1857e'>";
echo "<h2 id='slogan'>O-FISH-al fisherman network</h2>";
echo "</div>";

echo"<ul class='navbar'>";
	echo"<li><a href='Search.php'>SEARCH</a></li>";
	echo"<li><a href='Upload.php'>UPLOAD</a></li>";
	echo '<li><a href="Login.php">LOGIN</a></li>';
	echo '<li><a href="CreateAccount.php" class="active">CREATE ACCOUNT</a></li>';
echo'</ul>';

echo'<div class="center_div">'
echo'<form>'
	echo'<h2>Create an Account</h2>'
		echo'<p>Username</p>'
		echo'<input type="text" name="username"><br>'
		echo'<p>Password</p>'
		echo'<input type="password" name="password"><br>'
		echo'<p>Confirm Password</p>'
		echo'<input type="password" name="confirm_pw"><br>'
		echo'<p>E-mail</p>'
		echo'<input type="text" name="email"><br>'
		echo'<p>First Name</p>'
		echo'<input type="text" name="firstname"><br>'
		echo'<p>Last Name</p>'
		echo'<input type="text" name="lastname"><br>'
		echo'<br>'
	echo'<button>CREATE ACCOUNT</button>'
echo'</form>'

?>
