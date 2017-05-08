<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'About Cirrus Idea';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
 ?> 
 <h3>About CirrusIdea:</h3>

<div style="text-align:center;">
<iframe width="640" height="480" src="http://youtu.be/kG_kGGqNS3o" frameborder="0" allowfullscreen></iframe>
</div>



 <?php
 echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
 // Insert the page footer
  require_once('footer.php');
 ?>
