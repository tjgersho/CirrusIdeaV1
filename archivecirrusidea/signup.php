<?php
  // Insert the page header
  $page_title = 'Sign Up';
 session_start();
 
 
 
 
  require_once('appvars.php');
  require_once('connectvars.php');
 
 // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
      
      
      if (isset($_SESSION['user_id'])) {
    // Delete the session vars by clearing the $_SESSION array
    $_SESSION = array();

    // Delete the session cookie by setting its expiration to an hour ago (3600)
    if (isset($_COOKIE[session_name()])) {      setcookie(session_name(), '', time() - 3600);    }
     unset($_SESSION);
    $_SESSION= NULL; 
    // Destroy the session
    session_destroy();
    
  }

  // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
  setcookie('user_id', '', time() - 3600);
  setcookie('username', '', time() - 3600);
  setcookie('newuser', '', time() - 3600);

 

    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $status = 'OK';
	
    $msg = '';
   

    
      if(empty($_SESSION['6_letters_code'] ) ||   strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)   {     
          //Note: the captcha code is compared case insensitively.      
          //if you want case sensitive match, update the check above to      
          // strcmp()     
        $msg =  '</div>';
        $msg .=  '<div id="fillcontent">';
         $msg .=  '<p class="error"> The captcha code does not match!</ br></p>';  
         
          $status= 'NOTOK';
          
          }   
    
	 

	if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
	{ // checking your email
            $msg =  '</div>';
        $msg .=  '<div id="fillcontent">';
         $msg .=  '<p class="error">Your email address was not entered correctly<br /></p>';
        $status= 'NOTOK';
    } 


              $domain = substr(strstr($email, "@"),1);

        if (!checkdnsrr($domain)){
               $msg =  '</div>';
                 $msg .=  '<div id="fillcontent">';
                  $msg .=  '<p class="error">Your email address was not entered correctly<br /></p>';
             $status= 'NOTOK';
            }



	       if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2) && !empty($email) ) {  //Make sure all data is entered.
           if ($status == 'OK'){ 
  
	          // Make sure someone isn't already registered using this username
             $query = "SELECT * FROM cbp_user WHERE username = '$username'";
             $data = mysqli_query($dbc, $query);
                // Make sure someone isn't already registered using this username
              $query1 = "SELECT * FROM cbp_user WHERE  email = '$email'";
              $data1 = mysqli_query($dbc, $query1);
      
      
             if (mysqli_num_rows($data1) == 0) {  //Make sure email is unique
             if (mysqli_num_rows($data) == 0) {  //Make sure username is unique
              // The username is unique, so insert the data into the database
              $code = mt_rand(1,99999);
              $_SESSION['newuser'] = true;
              $query = "INSERT INTO cbp_user (username, password, join_date, email, mailme, cred, validated) VALUES ('$username', SHA('$password1'), NOW(), '$email', 1, 0, ".$code.")";
              mysqli_query($dbc, $query);
                             
 
	$post_member_id = 1;
	$to_member_name = $username;
	$comment_private = 1;
	$retocomment = NULL;
	
	
	
	mysqli_close($dbc);

	$to = "tgershon@msn.com , travis.g@paradigmmotion.com";
	$subject = "CirrusIdea.com New Member Notice";
	$message = "
 <html>
 <head>
 <title>New Member</title>
 </head>
 <body>
 <p><br /><br />Travis, there is a new member to CirrusIdea.com: <br /> &nbsp; Username:" .
 $username . 
 "&nbsp;.<br /> Email: " .
  $email . 
 "</p>
 </body>
 </html>";
 
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
 $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";
	
	mail($to,$subject,$message,$headers);
	
	// Redirect to the home page
    $_SESSION['loginusername'] = $username;
    $_SESSION['newuser'] = true; 
  $signupint_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']).'/signupint.php?loginusername='.$username;
  header('Location: ' . $signupint_url);
	
 


      }else {  //Account already exists
        // An account already exists for this username, so display an error message
	 $msg =  '</div>';
        $msg .= '<div id="fillcontent">';
         $msg .=  '<p class="error">An account already exists for that username. Please use a different username.</p>';

        $username = "";
      }
      
         }else {  //Account already exists
        // An account already exists for this username, so display an error message
    	    $msg =  '</div>';
        $msg .=  '<div id="fillcontent">';
         $msg .=  '<p class="error">An account already exists for that email. Please use a different email.</p>';

        $email = "";
      }
      
      

    }
  
    
}
    
}

 
require_once('header.php');
 

  echo  $msg;

  mysqli_close($dbc);
?>
</div>
<div id="fillcontent">

<div style="display:block; width:600px; float:left; margin-left:50px;">
  <p>Please enter your username and desired password to sign up for your CirrusIdea account.</p>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <legend>Registration Info</legend>
 <table><tr><td>
      <label for="username">Username:</label></td>
      <td><input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /></td></tr>
	  <tr><td><label for="email">Email:</label></td>
      <td><input type="email" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /></td></tr>
      <tr><td><label for="password1">Password:</label></td>
      <td><input type="password" id="password1" name="password1" /></td></tr>
      <tr><td><label for="password2">Password (retype):</label></td>
      <td><input type="password" id="password2" name="password2" /></td></tr>
	

 <tr><td colspan="2">
 <?php
 echo '<img src="';
 echo 'captcha_code_file.php?rand=';
 echo rand(); 
 echo '" id="captchaimg" >';
 ?>
 </td></tr><tr><td>
 <label for="message">Enter the code above here :</label></td><td>
 <input id="6_letters_code" name="6_letters_code" type="text"> 
 <br>
<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>

 </td><td></td></tr>
 
 <tr><td></td><td>

    <input type="submit" class="stylebutton" value="Sign Up" name="submit" />
  
</td></tr>
</table>
</form>
 <br />
 <br />
<a href="index.php">Home</a>&nbsp;
 <br />
 <br />
</div>

<div style="display:block; width:500px; float:left;">
<img src="http://www.znoter.com/images/geek1.png" />
</div>



<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
    var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>

<?php
  // Insert the page footer
  require_once('footer.php');
?>
