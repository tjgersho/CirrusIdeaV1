<?php

 // Start the session
require_once('../startsession.php');
//require_once('connectvars.php');
   
  // Clear the error message
  $error_msg = "";
  
  
 //$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}

if(isset($request->userid)){
  if($request->userid == 1){
echo 12;
  }else{
  echo 100;
  }

}else{

$code =   $request->code;

switch($code){
case 'Attitude':
$totalpages = 26;

break;


default:
 $totalpages = 2;

}

echo $totalpages;
}

?>