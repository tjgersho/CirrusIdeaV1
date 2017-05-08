<?php


require_once('../startsession.php');


if (!isset($_SESSION['user_id'])) {

  exit();
  
}
  
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

   


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$thoughtcommentdate = date("Y-m-d H:i:s");   

  $thought_id = $request->thought_id;
  $comment = $request->comment;
   
$query = "SELECT * FROM thoughts WHERE id = '". $thought_id."'";
 $data = mysqli_query($dbc, $query);

 $row = mysqli_fetch_array($data);
 

 /////Good to edit ///////
 
 
  $query = "INSERT INTO postcomments (postcomment_date, comment, post_member_id, ref_post_id) VALUES ('" .
		 $thoughtcommentdate . "', '" . $comment . "', '" . $_SESSION['user_id'] . "', '" . $thought_id. "')";
	
	                         mysqli_query($dbc, $query);
				          
		 
	 
 mysqli_close($dbc); 
 
 

 
?>

