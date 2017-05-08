<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]); 
  require_once($root.'/appvars.php');
  require_once($root.'/connectvars.php');
 // Start the session
  require_once($root.'/startsession.php');
   // Insert the page header
   
   

 if (!isset($_SESSION['user_id'])) {

  //  exit();
  
  }
  
   $file_dir1 = dirname($_SERVER['PHP_SELF']); 
 $file_dir2 = dirname($file_dir1);
 $foldername1 = basename($file_dir1);
 
       $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
 $viewokay = true;
 
  $query777 = "SELECT * FROM cbpfiles WHERE file_name = '$foldername1' AND file_path = '$file_dir2'";
  $data777 = mysqli_query($dbc, $query777);
  $row777 = mysqli_fetch_array($data777);

  
 if ($row777['file_private'] == 1) {
       $viewokay = false;
       $query432 = "SELECT * FROM folderprivacy WHERE folderID = '" . $row777['file_id'] . "'";
       $data432= mysqli_query($dbc, $query432);
        while($row432 = mysqli_fetch_array($data432)) { 
            if($_SESSION['username'] == $row432['user_name']){
            $viewokay = true;
			 }
			}
		}
	
if (!$viewokay) {
   
 //   exit();
  }
  
  
  
  
  
  $file_dir = $file_dir2 . '/' . $foldername1;
  
  
  
  //////////////////////////////////////////////Post Added/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

   $response =  "";
   
 

 // Get data from post
	$description = mysqli_real_escape_string($dbc, trim($_POST['description']));
    $file = mysqli_real_escape_string($dbc, trim($_FILES['file']['name']));
	

	$private = mysqli_real_escape_string($dbc, trim($_POST['private']));
	if ($private == NULL){
	$private = 0;
	}else{
	$private = 1;
	}
    
    
    if ($row777['file_private'] == 1) {
    $private = 1;
    }
	
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size']; 
	$fileinfo = pathinfo($file);
     $fileext23=$fileinfo['extension'];
     $file_name23 = $fileinfo['filename'];
    // echo $_FILES['file']['error'];
     
     if (!empty($description) || $file_size>0 ) {
        	if ($file_size <= CBP_MAXFILESIZE) {

	        	if ($_FILES['file']['error'] == 0 || $file==NULL) {
                             
                        						
	if (strlen($file_name23) > 15) // if you want...
		{
    $maxLength = 14;
   $file_name23 = substr($file_name23, 0, $maxLength);
		}

$file_name23 = str_replace( '"', '' , $file_name23);
$file_name23 = str_replace( "'", "" , $file_name23);
$file_name23= str_replace( ";", "" , $file_name23);
$file_name23 = str_replace( "<?php", "" , $file_name23);	
$file_name23 = str_replace( "<script>", "" , $file_name23);	
  
                       if ($file!=NULL){ 
                          $target =  $root . $file_dir . '/' . $file_name23 . '.' . $fileext23;
                            }
 
                        if (file_exists($target)) {
                            srand((double)microtime()*1000000);
 
                            $newfilename = $file_name23 . rand(1000,20000) . '.' . $fileext23;
                            }else {
 
                            $newfilename = $file_name23 . '.' . $fileext23;
                            }

                        if (file_exists($target)) {
                                    srand((double)microtime()*1000000);
 
                             $newfilename = $file_name23 . rand(1000,20000) . '.' . $fileext23;
                            }else {
 
                                $newfilename = $newfilename;
                            }
							
	
		
							

                       if ($file!=NULL){
                        $target =  $root . $file_dir . '/' . $newfilename;
                                }
 
                         if (move_uploaded_file($_FILES['file']['tmp_name'], $target) || $newfilename == NULL || $file == NULL) { // Move the file to the target upload folder
                                    // Write the data to the database
                            $postdate = date("Y-m-d H:i:s");
                            
	                         $query = "INSERT INTO creativebrainpower (date, description, filename, member_id, approved, file_id, startedproject, private, filesize, rating) VALUES ('" . $postdate . "', '" .
	                                 $description . "', '" . $newfilename . "', '" . $_SESSION['user_id'] . "', 1, '" . $file_dir . "', 0," . $private . ", " . $file_size . ", " . 0 . ")";
	
	                         mysqli_query($dbc, $query);
		
                            	if ($private==1){
                                    	$query33 = "SELECT id FROM creativebrainpower WHERE date ='".  $postdate ."' AND description='" . $description . "' AND member_id ='" . $_SESSION['user_id'] . "' AND file_id ='" . $file_dir . "'";
                                           $result33 = mysqli_query($dbc, $query33);
                                        	$row33 = mysqli_fetch_array($result33);
	
                                            	 $query55 = "INSERT INTO uploadprivacy (upload_id, user_name) VALUES ('" . $row33['id'] ."', '" . $_SESSION['username'] . "')";
	
                                    	mysqli_query($dbc, $query55);
	
                                    	}
	
                            	if ($private==1){
                                	 $query552 = "SELECT file_id FROM cbpfiles WHERE file_name='" . basename($file_dir). "' AND file_path ='" . dirname($file_dir) . "'";
                                    	$result552 = mysqli_query($dbc, $query552);
                                    	$row552 = mysqli_fetch_array($result552);
		
                                         $query331 = "SELECT user_name FROM folderprivacy WHERE folderID ='" . $row552['file_id'] . "'";
                                         $result331 = mysqli_query($dbc, $query331);	
	
	                                while($row331 = mysqli_fetch_array($result331)) { 
                                        			if($_SESSION['username'] <> $row331['user_name']){
       
	                                                 $query551 = "INSERT INTO uploadprivacy (upload_id, user_name) VALUES ('" . $row33['id'] ."', '" . $row331['user_name'] . "')";
	
	                                                 mysqli_query($dbc, $query551);
	                                                     }
	                                                 }
                                             }
	
                             // Confirm success with the user
                   $response .= '<p style="">Thanks for adding your project file!<br />';
			         $response .= 'This file may be removed if deemed inappropriate or violates any wrongfully used Intellectual Property.';
					$response .=  '<br />Use this <a href="'.$_SERVER['PHP_SELF'].'">link</a> to refresh this page</p>';
                               
                               // if($file!=NULL){
	                        	//	echo '<p style=""><strong>File Name:</strong> ' . $newfilename . '<br />';}
                                  //   echo '<strong>Comment/Description:</strong><p style="text-align:left"> ' . parsedescription($description) . '</p><br />';
	                            			
		                            //	echo '<p><a style="" href="http://www.cirrusidea.com'. $file_dir . '">&lt;&lt; Back to Project Folder.</a></p>';
			
                                      //      echo '<p><a style="" href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to My CirrusIdea page.</a></p>';

                                // Clear the score data to clear the form
           
                                      $description = "";
                                       $file = "";
	                                	$newfilename = "";
	
	
                                	$folder_name = basename($file_dir);
                                	 $basefile_dir = dirname($file_dir);

                                    	$query76 = "SELECT creator FROM cbpfiles WHERE file_path = '$basefile_dir' AND file_name = '$folder_name' LIMIT 1";
                                         $data76 = mysqli_query($dbc, $query76);
	                                        $row76 = mysqli_fetch_array($data76);
	
	                                        $query86 = "SELECT * FROM cbp_user WHERE user_id = '" . $row76['creator'] . "' LIMIT 1";
                                            $data86 = mysqli_query($dbc, $query86);
                                  	          $row86 = mysqli_fetch_array($data86);
                                        	$foldercreator = $row86['email'];
                                        	$username1 = $row86['username'];
	
                        if ($row86['mailme'] == 1){	
                                	$to = "$foldercreator";
                                	$subject = "CirrusIdea.com - Project Post";
                                	$message = "
                                        <html>
                                            <head>
                                     <title>A post to your project folder has been uploaded.</title>
                                        </head>
                                            <body>
                                            <p><br /><br />" . $username1 . ",  <a href='http://www.cirrusidea.com". $file_dir . "'>Log In</a>
                                             and checkout what has been posted to your project folder: " . $folder_name . ".<br /><br />
                                                </p>
                                                </body>
                                                </html>
                                                     ";
 
                                        $headers = "MIME-Version: 1.0" . "\r\n";
                                        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
                                        // More headers
                                         $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";
	
                                        	mail($to,$subject,$message,$headers);
	
	                            }
	
	                        $fileID =  $basefile_dir  . "/" . $folder_name;

                            $query8787= "SELECT member_id FROM creativebrainpower WHERE file_id = '$fileID'";
                            $data8787 = mysqli_query($dbc, $query8787);
                            $row8787 = mysqli_fetch_array($data8787);

                            $k=0;	
                            $memberinthread[$k] = 0;
                    
                            while ($row8787 = mysqli_fetch_array($data8787)) { 	


                                foreach($memberinthread as $done){

                                    if ($done == $row8787['member_id']){
                                        $sent = 1;
                                        break;
                                    }else {
                                        $sent=0;
                                    }

                                    }

                            $memberinthread[$k] = $row8787['member_id'];
	
                            $query888 = "SELECT * FROM cbp_user WHERE user_id = '" . $row8787['member_id'] . "' LIMIT 1";
                            $data888 = mysqli_query($dbc, $query888);
                            $row888 = mysqli_fetch_array($data888);
	
                                if ($row888['mailme'] == 1 && $sent==0){	

                            	$to_email = $row888['email'];
                            	$to = "$to_email";
                            	$subject = "CirrusIdea.com - Project Post";
                            	$message = "
                                 <html>
                                 <head>
                                 <title>An upload to a thread you have been involved in is now online.</title>
                                 </head>
                                 <body>
                                 <p><br /><br />" . $row888['username'] . ",  <a href='http://www.cirrusidea.com" . $file_dir . "'>Log In</a>
                                 and checkout what has been posted to the thread: " . $folder_name . ".<br /><br />
                                 </p>
                                 </body>
                                 </html>
                                    ";
 
                                 $headers = "MIME-Version: 1.0" . "\r\n";
                                 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                                 
                                // More headers
                                 $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";
                                	
                                	mail($to,$subject,$message,$headers);
	
	
	                                }
                        	$k=$k+1;
	
                        }

            //	require_once($root.'/footer.php');	
            	//exit;		
		
            } else {
		
                  $response .= '<p class="error" style="">Sorry, there was a problem uploading your file.</p>';
    
		  }
        }
      
      } else {

        $response .= '<p class="error" style="">The file should be no greater than ' . round((CBP_MAXFILESIZE / 1024),4) . ' KB in size.</p>';
   
	     }
   
   // Try to delete the temporary file
      @unlink($_FILES['file']['tmp_name']);
    } else {

                 $response .= '<p class="error" style="">Please fill in a comment or upload a file.</p>';
    
	}
  
  
  
  
  
  
//echo '{"result": "' .  $response . '"}';
  
  
  
  
  
  
  ?>
