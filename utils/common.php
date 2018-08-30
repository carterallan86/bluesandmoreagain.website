<?php

// This block grabs Home Page Text
$home_text = "";
$sql_home = mysqli_query($link, "SELECT * FROM manage_style WHERE style_id='1'");
$count = mysqli_num_rows($sql_home); // count the output amount
if ($count > 0) {
	while($row = mysqli_fetch_array($sql_home)){ 
             $home_text = $row["home_text"];
    }
} else {
	$home_text = "You have nothing written";
}







?>

