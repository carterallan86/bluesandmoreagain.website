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
	
	$rid = mysqli_real_escape_string($link,$_POST['thisID']);
  $value1 = mysqli_real_escape_string($link,$_POST['artist']);
	$value2 = mysqli_real_escape_string($link,$_POST['titlea']);
	$value3 = mysqli_real_escape_string($link,$_POST['label']);
	$value4 = mysqli_real_escape_string($link,$_POST['summary']);
	$value5 = mysqli_real_escape_string($link,$_POST['web1']);
	$value6 = mysqli_real_escape_string($link,$_POST['web2']);
	$value7 = mysqli_real_escape_string($link,$_POST['web3']);
	$value8 = mysqli_real_escape_string($link,$_POST['review']);
	$value9 = mysqli_real_escape_string($link,$_POST['category']);
	
	// See if that product name is an identical match to another product in the system
	$sql_post = mysqli_query($link,"UPDATE reviews SET artist='$value1', title='$value2', label='$value3', summary='$value4', web1='$value5', web2='$value6', web3='$value7', review='$value8', category='$value9' WHERE review_id='$rid'") or die (mysqli_error());
  
  if (mysqli_query($link,$sql_post)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($link); }  mysqli_close($link);


	if ($_FILES['fileField']['tmp_name'] != "") {
	    // Place image in the folder 
	    $newname = "$rid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../images/artwork_images/$newname");
	}
	header("location: review_edit.php?rid=".$rid.""); 
    exit();
}
?>

<?php 
// This block grabs the whole list for viewing
$review_list = "";
$sql_display = mysqli_query($link,"SELECT * FROM reviews ORDER BY review_id DESC");
$productCount = mysqli_num_rows($sql_display); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql_display)){ 
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

<?php 
// Gather this product's full information for inserting automatically into the edit form below on page
if (isset($_GET['rid'])) {
	$targetID = $_GET['rid'];
    $sql = mysqli_query($link,"SELECT * FROM reviews WHERE review_id='$targetID' LIMIT 1");
    $productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysqli_fetch_array($sql)){ 
             $id = $row["review_id"];
			 $artist = $row["artist"];
			 $title = $row["title"];
			 $label = $row["label"];
			 $summary = $row["summary"];
			 $web1 = $row["web1"];
			 $web2 = $row["web2"];
			 $web3 = $row["web3"];
			 $review = $row["review"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 }
    } else {
	    echo "You have no products listed in your store yet";
		exit();
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../ckeditor/ckeditor.js"></script>
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
    &darr; Edit Review Item Form &darr;
    </h3>
    <form action="review_edit.php?rid=<?php echo $targetID; ?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">Artist</td>
        <td width="80%"><label>
          <input name="artist" type="text" id="artist" size="64" value="<?php echo $artist; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Title</td>
        <td><label>
          <input name="titlea" type="text" id="titlea" size="12" value="<?php echo $title; ?>" />
        </label></td>
      </tr>
      <td align="right">Label</td>
        <td><label>
          <input name="label" type="text" id="label" size="12"value="<?php echo $label; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Summary</td>
        <td><label>
			<textarea class="ckeditor" cols="80" id="summary" name="summary" rows="5"><?php echo $summary; ?></textarea>
        </label></td>
      </tr>
      <tr>
        <td align="right">Web Address #1</td>
        <td><label>
          <input name="web1" type="text" id="web1" size="12" value="<?php echo $web1; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Web Address #2</td>
        <td><label>
          <input name="web2" type="text" id="web2" size="12" value="<?php echo $web2; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Web Address #3</td>
        <td><label>
          <input name="web3" type="text" id="web3" size="12" value="<?php echo $web3; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Review</td>
        <td><label>
			<textarea class="ckeditor" cols="80" id="review" name="review" rows="5"><?php echo $review; ?></textarea>
        </label></td>
      </tr>
      <tr>
      <tr>
        <td align="right">Category</td>
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
        <td align="right">Review Artwork</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="button" id="button" value="Update" />
        </label></td>
      </tr>
    </table>
    </form>
    <br />
    <a href="review_list.php">Go Back To The Reviews List</a>
  <br />
  </div>
</div>
</body>
</html>
