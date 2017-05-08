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

$delete = $request->delete;
$msgID = $request->messageID;
 
 
if($delete == 1){

$query = "DELETE FROM contactus WHERE comment_id = '".$msgID."'";
 echo mysqli_query($dbc, $query);



}else{   	
  $query = "SELECT * FROM contactus ORDER BY comment_date DESC";
  $data = mysqli_query($dbc, $query);
              
$msgList = array();
	$i = 0;	
while($row = mysqli_fetch_array($data)){
$msgList[$i]['comment_id'] = $row['comment_id'];
$msgList[$i]['comment_date'] = $row['comment_date'];
$msgList[$i]['firstname'] = $row['firstname'];
$msgList[$i]['lastname'] = $row['lastname'];
$msgList[$i]['email'] = $row['email'];
$msgList[$i]['comment'] = $row['comment'];



 $i++;    
 }
  

echo json_encode($msgList);
}
	    	
	    	


?>