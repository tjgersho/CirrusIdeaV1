<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Change Password';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
 // require_once('navmenu.php');
 
 
 
 if (isset($_POST['submit'])) {
  
 if (isset($_POST['email'])){ 
 
 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  // Grab the profile data from the POST
	
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
   
 $query = "SELECT * FROM cbp_user WHERE  email = '" . $email . "'";

 $data = mysqli_query($dbc, $query);
 
 $row = mysqli_fetch_array($data);

if(isset($row['username'])){
    
  $code = mt_rand(1,99999);

 $query1 = "UPDATE cbp_user SET validated = '".$code."' WHERE username='".$row['username']."'";
 mysqli_query($dbc, $query1);
    
$username = $row['username'];
 $to = $row['email'];
 $subject = "Change Password";
 
$message = "
 <html>
 <head>
 <title>Lost Username or Password</title>
 </head>
 <body>
 <p><br /><br />Thanks for being a part of CirrusIdea.com, &nbsp;" .
 $first_name . 
 "&nbsp; we really appreciate your involvement, and we hope you have fun with all the growing projects.<br />
 Click the link below to create your new password. <br />
 <a href='http://www.cirrusidea.com/changepasswordlink.php?username=" . $username  . "&code=". $code."'>Change Password</a></br ><br />
 If the link is not working copy and paste this link into your browser: <br />
 http://www.cirrusidea.com/changepasswordlink.php?username=" . $username  . "&code=". $code."</p><br /><br />
 </body>
 </html>
 ";
 
// Always set content-type when sending HTML email
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
 $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";

mail($to,$subject,$message,$headers);
echo '</div>';
echo '<div id="fillcontent">';
echo '<p>Please check your email for a link to change your password.  This email may have gone to your junk folder so please check there.</p>';
echo '<br /><br />';
echo '<a href="http://www.cirrusidea.com">Home</a>';
mysqli_close($dbc);
	require_once('footer.php');		
	exit;		
			
				}else{
                    echo '</div>';
echo '<div id="fillcontent">';
					echo '<p class="error"> You are not a member please create a new account.</p>';
					}
 
 
 }else{
 echo '</div>';
echo '<div id="fillcontent">';
 echo '<p class="error"> Please fill out all fields.</p>';
 
 }
 
 }
  
 ?> 
 </div>
 <div id = "fillcontent">
 <div style="position:relative; left:10px;">
 <table><tr><td>
 <p>Fill out information and press Change Password.  An email will be sent to you to change your password.</p><br />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="padding-left:200px;padding-right:100px">
     
     
	  <label for="email">Email:</label>
      <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br /> 
	 
	 
	 
    <input type="submit" value="Change Password" name="submit" />
  </form>
 </td></tr>
 </table> 
 </div>
 
 <br /><br />
 <a href="http://www.cirrusidea.com">Home</a>
 <br /><br />
 
 <?php
 
 // Insert the page footer
  require_once('footer.php');
 ?>