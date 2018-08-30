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
	  
      <div id="content">
        <div class="content_item">
          <h1>Index of uploaded review.. sort however you like</h1> 
          <p />Sort by...
			<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=0";?>">Artist</a>
			<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=1";?>">Title</a>
			<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=2";?>">Label</a>
			<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=3";?>">Category</a>
			<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=4";?>">Date</a>
          <table width="1000" align="center" border='1'>
            <tr>
                <th>Artist</th>
                <th>Title</th>
                <th>Label</th>
                <th>Category</th>
                <th>Date Added</th>
                <th>Quick Link</th>
             </tr>
             <?php echo $review_list; ?> 
            </table>   
	    </div><!--close content_item-->
      </div><!--close content-->
	  
	</div><!--close site_content--> 	
 
  </div><!--close main-->
  
     <?php include ("includes/footer.php"); ?> 
  
</body>
</html>
