<?php
  // Start the session
  require_once('startsession.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu

 
   if (!isset($_SESSION['user_id'])) {
    exit();
  }

   
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  $post_id = mysqli_real_escape_string($dbc, trim($_POST['post_id']));
  
  $comment = mysqli_real_escape_string($dbc, trim($_POST['comment']));
  
 // echo $post_id . '      ';
 // echo $comment;
  
  
  $query = "INSERT INTO postcomments (comment, post_member_id, ref_post_id) VALUES ('" . $comment . "', '" . $_SESSION['user_id'] . "', '" . $post_id . "')";
    
	mysqli_query($dbc, $query);
	
	echo 'Thanks posting a comment!!';
  

   $query8787= "SELECT * FROM creativebrainpower WHERE id = '".$post_id."'";
 $data8787 = mysqli_query($dbc, $query8787);
  $row8787 = mysqli_fetch_array($data8787);

$file_dir = $row8787['file_id'];
                            $query888 = "SELECT * FROM cbp_user WHERE user_id = '" . $row8787['member_id'] . "' LIMIT 1";
                            $data888 = mysqli_query($dbc, $query888);
                            $row888 = mysqli_fetch_array($data888);

                            	$to_email = $row888['email'];
                            	$to = "$to_email";
                            	$subject = "CirrusIdea.com - Comment on one of your posts";
                            	$message = "
                                 <html>
                                 <head>
                                 <title>New comment to one of your posts.</title>
                                 </head>
                                 <body>
                                 <p><br /><br />" . $row888['username'] . ",  <a href='http://www.cirrusidea.com" . $file_dir . "' target='_blank'>Log In</a>
                                 and checkout the comment that has been posted to your post in the folder: " . basename($file_dir) . ".<br /><br />
                                 </p>
                                 </body>
                                 </html>
                                    ";
 
                                 $headers = "MIME-Version: 1.0" . "\r\n";
                                 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                                 
                                // More headers
                                 $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";
                                	
                                	mail($to,$subject,$message,$headers);
	
	
	                                
                        
	
                        

  
  
  
  
  
  
  ?>