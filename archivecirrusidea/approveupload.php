<?php

// Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Approve Upload';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.

  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  
  }
 
 if ($_SESSION['username']!=tjgersho){
    echo '<p class="login">Administrator login needed to access this page.</p>';
    exit();
  
  }


  // Show the navigation menu
  require_once('navmenu.php');
 
 
  if (isset($_GET['id'])) {
    // Grab the score data from the GET
    $id = $_GET['id'];
 }
  else if (isset($_POST['id'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
   
  }
  else {
    echo '<p class="error">Sorry, no upload was specified for approval.</p>';
  }

  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
      // Connect to the database
   
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

      // Approve the score by setting the approved column in the database
      $query = "UPDATE creativebrainpower SET approved = 1 WHERE id = $id";
      mysqli_query($dbc, $query);
      mysqli_close($dbc);

      // Confirm success with the user
      echo '<p>The upload ' . $id . ' was successfully approved.';
    }
    else {
      echo '<p class="error">Sorry, there was a problem approving the comment/upload.</p>';
    }
  }
  else if (isset($id)) {
    echo '<p>Are you sure you want to approve the following comment/upload?</p>';
    echo '<p><strong>Comment/upload ID: </strong>' . $id . '</p>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
	echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
	echo '</form>';
  }

  echo '<p><a href="http://www.cirrusidea.com/admin.php">&lt;&lt; Back to admin page</a></p><br /><br /><br /><br />';

require_once('footer.php');
?>






