<?php
  // Insert the page header
  $page_title = 'Sign Up Complete';

require_once('startsession.php');
                   
           require_once('appvars.php');
  require_once('connectvars.php');
          // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


 
require_once('header.php');
  require_once('appvars.php');
  require_once('connectvars.php');

    
  echo '</div>';

        // Confirm success with the user
        echo '<div id="fillcontent">';
        echo '<p>Thanks for joining';
    ?>    
        <span class="hotspot" onmouseover="tooltip.show('Thanks for Signing Up! Take the CirrusIdea tour.  First click on the Terms and Conditions link Below.');" onmouseout="tooltip.hide();">
        <i>CirrusIdea</i>!</span><br />
    <?php    
		echo 'Please see the <a href="termsandconditions.php">Terms and Conditions</a> page, by uploading anything at all you agree to these terms.</p>';
		echo '<br /><br /><br /><br /><br /><br />';


    
	 // Insert the page footer
  require_once('footer.php');
                

?>
