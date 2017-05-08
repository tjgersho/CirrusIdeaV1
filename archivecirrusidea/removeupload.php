<?php
// Start the session
  require_once('startsession.php');
 
 $root = realpath($_SERVER["DOCUMENT_ROOT"]);  

  // Insert the page header
  $page_title = 'Admin Remove Upload';
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
    echo '<p class="error">Sorry, no file was specified for removal.</p>';  
  }
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);  

  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
      // Delete the screen shot image file from the server
      // Connect to the database
      
	  
	 $query = "SELECT * FROM creativebrainpower WHERE id =  $id LIMIT 1";
     $data = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);
	$file_dir = $row['file_id'];
	
	if ($row['filename']!=NULL){
	
	unlink($root. $row['file_id'] . '/' . $row['filename']);
	
	}

 

      // Delete the data from the database
      $query1 = "DELETE FROM creativebrainpower WHERE id = $id LIMIT 1";
      mysqli_query($dbc, $query1);

    	 
	  $query2 = "DELETE FROM uploadprivacy WHERE upload_id = '". $id . "'";
        mysqli_query($dbc, $query2);
        
        


      mysqli_close($dbc);
	 

      // Confirm success with the user
      echo '<p>The uploaded comment/file ' . $id . ' was successfully removed.';
	 echo '<br /><p><a href="http://www.cirrusidea.com'. $file_dir . '">&lt;&lt; Back to Project Folder.</a></p>';
	 
    }
    else {
	 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	  
	 $query = "SELECT * FROM creativebrainpower WHERE id =  $id LIMIT 1";
     $data = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);
	 $file_dir = $row['file_id'];
      echo '<p class="error">The comment/file was not removed.</p>';
	 echo '<br /><p><a href="http://www.cirrusidea.com'. $file_dir . '">&lt;&lt; Back to Project Folder.</a></p>';  
    }
  }
  else if (isset($id)) {
    echo '<p>Are you sure you want to delete the following comment/file?</p>';
    echo '<p><strong>Comment/file ID: </strong>' . $id . '<br /></p>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';

    echo '</form>';
  }

  echo '<p><a href="http://www.cirrusidea.com/admin.php">&lt;&lt; Back to admin page</a></p><br /><br /><br /><br /><br /><br /><br /><br /><br />';
 
 require_once('footer.php');
?>

