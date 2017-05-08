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

  $payoutdistrib = $request->distribution;
  
  $idea_id = $request->ideaiD;
  

   	
  echo json_encode($payoutdistrib);

$updateOK = true;
  $errorMSG = ''; 
 foreach ($payoutdistrib->contribs as $members){
 $query = "SELECT * FROM users WHERE username = '". $members->member."'";
   $data = mysqli_query($dbc, $query);
   $row = mysqli_fetch_array($data);
   if( $row['collect'] == 1){
   
   $errorMSG = 'HEY ADMIN YOU MUST PAY OUT FROM PAY-LIST FIRST FOR: ' . $member->member;

  $updateOK = false;
   break;
      }
 
 }  
  
 if($updateOK){
 foreach ($payoutdistrib->contribs as $members){
 
  $errorMSG = ''; 
  
  
 echo '   Cash Payment   ' .$members->cashval;
 echo  '  Data    ' .$members->data;
 echo '   Percent   ' .$members->percent;
 echo '   Who:   ' .$members->member;
 
   $query = "SELECT * FROM users WHERE username = '". $members->member."'";
   $data = mysqli_query($dbc, $query);
   $row = mysqli_fetch_array($data);
  
 
   $cashonhand = $row['balance'];

echo '   Cash On Hand    ' . $cashonhand;
$newcash =  $cashonhand + $members->cashval;
echo '    New Cash = ' . $newcash;

	
	echo 'UPDATE  MODEL:';
	   $query = "UPDATE users SET balance = '".$newcash."', collect = '0' WHERE username = '". $members->member."'";
	    mysqli_query($dbc, $query);
	  
	
	 
	  
 
}
 
 $query = "UPDATE ideas SET funds = '0' WHERE file_id = '". $idea_id."'";
	    mysqli_query($dbc, $query);

	 $query = "UPDATE donations SET paid = '1' WHERE idea_id = '". $idea_id."'";
	    mysqli_query($dbc, $query);

 
 } else{
 echo $errorMSG;
  }
 
 echo $idea_id; 	
	    	


?>