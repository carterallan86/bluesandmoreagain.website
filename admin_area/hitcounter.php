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

<?php
$query = "SELECT SUM(count)  AS totalhits FROM hits"; 
	 
	$result = mysqli_query($link,$query) or die(mysqli_error());

	
	while($row = mysqli_fetch_array($result))
	{
		$totalhits = $row['totalhits']  ;
	}
	
	
$result=mysqli_query($link,"SELECT MAX(id) FROM info");
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) 
{
$totalips = $row[0] ;  
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hit Viewer</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="main">
			<?php include ("includes/header.html"); ?>
		
		<div id="site_content">
				
			<div id="content">
				
					<?php
	
					echo '<h3>Hits</h3>' ;

					$result = mysqli_query($link,"SELECT * FROM " . $dbtablehits . " ORDER BY count DESC");
	
					echo "<table width='100%' border='0'>";
					echo '	<tr>
						<td height="2" bgcolor="#1AC414" width="400">Page</td> 
						<td height="2" bgcolor="#1AC414" width="169"> Hits</td>
						</tr>' ;

					// keeps getting the next row until there are no more to get
					while($row = mysqli_fetch_array( $result )) 
					{
					// Print out the contents of each row into a table
					echo '<tr><td bgcolor="#75D169">'; 
					echo $row['page'];
					echo '</td><td bgcolor="#75D169">'; 
					echo $row['count'];
					echo '</td></tr>'; 	
					} 
					echo "<tr><td bgcolor=\"#1AC414\"> <strong> Total Hits </strong> </td><td bgcolor=\"#1AC414\"> <strong> $totalhits </strong> </td></tr>" ;
					echo "</table><br /> ";
					
					echo '<h3> Visitors </h3>' ;

				$result = mysqli_query($link,"SELECT * FROM $dbtableinfo ORDER BY id DESC") 
				or die(mysqli_error());  

				echo "<table width='100%' border='0'>";
				echo '<tr> <td width="200" bgcolor="#1AC414">  IP </td> <td height="2" bgcolor="#1AC414" width="400">User agent</td> <td height="2" bgcolor="#1AC414" width="169"> Date &amp; Time</td></tr>';

				// keeps getting the next row until there are no more to get
				while($row = mysqli_fetch_array( $result )) 
				{
					// Print out the contents of each row into a table
					echo '<tr><td bgcolor="#75D169">'; 
					echo $row['ip_address'];
					echo '</td><td bgcolor="#75D169">'; 
					echo $row['user_agent'];
					echo '</td><td bgcolor="#75D169">'; 
					echo $row['datetime'];
					echo "</td></tr>"; 		
				} 
					echo "<tr><td bgcolor=\"#1AC414\"> <strong> Total unique IP´s </strong> </td><td bgcolor=\"#1AC414\"> <strong> $totalips </strong> </td></tr>" ;
					echo "</table><br /> ";
				?>
					
				    <a href="#" onclick="history.back();return false">Go Back To The Previous Page</a>
			</div><!--close content--> 

	</div><!--close site_content--> 
 
  </div><!--close main-->

     <?php include ("includes/footer.html"); ?> 
  
</body>
</html>
