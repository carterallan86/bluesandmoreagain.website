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

//Generating Review index list
$sort = "";
        if(isset($_GET['sort'])) {
            switch ($_GET['sort'] ) {
            case 0: 
                        $sort = " ORDER BY artist"; 
                        break;
            case 1:
                        $sort = ' ORDER BY title';
                        break;
            case 2:
                        $sort = ' ORDER BY label DESC';
                        break;
            case 3:
                        $sort = ' ORDER BY category';
                        break; 
            case 4:
                        $sort = ' ORDER BY date_added DESC';
                        break;            
            }
        }
// This block grabs the whole list for viewing
$review_list = "";
$sql = mysqli_query($link,"SELECT * FROM reviews". $sort);
$reviewCount = mysqli_num_rows($sql); // count the output amount
if ($reviewCount > 0) {
	while($row = mysqli_fetch_array($sql)){ 
             $review_id = $row["review_id"];
			 $artist = $row["artist"];
			 $title = $row["title"];
			 $label = $row["label"];
			 $category = $row["category"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $review_list .= " 
				<tr>
                <td>$artist</td>
                <td>$title</td>
                <td>$label</td>
                <td>$category</td>
                <td>$date_added</td>
                <td><a href='review.php?rid=$review_id' >Go To Review</a></td>
				</tr>
			 ";
    }
} else {
	$review_list = "You have no recent reviews added";
}


//Query for review list on reviews album tab
$reviews_q="SELECT * FROM reviews ORDER BY review_id DESC;";
$reviews_r=mysqli_query($link,$reviews_q) or die ("Query to get data from reviews failed: ".mysqli_error());
$reviews = array();
$y = 0;
while ($row = mysqli_fetch_assoc($reviews_r)) {
    foreach ($row as $k => $v) {
        $reviews[$y][$k] = $v;
    }
    $y++;
} 





?>

