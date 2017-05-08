<?php
  // Start the session
  require_once('startsession.php');
$headdersent = false;

  require_once('appvars.php');
  require_once('connectvars.php');

   if (!isset($_SESSION['user_id'])) {

    echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  }

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {

    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));



	if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2) ) {  //Make sure all data is entered.
       
  
	    // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM cbp_user WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
         // Make sure someone isn't already registered using this username
         
      
      if (mysqli_num_rows($data) == 0) {  //Make sure username is unique
        // The username is unique, so insert the data into the database
        $query1 = "UPDATE cbp_user SET username = '" . $username . "', password = SHA('" . $password1 . "'), validated = 1 WHERE user_id = '" .  $_SESSION['user_id'] . "'";
        mysqli_query($dbc, $query1);

              
              $oldusername = $_SESSION['username'];
              
              //Update username session variable
                  $_SESSION['username'] = $username;
                 setcookie('username', $username, time() + (60 * 60 * 24 * 5));  // expires in 30 days
                 
             //update codevelopernames 
             
             $query33 = "UPDATE codevelopers SET member = '" . $username . "'WHERE member = '" .  $oldusername . "'";
             mysqli_query($dbc, $query33);
             
              $query33 = "UPDATE codevelopers SET codeveloper = '" . $username . "'WHERE codeveloper = '" .  $oldusername . "'";
             mysqli_query($dbc, $query33);
             
             //update developervote....
             
                $query33 = "UPDATE developervote SET developer_name = '" . $username . "'WHERE developer_name = '" .  $oldusername . "'";
             mysqli_query($dbc, $query33);
             
             
             //update folderprivacy....
              $query33 = "UPDATE folderprivacy SET  user_name = '" . $username . "'WHERE  user_name = '" .  $oldusername . "'";
             mysqli_query($dbc, $query33);
            
             
              //update uploadprivacy....
             
              $query33 = "UPDATE uploadprivacy SET  user_name = '" . $username . "'WHERE  user_name = '" .  $oldusername . "'";
             mysqli_query($dbc, $query33);
             
             
              //update comment///
              $query33 = "UPDATE comment SET  to_member_name = '" . $username . "'WHERE  to_member_name = '" .  $oldusername . "'";
             mysqli_query($dbc, $query33);
              

     $query = "SELECT * FROM cbp_user WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);

  $page_title = 'Sign Up';

  require_once('header.php');

       echo '</div>';
        // Confirm success with the user
        echo '<div id="fillcontent">';
        
		echo '<p>Your username and password have been updated.<br />';

		echo '<br /><a href="mycreativebrainpower.php">Home</a><br /><br /><br /><br /><br />';

	
	 // Insert the page footer
  require_once('footer.php');
 
 
	
	mysqli_close($dbc);


	
        exit();
      }else {  //Account already exists
        // An account already exists for this username, so display an error message
          $page_title = 'Sign Up';

  require_once('header.php');
$headdersent = true;
		echo '</div>';
        echo '<div id="fillcontent">';
        echo '<p class="error">An account already exists for that username. Please use a different username.</p>';

        $username = "";
      }
      
              
      
      
		}else { //All data isn't set
          $page_title = 'Sign Up';

  require_once('header.php');
$headdersent = true;
    echo '</div>';
        echo '<div id="fillcontent">';
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
	  
    }
  
  
}


  mysqli_close($dbc);
    $page_title = 'Sign Up';
if (!$headerset) {
     require_once('header.php');
}
 

?>
</div>
<div id="fillcontent">
<div style="position:relative; left:50px;">
  <p>Please enter your <b style="font-size:30px;">new</b> username and password for your Cirrus Idea account.</p>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <table><tr><td>
      <label for="username">Username:</label></td>
      <td><input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /></td></tr>
      <tr><td><label for="password1">Password:</label></td>
      <td><input type="password" id="password1" name="password1" /></td></tr>
      <tr><td><label for="password2">Password (retype):</label></td>
      <td><input type="password" id="password2" name="password2" /></td></tr>
	


 <tr><td></td><td>

    <input type="submit" value="Update Profile" name="submit" />
  
</td></tr>
</table>
</form>
 <br />
 <br />
 <br />
 <br />
</div>

<?php
  // Insert the page footer
  require_once('footer.php');
?>
