<?php

 // Start the session
require_once('../startsession.php');
require_once('../connectvars.php');
   
if(!isset($_SESSION['username'])){

header(' ', true, 400);
	    	$arr = array('msg' => "User Does not Exist" . $_SESSION['username'] .' != '. $username .' && ' . $_SESSION['user_id'] .' != '.  $user_id, 'error' => '');
                $jsn = json_encode($arr);
		  print_r($jsn);
                  exit();

}  

 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


$user_id = $request->user_id;
$username = $request->username;



if($_SESSION['username'] == $username && $_SESSION['user_id'] == $user_id){
         
         $first_name = $request->first_name;
         $last_name = $request->last_name;
         $paypalEmail = $request->paypalemail;
         $amount = $request->amount;
       
       $status= 'OK';
       
	if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $paypalEmail))
	{ // checking your email
        
          $errorMsg['paypalemail_errmsg'] .=  "Your email address was not entered correctly.";
        $status= 'NOTOK';
        } 


              $domain = substr(strstr($paypalEmail, "@"),1);

        if (!checkdnsrr($domain)){
               
              $errorMsg['paypalemail_errmsg'] .=  "Your email address was not entered correctly.";
             $status= 'NOTOK';
            }

       if($status == 'OK'){
       
       
           $query = "UPDATE users SET first_name ='".$first_name."', last_name = '".$last_name."', paypalemail = '".
           $paypalEmail."', collect = '1' WHERE user_id = '".$user_id."'";
           mysqli_query($dbc, $query);
           
        

           $query = "INSERT INTO paylist (requestdate, user_id, username, amount) VALUES (NOW(), '".$user_id."', '".$username."', '".$amount."')";
           
           
            mysqli_query($dbc, $query);
           
           echo 'Collection Successful!';
        
         }else{
         
                  header(' ', true, 400);
	         $jsn = json_encode($errorMsg);
		  print_r($jsn);
                  exit();
         
         }
      
     }else{
         
            header(' ', true, 400);
	    	$arr = array('msg' => "User Does not Exist" . $_SESSION['username'] .' != '. $username .' && ' . $_SESSION['user_id'] .' != '.  $user_id, 'error' => '');
                $jsn = json_encode($arr);
		  print_r($jsn);
                  exit();
         
         
         }

                          
?>