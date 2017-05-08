<?php
// Start the session
  require_once('startsession.php');
    // Insert the page header
  require_once('header.php');
  $page_title = 'Change Password';
 $page_title = 'Change Password';
  require_once('header.php');
 
  require_once('appvars.php');
  require_once('connectvars.php');
  

if(isset($_GET['username'])){
    
$username = $_GET['username'];
$code = $_GET['code'];

}elseif(isset($_POST['username1'])){

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$username = mysqli_real_escape_string($dbc, trim($_POST['username1']));
$code =  mysqli_real_escape_string($dbc, trim($_POST['code1']));

}else{
    
    echo '</div>';
       echo '<div id="fillcontent">';
      echo '<p class="error">You must be logged in to change your password or have recieved an email to change your password.</p>';
         echo '<br /><br /><br /><br /><br /><br />';
        require_once('footer.php');
        exit();
}



  // Connect to the database
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
   if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));

	
    if (!empty($password1) && !empty($password2) && ($password1 == $password2)) {
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      $query2 = "SELECT validated FROM cbp_user WHERE username = '".$username."'";
     $data2 = mysqli_query($dbc, $query2);
   	 $row2 = mysqli_fetch_array($data2);
        
      if ( $code == $row2['validated']){
        $query = "UPDATE cbp_user SET password = SHA('" . $password1 . "') WHERE username = '" .  $username . "'";
        mysqli_query($dbc, $query);
      
       
        mysqli_close($dbc);
       echo '</div>';
       echo '<div id="fillcontent">';
        // Confirm success with the user
    
       
		echo '<p>Your new account has been successfully updated. You\'re now ready to <a href="login.php">log in</a> with your new password.</p>';
		echo '<br /><br /><br /><br /><br /><br />';
        require_once('footer.php');
        exit();
      }else{

    	echo 'YOU HAVE REACHED THIS PAGE IN ERROR<br /><a href="https://www.cirrusidea.com"><img src="images/logo.png" /></a><br />';
	echo '<br /><br /><br /><br /><br /><br />';
        require_once('footer.php');
        exit();


	}
     
    }
    else {
  echo '</div>';
       echo '<div id="fillcontent">';
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
	  
    }
  }
  

 $query2 = "SELECT validated FROM cbp_user WHERE username = '".$username."'";
 $data2 = mysqli_query($dbc, $query2);
 $row2 = mysqli_fetch_array($data2);
 if ( $code == $row2['validated']){
 
  ?>
</div>
<div id="fillcontent">
  <p>Please enter your new password for your CirrusIdea.com account.</p>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" id="code1" name="code1" value="<?php if (!empty($code)) echo $code; ?>"/><br />
      <input type="hidden" id="username1" name="username1" value="<?php if (!empty($username)) echo $username; ?>"/><br />
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" disabled/><br />
      <label for="password1">Password:</label>
      <input type="password" id="password1" name="password1" /><br />
      <label for="password2">Password (retype):</label>
      <input type="password" id="password2" name="password2" /><br />
  
    <input type="submit" value="Change Password" name="submit" />
  </form>
 <br />
 <br />
<a href="index.php">Home</a>&nbsp;
 <?php
 
 // Insert the page footer
  require_once('footer.php');
  
	}else{
echo 'YOU HAVE REACHED THIS PAGE IN ERROR<br /><a href="https://www.znoter.com"><img src="images/logo.png" /></a><br />';
echo '<br /><br /><br /><br /><br /><br />';
        require_once('footer.php');
        exit();

}
 ?>