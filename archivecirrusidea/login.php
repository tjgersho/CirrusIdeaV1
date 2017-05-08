<?php
 // Start the session
require_once('startsession.php');
require_once('connectvars.php');
   
  // Clear the error message
  $error_msg = "";
  
  $loginpage = $_GET['page'];

  
   if (isset($_GET['anonymous'])){
          $user_username = 'Anonymous';
          $user_password = '123';
          $anonymous = 1;
      }

   
   if (isset($_GET['newlogin'])){
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

     $query44 = "SELECT * FROM cbp_user WHERE username = '" . $_GET['23j3j2livfha'] . "' AND password = SHA('" . $_GET['asu2jasjvh23'] . "')";
     $data44 = mysqli_query($dbc, $query44);
     $row44 = mysqli_fetch_array($data44);

     if (mysqli_num_rows($data44) == 1) {

               $_SESSION['user_id'] = $row44['user_id'];
              $_SESSION['newuser'] = true;
                  $_SESSION['username'] = $row44['username'];
                 setcookie('user_id', $row1['user_id'], time() + (60 * 60 * 24 * 5));    // expires in 30 days
                 setcookie('username', $row1['username'], time() + (60 * 60 * 24 * 5));  // expires in 30 days
    			$browse_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'editpwusername.php';
                header('Location: ' . $browse_url);
                
    } else {
      $error_msg = 'Sorry, your email link is broken.  Send an email to travis.g@cirrusidea.com to get the issue resolved.';
      
    }
  }

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id']) && !isset($_GET['anonymous'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
   
     
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
      
          
      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT * FROM cbp_user WHERE username = '" . $user_username . "' AND password = SHA('" . $user_password . "')";
        $data = mysqli_query($dbc, $query);

        
         
        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
            
                  $_SESSION['user_id'] = $row['user_id'];
                  $_SESSION['username'] = $row['username'];
                      setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 5));    // expires in 30 days
                     setcookie('username', $row['username'], time() + (60 * 60 * 24 * 5));  // expires in 30 days
                                     
                     if ($loginpage != '' && $loginpage != '/index.php') {
                             $browse_url = $loginpage;
                             header('Location: ' . $browse_url);
                         
                     } else {
                         
                             $browse_url = 'http://www.cirrusidea.com/mycreativebrainpower.php';
                             header('Location: ' . $browse_url); 
                     }
          
	    	} else {
		
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in. (Check Caps Lock)';
	
	    	}
        
        
        
        
        
      }
      else {
	
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';

	  }
    }
}else if ($anonymous == 1 &&  !isset($_SESSION['user_id'])){
         $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
          $user_username = 'Anonymous';
          $user_password = '123';
      
          $loginpage = $_GET['page'];
         
        // echo $loginpage;
         
        $query = "SELECT * FROM cbp_user WHERE username = '" . $user_username . "' AND password = SHA('" . $user_password . "')";
        $data = mysqli_query($dbc, $query);
         $row = mysqli_fetch_array($data);
            
                  $_SESSION['user_id'] = $row['user_id'];
                  $_SESSION['username'] = $row['username'];
                     setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 5));    // expires in 30 days
                     setcookie('username', $row['username'], time() + (60 * 60 * 24 * 5));  // expires in 30 days


    				if ($loginpage != '' && $loginpage != '/index.php') {
                             $browse_url = $loginpage;
                             header('Location: ' . $browse_url);
                         
                     } else {
                         
                             $browse_url = 'http://www.cirrusidea.com/mycreativebrainpower.php';
                             header('Location: ' . $browse_url);
                     }
			       
 
  }elseif(isset($_SESSION['user_id']) && isset($loginpage)){
     
          if ($loginpage != '' && $loginpage != '/index.php' ) {
                             $browse_url = $loginpage;
                      header('Location: ' . $browse_url);
          }
  }elseif(isset($_SESSION['user_id'])){
     
          $browse_url = 'http://www.cirrusidea.com/mycreativebrainpower.php';
                             header('Location: ' . $browse_url);
  }

  // Insert the page header
 $page_title = 'Log In';
  require_once('header.php');

  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (!isset($_SESSION['user_id'])) {
   echo '</div>';
    echo '<div id="fillcontent">';
	echo('<p>' . $error_msg . '</p>');

?>

<div style="display:block; float:left; width:600px; margin-left:50px;">
 <p>Log In: </p>
<table><tr><td>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; echo '?page='; echo $loginpage; ?>">
   
     <label for="username"><b>Username: </b></label></td><td>
      <input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" /></td></tr>
    <tr><td><label for="password"><b>Password: </b></label></td><td>
    <input type="password" name="password" /></td></tr><tr><td></td><td>
  <input type="submit" value="Log In" name="submit" /></td></tr></table>
 </form>
<br /><br />
<a href="index.php">Home</a>&nbsp;<a href="signup.php">Create an Account</a>
<br /><br /><br /><br />
</div>



<div style="display:block; width:500px; height:300px; float:left;">
<img src="http://www.znoter.com/images/geek1.png" />
</div>


<?php
  }
  else {
 
    // Confirm the successful log-in
	require_once('navmenu.php');
    echo '<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>';
	echo '</br></br></br>';
    echo '<a href="http://www.cirrusidea.com">Home</a>';
    echo '</br></br></br>';
  
    
  }

  // Insert the page footer
  require_once('footer.php');
?>
