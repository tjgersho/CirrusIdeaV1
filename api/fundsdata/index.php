<?php
require_once('../startsession.php');

  
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

  

  $path = $request->path;
  $page = $request->page;
  
  
$fundsData = array();
$fundsData['funds'] = 0;

 $query = "SELECT * FROM ideas WHERE file_path = '/".$path."' AND file_name = '".$page."'";
 $data =  mysqli_query($dbc, $query);
  $row = mysqli_fetch_array($data);

 $idea_id = $row['file_id'];
  
 if($row['funds'] == 1){
  
     $query1 = "SELECT * FROM donations WHERE idea_id = '". $idea_id ."' AND paid IS NULL";
     $data1 =  mysqli_query($dbc, $query1);
     $money = 0;
     
    while($row1 = mysqli_fetch_array($data1)){
   
        $money = $money + $row1['amount'];
      
    } 
  $fundsData['funds'] = $money;
 }
 

		
 $query = "SELECT * FROM ideapayout WHERE idea_id = '".$row['file_id']."'";
 $data =  mysqli_query($dbc, $query);
 
 $payout = 0;
 $morethoughts = 0;
 $total = 0;
  while($row = mysqli_fetch_array($data)){
      if($row['vote'] == 1){
         $payout = $payout + 1;
      }else{
      $morethoughts = $morethoughts +1;
      }
   
   
  $total = $total + 1;
  
  }	

if($total > 0){
	  	
	$fundsData['payoutpercent'] = round($payout /$total * 100,0);
	$fundsData['payoutpercentstyle']['width'] = $fundsData['payoutpercent'] . '%';
       
        
      $fundsData['moredevneededpercent'] = 100-$fundsData['payoutpercent'];
      $fundsData['moredevneededpercentstyle']['width'] =  $fundsData['moredevneededpercent'] . '%';
      
      $fundsData['payoutvotes'] = $total;
 
 
  }else{
  
  
  $fundsData['payoutpercent'] = 0;
	$fundsData['payoutpercentstyle']['width'] =  '0%';
       
        
        $fundsData['moredevneededpercent'] = 0;
      $fundsData['moredevneededpercentstyle']['width'] =  '0%';
$fundsData['payoutvotes'] = 0;
 
  }     
       
       
       
 if(isset($_SESSION['user_id'])){ 	
 	
	 $query = "SELECT * FROM ideapayout WHERE idea_id = '".$idea_id ."' AND member_id = '".$_SESSION['user_id']."' ORDER by date DESC LIMIT 1";
	 $data =  mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);
	 
	  $date1 = $row['date'];
	  
	     
	$date2 = date("Y-m-d H:i:s");   
	
	$diff = abs(strtotime($date2) - strtotime($date1));
	
	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	$hours = floor(($diff / (60*60)));
	$hoursDec = $diff / (60*60);
	//echo 'Hours Since last Vote';
//	echo $hours;
//	exit();
	
	 if($hours > 1 && $total >22) {
	  $fundsData['usercanVote'] = true;
	  
	  }else{
	  
	  $fundsData['timetoVote'] = round(1 - $hoursDec,2);
	  
	 $fundsData['usercanVote'] = false;
	 
	 }

	
	
	
	 if($hours > -$total  + 24 && $total < 23){
	   
	$fundsData['usercanVote'] = true;
	
	 
	 }elseif($total < 23){
	 
	  $fundsData['timetoVote'] = round((-$total  + 24) - $hours,0);
	  
	 $fundsData['usercanVote'] = false;
		
	 }
	 
		
    }else{
    
    $fundsData['usercanVote'] = false;
    }   
       
             
       
     echo json_encode($fundsData);
	           			
		
 mysqli_close($dbc); 
 
 

 
?>

