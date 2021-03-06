<?php

// Hit counter function.
// Your probably want to remove lines that report errors. If not your website could stop working if, for example, your database is down.

include ('counter_config.php');

function addinfo($page)

{ 
	
// ################################################
// ######### connect + select  database ###########
// ################################################

	global $db_host, $db_username, $db_pass, $db_name, $dbtablehits,$dbtableinfo,$maxrows; 

	$counter_link = mysqli_connect($db_host, $db_username, $db_pass, $db_name);
	
	if (!$counter_link) 
	{
	    die('Could not connect: ' . mysqli_error());  // remove ?
	}	


// ########################################################
// ######### check if counter exsist and update ###########
// ########################################################

	if(mysqli_num_rows(mysqli_query($counter_link,"SELECT page FROM $dbtablehits WHERE page = '$page'")))
	{
	//A counter for this page  already exsists. Now we have to update it.

		$updatecounter = mysqli_query($counter_link,"UPDATE $dbtablehits SET count = count+1 WHERE page = '$page'");
		if (!$updatecounter) 
		{
		die ("Can't update the counter : " . mysqli_error()); // remove ?
		}
	
	} 
	else
	{
	// This page did not exsist in the counter database. A new counter must be created for this page.

		$insert = mysqli_query($counter_link,"INSERT INTO $dbtablehits (page, count)VALUES ('$page', '1')");
	
		if (!$insert) 
		{
    		die ("Can\'t insert into $dbtablehits : " . mysqli_error()); // remove ?
		}
	}
	
// ####################################################
// ######### add IP and user-agent and time ###########
// ####################################################


// gather user data
$ip= $_SERVER["REMOTE_ADDR"]; 
$agent =$_SERVER["HTTP_USER_AGENT"];
$datetime =date("Y/m/d") . ' ' . date('H:i:s') ;


if(!mysqli_num_rows(mysqli_query($counter_link,"SELECT ip_address FROM info WHERE ip_address = '$ip'"))) // check if the IP is in database
{
	// if not , add it.	
	$adddata = mysqli_query($counter_link,"INSERT INTO $dbtableinfo (ip_address, user_agent, datetime) VALUES('$ip' , '$agent','$datetime' ) ") ;
	if (!$adddata) 
	{
	    die('Could not add IP : ' . mysqli_error()); // remove ?
	}
}

// ***************************************************************
// ** delete the first entry in $dbtableinfo if rows > $maxrows **
// ***************************************************************

$result = mysqli_query($counter_link,"SELECT * FROM $dbtableinfo");
$num_rows = mysqli_num_rows($result);
$to_delete = $num_rows- $maxrows;
if($to_delete > 0)
{
	for ($i = 1; $i <= $to_delete; $i++) 
	{

		$delete = mysqli_query($counter_link,"DELETE FROM $dbtableinfo ORDER BY id LIMIT 1") ;
		if (!$delete) 
		{
		    die('Could not delete : ' . mysqli_error()); // remove ?
		}
	}
}	

mysqli_close($counter_link);

} 

?>
