<?php 
include "utils/connect_db.php"; 
include "utils/common.php"; 

$page = $_SERVER['PHP_SELF'] ;

include ( 'hitcounter/counter.php');
addinfo($page);
include ("includes/header.php"); 



	
?>


<body>
  <div id="main">
	
 
    
	<div id="site_content">
	
	<div id="welcome">
	      <h2><a href="#">Album Reviews</a></h2>
	    </div><!--close welcome-->
		
 
        
	  <div id="content">
        <div class="content_item">
          <p>The reason this site exists. We built this city on rock n roll and all that.<br>
			<br>This is the place for reviews of CDs mainly, but books about rock n roll and, of course, live gigs may feature here too.<br><br>
			Albums reviewed here.</p>
			
		</div><!--close content_item-->
		</div><!--close content-->
		  
	<div id="reviews">
		 	<div class="review_list">
		      
			  <?php
			  foreach ($reviews as $member) { 
			  foreach ($member as $k => $v) {
			  echo "<div class='review_list'>";
			  echo "<img ALIGN='Left' style='padding-right:30px' src='images/artwork_images/".$member['review_id'].".jpg',' width='300' height='300' alt='content image' />";
			  echo "<p style='position:relative; left:0px;'><b>".$member['artist']."</b>";
			  echo "<span style='float:right;'><b>".$member['date_added']."</b></span><br>";
			  echo "<i>".$member['title']."</i><br>";
			  echo $member['label'];
			  echo "<br><br>".$member['summary']."<br>";
			  echo "<br><a href='review.php?rid=".$member['review_id']."' class='readmore'>Read more</a>";
			  echo "</p>";
			 
			  echo "</div>";
			  break;
			  
		      }
			  }
				?>
			 </div>
			  
			  
			  
			  </div>
			  
		
      
	  
	</div><!--close site_content--> 
 
  </div><!--close main-->
  
     <?php include ("includes/footer.php"); ?> 
  
</body>
</html>
