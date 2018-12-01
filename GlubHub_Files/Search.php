<?php
// Uses html to set up layout of website

echo '<html>';
echo '<head>';
	
	echo '<title>GlubHub - Search</title>';

//links to css stylesheet and javascript
echo '<link rel="stylesheet" type="text/css" href="GlubHub_Stylesheet.css">';
echo '<script src="Slogans.js"></script>';

echo '</head>';

//when website loads, load the slogan
echo '<body onload="slogans()">';

//sets up div for title block
echo '<div class="title_block">';
echo '<img src="http://www.megaicons.net/static/img/icons_sizes/8/178/256/animals-fish-icon.png"/>';
echo '<h1>Glub<span style="color:#e33809">Hub</span></h1>';
echo '</div>';
echo '<div class="slogan_block" style="background-color:#f1857e">';
	echo '<h2 id="slogan">O-FISH-al fisherman network</h2>';
echo '</div>';

//sets up div for tabs
echo '<ul class="navbar">';
	echo '<li><a href="Search.php" class="active">SEARCH</a></li>';
	echo '<li><a href="Upload.html">UPLOAD</a></li>';
	echo '<li><a href="Login.html">LOGIN</a></li>';
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

//Retrieve all necessary information in a query
$query = "SELECT fish_image, first_name, last_name, username, contact_info, color, length, weight, location, common_name 
FROM images NATURAL JOIN fishes NATURAL JOIN fishermen WHERE first_name='" . $_POST['firstname'] . "' OR last_name='" . $_POST['lastname'] . "'
OR username='" . $_POST['username'] . "' OR color='" . $_POST['color'] . "' OR location='" . $_POST['location'] . "'
OR common_name='" . $_POST['commonname'] . "'";

//creates a variable to reference the mySQL table from the previous block
$image_info_table = mysql_query($query);

//creates the search forms
echo '<div class="search_form">'; //references the div style from css
echo '<form action="Search.php" method="post"><pre>';
	echo '<h2>Fish</h2>';
		echo '<p>Weight</p><br>';
			echo'<select name="weight">'; //search dropdown menu for weight with weight ranges
			  echo '<option value="" selected>All</option>';
			  echo '<option value="<2">Less than 2 lb.</option>';
			  echo '<option value="2-10">2-10 lb.</option>';
			  echo '<option value="11-20">10-20 lb.</option>';
			  echo '<option value="21-50">20-50 lb.</option>';
			  echo '<option value="51-100">50-100 lb.</option>';
			  echo '<option value=">100">Greater than 100 lb.</option>';
			echo '</select><br>';
		echo '<p>Length</p><br>';
			echo '<select name="">'; //search dropdown menu for length with length ranges
			  echo '<option value="" selected>All</option>';
			  echo '<option value="<5">Less than 5 in.</option>';
			  echo '<option value="5-30">5-30 in.</option>';
			  echo '<option value="31-100">31-100 in.</option>';
			  echo '<option value="101-300">101-300 in.</option>';
			  echo '<option value=">300">Greater than 300 in.</option>';
			echo '</select><br>';
		echo '<p>Common Name</p><br>';
		echo '<input type="text" name="commonname"><br>';
		echo '<p>Location</p><br>';
			echo '<select name="location">'; //search dropdown menu with options for counties in NJ
			echo '<option value="" selected>All</option>';
			  echo '<option value="bergen" >Bergen County, NJ</option>';
			  echo '<option value="essex">Essex County, NJ</option>';
			  echo '<option value="middlesex">Middlesex, NJ</option>';
			  echo '<option value="monmouth">Monmouth, NJ</option>';
			  echo '<option value="hudson">Hudson County, NJ</option>';
			  echo '<option value="ocean">Ocean County, NJ</option>';
			  echo '<option value="union">Union County, NJ</option>';
			  echo '<option value="camden">Camden County, NJ</option>';
			  echo '<option value="passaic">Passaic County, NJ</option>';
			  echo '<option value="morris">Morris County, NJ</option>';
			  echo '<option value="burlington">Burlington County, NJ</option>';
			  echo '<option value="mercer">Mercer County, NJ</option>';
			  echo '<option value="somerset">Somerset County, NJ</option>';
			  echo '<option value="gloucester">Gloucester County, NJ</option>';
			  echo '<option value="atlantic">Atlantic County, NJ</option>';
			  echo '<option value="sussex">Sussex County, NJ</option>';
			  echo '<option value="cumberland">Cumberland County, NJ</option>';
			  echo '<option value="hunterdon">Hunterdon County, NJ</option>';
			  echo '<option value="warren">Warren County, NJ</option>';
			  echo '<option value="cape may">Cape May County, NJ</option>';
			  echo '<option value="salem">Salem County, NJ</option>';
			  echo '<option value="gulf of mexico">Gulf of Mexico</option>';
			echo '</select><br>';
		echo '<p>Color</p><br>';
			echo '<select name="color">';  //search dropdown menu for colors
			echo '<option value="" selected>All</option>';
			  echo '<option value="red">Red</option>';
			  echo '<option value="orange">Orange</option>';
			  echo '<option value="yellow">Yellow</option>';
			  echo '<option value="green">Green</option>';
			  echo '<option value="blue">Blue</option>';
			  echo '<option value="purple">Purple</option>';
			  echo '<option value="pink">Pink</option>';
			  echo '<option value="black">Black</option>';
			  echo '<option value="brown">Brown</option>';
			  echo '<option value="grey">Grey</option>';
			  echo '<option value="white">White</option>';
			  echo '<option value="silver">Silver</option>';
			  echo '<option value="gold">Gold</option>';
			echo '</select><br>';
	echo '<h2>Fishermen</h2>'; 
		echo '<p>Username</p><br>';  //search for username, first name, and last name
		echo '<input type="text" name="username"><br>';
		echo '<p>First Name</p><br>';
		echo '<input type="text" name="firstname"><br>';
		echo '<p>Last Name</p><br>';
		echo '<input type="text" name="lastname"><br>';
		echo '<br>';
	echo '<button type="submit" value="SEARCH">SEARCH</button>';
echo '</pre></form>';
echo '</div>';
echo '<div class="results">';
	echo '<h2>Results</h2>';

// Call a function defined later in this file on table
display_table($image_info_table);
function display_table($image_info_table)
{	echo "<TABLE style='float:center'>";
	$closed_tr = 0; // flag, used to determine if we are at the end of a row when the loop terminates

	if (mysql_num_rows($image_info_table)>0)
	{
		// Iterate through all of the returned images, placing them in a table for easy viewing
		for ($count = 0; $count < mysql_num_rows($image_info_table); $count++)
		{
			// The following few lines store information from specific cells in the data about an image
			$image_row = mysql_fetch_row($image_info_table); // Advances a row each time it is called
			$image_name = $image_row[0];
			$first_name = $image_row[1];
			$last_name = $image_row[2];
			$username = $image_row[3];
			$contact_info = $image_row[4];
			$color = $image_row[5];
			$length = $image_row[6];
			$weight = $image_row[7];
			$location = $image_row[8];
			$common_name = $image_row[9];

			// Remember the mod operator, this one gives us the remainder when $count is divided by 6
			if ($count % 2 == 0)
			{
				echo "<TR>";
				$closed_tr = 0;
			}

			$domain = $_SERVER['SERVER_NAME'];

			//displays all the information about each fish found in the search
			echo "<TD><img src='http://$domain//~hanasm6s/aprilla/$image_name'/>";
			echo "<p id='info'>";
			echo "Fisherman: $first_name $last_name ($username)";
			echo "<br/>Contact: $contact_info";
			echo "<br/>Common Name: $common_name<br/>Location: $location<br/>Length: $length in.<br/>Weight: $weight lbs.<br/>Color: $color";
			echo "</p></TD>";
			
			//creates grid of images
			if ($count % 2 == 1)
			{
				echo "</TR>";
				$closed_tr = 1;
			}
		}
	}
	//if no results are found in search, provide feedback to user
	else {
		echo "<p> No results found </p>";
	}

	if ($closed_tr == 0) echo "</TR>"; // Appends a close tag for the TR element if the loop did not terminate at a row end.
	echo "</TABLE>";
}

echo '</div>';
echo '</body>';
echo '</html>';
?>