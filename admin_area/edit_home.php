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
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Parse the form data and add review item to the system
if (isset($_POST['button'])) {
	
    $value1 = mysqli_real_escape_string($link,$_POST['home_text']);
	// See if that product name is an identical match to another product in the system
    $sql_post = "UPDATE manage_style SET home_text='$value1' WHERE style_id='1'";
    
    if (mysqli_query($link,$sql_post)) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . mysqli_error($link); }  mysqli_close($link);
			
	if ($_FILES['fileField1']['tmp_name'] != "") {
	    // Place image in the folder 
	    move_uploaded_file($_FILES['fileField1']['tmp_name'], "../style/background.jpg");
	}
	
		if ($_FILES['fileField2']['tmp_name'] != "") {
	    // Place image in the folder 
	    move_uploaded_file($_FILES['fileField2']['tmp_name'], "../style/header.jpg");
	}
	
	
	header("location: edit_home.php"); 
    exit();
}
?>
<?php 
// Gather this product's full information for inserting automatically into the edit form below on page

    $sql_display = mysqli_query($link,"SELECT * FROM manage_style WHERE style_id='1' LIMIT 1");
    if (!empty($sql_display)) {
	    while($row = mysqli_fetch_array($sql_display)){ 
             $home_text = $row["home_text"];
			 }
    } else {
	    echo "You have not written anything yet";
		exit();
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../ckeditor/ckeditor.js"></script>
<title>Edit Home Page</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
		<div id="main">
			<?php include ("includes/header.html"); ?>
	
			<div id="site_content">
					
					
						<div align="right" style="margin-right:32px;">
							<a href="review_list.php#reviewForm">+ Add New Review Item</a>
						</div>
											
    <hr />
    <a name="reviewForm" id="reviewForm"></a>
    <h3>
    &darr; Edit Review Item Form &darr;
    </h3>
    <form action="edit_home.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td align="right">Home Page Text</td>
        <td><label>
			<textarea class="ckeditor" cols="80" id="home_text" name="home_text" rows="5"><?php echo $home_text; ?></textarea>
        </label></td>
      </tr>
      <tr>
        <td align="right">Backgound Image</td>
        <td><label>
          <input type="file" name="fileField1" id="fileField1" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Header Image (should be 460 x 1200)</td>
        <td><label>
          <input type="file" name="fileField2" id="fileField2" />
        </label></td>
      </tr>         
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Update" />
        </label></td>
      </tr>
    </table>
    </form>
    <br />
    <a href="index.php">Go Back To The Reviews List</a>
  <br />
  </div>
</div>
</body>
</html>
