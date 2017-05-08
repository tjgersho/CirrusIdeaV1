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
 <h2>About CirrusIdea.com Animation:</h2>
<h3>This animation summarizes what CirrusIdea.com can do.</h3>

<div style="text-align:center;">

<a class="buttonlink" style="display: inline-block;" href="aboutanimation.php">
Animation
</a>

</div>
<!--
<h2>About CirrusIdea.com Video:</h2>
<h3>This video summarizes what CirrusIdea.com is all about.</h3>


<div style="text-align:center;">

<a class="buttonlink" style="display: inline-block;" href="aboutvideo.php">
Video
</a>

</div>
-->

<!--<h2>Edit your user profile:</h2>
<h3>This video shows you how to edit your user info.</h3>
<div style="text-align:center;">
<a class="buttonlink" style="display: inline-block;" href="editprofilevideo.php">
Video
</a>
</div>

-->

 
 <?php
 echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
 // Insert the page footer
  require_once('footer.php');
 ?>