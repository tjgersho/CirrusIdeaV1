<?php
 // Start the session
require_once('../startsession.php');


// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


       $username = $request->username;
      
       $password1 = $request->password1;
         $password2  = $request->password2;
        
        $code =  $request->code;
      // Connect to the database
        require_once('../connectvars.php');
   
  
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // Look up the username and password in the database
       // $query = "SELECT * FROM zusers WHERE username = '" . $user_username . "' AND password = SHA('" . $user_password . "') AND validated != 0";
       // $data = mysqli_query($dbc, $query);


    $status = 'OK';
	
   $errorMsg = array(); 
   
$errorMsg['password_errmsg']   = '';
  
      	  if (!isset($password1) || !isset($password2)) {
	        
	        $errorMsg['password_errmsg'] .= "Fill out both password fields.";
                 $status = 'NOTOK';
	
	  }
	  
	    if (!($password1 == $password2)) {
	        
	       $errorMsg['password_errmsg'] .= "Both password fields must match.";
                 $status = 'NOTOK';
	
	  }
	  
	  
if(isset($code) && $code <10){

$errorMsg['password_errmsg'] .= "There was an error reseting you password.";
$status = 'NOTOK';


}

  if ($status == 'OK'){ 
  
  	    
	if(isset($_SESSION['user_id'])){
	
	 $query = "UPDATE users SET password = SHA('$password1'), validated = 1 WHERE user_id = '".$_SESSION['user_id']. "' AND username = '".$username."'";
		  mysqli_query($dbc, $query);

	  header(' ', true, 200);
	     $returnArray = array();
	     $returnArray['msg'] = 'Thanks for signing up.';
	     
	      $returnArray['username'] = $username;
            
	       
                $jsn = json_encode($returnArray);

	  print_r($jsn);
                 exit();

	}elseif(isset($code)){
	  
	  $query = "SELECT * FROM users WHERE username = '".$username."' AND validated = '".$code."'";
          $data = mysqli_query($dbc, $query);

           if(mysqli_num_rows($data)>0){
               
                 $query1 = "UPDATE users SET password = SHA('$password1'), validated = 1 WHERE username = '".$username."'";
		  mysqli_query($dbc, $query1);

               }else{
                $errorMsg['password_errmsg'] .= "There was an error reseting you password.";
                 $status = 'NOTOK';

               }
	
	}else{
	
	 $errorMsg['password_errmsg'] .= "There was an error reseting you password.";
         $status = 'NOTOK';
      
       }

}
			    			            
         
              
	
         if ( $status == 'NOTOK') {
	        
	        header(' ', true, 400);
		
                $jsn = json_encode( $errorMsg);

	    	
		  print_r($jsn);
                 exit();	     	
	
	  } 
	  


?>