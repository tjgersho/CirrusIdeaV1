<?php  
// Start the session 
  require_once('startsession.php');
 $root = realpath($_SERVER["DOCUMENT_ROOT"]); 
  // Insert the page header
  $page_title = 'Edit Private Folder';
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
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
 $query776 = "SELECT * FROM cbpfiles WHERE file_id = '" . $id . "'";
 $data776 = mysqli_query($dbc, $query776);
 $row776 =  mysqli_fetch_array($data776);
 if($row776['creator'] != $_SESSION['user_id']){
 echo '<p class="error">You must be the creator to share or delete a file.  ';
 
 echo  '<a href="http://www.cirrusidea.com/mycreativebrainpower.php">Return to your profile.</a></p>';
 exit();
 }
 
 if(isset($_POST['shareit'])) {
 $dontadd=false;
 $to_member_name = $_POST['to_member_name'];
  
  $query888 = "SELECT * FROM folderprivacy WHERE folderID = '" . $id . "'";
  $data888 = mysqli_query($dbc, $query888);
 while($row888 =  mysqli_fetch_array($data888)){
 if($row888['user_name'] == $to_member_name){
 $dontadd=true;
 }
 }
  
  $query = "SELECT * FROM cbpfiles WHERE file_id =  $id LIMIT 1";
      $data = mysqli_query($dbc, $query);
      $row =  mysqli_fetch_array($data);
      
      $foldername = $row['file_name'];
      $folderpath =  $row['file_path'];
      
  if($dontadd){
 
 echo '<p class="error">The Cirrus Folder: ' . $foldername . ' is already shared with ' . $to_member_name  . '.<br />';
 
 }else if($to_member_name == NULL){
 
  echo '<p class="error">Choose a member to share the file with.<br />';
 
 }else{
	 
	 $query = "INSERT INTO folderprivacy (user_name, folderID) VALUES ('$to_member_name', '$id')";
	mysqli_query($dbc, $query);
	
	echo '<p>The uploaded Folder: ' . $foldername . ' was successfully shared with ' . $to_member_name  . '.<br />';
    echo '<p><a href="http://www.cirrusidea.com/'. $folderpath .'">&lt;&lt; Back to folder path</a></p><br /><br />';
   
   echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to your profile</a></p><br /><br /><br />';
 
 	
	 $query552 = "SELECT * FROM cbpfiles WHERE file_id='" .$id. "'";
	 
	$result552 = mysqli_query($dbc, $query552);
	$row552 = mysqli_fetch_array($result552);
	
    $query331 = "SELECT id FROM creativebrainpower WHERE file_id ='" . $row552['file_path'] . '/' . $row552['file_name']. "'";
    $result331 = mysqli_query($dbc, $query331);	
	
	while($row331 = mysqli_fetch_array($result331)) { 
       
	  $query551 = "INSERT INTO uploadprivacy (upload_id, user_name) VALUES ('" . $row331['id'] ."', '" . $to_member_name . "')";
	
	   mysqli_query($dbc, $query551);
	    
	
	
	
	    }
	
	
	
	$query86 = "SELECT * FROM cbp_user WHERE username = '" . $to_member_name . "' LIMIT 1";
	$data86 = mysqli_query($dbc, $query86);
	$row86 = mysqli_fetch_array($data86);
	$useremail = $row86['email'];
	

	

	$to = "$useremail";
	$subject = "CirrusIdea.com - Folder Share";
	$message = "
 <html>
 <head>
 </head>
 <body>
 <p>
  A private folder has been shared with you on CirrusIdea.com by " . $row90['username'] . ".<br />
  <br />" . $to_member_name . ", Click <a href='http://www.cirrusidea.com" .  $folderpath .'/'. $foldername . "'>here </a> to go to the private folder.
 <br /><br />
 
 </p>
 </body>
 </html>
 ";
 
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
    $headers .= "From: " . $row90['email'] . "\r\n";
	
	mail($to,$subject,$message,$headers);
	
	
	
    

 }
 
 }
 
 
 if(isset($_POST['unshareit'])) {

 $member_name = $_POST['member_name'];
  
	 $query = "DELETE FROM folderprivacy WHERE user_name = '" . $member_name . "' AND folderID = '" . $id . "'";
	mysqli_query($dbc, $query);
    
        $query3355 = "SELECT * FROM cbpfiles WHERE file_id = '" .$id . "'";
        $data3355 = mysqli_query($dbc, $query3355);
        $row3355 = mysqli_fetch_array($data3355);
      
          
       $query3575 = "SELECT * FROM creativebrainpower WHERE file_id = '" . $row3355['file_path'] . '/' .  $row3355['file_name']  . "'";
       $data3575 = mysqli_query($dbc, $query3575);
       
      while ($row3575 = mysqli_fetch_array($data3575)){
          
           $query = "DELETE FROM uploadprivacy WHERE upload_id = '" . $row3575['id'] . "' AND user_name = '" . $member_name . "'";
             mysqli_query($dbc, $query);
          
          
      }
          
      
	
	echo '<p>The user: '. $member_name  . '<br /> No loger has acces to the folder or its contents.<br />';
    
     echo '<p><a href="http://www.cirrusidea.com/'. $row3355['file_path'] .'">&lt;&lt; Back to folder path</a></p><br /><br />';
   
   echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to your profile</a></p><br /><br /><br />';
 
 
 
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

  $pos = strpos($newname, "!");
  $pos1 = strpos($newname, "@");
  $pos2 = strpos($newname, "$");
  $pos3 = strpos($newname, "%");
  $pos4 = strpos($newname, "^");
  $pos5 = strpos($newname, "&");
  $pos6 = strpos($newname, "?");
  $pos7 = strpos($newname, "index.php");
  $pos8 = strpos($newname, "*");
  $pos9 = strpos($newname, "(");
  $pos10 = strpos($newname, ")");
  $pos11 = strpos($newname, "=");
  $pos12 = strpos($newname, "+");
  $pos13 = strpos($newname, "/");
  $pos14 = strpos($newname, "\\");
    $pos15 = strpos($newname, "'");
  
  
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
      while ($dir12.'/'. $currentfolder <> $oldpath .'/'. $oldname){
          
      
          
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
      while ($dir12.'/'. $currentfolder <> $oldpath .'/'. $oldname ){
          
      
          
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
       echo '<p><a href="http://www.cirrusidea.com/'. $oldpath.'">&lt;&lt; Back to folder path</a></p><br /><br />';
   
      } else {
           echo '<p class="error"><strong>There is already a folder in this directory with that name.  Try another name.<br /></strong></p>';
           echo '<p><a href="http://www.cirrusidea.com/'. $oldpath.'">&lt;&lt; Back to folder path</a></p><br /><br />';
   
      }
      
      }else{
	  
	   echo '<p class="error"><strong>You used an unallowed character in the new name.  Try another name.<br /></strong></p>';
          
          echo '<p><a href="http://www.cirrusidea.com/'. $oldpath.'">&lt;&lt; Back to folder path</a></p><br /><br />';
   
	  
	  }
      
     
 }
 
 if(isset($_POST['publicit'])) {

 $folder_id = $_POST['id'];
  
 if ($_POST['confirm'] == 'Yes') { 
    
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
     
   
   
    $currentFolder = $folder_id;
    //// Make all uploads in this folder public ////
    $query3355 = "SELECT * FROM cbpfiles WHERE file_id = '" .$currentFolder . "'";
        $data3355 = mysqli_query($dbc, $query3355);
        $row3355 = mysqli_fetch_array($data3355);
      
       $query3575 = "SELECT * FROM creativebrainpower WHERE file_id = '" . $row3355['file_path'] . '/' .  $row3355['file_name']  . "'";
       $data3575 = mysqli_query($dbc, $query3575);
       
             while ($row3575 = mysqli_fetch_array($data3575)){
          
                  $query = "DELETE FROM uploadprivacy WHERE upload_id = '" . $row3575['id'] . "'";
                  mysqli_query($dbc, $query);

                  $query1713 = "UPDATE creativebrainpower SET  private = '0' WHERE id ='".$row3575['id']."'";      
                 mysqli_query($dbc, $query1713);
          
                 }
   
    $filePrivate = 1;  
    
               $upfile_path = dirname($row3355['file_path']);
               $upfile_name = basename( $row3355['file_path']);
    while ($filePrivate == 1){
                         
       
                
          $query173 = "UPDATE cbpfiles SET  file_private = '0' WHERE file_id ='".$currentFolder."'";      
          mysqli_query($dbc, $query173);
      
         $query = "DELETE FROM folderprivacy WHERE folderID = '" . $currentFolder . "'";
         mysqli_query($dbc, $query);
                          
          
             
             
                       $query3455 = "SELECT * FROM cbpfiles WHERE file_path = '" . $upfile_path . "' AND file_name = '". $upfile_name. "'";
                       $data3455 = mysqli_query($dbc, $query3455);
                       $row3455 = mysqli_fetch_array($data3455);
           
                   $currentFolder = $row3455['file_id'];
                   
                         if   ($row3455['file_private'] == 0) {
                             
                             $filePrivate = 0;
                         }
                       
                         $upfile_name = basename($upfile_path);
                         $upfile_path = dirname($upfile_path);
                       
                    
                    }
           
           
             
      
  
	echo '<p>The folder: '. $row3355['file_name']  . ' is now a public folder.  All the private parent folders are also public to allow access to this folder.<br />';
   echo '<p><a href="http://www.cirrusidea.com/'.$row3355['file_path'].'">&lt;&lt; Back to folder path</a></p><br /><br />';
   
  
  echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to your profile</a></p><br /><br /><br />';
   
    mysqli_close($dbc);
 require_once('footer.php');
        exit();
        
 }else{
     
      echo '<p class="error">The folder was not made public.</p>';
 echo '<p><a href="http://www.cirrusidea.com/'.$row3355['file_path'].'">&lt;&lt; Back to folder path</a></p><br /><br />';
      
 }
 
 
 }
 
 
  if (isset($_POST['submit'])) {
  $okaytodelete = true;
 
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	 
	 $query = "SELECT * FROM cbpfiles WHERE file_id =  $id LIMIT 1";
      $data = mysqli_query($dbc, $query);
	  $row =  mysqli_fetch_array($data);
	   
    ///First check if there is another member's post present
	   $query345 = "SELECT * FROM creativebrainpower WHERE file_id ='" . $row['file_path'] . '/' . $row['file_name'] ."'";
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
      echo '<p>The Cirrus Folder: <strong>' .  $row['file_path'] . '/' .  $row['file_name'] . '</strong> was successfully removed.<br /><br />';
        echo '<p><a href="http://www.cirrusidea.com/'.$row['file_path'].'">&lt;&lt; Back to folder path</a></p><br /><br /><br /><br /><br /><br />';
	   echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to your profile</a></p><br />';
        echo '<p><a href="http://www.cirrusidea.com/editprofile.php">&lt;&lt; Back to your folders</a></p><br /><br /><br />';
	   require_once('footer.php');
        exit();
    }
    else {
      echo '<p class="error">The folder was not removed.</p>';
        echo '<p><a href="http://www.cirrusidea.com/'.$row['file_path'].'">&lt;&lt; Back to edit profile/folders</a></p><br />';
    }
   }else{
     echo '<p class="error">Sorry you cannot delete this folder, there are other member posts in this folder or there are sub-folders which must be deleted first.<br />';
      echo 'Contact the other members if you still want to delete this folder and or delete sub-folders first.</p>';
      
      echo '<p><a href="http://www.cirrusidea.com/'.$row['file_path'].'">&lt;&lt; Back to folder path</a></p><br />';
      
   } 
 
 
 
 }
 
 if (isset($id)) {
 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	  
	 $query = "SELECT * FROM cbpfiles WHERE file_id =  $id LIMIT 1";
     $data = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);
	 echo '<br /><br /><table border="1" style="text-align:left; margin-left:auto; margin-right:auto; width:70%;"><tr><td>';
    echo '<b>Are you sure you want to delete the following Folder? This will delete all of your posts in this folder!
	      You cannot delete if there are other member posts.</b>';
    echo '<b>Folder Location: ' . $row['file_path'] . '/'. $row['file_name'] . '<br /></b>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '</form>';
	echo '</td></tr></table>';
  



	 $query90 = "SELECT * FROM codevelopers WHERE member = '" .$_SESSION['username']. "' ORDER BY codeveloper ASC";
	$data90 = mysqli_query($dbc, $query90);
	
	  echo '<br /><table border="1" style="text-align:left; margin-left:auto; margin-right:auto; width:70%;"><tr><td>';
    echo '<b>Share this folder: </b>';
    echo '<p>File Location: ' . $row['file_path'] . '/'. $row['file_name'] . '<br /></p>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo '<select id="to_member_name" name="to_member_name">';
 echo '<option value="NULL">YOUR CO-DEVELOPERS</option>';
while($row90 = mysqli_fetch_array($data90)) { 
echo '<option value="' . $row90['codeveloper'] . '">'.$row90['codeveloper'].'</option>';
} 
	
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="submit" value="Share Folder" name="shareit" />';
    echo '</form>';

echo '</td></tr></table>';


/// Form to remove folder access from a co-developer.
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	 $query22 = "SELECT * FROM folderprivacy WHERE folderID = '" . $id . "'";
	
     $data22 = mysqli_query($dbc, $query22);
	 
	
	  echo '<br /><table border="1" style="text-align:left; margin-left:auto; margin-right:auto; width:70%;"><tr><td>';
    echo '<b>Remove Access of this folder from: </b>';
	echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo '<select id="member_name" name="member_name">';
 echo '<option value="NULL">Unshare with:</option>';
while($row22 = mysqli_fetch_array($data22) ) { 
    
    if ($row22['user_name'] != $_SESSION['username']){
echo '<option value="' . $row22['user_name'] . '">'.$row22['user_name'].'</option>';
}

} 
	
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="submit" value="Unshare Folder" name="unshareit" />';
    echo '</form>';

echo '</td></tr></table>';

/// Form to change the name of the folder.
   echo '<br /><table border="1" style="text-align:left; margin-left:auto; margin-right:auto; width:70%;"><tr><td>';
    echo '<p>Re-name this folder: </p>';
    echo '<p>File Location: ' . $row['file_path'] . '/'. $row['file_name'] . '<br /></p>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo 'New Folder Name: <input type="text" name="newname"  />  ';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="submit" value="Submit" name="renamesubmit" />';
    echo '</form>';
    echo '</td></tr></table>';


// Form to change folder to a public one.
     echo '<br /><br /><table border="1" style="text-align:left; margin-left:auto; margin-right:auto; width:70%;"><tr><td>';
    echo '<b>Are you sure you want to make this folder a public one? This will make all of the parent folders public also!
	      Once you make this folder a public folder there is no changing back to a private folder.</b>';
    echo '<b>Folder Location: ' . $row['file_path'] . '/'. $row['file_name'] . '<br /></b>';
    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="submit" value="Submit" name="publicit" />';
    echo '</form>';
	echo '</td></tr></table>';


}
  
 echo '<p><a href="http://www.cirrusidea.com/editprofile.php">&lt;&lt; Back to edit profile/folders</a></p><br />';
  echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to your profile</a></p><br /><br /><br />';
  
 require_once('footer.php');
 
?>
