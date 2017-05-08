<?php
  
$root = realpath($_SERVER["DOCUMENT_ROOT"]);  

  // Start the session
  require_once($root.'/startsession.php');

  // Insert the page header
  $page_title = 'Search';
  require_once($root.'/header.php');

  require_once($root.'/appvars.php');
  require_once($root.'/connectvars.php');
 
  if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';

    exit();
  
  }

  // Show the navigation menu
  require_once($root.'/navmenu.php');
 

?>

<table style="position:relative; margin-left:auto; margin-right:auto;"><tr><td>
 
  <h4 style="text-align:center;">CirrusIdea Search</h3>
  <form method="post" action="search.php" style="text-align:center;">
    <label for="usersearch">Find a project: </label>
    <input type="text" id="usersearch" name="usersearch" /><br />
    <input type="submit" name="submit" value="Submit" />
  </form>
 <br /><br />
   <h4 style="text-align:center;">CirrusIdea Folder Search</h3>
  <form method="post" action="searchfolder.php" style="text-align:center;">
    <label for="usersearch">Find a folder: </label>
    <input type="text" id="usersearch" name="usersearch" /><br />
    <input type="submit" name="submit" value="Submit" />
  </form>
  <br /><br />
   <h4 style="text-align:center;">CirrusIdea Member Search</h3>
  <form method="post" action="searchmember.php" style="text-align:center;">
    <label for="usersearch">Find a member: </label>
    <input type="text" id="usersearch" name="usersearch" /><br />
    <input type="submit" name="submit" value="Submit" />
  </form>
 </td></tr></table> 
<br /><br /><br /><br /><br /><br />


 <?php
 
  // Insert the page footer
  require_once($root.'/footer.php');
 ?>
