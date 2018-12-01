<?php
echo '<html>';
echo '<head>';
	
	echo '<title>GlubHub - Login</title>';

//Reference external stylesheet and non-functioning JS
echo '<link rel="stylesheet" type="text/css" href="GlubHub_Stylesheet.css">';
echo '<script src="Slogans.js"></script>';

echo '</head>';

echo '<body>';

//Title block with icon and slogan
echo '<div class="title_block">';
echo '<img src="http://www.megaicons.net/static/img/icons_sizes/8/178/256/animals-fish-icon.png"/>';
echo '<h1>Glub<span style="color:#e33809">Hub</span></h1>';
echo '</div>';
echo '<div class="slogan_block" style="background-color:#f1857e">';
	echo '<h2 id="slogan">O-FISH-al fisherman network</h2>';
echo '</div>';

//Navigation bar, Login currently active
echo '<ul class="navbar">';
	echo '<li><a href="Search.php">SEARCH</a></li>';
	echo '<li><a href="Upload.html">UPLOAD</a></li>';
	echo '<li><a href="Login.php" class="active">LOGIN</a></li>';
	echo '<li><a href="CreateAccount.html">CREATE ACCOUNT</a></li>';
echo '</ul>';

/* 
This block allows our program to access the MySQL database.
Elaborated on in 2.2.3.
 */
require_once 'studentdb.php';
$db_server = mysql_connect($host, $username, $password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($dbname)
	or die("Unable to select database: " . mysql_error());

//Retrieve information of user with given username and password
$query = "SELECT username, first_name, last_name FROM fishermen WHERE username='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "'";
$users = mysql_query($query);

//establish div with login form
echo '<div class="center_div">';
echo '<form action="Login.php" method="post"><pre>';
	echo '<h2>Log In</h2>';
		echo '<p>Username</p>';
		echo '<input type="text" name="username"><br>';
		echo '<p>Password</p>';
		echo '<input type="password" name="password"><br>';
		echo '<br>';
	echo '<button type="submit" value="LOG IN">LOG IN</button><br>';

//display message based on submitted form
display_message($users);

function display_message($users){
	//if the table is empty, the login was invalid and we inform the user
	if (mysql_num_rows($users)<1) {
		echo'<p>Your login was not successful.</p>';
	//else, the table exists and we retrieve the information to show we recognize the user
	}else {
		$row = mysql_fetch_row($users);
		$username=$row[0];
		$first_name=$row[1];
		$last_name=$row[2];
		//makes the welcome statement
		$welcome="<p>Welcome"." ".$first_name." ".$last_name."!<br>You are logged in as ".$username.".</p>";
		echo $welcome;
	}
}
echo '</pre></form>';
echo '</div>';

echo '</body>';
echo '</html>';
?>