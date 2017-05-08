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

   	
  $query = "SELECT * FROM ideas WHERE funds = 1";
  $data = mysqli_query($dbc, $query);
              
$payoutStats = array();
$i=0;
$totalCashin = 0;
		
while($row = mysqli_fetch_array($data)){


  $query1 = "SELECT * FROM ideapayout WHERE idea_id = '".$row['file_id']."'";
  $data1 = mysqli_query($dbc, $query1);
 $totalVotes = 0; 
 $payoutVotes = 0; 
   while($row1 = mysqli_fetch_array($data1)){
   
    $totalVotes++;
    if($row1['vote'] == 1){
     $payoutVotes++;
    }
    
   }
   
if( $totalVotes>10){ 
$payoutStats['idea'][$i]['totalvotes'] = $totalVotes;
if($totalVotes>0){
$payoutStats['idea'][$i]['payoutvotepercent'] =  round( $payoutVotes/$totalVotes*100,0);
}else{
$payoutStats['idea'][$i]['payoutvotepercent'] =  0;
}



$payoutStats['idea'][$i]['ideaID'] = $row['file_id'];
$payoutStats['idea'][$i]['path'] = $row['file_path'];
$payoutStats['idea'][$i]['page'] = $row['file_name'];



   	
  $query1 = "SELECT * FROM donations WHERE idea_id = '".$row['file_id']."' AND ISNULL(paid)";
  $data1 = mysqli_query($dbc, $query1);
 $cashIN = 0; 
   while($row1 = mysqli_fetch_array($data1)){
   
   $cashIN = $cashIN  + $row1['amount'];
   $totalCashin = $totalCashin + $row1['amount'];
   }
   
$payoutStats['idea'][$i]['cashin'] =  $cashIN;



	$i++;
   }
} 

$payoutStats['totalIn'] =  $totalCashin;

////////////////////////////////////////////////////////////
//////////////////Order By payout percent //////////////////
////////////////////////////////////////////////////////////



  $n = $i;
    do {
          $swapped = false;
       for ($i = 1; $i<$n; $i++){
          if ($payoutStats['idea'][$i-1]['payoutvotepercent'] < $payoutStats['idea'][$i]['payoutvotepercent']){
            
               $tempid = $payoutStats['idea'][$i-1]['ideaID'];
               $temppath = $payoutStats['idea'][$i-1]['path'];
               $temppage = $payoutStats['idea'][$i-1]['page'];
               $temppayoutpercent = $payoutStats['idea'][$i-1]['payoutvotepercent'];
               $temptotalvotes = $payoutStats['idea'][$i-1]['totalvotes'];
               $tempCashIn = $payoutStats['idea'][$i-1]['cashin'];
                     
               $payoutStats['idea'][$i-1]['ideaID'] =  $payoutStats['idea'][$i]['ideaID'];
                $payoutStats['idea'][$i-1]['path'] =  $payoutStats['idea'][$i]['path'];
              $payoutStats['idea'][$i-1]['page'] = $payoutStats['idea'][$i]['page'];
               $payoutStats['idea'][$i-1]['payoutvotepercent'] = $payoutStats['idea'][$i]['payoutvotepercent'];
               $payoutStats['idea'][$i-1]['totalvotes'] = $payoutStats['idea'][$i]['totalvotes'];
               $payoutStats['idea'][$i-1]['cashin'] = $payoutStats['idea'][$i]['cashin'];
               
                 $payoutStats['idea'][$i]['ideaID'] = $tempid;
                 $payoutStats['idea'][$i]['path'] = $temppath;
               $payoutStats['idea'][$i]['page'] =$temppage;
                $payoutStats['idea'][$i]['payoutvotepercent'] =$temppayoutpercent;
                $payoutStats['idea'][$i]['totalvotes'] = $temptotalvotes;
               $payoutStats['idea'][$i]['cashin'] = $tempCashIn;            
                                      
                $swapped = true;
          }
       }
        $n = $n-1;

   }while($swapped);



echo json_encode($payoutStats);

	    	
	    	


?>