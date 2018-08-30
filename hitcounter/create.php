<?php

//############################################################################
//##### run this file to create the tables needed for the counter to work #### 
//############################################################################

 include ('counter_config.php');


 $counter_link = mysqli_connect($db_host, $db_username, $db_pass, $db_name);
 
 if (!$counter_link) 
 {
     die('Could not connect: ' . mysqli_error());  // remove ?
 }	




$create1 = mysqli_query($counter_link,"CREATE TABLE IF NOT EXISTS $dbtableinfo(id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), ip_address VARCHAR(30), user_agent VARCHAR(50), datetime VARCHAR(25))");
if (!$create1) 
{
    die("Could create table $dbtableinfo :" . mysqli_error());
}

echo "- Table $dbtableinfo created.<br />";

$create2 = mysqli_query($counter_link, "CREATE TABLE IF NOT EXISTS $dbtablehits(page char(100),PRIMARY KEY(page),count int(15))");
if (!$create2) 
{
    die("Could create table $dbtablehits :" . mysqli_error());
} 

echo "- Table $dbtablehits created<br/>";


mysqli_close($counter_link);

echo '- You are now ready to start using the statscounter.';

?>

