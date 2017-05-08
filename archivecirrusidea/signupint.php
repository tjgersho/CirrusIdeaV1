<?php
require_once('startsession.php');

                //login the new user....
          $username = $_GET['loginusername'];
                
      
                //If logged in as Anonymous then logout from anonymous..
                

                   if ($_SESSION['username']='Anonymous'){
                     // If the user is logged in, delete the session vars to log them out
 
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

                   $signupint_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']).'/signupint.php?loginusername = '.$username;
                  header('Location: ' . $signupint_url);

                    	}
              
                        
     
        
        
               
     
          
                   
           require_once('appvars.php');
  require_once('connectvars.php');
          // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

              $query23 = "SELECT * FROM cbp_user WHERE username = '$username'";
              $data23 = mysqli_query($dbc, $query23);
                $row23 = mysqli_fetch_array($data23);
     
      
      
                $_SESSION['user_id'] = $row['user_id'];
                  $_SESSION['username'] = $username;
                      setcookie('user_id', $row23['user_id'], time() + (60 * 60 * 24 * 5));    // expires in 30 days
                     setcookie('username', $username, time() + (60 * 60 * 24 * 5));  // expires in 30 days
                     
        $signupcomplete_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']).'signupcomplete.php';
        header('Location: ' . $signupcomplete_url);

                    
                
  

?>
