<?php 
// Start the session
  require_once('startsession.php');
 $root = realpath($_SERVER["DOCUMENT_ROOT"]); 
  // Insert the page header
  $page_title = 'Admin Remove Folder';
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

 
 
 if (isset($_GET['folder_id'])) {
 
   // Grab the score data from the GET
    $id = $_GET['folder_id'];
	
	
  }
  else if (isset($_POST['id'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
  }
  else {
    echo '<p class="error">Sorry, no folder was specified for removal.</p>';  
  }

  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
       // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	  
	 $query = "SELECT * FROM cbpfiles WHERE file_id =  $id LIMIT 1";
     $data = mysqli_query($dbc, $query);
	  $row =  mysqli_fetch_array($data);
	
	if ($row['file_private']){
	 $query4 = "DELETE FROM folderprivacy WHERE folderID ='" .$row['file_id'] ."'";
      mysqli_query($dbc, $query4);
	  }
	  
		$query1 = "SELECT * FROM creativebrainpower WHERE file_id ='" . $row['file_path'] . '/' . $row['file_name'] ."'";
       $data1 = mysqli_query($dbc, $query1);
	 
	
	 while ($row1 = mysqli_fetch_array($data1)){
	 if(isset($row1['filename'])){
	  unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/' . $row1['filename']);
	    $pic_parts = pathinfo($row1['filename']);
        $newpicname = $pic_parts['filename'] . 'thum63820';
         $extension = $pic_parts['extension'];

     if (file_exists($root. $row['file_path'] . '/' . $row['file_name'] . '/' . $newpicname .'.'. $extension)){
	 unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/' . $newpicname .'.'. $extension);
	 }
	     
         
     
     }
	  $query3 = "DELETE FROM creativebrainpower WHERE id ='" .$row1['id'] ."'";
      mysqli_query($dbc, $query3);
	
	 }
	 unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/index.php');
	 unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/projectviewscount.txt'); 
	 if(file_exists($root. $row['file_path'] . '/' . $row['file_name'] . '/.htaccess')){
     unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/.htaccess');
	 }
     rmdir($root. $row['file_path'] . '/' . $row['file_name']);

      // Delete the score data from the database
      $query4 = "DELETE FROM cbpfiles WHERE file_id = $id LIMIT 1";
      mysqli_query($dbc, $query4);
      mysqli_close($dbc);

      // Confirm success with the user
      echo '<p>The uploaded Folder: ' . $id . ' was successfully removed.<br /><br /><br /><br /><br /><br /><br />';
    }
    else {
      echo '<p class="error">The folder was not removed.</p>';
    }
  }
  else if (isset($id)) {
 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	  
	 $query = "SELECT * FROM cbpfiles WHERE file_id =  $id LIMIT 1";
     $data = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);
	 
    echo '<p>Are you sure you want to delete the following Folder?</p>';
    echo '<p><strong>Folder ID: </strong>' . $id . ' File Location: ' . $row['file_path'] . '<br /></p>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '</form>';
  }

  echo '<p><a href="http://www.cirrusidea.com/admin.php">&lt;&lt; Back to admin page</a></p><br /><br /><br />';
 
 require_once('footer.php');
?>
