<?php
//Include files
include "utils/connect_db.php"; 
include "utils/common.php"; 
include ("includes/header.php"); 

//Hit Counter
$page = $_SERVER['PHP_SELF'] ;
include ( 'hitcounter/counter.php');
addinfo($page);

?>



<body>
  <div id="main">
    

    
    <div id="site_content">

      <div id="content">
        <div class="content_item">
            <div class="form_settings">
              <h2>Contact Us</h2>        
              <form name="contactform" method="post" action="utils/send_form_email.php">
                <table width="450px">
                  <tr>
                    <td valign="top"><label for="first_name">First Name *</label></td>
                    <td valign="top"><input  type="text" name="first_name" maxlength="50" size="30"></td>
                  </tr>
                  <tr>
                    <td valign="top"><label for="last_name">Last Name *</label></td>
                    <td valign="top"><input  type="text" name="last_name" maxlength="50" size="30"></td>
                  </tr>
                  <tr>
                    <td valign="top"><label for="email">Email Address *</label></td>
                    <td valign="top"><input  type="text" name="email" maxlength="80" size="30"></td>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                    <td valign="top"><label for="comments">Comments *</label></td>
                    <td valign="top"><textarea  name="comments" maxlength="2000" cols="25" rows="6"></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="text-align:center"><input type="submit" value="Submit"></td>
                  </tr>
                </table>
              </form>         
          </div><!--close form_settings-->
        </div><!--close content_item-->
      </div><!--close content-->

    </div><!--close site_content--> 

  </div><!--close main-->
    
  <?php include ("includes/footer.php"); ?>  	
  
</body>
</html>
