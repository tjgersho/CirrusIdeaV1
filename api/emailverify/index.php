<?php

  
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

   
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

  $newusername = $request->user;
  $newuseremail = $request->email;
  $code = $request->code;
  $verify = $request->verifyit;
  $re_send = $request->re_send;
  
  
if(  $verify == 1){
  $newuseremail = str_replace('xxyyyatsym', '@', $newuseremail);
  

 $query = "SELECT * FROM users WHERE username = '".$newusername."' AND email = '".$newuseremail."' AND validated = '".$code."'";
 $data =  mysqli_query($dbc, $query);
   
   
		 if(mysqli_num_rows($data)==1){ 
		 
		 	$row = mysqli_fetch_array($data);
		 	  
		           $query = "UPDATE users SET validated = 1 WHERE user_id = '".$row ['user_id']."'"; 
		           			
                           mysqli_query($dbc, $query);
			 echo "Your email has been verified and your account is active. <br /><br/ ><a class='btn btn-success btn-xl' href='/login'>Login</a>";
			 exit();
			}else{
			
			
		header(' ', true, 400);
	    	$arr = array('msg' => "There was an error in verifying your email address.", 'error' => '');
                $jsn = json_encode($arr);

	    	
		print_r($jsn);
               exit();

			
   }
   
   }elseif($re_send  == 1){
   $decodeduseremail = str_replace('xxyyyatsym', '@', $newuseremail);
    $query = "SELECT * FROM users WHERE username = '".$newusername."' AND email = '".$decodeduseremail ."'";
    $data =  mysqli_query($dbc, $query);
    if(mysqli_num_rows($data)==1){ 
    $row = mysqli_fetch_array($data);
    
    $code = mt_rand(10,99999);
    $query = "UPDATE users SET validated = '". $code."' WHERE user_id = '".$row ['user_id']."'"; 
    mysqli_query($dbc, $query);
   
      

  		$email = 	$decodeduseremail;
		$username = 	$newusername;
			 
$getemail = str_replace ("@", "xxyyyatsym", $email);

$message = '
 <html>
 <head>
 <title>Email - Confirmation</title>
 </head>
 <body>
 <p><br /><br />' .
 $username . 
 '&nbsp;<br />Please confirm your email address by clicking the link below: <br /><br />' .
  '<a href="http://cirrusidea.com/#!/emailverification/user/' .  $username .'/email/' . $getemail .'/code/'.$code.'" target="_blank"><div style="display:block; width:200px; height:50px; background-color:#C0FFC0; text-align:center;">Confirm Email</div></a>' .
 '</p>' .
 '<p>If the link is not working copy and paste this link into your browser: </p><br />' .
 'http://cirrusidea.com/#!/emailverification/user/' .  $username .'/email/' . $getemail .'/code/'.$code.'<br /><br />' . 
 '<br /><a href="http://cirrusidea.com/" target="_blank">'.
 '<img src="cid:cirrusidealogo" height="30" width="40" alt="Cirrusidea Logo" /></a><br /><br /><br /><br /></body></html>';
 

 
 
 require_once("../../phplib/class.phpmailer.php");

//Create a new PHPMailer instance
//Passing true to the constructor enables the use of exceptions for error handling
$mail = new PHPMailer(true);


    //Set who the message is to be sent from
    $mail->setFrom("webmaster@cirrusidea.com", "CirrusIdea");
  
 
    //Set who the message is to be sent to
    $mail->addAddress($email, $username);
    //Set the subject line
    $mail->Subject = "CirrusIdea - User Confirmation";
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //and convert the HTML into a basic plain-text alternative body
  


    $mail->msgHTML($message);


    $mail->AltBody = $message;


       
     
      $mail->AddEmbeddedImage('../../images/cirrusidealogo.png', "cirrusidealogo", 'logo.png');
     
     
    //send the message
    //Note that we don't need check the response from this because it will throw an exception if it has trouble
    $mail->send();
   

		 
		echo 'Your Verification Email has been sent to: '. $email . '. <br /> This window will close now ';
		




     }else{
     
            header(' ', true, 400);
	    	$arr = array('msg' => "There was an error in sending your confirmation email. You may need to <a class='btn btn-warning' href='#!/signup'>re-signup</a>", 'error' => '');
                $jsn = json_encode($arr);

	    	
		print_r($jsn);
               exit();

     }
     
     
     
   }
			       			          
 
?>

