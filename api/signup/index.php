<?php
 // Start the session
require_once('../startsession.php');


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


// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


       $username = $request->newuser->username;
       $password1 = $request->newuser->password1;
         $password2  = $request->newuser->password2;
         $email = $request->newuser->email;
         $captcha = $request->newuser->captcha;
   $privateprof = $request->newuser->privateprof;

    
 
      // Connect to the database
        require_once('../connectvars.php');
   
  
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // Look up the username and password in the database
       // $query = "SELECT * FROM zusers WHERE username = '" . $user_username . "' AND password = SHA('" . $user_password . "') AND validated != 0";
       // $data = mysqli_query($dbc, $query);


    $status = 'OK';
	
   $errorMsg = array(); 
   
$errorMsg['username_errmsg']  = '';

$errorMsg['password_errmsg']   = '';

$errorMsg['email_errmsg']  = '';

$errorMsg['captcha_errmsg']  = '';
   
	   if (!isset($username)) {
                 $errorMsg['username_errmsg'] .= "You must a username.";
                 $status = 'NOTOK';
	     }
    
    
    	   if (!isset($password1) || !isset($password2)) {
	        
	        $errorMsg['password_errmsg'] .= "Fill out both password fields.";
                 $status = 'NOTOK';
	
	  }
	  
	    if (!($password1 == $password2)) {
	        
	       $errorMsg['password_errmsg'] .= "Both password fields must match.";
                 $status = 'NOTOK';
	
	  }
	  
	if (!isset($email)) {
	        
	          $errorMsg['email_errmsg'] .= "You must enter your email.";
                 $status = 'NOTOK';

	     }

	  
	  if (!isset($username) || !isset($password1) || !isset($password2)) {
	        
	          $errorMsg['password_errmsg'] .= "You must enter both username and both password filds.  The passwords must match.";
                 $status = 'NOTOK';

	     }
	     
      if(empty($_SESSION['6_letters_code'] ) ||   strcasecmp($_SESSION['6_letters_code'], $captcha) != 0)   {     
           
          $errorMsg['captcha_errmsg'] .= 'The captcha code does not match.';  
          $status= 'NOTOK';
          
          }   
    
	 

	if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
	{ // checking your email
        
          $errorMsg['email_errmsg'] .=  "Your email address was not entered correctly.";
        $status= 'NOTOK';
        } 


              $domain = substr(strstr($email, "@"),1);

        if (!checkdnsrr($domain)){
               
              $errorMsg['email_errmsg'] .=  'Your email address was not entered correctly';
             $status= 'NOTOK';
            }

    if(isset($username) && isset($email)){
      // Make sure someone isn't already registered using this username
		             $query = "SELECT * FROM users WHERE username = '".$username."'";
		             $data = mysqli_query($dbc, $query);
		              
		               if (mysqli_num_rows($data) > 0) {  //Make sure username is unique
			             
			              

		         $errorMsg['username_errmsg'] .=  'An account already exists for that username. Please use a different username.';
		 $status = 'NOTOK';
                                  }

		                // Make sure someone isn't already registered using this username
		              $query1 = "SELECT * FROM users WHERE  email = '".$email."'";
		              $data1 = mysqli_query($dbc, $query1);
		      
		      
		             if (mysqli_num_rows($data1) > 0) {  //Make sure email is unique
		             
                        $errorMsg['email_errmsg']  .=  'An account already exists for that email. Please use a different email.';
		        $status = 'NOTOK';
			           
			                                              		      
		         }
		         
		      }
		      



	  if ($status == 'OK'){ 
  $privateprof = 0;
			    			              $code = mt_rand(10,99999);
			           
			           
			  $query = "INSERT INTO users (username, password, join_date, email, mailme, cred, validated, privateprofile) VALUES" .
			              " ('".$username."', SHA('$password1'), NOW(), '".$email."', 1, 0, '".$code."', '".$privateprof."')";
			           mysqli_query($dbc, $query);
			                             
			 

 require_once("../Classes/CirrusEmail.php");
        
     //Create a new PHPMailer instance
       $signupemail = new CirrusEmail('introEmailValidation',  $username);
$injectArray = array();
$injectArray['email'] = $email;
$injectArray['username'] = $username;
$injectArray['code'] = $code;
$signupemail->getEmail($injectArray);
                        $toA = array();
			$toA['email'] = $email;
                        $toA['name'] = $username;
                   
                        
                        $fromA = array();
			$fromA['email'] = 'webmaster@cirrusidea.com';
                        $fromA['name'] = 'CirrusIdea';
 $signupemail->sendEmail($toA, $fromA);



			  
		
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
			
			
			 
//$getemail = str_replace ("@", "xxyyyatsym", $email);

//$message = '
// <html>
// <head>
// <title>Email - Confirmation</title>
// </head>
// <body>
// <p><br /><br />' .
// $username . 
// '&nbsp;<br />Please confirm your email address by clicking the link below: <br /><br />' .
//  '<a href="https://www.znoter.com/cirrusidea/#/emailverification/user/' .  $username .'/email/' . $getemail .'/code/'.$code.'" target="_blank"><div style="display:block; width:200px; height:50px; //background-color:#C0FFC0; text-align:center;">Confirm Email</div></a>' .
 //'</p>' .
// '<p>If the link is not working copy and paste this link into your browser: </p><br />' .
// 'https://www.znoter.com/cirrusidea/#/emailverification/user/' .  $username .'/email/' . $getemail .'/code/'.$code.'<br /><br />' . 
// '<br /><a href="https://www.znoter.com/cirrusidea/" target="_blank">'.
// '<img src="cid:cirrusidealogo" height="30" width="40" alt="Cirrusidea Logo" /></a><br /><br /><br /><br /></body></html>';
 

 
 
// require_once("../../phplib/class.phpmailer.php");

//Create a new PHPMailer instance
//Passing true to the constructor enables the use of exceptions for error handling
//$mail = new PHPMailer(true);


//    //Set who the message is to be sent from
 //   $mail->setFrom("webmaster@cirrusidea.com", "CirrusIdea");
  //
 
    //Set who the message is to be sent to
 ///   $mail->addAddress($email, $username);
    //Set the subject line
 //   $mail->Subject = "CirrusIdea - User Confirmation";
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //and convert the HTML into a basic plain-text alternative body
  


 //   $mail->msgHTML($message);


  //  $mail->AltBody = $message;


       
     
  //    $mail->AddEmbeddedImage('../../images/cirrusidealogo.png', "cirrusidealogo", 'logo.png');
     
     
    //send the message
    //Note that we don't need check the response from this because it will throw an exception if it has trouble
 //   $mail->send();
   

		 
		
		
		  
		      

   	
  
    
		}

         
              
	
         if ( $status == 'NOTOK') {
	        
	        header(' ', true, 400);
		
                $jsn = json_encode( $errorMsg);

	    	
		  print_r($jsn);
                 exit();	     	
	
	  } else{
	  
	  header(' ', true, 200);
	     $returnArray = array();
	     $returnArray['msg'] = 'Thanks for signing up.';
	     
	      $returnArray['username'] = $username;
            
	       
                $jsn = json_encode($returnArray);

	  print_r($jsn);
                 exit();
	  
	  }

	  


?>