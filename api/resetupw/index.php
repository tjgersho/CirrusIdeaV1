<?php
 // Start the session
require_once('../startsession.php');


    

// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


       $username = $request->username;
       $useremail = $request->useremail;
       
       $getusername = $request->getusername;
       $resetpassword = $request->resetpassword;
       
      // Connect to the database
        require_once('../connectvars.php');
   
  
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // Look up the username and password in the database
        

    $status = 'OK';
	
   $errorMsg = array(); 
   
$errorMsg['email_errmsg']  = '';

$errorMsg['username_errmsg']   = '';

 
if(!isset($useremail) && $getusername == 1){ 

 $errorMsg['email_errmsg'] .= "You must enter your email associated with your cirrusidea account.  ";
  $status = 'NOTOK';
}
   

if(!isset($username ) && $resetpassword == 1){ 

 $errorMsg['email_errmsg'] .= "You must enter your email associated with your cirrusidea account.  ";
 $status = 'NOTOK';
  
}   
   
    
  if($resetpassword == 1){ //// Get email link to reset password
	    $query = "SELECT * FROM users WHERE username = '" . $username. "'";
	    $data = mysqli_query($dbc, $query);	
	    if(mysqli_num_rows($data)<1){
	        $errorMsg['username_errmsg']   = 'There is not a CirrusIdea account with that username.  ';
	       $status = 'NOTOK';
	    }else{
	    $row = mysqli_fetch_array($data);
	    $sendEmail = $row['email'];
	    }
   }
   
   if($getusername == 1){  

   if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",  $useremail))
	{ // checking your email
        
          $errorMsg['email_errmsg'] .=  "Your email address was not entered correctly.  ";
        $status= 'NOTOK';
        }else{


              $domain = substr(strstr( $useremail, "@"),1);

        if (!checkdnsrr($domain)){
               
              $errorMsg['email_errmsg'] .=  'Your email address was not entered correctly.  ';
             $status= 'NOTOK';
             
            }
            
          $query = "SELECT * FROM users WHERE email = '" .  $useremail. "'";
	    $data = mysqli_query($dbc, $query);	
	    if(mysqli_num_rows($data)<1){
	       $errorMsg['email_errmsg'] .=  'There is not a CirrusIdea account with that email.  ';
             $status= 'NOTOK';
	    }else{
	    $row = mysqli_fetch_array($data);
	    $username = $row['username'];
	    $sendEmail = $useremail;
	    }
   
       }
   }
   

 
	  if ($status == 'OK'){ 
	  
	   
              if($resetpassword == 1){
  
			  $code = mt_rand(10,99999);
        
			  $query = "UPDATE users SET validated = '".$code."' WHERE user_id = '".$row['user_id']."'";
			         mysqli_query($dbc, $query);

						
			
			 
			 require_once("../Classes/CirrusEmail.php");
        
     //Create a new PHPMailer instance
       $resetemail = new CirrusEmail('resetPassword',  $username, $row['user_id']);
$injectArray = array();
$injectArray['email'] = $sendEmail;
$injectArray['username'] = $username;
$injectArray['code'] = $code;
$resetemail->getEmail($injectArray);
                        $toA = array();
			$toA['email'] = $sendEmail;
                        $toA['name'] = $username;
                   
                        
                        $fromA = array();
			$fromA['email'] = 'webmaster@cirrusidea.com';
                        $fromA['name'] = 'CirrusIdea';
 $resetemail->sendEmail($toA, $fromA); 
			 
			  
						   
			
		   }
		
		if($getusername == 1){ 
			
					
			 
			 require_once("../Classes/CirrusEmail.php");
        
     //Create a new PHPMailer instance
       $resetemail = new CirrusEmail('getUsername',  $username, $row['user_id']);
	$injectArray = array();
	$injectArray['email'] = $sendEmail;
	$injectArray['username'] = $username;
	
	$resetemail->getEmail($injectArray);
	               $toA = array();
			$toA['email'] = $sendEmail;
                        $toA['name'] = $username;
                   
                        
                        $fromA = array();
			$fromA['email'] = 'webmaster@cirrusidea.com';
                        $fromA['name'] = 'CirrusIdea';
               $resetemail->sendEmail($toA, $fromA); 
			 
			  
		
		}
		  
		      

   	
  
    
              }

         
              
	
         if ( $status == 'NOTOK') {
	        
	        header(' ', true, 400);
		
                $jsn = json_encode( $errorMsg);

	    	
		  print_r($jsn);
                 exit();	     	
	
	  } else{
	  
	  header(' ', true, 200);
	     $returnArray = array();
	     $returnArray['msg'] = 'Get/Reset Went Good.';
	     
       
                $jsn = json_encode($returnArray);

	  print_r($jsn);
                 exit();
	  
	  }

	  


?>