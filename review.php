
<?php
//Include files
include "utils/connect_db.php"; 
include "utils/common.php"; 
include ("includes/header.php"); 

	//Grabs the individual review for review.php
	if (isset($_GET['rid'])) {
	$targetID = $_GET['rid'];		
    $sql = mysqli_query($link,"SELECT * FROM reviews WHERE review_id='$targetID' LIMIT 1");
    $reviewCount = mysqli_num_rows($sql); // count the output amount
    if ($reviewCount > 0) {
	    while($row = mysqli_fetch_array($sql)){ 
             $review_id = $row["review_id"];
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
	    echo "You have no reviews written yet";
		exit();
    }
}

//Hit Counter
$page = "review.php?rid=$targetID";
include ( 'hitcounter/counter.php');
addinfo($page);
			
	
?>





<body>
  <div id="main">

	<div id="site_content">
        
	  <div id="content">
        <div class="content_item">
          <h2><?php echo "<i>".$title."</i><br>";?></h2>
		</div><!--close content_item-->
	  
	  <?php echo "<img ALIGN='left' style='padding-right:30px' src='images/artwork_images/".$review_id.".jpg',' width='300' height='300' alt='content image' />";?>
	  
	  
	  <p style="position:relative; left:0px;">
		  
			  <?php echo "<b>".$artist."</b><br>";?>
			  <?php echo "<i>".$title."</i><br>";?>
			  <?php echo "".$label."<br>";?>
			  <?php echo "".$review."";?>
			  <br><br><a href="http://<?php echo "".$web1."";?>"><?php echo "".$web1."";?></a><br>
			  <a href="http://<?php echo "".$web2."";?>"><?php echo "".$web2."";?></a><br>
			  <a href="http://<?php echo "".$web3."";?>"><?php echo "".$web3."";?></a><br>
			  <?php echo "Date added:  ".$date_added."";?>
			  </p><br>
			  <?php echo "<a href='https://www.facebook.com/sharer/sharer.php?u=http://www.bluesandmoreagain.com/review.php?rid=".$targetID."' target='_blank'>Share on Facebook</a>";?>
			  		  
			  <br><br><br><a href="#" onclick="history.back();return false">Go Back To The Previous Page</a>
			</div> 
			  
			 
	
				
	  
	  
      </div><!--close content-->

	  
	</div><!--close site_content--> 
 
  </div><!--close main-->
  
     <?php include ("includes/footer.php"); ?> 
  
</body>
</html>
