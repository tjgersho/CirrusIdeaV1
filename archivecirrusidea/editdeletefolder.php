<?php  
// Start the session
  require_once('startsession.php');
 $root = realpath($_SERVER["DOCUMENT_ROOT"]); 
  // Insert the page header
  $page_title = 'Edit Folder';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.

  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
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
    exit();
  }
 
 if(isset($_POST['renamesubmit'])) {
    $newname =  $_POST['newname'];
    
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
     
      $query = "SELECT * FROM cbpfiles WHERE file_id =  $id LIMIT 1";
      $data = mysqli_query($dbc, $query);
	  $row =  mysqli_fetch_array($data);
      
      $oldname = $row['file_name'];
      $oldpath =  $row['file_path'];
      
           
  $charactersok = true;

  $pos = strpos($newfile, "!");
  $pos1 = strpos($newfile, "@");
  $pos2 = strpos($newfile, "$");
  $pos3 = strpos($newfile, "%");
  $pos4 = strpos($newfile, "^");
  $pos5 = strpos($newfile, "&");
  $pos6 = strpos($newfile, "?");
  $pos7 = strpos($newfile, "index.php");
  $pos8 = strpos($newfile, "*");
  $pos9 = strpos($newfile, "(");
  $pos10 = strpos($newfile, ")");
  $pos11 = strpos($newfile, "=");
  $pos12 = strpos($newfile, "+");
  $pos13 = strpos($newfile, "/");
  $pos14 = strpos($newfile, "\\");
   $pos15 = strpos($newfile, "'");
   
    
 if ($pos !== false || $pos1 !== false  || $pos2 !== false  || $pos3 !== false  || $pos4 !== false  || $pos5 !== false  || $pos6 !== false  || $pos7 !== false){
     $charactersok =false;

 }
  if ($pos8 !== false || $pos9 !== false  || $pos10 !== false  || $pos11 !== false  || $pos12 !== false  || $pos13 !== false  || $pos14 !== false || $pos15 !== false){
  
     $charactersok =false;
 
 } 
      //Check to make sure there is not a folder with this name that exists already in this location
	
if ($charactersok){

     $query333 = "SELECT * FROM cbpfiles WHERE file_name = '". $newname . "' AND file_path = '". $oldpath . "'";
      $data333 = mysqli_query($dbc, $query333);
      if (mysqli_num_rows($data333) == 0) {
      
      //change folder name
      rename( $root . $oldpath .'/'. $oldname , $root . $oldpath .'/'. $newname );
      
      //update all instances in database.
      
      //Update folder table
      $query11 = "UPDATE cbpfiles SET file_name = '" . $newname . "' WHERE file_id =  '" . $id . "' LIMIT 1";
      $data11 = mysqli_query($dbc, $query11);
  
      
      //Update all sub folders to have the correct new path
        $query355 = "SELECT * FROM cbpfiles WHERE file_path LIKE '" . $oldpath .'/'. $oldname . "%'";
       $data355 = mysqli_query($dbc, $query355);
       
      while ($row355 = mysqli_fetch_array($data355)){
         
         $filepath = $row355['file_path'];
         
         $dir12 = dirname($filepath);
         
         $currentfolder = basename($filepath);
         
         
         $base2 = '/'. $currentfolder;
         
         $iter = 0;
      while ($dir12.'/'. $currentfolder <> $oldpath .'/'. $oldname ){
                
          
          $currentfolder = basename($dir12);
         
           if ($currentfolder <>  $oldname){
              
               $base2 = '/' . basename($dir12) . $base2;
          }
          
          $dir12 = dirname($dir12);
          
          $iter++;
      }
      
      if ($iter == 0){
       $query17 = "UPDATE cbpfiles SET  file_path = '" . $oldpath .'/'. $newname . "' WHERE file_id ='".$row355['file_id']."'";
       $data17 = mysqli_query($dbc, $query17);
      }else{
         $query17 = "UPDATE cbpfiles SET  file_path = '" . $oldpath .'/'. $newname . $base2. "' WHERE file_id ='".$row355['file_id']."'";
       $data17 = mysqli_query($dbc, $query17);
      }
       
      }
      
   
         //Update all creativebrainpower posts with new path
        $query358 = "SELECT * FROM creativebrainpower WHERE file_id LIKE '" . $oldpath .'/'. $oldname . "%'";
       $data358 = mysqli_query($dbc, $query358);
       
      while ($row358 = mysqli_fetch_array($data358)){
         
         $filepath = $row358['file_id'];
         
                 
         $dir12 = dirname($filepath);
         
         $currentfolder = basename($filepath);
         
         
         $base2 = '/'. $currentfolder;
         
         $iter = 0;
      while ($dir12.'/'. $currentfolder <> $oldpath .'/'. $oldname){
          
      
          
          $currentfolder = basename($dir12);
         
           if ($currentfolder <>  $oldname){
              
               $base2 = '/' . basename($dir12) . $base2;
          }
          
          $dir12 = dirname($dir12);
          
          $iter++;
      }
      
      if ($iter == 0){
       $query19 = "UPDATE creativebrainpower SET  file_id = '" . $oldpath .'/'. $newname . "' WHERE id ='".$row358['id']."'";
       $data19 = mysqli_query($dbc, $query19);
      }else{
         $query19 = "UPDATE creativebrainpower SET  file_id = '" . $oldpath .'/'. $newname . $base2. "' WHERE id ='".$row358['id']."'";
       $data19 = mysqli_query($dbc, $query19);
      }
       
      }
      
      ///Confirmation
      
    echo '<p><strong>Success!!<br /> You changed the file name: </strong>' . $oldpath .'/'. $oldname. ' <br /><strong>to: ';
    echo '</strong><br />' . $oldpath .'/'. $newname. '  </p>';
     echo '<p><a href="http://www.cirrusidea.com/' .$oldpath .'/">&lt;&lt; Back to Folder Path</a></p><br />';

      
      } else {
           echo '<p class="error"><strong>Sorry there is already a folder in this directory with that name.  Try another name. <br /></strong></p>';
          echo '<p><a href="http://www.cirrusidea.com/' .$oldpath .'/">&lt;&lt; Back to Folder Path</a></p><br />';
      }
      
      }else{
	  
	  echo '<p class="error"><strong>You used an unallowed character in the folder name.  Try another name. <br /></strong></p>';
          echo '<p><a href="http://www.cirrusidea.com/' .$oldpath .'/">&lt;&lt; Back to Folder Path</a></p><br />';
	  }
      
     
 }
 
  if (isset($_POST['submit'])) {
  $okaytodelete = true;
 
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	 
	 $query = "SELECT * FROM cbpfiles WHERE file_id =  $id LIMIT 1";
      $data = mysqli_query($dbc, $query);
	  $row =  mysqli_fetch_array($data);
	  
    ///First check if there is another member's post present
	   $query345 = "SELECT * FROM creativebrainpower WHERE file_id LIKE '" . $row['file_path'] . '/' . $row['file_name'] ."%'";
       $data345 = mysqli_query($dbc, $query345);
	 while ($row345 = mysqli_fetch_array($data345)){
	   if($row345['member_id']!=$_SESSION['user_id']){
	   $okaytodelete = false;
	   }
	 }
       $query365 = "SELECT * FROM cbpfiles WHERE file_path LIKE '" . $row['file_path'] . '/' . $row['file_name'] ."%'";
       $data365 = mysqli_query($dbc, $query365);
    if(mysqli_num_rows($data365) <> 0){
	   
	   $okaytodelete = false;
	  
    }
	 
 
 
 if($okaytodelete){
 
   if ($_POST['confirm'] == 'Yes') {
       // Connect to the database

	if ($row['file_private']){
	 $query4 = "DELETE FROM folderprivacy WHERE folderID ='" .$row['file_id'] ."'";
      mysqli_query($dbc, $query4);
	  }
	  
	    $query1 = "SELECT * FROM creativebrainpower WHERE file_id LIKE '" . $row['file_path'] . '/' . $row['file_name'] ."%'";
       $data1 = mysqli_query($dbc, $query1);
	 
	if(mysqli_num_rows($data1) <> 0){
	 while ($row1 = mysqli_fetch_array($data1)){
	 if($row1['filename']<> ""){
	  unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/' . $row1['filename']);
         $pic_parts = pathinfo($row1['filename']);
      $newpicname = $pic_parts['filename'] . 'thum63820';
      $newpicname2 = $pic_parts['filename'] . 'gallery4434';
       $extension = $pic_parts['extension'];
      
        if (file_exists($root. $row['file_path'] . '/' . $row['file_name'] . '/' . $newpicname .'.'. $extension)){
	    unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/' . $newpicname .'.'. $extension);
	    }
        
         if (file_exists($root. $row['file_path'] . '/' . $row['file_name'] . '/' . $newpicname2 .'.'. $extension)){
        unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/' . $newpicname2 .'.'. $extension);
	    }
        
	 }
	  $query3 = "DELETE FROM creativebrainpower WHERE id ='" .$row1['id'] ."'";
      mysqli_query($dbc, $query3);
	
	 }
	 }
    
	 unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/index.php');
	 unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/projectviewscount.txt'); 
	 unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/uploader.php');
          
          
      if(file_exists($root. $row['file_path'] . '/' . $row['file_name'] . '/.htaccess')){
     unlink($root. $row['file_path'] . '/' . $row['file_name'] . '/.htaccess');
     }
     
         ////////////////////////////////////////////////////////////////////////////////////////////
     ////////////////delete synopsis pics///////////////////////////////////////////////////////
     //////////////////////////////////////////////////////////////////////////////////////////
      if($row['p_file1']!=NULL){
        unlink($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file1']);
      }
                       
                        $testpicname = basename($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file1']);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
     
       if (file_exists($root .$row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg')){
          unlink($root . $row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg');    
        }
        
            if($row['p_file2']!=NULL){
        unlink($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file2']);
      }
                       
                        $testpicname = basename($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file2']);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
     
	   if (file_exists($root .$row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg')){
          unlink($root . $row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg');    
        }
        
            if($row['p_file3']!=NULL){
        unlink($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file3']);
      }
                       
                        $testpicname = basename($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file3']);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
     
	   if (file_exists($root .$row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg')){
          unlink($root . $row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg');    
        }
        
            if($row['p_file4']!=NULL){
        unlink($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file4']);
      }
                       
                        $testpicname = basename($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file4']);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
     
	   if (file_exists($root .$row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg')){
          unlink($root . $row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg');    
        }
        
        
        
            if($row['p_file5']!=NULL){
        unlink($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file5']);
      }
                       
                        $testpicname = basename($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file5']);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
     
	   if (file_exists($root .$row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg')){
          unlink($root . $row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg');    
        }
        
        
            if($row['p_file6']!=NULL){
        unlink($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file6']);
      }
                       
                        $testpicname = basename($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file6']);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
     
	   if (file_exists($root .$row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg')){
          unlink($root . $row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg');    
        }
        
        
            if($row['p_file7']!=NULL){
        unlink($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file7']);
      }
                       
                        $testpicname = basename($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file7']);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
     
	   if (file_exists($root .$row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg')){
          unlink($root . $row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg');    
        }
        
        
      if($row['p_file8']!=NULL){
        unlink($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file8']);
      }
                       
                        $testpicname = basename($root. $row['file_path'] . '/' . $row['file_name']. '/' .  $row['p_file8']);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
     
	   if (file_exists($root .$row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg')){
          unlink($root . $row['file_path'] . '/' . $row['file_name']. '/' .$testpicname. '.jpg');    
        }


    ////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
     
     
     rmdir($root. $row['file_path'] . '/' . $row['file_name']);

      // Delete the score data from the database
      $query4 = "DELETE FROM cbpfiles WHERE file_id = $id LIMIT 1";
      mysqli_query($dbc, $query4);
      mysqli_close($dbc);

      // Confirm success with the user
      echo '<p>The Cirrus Folder: ' . $row['file_name'] . ' was successfully removed.<br /><br />';
      echo '<p><a href="http://www.cirrusidea.com/' .$row['file_path'] .'/">&lt;&lt; Back to Folder Path</a></p><br />';
      echo '<br /><br /><br /><br /><br />';
      
    }
    else {
      echo '<p class="error">The folder was not removed.</p>';
         echo '<p><a href="http://www.cirrusidea.com/' .$row['file_path'] .'/">&lt;&lt; Back to Folder Path</a></p><br />';
    }
   }else{
     echo '<p class="error">Sorry you cannot delete this folder, there are other member posts in this folder or there are sub-folders which must be deleted first.<br />';
      echo 'Contact the other members if you still want to delete this folder and or delete sub-folders first.</p>';
         echo '<p><a href="http://www.cirrusidea.com/' .$row['file_path'] .'/">&lt;&lt; Back to Folder Path</a></p><br />';
   } 
 
 }
  else if (isset($id)) {
 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	  
	 $query = "SELECT * FROM cbpfiles WHERE file_id =  $id LIMIT 1";
     $data = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);
	  echo '<br /><br /><br /><table border="1" style="text-align:left; margin-left:auto; margin-right:auto; width:70%;"><tr><td>';
    echo '<p>Are you sure you want to delete the following Folder? This will delete all of your posts in this folder!
	      You cannot delete if there are other member posts.</p>';
    echo '<p><strong>Folder ID: </strong>' . $id . ' File Location: ' . $row['file_path'] . '/'. $row['file_name'] . '<br /></p>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '</form>';
    echo '</td></tr></table>';

   echo '<br /><br /><br /><table border="1" style="text-align:left; margin-left:auto; margin-right:auto; width:70%;"><tr><td>';
    echo '<p>Re-name this folder: </p>';
    echo '<p><strong>Folder ID: </strong>' . $id . ' File Location: ' . $row['file_path'] . '/'. $row['file_name'] . '<br /></p>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo 'New Folder Name: <input type="text" name="newname"  />  ';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="submit" value="Submit" name="renamesubmit" />';
    echo '</form>';
    echo '</td></tr></table>';

  }
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
      
  
 echo '<p><a href="http://www.cirrusidea.com/editprofile.php">&lt;&lt; Back to edit profile/folders</a></p><br />';
  echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to your profile</a></p><br /><br /><br />';
 
 require_once('footer.php');
?>
