<?php

 // Start the session
require_once('../../startsession.php');
require_once('../../connectvars.php');
   
  
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}
$member_id = $request->member_id;

if(isset($member_id)){
/////Delete...
////////////////or do something with member id...
echo $member_id . ' Deleted!';
       
        $query = "DELETE FROM users WHERE user_id = '".$member_id."'";
  $data = mysqli_query($dbc, $query);
  
     
	    	} else {
	    	
  $query = "SELECT * FROM users ORDER by user_id ASC";
  $data = mysqli_query($dbc, $query);
              
$memberList = array();
$i=0;
while($row = mysqli_fetch_array($data)){

$memberList[$i]['user_id'] = $row['user_id'];
$memberList[$i]['username'] = $row['username'];
$memberList[$i]['first_name'] = $row['first_name'];
$memberList[$i]['last_name'] = $row['last_name'];
$memberList[$i]['email'] = $row['email'];
$memberList[$i]['join_date'] = $row['join_date'];
$memberList[$i]['interest'] = $row['interest'];
$memberList[$i]['cred'] = $row['cred'];
$memberList[$i]['validated'] = $row['validated'];




$i++;
}   	

echo json_encode($memberList);

	    	
	    	
}

?>