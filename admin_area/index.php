<?php 
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
// Be sure to check that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "../utils/connect_db.php"; 
$sql = mysqli_query($link,"SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "Your login session data is not on record in the database.";
     exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Admin Area</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="main">
			<?php include ("includes/header.html"); ?>
		
		<div id="site_content">
				
			<div id="content">
				<div align="left" style="margin-left:24px;">
					<h2>Hello user, what would you like to do today?</h2>
					<p><a href="edit_home.php">Edit Home Page Text</a><br />
					<p><a href="review_list.php">Manage Reviews</a><br />
					<p><a href="hitcounter.php">View Hit Counter</a><br />
				</div>
			</div><!--close content--> 

	</div><!--close site_content--> 
 
  </div><!--close main-->

     <?php include ("includes/footer.html"); ?> 
  
</body>
</html>