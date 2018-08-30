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
// Delete Item Question to Admin, and Delete Product if they choose
if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete review with ID of ' . $_GET['deleteid'] . '? <a href="review_list.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="review_list.php">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	// delete from database
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysqli_query($link,"DELETE FROM reviews WHERE review_id='$id_to_delete' LIMIT 1") or die (mysqli_error());
	// unlink the image from server
	// Remove The Pic -------------------------------------------
    $pictodelete = ("../images/artwork_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: review_list.php"); 
    exit();
}
?>


<?php 
// Parse the form data and add review item to the system
if (isset($_POST['artist'])) {
	
    
    $value1 = mysqli_real_escape_string($link,$_POST['artist']);
	$value2 = mysqli_real_escape_string($link,$_POST['titlea']);
	$value3 = mysqli_real_escape_string($link,$_POST['label']);
	$value4 = mysqli_real_escape_string($link,$_POST['summary']);
	$value5 = mysqli_real_escape_string($link,$_POST['web1']);
	$value6 = mysqli_real_escape_string($link,$_POST['web2']);
	$value7 = mysqli_real_escape_string($link,$_POST['web3']);
	$value8 = mysqli_real_escape_string($link,$_POST['review']);
	$value9 = mysqli_real_escape_string($link,$_POST['category']);
    

	// Add this product into the database now
	$sql = mysqli_query($link,"INSERT INTO reviews (artist, title, label, summary, web1, web2, web3, review, category, date_added) 
			VALUES ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7', '$value8', '$value9',now())") or die (mysqli_error());
     $rid = mysqli_insert_id();
     
	// Place image in the folder 
	$newname = "$rid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../images/artwork_images/$newname");
	header("location: review_list.php"); 
    exit();
}
?>



<?php 
// This block grabs the whole list for viewing
$review_list = "";
$sql = mysqli_query($link,"SELECT * FROM reviews ORDER BY review_id DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){ 
             $id = $row["review_id"];
			 $artist = $row["artist"];
			 $title = $row["title"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $review_list .= "Review ID: $id - <strong>$artist</strong> - $title - <em>Added $date_added</em> &nbsp; &nbsp; &nbsp; <a href='review_edit.php?rid=$id'>edit</a> &bull; <a href='review_list.php?deleteid=$id'>delete</a><br />";
    }
} else {
	$review_list = "You have no products listed in your store yet";
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script src="../ckeditor/ckeditor.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Review List</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
			<div id="main">
			<?php include ("includes/header.html"); ?>
	
			<div id="site_content">
					
					
						<div align="right" style="margin-right:32px;">
							<a href="review_list.php#reviewForm">+ Add New Review Item</a>
						</div>
						
						<div align="left" style="margin-left:24px;">
							<h2>Review list</h2>
							<?php echo $review_list; ?>
							</br>
							</br>
						</div>
					
    <hr />
    <a name="reviewForm" id="reviewForm"></a>
    <h3>
    &darr; Add New Review Item Form &darr;
    </h3>
    <form action="review_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
		
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">Artist</td>
        <td width="80%"><label>
          <input name="artist" type="text" id="artist" size="25" />
        </label></td>
      </tr>
     
      <tr>
        <td width="20%" align="right">Title</td>
        <td><label>
		<input name="titlea" type="text" id="titlea" size="25" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Label</td>
        <td><label>
		<input name="label" type="text" id="label" size="25" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Summary</td>
        <td><label>
			<textarea class="ckeditor" cols="80" id="summary" name="summary" rows="5"></textarea>
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Web Address #1</td>
        <td><label>
          <input name="web1" type="text" id="web1" size="25" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Web Address #2</td>
        <td><label>
          <input name="web2" type="text" id="web2" size="25" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Web Address #3</td><br>
        <td><label>
          <input name="web3" type="text" id="web3" size="25" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Review</td>
        <td>
			<textarea class="ckeditor" cols="80" id="review" name="review" rows="10"></textarea>
		</td>
        
      </tr>
      <tr>
        <td width="20%" align="right">Category</td>
        <td><label>
          <select name="category" id="category">
          <option value="Album">Album</option>
          <option value="Live">Live</option>
          <option value="Book">Book</option>
          <option value="Book">Interview</option>
          <option value="Book">Vintage</option>
          <option value="Other">Other</option>
          </select>
        </label></td>
      </tr>

      <tr>
        <td width="20%" align="right">Review Artwork</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Add This Item Now" />
        </label></td>
      </tr>
    </table>
    </form>
    <br />
    <a href="#" onclick="history.back();return false">Go Back To The Previous Page</a>
  <br />
  </div>
</div>
</body>
</html>
