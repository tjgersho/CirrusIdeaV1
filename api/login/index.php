<?php
 // Start the session
 session_start();
 
//require_once('../startsession.php');
require_once('../connectvars.php');
   
  
  
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


      $user_username = $request->username;
      $user_password = $request->password;
      

   
  // If the user isn't logged in, try to log them in
 //if (isset($_SESSION['user_id'])) {
      // Delete the session vars by clearing the $_SESSION array
   //   $_SESSION = array();

      // Delete the session cookie by setting its expiration to an hour ago (3600)
//      if (isset($_COOKIE[session_name()])) {      setcookie(session_name(), '', time() - 3600);    }
  //     unset($_SESSION);
    //  $_SESSION= NULL; 
       // Destroy the session
      //  session_destroy();
    
       

      // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
//      setcookie('user_id', '', time() - 3600);
  //    setcookie('username', '', time() - 3600);
    //  setcookie('newuser', '', time() - 3600);
      // }



    if (isset($user_username ) && isset($user_password)) {
      // Connect to the database
     
        // Look up the username and password in the database
        $query = "SELECT * FROM users WHERE username = '" . $user_username . "' AND password = SHA('" . $user_password . "') AND validated < 10 AND validated != 0";
        $data = mysqli_query($dbc, $query);

            if (mysqli_num_rows($data) == 1) {

 
                // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
           
                 $_SESSION['user_id'] = $row['user_id'];
                  $_SESSION['username'] = $row['username'];
                      setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 5));    // expires in 30 days
                     setcookie('username', $row['username'], time() + (60 * 60 * 24 * 5));  // expires in 30 days
                                               
                                         
                                                   
                 header(' ', true, 200);
                 $successLoginMsg = "login Successful - Username ".$row['username']. "  User_id " .$row['user_id'];
                   $successLoginMsg .= "   Session Username " .$_SESSION['username'] ;
                   $successLoginMsg .= "Session User_ID " .  $_SESSION['user_id'];
                    $successLoginMsg .= "         Login!";
	        $arr = array('msg' =>  $successLoginMsg, 'error' => '');
                $jsn = json_encode($arr);

                print_r($jsn);
              exit();

			       
          
	    	} else {
	    	 $query = "SELECT * FROM users WHERE username = '" . $user_username . "' AND password = SHA('" . $user_password . "') AND validated > 10 AND validated != 0";
                 $data = mysqli_query($dbc, $query);

            if (mysqli_num_rows($data) == 1){ 
	    	header(' ', true, 400);
	    	$arr = array('msg' => "You must verify your email with the email sent to you or you must <a href='/resetupw'>reset</a> your password.", 'error' => '');
                $jsn = json_encode($arr);

	    	
		  print_r($jsn);
               exit();
	    	
	    	}else{
	    	header(' ', true, 400);
	    	$arr = array('msg' => "You did not enter the correct username and/or password", 'error' => '');
                $jsn = json_encode($arr);

	    	
		  print_r($jsn);
               exit();
               }

            
	    	}
        
        
	      } else {
	        
	        header(' ', true, 400);
		$arr = array('msg' => "You must enter both username and password", 'error' => '');
                $jsn = json_encode($arr);

	    	
		  print_r($jsn);
                 	     	
	exit();

	  }
	  
     

?>