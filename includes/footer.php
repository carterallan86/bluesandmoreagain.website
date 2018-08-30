<?php
  
include "utils/connect_db.php";

$ip_result=mysqli_query($link,"SELECT MAX(id) FROM info");
while ($row = mysqli_fetch_array($ip_result, MYSQLI_NUM)) 
{
$totalips = $row[0] ;  
}


// Convert number to word.  like 1 to 1st
function ordinal_suffix($totalips){
    $totalips = $totalips % 100; // protect against large numbers
    if($totalips < 11 || $totalips > 13){
         switch($totalips % 10){
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}
?>



<!-- Footer -->
    <footer id="footer">
        <div class="container">
            <div class="row double">
                <h3>BLUESANDMOREAGAIN by David Innes - You are the <?php echo $totalips, ordinal_suffix($totalips) ?> visitor to bluesandmoreagain.com.</h3>
            </div>
            <ul class="copyright">
                <li>&copy; Bluesandmoreagain. All rights reserved.</li>
                <li>Design: <a href="http://templated.co">TEMPLATED</a></li>
            </ul>
        </div>
    </footer>
  
