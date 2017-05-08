<?php

 // Start the session
require_once('../../startsession.php');
require_once('../../connectvars.php');
if($_SESSION['username'] != 'tjgersho'){
exit();

}   
  
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}

$distribute = $request->distribute;
$amount = $request->amount;
$username = $request->who;
$user_id = $request->userID;
$paylist_id = $request->PayListID;

if($distribute == 1){

 $query = "SELECT * FROM users WHERE username = '".$username."' AND user_id = '".$user_id ."'";
  $data = mysqli_query($dbc, $query);
              

$row = mysqli_fetch_array($data);

if($amount == $row['balance']){
  
  ////////Now update this user balance to 0, update collect to 0 and add in the paidtotal column.
  //////Don't forget to acutally pay this person!///////////
  
  $paidtotal = $row['paidtotal'];
  $newpaidtotal = $paidtotal + $amount;
  
  $query = "UPDATE users SET balance = 0, collect = 0, paidtotal = '". $newpaidtotal."' WHERE username = '".$username."' AND user_id = '".$user_id ."'";
  mysqli_query($dbc, $query);
  
  $paydate =  date("Y-m-d H:i:s");
  $query = "UPDATE paylist SET paydate = '".$paydate."' WHERE paylist_id = '".$paylist_id ."'";
           
           
            mysqli_query($dbc, $query);


////////Email Something to the person ! ///////////////
require_once("../../Classes/CirrusEmail.php");



//Create a new PHPMailer instance
       $paymentEmail = new CirrusEmail('paymentEmail',  $username, $user_id);

$injectArray = array();
$injectArray['amount'] = $amount;
$injectArray['username'] = $username;

 $paymentEmail->getEmail($injectArray);
                        $toA = array();
                 
			$toA['email'] = $row['email'];
			
                        $toA['name'] = $username;
                   
                        
                        $fromA = array();
			$fromA['email'] = 'cirrusidea@cirrusidea.com';
                        $fromA['name'] = 'CirrusIdea';
  $paymentEmail->sendEmail($toA, $fromA); 
	


 header(' ', true, 200);
                $arr = array('msg' =>  'Success, Email sent to ' . $row['email'] , 'error' => '');
                $jsn = json_encode($arr);

                print_r($jsn);
              exit();


}else{

header(' ', true, 400);
	    	$arr = array('msg' => "Something went wrong.. This member does not have the right balance", 'error' => '');
                $jsn = json_encode($arr);

	    	
		  print_r($jsn);
               exit();

}
}else{
   	
  $query = "SELECT * FROM paylist ORDER BY requestdate DESC";
  $data = mysqli_query($dbc, $query);
              
$payList = array();
	$i = 0;	
while($row = mysqli_fetch_array($data)){
$payList[$i]['paylist_id'] = $row['paylist_id'];
$payList[$i]['requestdate'] = $row['requestdate'];
$payList[$i]['paydate'] = $row['paydate'];
$payList[$i]['user_id'] = $row['user_id'];
$payList[$i]['username'] = $row['username'];
$payList[$i]['amount'] = $row['amount'];


   $query1 = "SELECT * FROM users WHERE user_id = '". $row['user_id'] ."'";
   $data1 = mysqli_query($dbc, $query1);
   $row1 = mysqli_fetch_array($data1);


$payList[$i]['paypalemail'] = $row1['paypalemail'];


 $i++;    
 }
  

echo json_encode($payList);
}    	
	    	


?>