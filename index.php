<!DOCTYPE HTML>

<?php 

include "utils/connect_db.php"; 
include "utils/common.php"; 

$page = $_SERVER['PHP_SELF'] ;

include ( 'hitcounter/counter.php');
addinfo($page);

?>

<html>
	<head>
		<title>Bluesandmoreagain.com</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>

<body id="top">
	<?php include ("includes/header.html"); ?>	
		<!-- Banner -->
		<section id="banner">
				<div class="inner">
					<h2>This is Bluesandmoreagain</h2>
					<p>Free musical opinions from David Innes</a></p>
					<ul class="actions">
						<li><a href="#content" class="button big special">Latest Reviews</a></li>
						<li><a href="#elements" class="button big alt">Contact Form</a></li>
					</ul>
				</div>
			</section>

	<section id="one" class="wrapper style1">
				<div class="container">
					<p><?= $home_text ?></p>
				</div>
			</section>



	<!-- Two -->
	<section id="two" class="wrapper style2">
				<header class="major">
					<h2></h2>
					<p>Latest reviews from Bluesandmoreagain</p>
				</header>
				
				<div class="container">
					<div class="row">
						<?php
							$query = "SELECT * FROM reviews ORDER BY review_id DESC LIMIT 3";
							if ($result = $link->query($query)) {
							
								foreach($result as $row) { //Here is the magic how it is converted and row is retrieved
									//echo "<pre>"; print_r($row);

									echo "<div class='4u'>
										<section class='special box'>
											<a href='/review.php?rid=".$row["review_id"]."' class='image fit'><img src='imgages/artwork_images/".$row["review_id"].".jpg' alt='' /></a>
											<h3>".$row["title"]."</h3>
											<strong>".$row["artist"]."</strong>
											<p>".$row["summary"]."</p>
										</section>
									</div>";
								}   
									
								$result->free();
							}
						?>
					</div>
				</div>
			</section>
	
  
  <?php include ("includes/footer.php"); ?> 
  
</body>
</html>
