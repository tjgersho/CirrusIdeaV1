<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Privacy Policy';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
 ?>
 <h3>Privacy Policy</h3>
  <p>Here at CirrusIdea we respect your privacy. Any and all information collected on this 
 site will be kept strictly confidential and will not be sold, disclosed to third parties or reused
 without your permission. Any information you give to us will be held with care and will not be used
 in ways that you have not consented to.</p>
 <?php
 echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
 // Insert the page footer
  require_once('footer.php');
 ?>