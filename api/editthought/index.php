<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(!isset($_SESSION['user_id'])){
exit();
}

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $thought_id = $request->thought_id;
  $headline = $request->headline;
   echo '     PASSED IN      ' .$headline;
 $headline = str_replace('HTTPPROTOCOL234234', 'http://',  $headline);
 echo '     HTTP REPLACE      ' .$headline;
 
   $headline = str_replace('HTTPPROTOCOLsss234234', 'https://',  $headline);
   echo '     HTTPS REPLACE      ' .$headline;
$query = "SELECT * FROM thoughts WHERE id = '". $thought_id."'";
 $data = mysqli_query($dbc, $query);

 $row = mysqli_fetch_array($data);
 
 
 if($_SESSION['user_id'] != $row['member_id']){
 
 exit();
 }else{
 /////Good to edit ///////
 
 
 $query = "UPDATE thoughts SET headline = '" . $headline . "' WHERE id = '" . $thought_id . "'";
  mysqli_query($dbc, $query); 	
		 
	 
 mysqli_close($dbc); 
 
 
 }
 
 

?>