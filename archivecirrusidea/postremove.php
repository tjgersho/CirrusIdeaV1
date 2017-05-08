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
 

 if ($_SESSION['user_id']!=$_GET['member_id']){
    echo '<p class="login">You cannot delete someone elses post.</p>';
    exit();
  
  }
  // Show the navigation menu
  require_once('navmenu.php');

 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 
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
 

  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
      // Delete the screen shot image file from the server
      // Connect to the database
       $id = $_POST['id'];
	  
	 $query = "SELECT * FROM creativebrainpower WHERE id = '$id' LIMIT 1";
     $data = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);

	if ($row['filename']!=NULL){
	
	unlink($root. $row['file_id'] . '/' . $row['filename']);

                       
                        $testpicname = basename($root. $row['file_id'] . '/' . $row['filename']);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
	 
	  if (file_exists($root . $row['file_id']  . '/' .$testpicname. '.jpg')){


                           unlink($root . $row['file_id']  . '/' .$testpicname. '.jpg');
                           
                        }
                        
     $testpicname = $pic_parts1['filename'] . 'gallery4434';
     
	  if (file_exists($root . $row['file_id']  . '/' .$testpicname. '.jpg')){


                           unlink($root . $row['file_id']  . '/' .$testpicname. '.jpg');
                           
                        }                    
                        

    }

   	 $query34 = "SELECT * FROM creativebrainpower WHERE id = '$id' LIMIT 1";
     $data34 = mysqli_query($dbc, $query34);
	 $row34 = mysqli_fetch_array($data34);
	 $file_dir34 = $row34['file_id'];
	 

      // Delete the score data from the database
      $query1 = "DELETE FROM creativebrainpower WHERE id = '$id' LIMIT 1";
      mysqli_query($dbc, $query1);
	
		  $query2 = "DELETE FROM uploadprivacy WHERE upload_id = '". $id . "'";
        mysqli_query($dbc, $query2);
        
        
      // Confirm success with the user
      echo '<p>The uploaded comment/file ' . $id . ' was successfully removed.';
	 
	
  echo '<br /><p><a href="http://www.cirrusidea.com'. $file_dir34 . '">&lt;&lt; Back to Project Folder.</a></p><br />';
  echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to My Cirrus home page</a></p><br /><br /><br />';
 
 mysqli_close($dbc); 
 require_once('footer.php');
 exit;
    }
    else {
	 $query = "SELECT * FROM creativebrainpower WHERE id = '$id' LIMIT 1";
     $data = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);

	
      echo '<p class="error">The comment/file was not removed.</p>';
	  
    } 
  }
 if (isset($id)) {
   
   echo '<div style="position:relative; left:50px;">';
    echo '<p>Are you sure you want to delete the following comment/file?</p>';
    echo '<p><strong>Comment/file ID: </strong>' . $id . '<br /></p>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '?member_id='. $_GET['member_id'] . '&id='.$id . '">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';

    echo '</form>';
    echo '</div>';
  }
	 $query34 = "SELECT * FROM creativebrainpower WHERE id = '$id' LIMIT 1";
     $data34 = mysqli_query($dbc, $query34);
	 $row34 = mysqli_fetch_array($data34);
	 $file_dir34 = $row34['file_id'];
	 echo $file_dir43;
  echo '<br /><p><a href="http://www.cirrusidea.com'. $file_dir34 . '">&lt;&lt; Back</a></p><br />';
  echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to My Cirrus home page</a></p><br /><br /><br />';
 
 mysqli_close($dbc); 
 require_once('footer.php');
?>