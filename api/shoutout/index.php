<?php
 // Start the session
require_once('../startsession.php');


// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


   
         $email = $request->shoutOutemail;
        
    $message = $request->shoutOutmsg;
 
  $captcha = $request->shoutOutcaptcha;
  
   $yourname = $request->shoutOutyourname;

 $youremail = $request->shoutOutyouremail;

  

  
  // Connect to the database
        require_once('../connectvars.php');
   
  
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
       

    $status = 'OK';
	
   $errorMsg = array(); 
   
$errorMsg['username_errmsg']  = '';

$errorMsg['password_errmsg']   = '';

$errorMsg['email_errmsg']  = '';

$errorMsg['captcha_errmsg']  = '';

$errorMsg['yourname_errmsg']  = '';

$errorMsg['youremail_errmsg']  = '';
		  
		  
		  
	if (empty($email)) {
	        
	          $errorMsg['email_errmsg'] .= "You must enter your email.";
                 $status = 'NOTOK';

	     }else{
	     
	    if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) { // checking your email
        
          $errorMsg['email_errmsg'] .=  "Your frineds email address was not entered correctly.";
        $status= 'NOTOK';
        } 


              $domain = substr(strstr($email, "@"),1);

        if (!checkdnsrr($domain)){
               
              $errorMsg['email_errmsg'] .=  'Your friends email address was not entered correctly';
             $status= 'NOTOK';
            }


	     
	     }

	  
	 	     
      if(empty($_SESSION['6_letters_code'] ) ||   strcasecmp($_SESSION['6_letters_code'], $captcha) != 0)   {     
           
          $errorMsg['captcha_errmsg'] .= 'The captcha code does not match.';  
          $status= 'NOTOK';
          
          }   
    
	if(!isset($_SESSION['username']) && empty($yourname)){
	 	
	 	
	 	
	}

	if(!isset($_SESSION['username']) && empty($youremail)){
	 $errorMsg['yourname_errmsg'] .=  'You must enter your name';
             $status= 'NOTOK';

	
	}elseif( !isset($_SESSION['username'])){
	 
	 $domain = substr(strstr($youremail, "@"),1);

        if (!checkdnsrr($domain)){
               
            
             $errorMsg['youremail_errmsg'] .=  'Your email address was not entered correctly';
             $status= 'NOTOK';

            }elseif(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $youremail)) { // checking your email
       
	      $errorMsg['youremail_errmsg'] .=  'Your email address was not entered correctly';
             $status= 'NOTOK';
           }

	}
	 


	  if ($status == 'OK'){ 
  
			    $code = mt_rand(10,99999);
			           
			           
			  $query = "INSERT INTO shoutout (msg, post_member_id, to_email, your_name, your_email) VALUES" .
			              " ('".$message."', '".$_SESSION['user_id']. "', '".$email."', '".$yourname."', '".$youremail."')";
			           mysqli_query($dbc, $query);
			                             
	if(isset($_SESSION['user_id'])){  
                       $query = "SELECT email, username FROM users WHERE user_id  = '". $_SESSION['user_id']."'";
                       $data = mysqli_query($dbc, $query);
                       $row= mysqli_fetch_array($data); 

			$loggedinemail = $row['email'];
                        $loggedinname = $row['username'];;
                        }
		 
require_once("../Classes/CirrusEmail.php");
		$shoutoutEmail = new CirrusEmail('shoutoutEmail');
 
if(isset($loggedinname)){
$injectArray['yourname'] = $loggedinname;
}else{
$injectArray['yourname'] = $yourname;
}

$injectArray['msg'] = $message;
$shoutoutEmail->getEmail($injectArray);
                        $toA = array();
			$toA['email'] = $email;
                        $toA['name'] = '';
                   
                        
                        $fromA = array();
                      if(isset($_SESSION['user_id'])){  
                       $query = "SELECT email, username FROM users WHERE user_id  = '". $_SESSION['user_id']."'";
                       $data = mysqli_query($dbc, $query);
                       $row= mysqli_fetch_array($data); 

			$fromA['email'] = $row['email'];
                        $fromA['name'] = $row['username'];;
                        }else{
                        $fromA['email'] = $youremail;
                        $fromA['name'] = $yourname;
                        
                        }
 $shoutoutEmail->sendEmail($toA, $fromA); 	
			 
	   
  }

         
              
	
         if ( $status == 'NOTOK') {
	        
	        header(' ', true, 400);
		
                $jsn = json_encode( $errorMsg);

	    	
		  print_r($jsn);
                 exit();	     	
	
	  } else{
	  
	  header(' ', true, 200);
	     $returnArray = array();
	     $returnArray['msg'] = 'Thanks Giving a Shout Out!.';
	     
	                 
	       
                $jsn = json_encode($returnArray);

	  print_r($jsn);
                 exit();
	  
	  }

	  


?>