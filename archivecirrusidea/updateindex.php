<?php
// Start the session
  require_once('startsession.php');
 $root = realpath($_SERVER["DOCUMENT_ROOT"]); 
  // Insert the page header
  $page_title = 'Admin';
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

 
 

  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
       // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	  
	 $query = "SELECT * FROM cbpfiles";
     $data = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);
	 
	while ($row = mysqli_fetch_array($data)) { 
	
	copy($root . '/templates/index.php' , $root . $row['file_path'] . '/' . $row['file_name'] . '/index.php');
	//copy($root . '/templates/projectviewscount.txt' , $root . $row['file_path'] . '/' . $row['file_name'] . '/projectviewscount.txt');
//	copy($root . '/templates/.htaccess' , $root . $row['file_path'] . '/' . $row['file_name'] . '/.htaccess');
	//chmod($root . $row['file_path'] . '/' . $row['file_name'] . '/index.php',0777);

   //$query1 = "INSERT INTO synopsis (file_id, folder_name, file_path) VALUES ('".$row['file_id'] . "', '" . $row['file_name'] . "', '" . $row['file_path'] . "')";
  // mysqli_query($dbc, $query1);

copy($root . '/templates/uploader.php' , $root . $row['file_path'] . '/' . $row['file_name'] . '/uploader.php');



   } 
	
	copy($root . '/templates/index.php' , $root . '/files/Biology/index.php');
    copy($root . '/templates/uploader.php' , $root . '/files/Biology/uploader.php');
	//chmod($root . '/files/Biology/index.php',0777);

      mysqli_close($dbc);

   }
  }
  else {
    echo '<p>Are you sure you want to update all index.php</p>';
	echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '</form>';
  }

  echo '<p><a href="http://www.cirrusidea.com/admin.php">&lt;&lt; Back to admin page</a></p><br /><br /><br /><br /><br /><br /><br /><br /><br />';
 
 require_once('footer.php');
?>
