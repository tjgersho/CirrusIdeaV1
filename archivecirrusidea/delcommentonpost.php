<?php
  // Start the session
  require_once('startsession.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu

 
   if (!isset($_SESSION['user_id'])) {
    exit();
  }

   
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  $post_id = mysqli_real_escape_string($dbc, trim($_POST['del_post_id']));
  
 
  $query = "DELETE FROM postcomments WHERE postcomment_id =  '" . $post_id . "'";
    
	mysqli_query($dbc, $query);
	
  
  ?>