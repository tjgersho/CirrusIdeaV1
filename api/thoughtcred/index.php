<?php


require_once('../startsession.php');


if (!isset($_SESSION['user_id'])) {

  exit();
  
}
  
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

   


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$ratingdate = date("Y-m-d H:i:s");   

  $thought_id = $request->thought_id;
  $addcred = $request->addcred;
   
$query = "SELECT * FROM thoughts WHERE id = '". $thought_id."'";
 $data = mysqli_query($dbc, $query);

 $row = mysqli_fetch_array($data);


   
 $query1 = "SELECT * FROM ratingvote WHERE thought_id = '". $thought_id."' AND member_id= '".$_SESSION['user_id']."' ORDER by date DESC LIMIT 1";
 $data1 = mysqli_query($dbc, $query1);

 $row1 = mysqli_fetch_array($data1);
 
 
$date1 = $row1['date'];
$date2 = $ratingdate;

$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours = floor(($diff / (60*60)));

printf("%d years, %d months, %d days\n, %d hours", $years, $months, $days, $hours);
 if($hours > 24){
	 if($addcred == 1){
	
	 /////Good to edit ///////
	  $rating = $row['rating'] + 1;
	 
	 $query = "UPDATE thoughts SET rating = '" . $rating . "' WHERE id = '" . $thought_id . "'";
	  mysqli_query($dbc, $query); 	
	  
	  $query = "INSERT INTO ratingvote (date, thought_id, member_id) VALUES ('" .
			 $ratingdate . "', '" . $thought_id . "', '" . $_SESSION['user_id'] ."')";
		
	   mysqli_query($dbc, $query);
					          
			 
	
	  
	 }else{
		
		/////Good to edit ///////
	  $rating = $row['rating'] - 1;
	 if($rating <0){
	  $rating = 0;
	 
	 }
	 $query = "UPDATE thoughts SET rating = '" . $rating . "' WHERE id = '" . $thought_id . "'";
	  mysqli_query($dbc, $query); 	
	
		$query = "INSERT INTO ratingvote (date, thought_id, member_id) VALUES ('" .
			 $ratingdate . "', '" . $thought_id . "', '" . $_SESSION['user_id'] ."')";
		
	   mysqli_query($dbc, $query);
					          

		
	 }			          
}	 
	 
 mysqli_close($dbc); 
 
 

 
?>

