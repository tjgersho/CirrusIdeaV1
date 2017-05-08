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

  $path = $request->path;
  $page = $request->page;
  $payout = $request->payout;
  $currentNumVotes = $request->numVotes;

  
  
 $query = "SELECT * FROM ideas WHERE file_path = '/".$path."' AND file_name = '".$page."'";
 $data =  mysqli_query($dbc, $query);
  $row = mysqli_fetch_array($data);
 
 $idea_id = $row['file_id'];



   
 $query1 = "SELECT * FROM ideapayout WHERE idea_id = '". $idea_id."' AND member_id= '".$_SESSION['user_id']."' ORDER by date DESC LIMIT 1";
 $data1 = mysqli_query($dbc, $query1);

 $row1 = mysqli_fetch_array($data1);
 
 
$date1 = $row1['date'];
$date2 = date("Y-m-d H:i:s");   

$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours = floor(($diff / (60*60)));



$okaytoVote = false;

	
	 if($hours > -$currentNumVotes   + 24 && $currentNumVotes  < 23){
	   
	$okaytoVote =  true;
	
	 
	 }	 
	 if($hours > 1 && $currentNumVotes >22) {
	 
	$okaytoVote =  true;
	  
	  }



 if($okaytoVote){
	 if($payout == 1){
	
	 /////Good to edit ///////
	  $rating = $row['rating'] + 1;
	 
	 $query = "UPDATE thoughts SET rating = '" . $rating . "' WHERE id = '" . $thought_id . "'";
	  mysqli_query($dbc, $query); 	
	  
	  $query = "INSERT INTO ideapayout (date, idea_id, vote, member_id) VALUES ('" .
			 $date2 . "', '" . $idea_id . "', 1, '" . $_SESSION['user_id'] ."')";
		
	   mysqli_query($dbc, $query);
					          
			 
	
	  
	 }else{
		 $query = "INSERT INTO ideapayout (date, idea_id, vote, member_id) VALUES ('" .
			 $date2 . "', '" . $idea_id . "', 0, '" . $_SESSION['user_id'] ."')";
		
	   mysqli_query($dbc, $query);
					          

		
	 }			          
  }	 
	 
 mysqli_close($dbc); 
 
 

 
?>

