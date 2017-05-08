<?php
require_once('../startsession.php');
require_once('../connectvars.php');

$GLOBALS['total'];	

$GLOBALS['total'] = 0;
 
require_once('../Classes/PayOut.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $charttype = $request->type;
  
  $path = $request->path;
 $page = $request->page;
//  var data = {
//    labels: ["January", "February", "March", "April", "May", "June", "July"],
//    datasets: [
//        {
  //          label: "My First dataset",
    //        fillColor: "rgba(220,220,220,0.5)",
      //      strokeColor: "rgba(220,220,220,0.8)",
        ///    highlightFill: "rgba(220,220,220,0.75)",
           // highlightStroke: "rgba(220,220,220,1)",
  //          data: [65, 59, 80, 81, 56, 55, 40]
  //      },
  //      {
   ///         label: "My Second dataset",
   //         fillColor: "rgba(151,187,205,0.5)",
   //         strokeColor: "rgba(151,187,205,0.8)",
   //         highlightFill: "rgba(151,187,205,0.75)",
   //         highlightStroke: "rgba(151,187,205,1)",
   //         data: [28, 48, 40, 19, 86, 27, 90]
   //     }
   // ]
//};


function getDonationInIdea($idea_id){
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$donations = 0;

$querym = "SELECT * FROM donations WHERE idea_id = '".$idea_id . "' AND paid IS NULL";
$datam = mysqli_query($dbc, $querym);


	 
if(mysqli_num_rows($datam)> 0){

while($rowm = mysqli_fetch_array($datam)){

               $donations = $donations+ $rowm['amount'];
        }
 }


return $donations;

}




function recurGetPubIdeaFunds($fpath){

   
         $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	 $queryf = "SELECT * FROM ideas WHERE file_private < 1 AND file_path = '".$fpath . "'";
	 $dataf = mysqli_query($dbc, $queryf);
	


	 while($rowf = mysqli_fetch_array($dataf)){
	 

              $dir = $rowf['file_path']. '/' .$rowf['file_name'];

	      if($rowf['funds'] == 1){
	     
              $GLOBALS['total']  = $GLOBALS['total'] + getDonationInIdea($rowf['file_id']); 
               
              }  
              recurGetPubIdeaFunds($dir);

            }
          
}



function recurGetPubThoughs($fpath){
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   
    $queryc=  "SELECT COUNT(*) AS ctotal FROM thoughts WHERE path= '".$fpath. "'";
              $datac = mysqli_query($dbc, $queryc);
	      $rowc = mysqli_fetch_array($datac);
	   	    
              $GLOBALS['total']  = $GLOBALS['total']  + $rowc['ctotal']; 

   
         $queryf = "SELECT * FROM ideas WHERE file_private < 1 AND file_path = '".$fpath . "'";
	 $dataf = mysqli_query($dbc, $queryf);
	
	 
	 
	 while($rowf = mysqli_fetch_array($dataf)){
                
              $dir = $rowf['file_path']. '/' .$rowf['file_name'];
                       
             recurGetPubThoughs($dir);
               
               
            }
               
      
 
}



switch ($charttype){

case 1:   ///////// THOUGHTS IN MAIN CATEGORIES!//////////////////

	 $query = "SELECT * FROM ideas WHERE file_private != 1 AND file_path = '/files' ORDER By file_name ASC";
	 $data = mysqli_query($dbc, $query);
	 $i=0;
	 $arr = array();
	while($row = mysqli_fetch_array($data)){
	 
	 $arr['labels'][$i] =  $row['file_name'];
	 
	 
	$GLOBALS['total'] = 0;	
         
   
	   recurGetPubThoughs('/files/'. $row['file_name']); 
	   
	   
 	//recurGetPubThoughs('/files/Art'); 
 	
 	
	$arr['dthoughts'][$i] =  $GLOBALS['total'];
	 $i++;
	 }
	 
	 
	 ///////////////////////Sort Highest to lowest.. Plot only 5 or 6 ////////////////
	 
	
    $n = $i;
    do {
          $swapped = false;
       for ($i = 1; $i<$n; $i++){
          if ($arr['dthoughts'][$i-1] < $arr['dthoughts'][$i]){
            
             
               $tempdata = $arr['dthoughts'][$i-1];
              
               $arr['dthoughts'][$i-1] = $arr['dthoughts'][$i];
               $arr['dthoughts'][$i] = $tempdata;
               $templabel = $arr['labels'][$i-1];
               $arr['labels'][$i-1] =  $arr['labels'][$i];
               $arr['labels'][$i] = $templabel;
                 $swapped = true;
          }
       }
        $n = $n-1;

   }while($swapped);


          $sendarray = array();
	 for ($i=0; $i<7; $i++){
	 
	  $sendarray['labels'][$i] =  $arr['labels'][$i];
	   $sendarray['dthoughts'][$i] =  $arr['dthoughts'][$i];
	  
	 
	 }
	 
	 	
	
	echo json_encode($sendarray);
	
break;


case 2:  ///////// MONEY in MAIN CATEGORIES!//////////////////


	 $query = "SELECT * FROM ideas WHERE file_private <> 1 AND file_path = '/files'";
	 $data = mysqli_query($dbc, $query);
	 $i=0;
	 $arr = array();
	 while($row = mysqli_fetch_array($data)){
	 
	$GLOBALS['total']  = 0;	
	
	
	      if($row['funds'] == 1){
	     
              $GLOBALS['total']  = $GLOBALS['total'] + getDonationInIdea($row['file_id']); 
               
               }
              

	
	 
	 $arr['labels'][$i] = $row['file_name'];
	
   

	recurGetPubIdeaFunds('/files/'. $row['file_name']);
	
 	$arr['dmoney'][$i] = $GLOBALS['total']; 
	 
	 $i++;
	 }
	 
	 
	 
	 ///////////////////////Sort Highest to lowest.. Plot only 5 or 6 ////////////////
	 
	
    $n = $i;
    do {
          $swapped = false;
       for ($i = 1; $i<$n; $i++){
          if ($arr['dmoney'][$i-1] < $arr['dmoney'][$i]){
            
             
               $tempdata = $arr['dmoney'][$i-1];
              
               $arr['dmoney'][$i-1] = $arr['dmoney'][$i];
               $arr['dmoney'][$i] = $tempdata;
               $templabel = $arr['labels'][$i-1];
               $arr['labels'][$i-1] =  $arr['labels'][$i];
               $arr['labels'][$i] = $templabel;
                 $swapped = true;
          }
       }
        $n = $n-1;

   }while($swapped);


          $sendarray = array();
	 for ($i=0; $i<7; $i++){
	 
	  $sendarray['labels'][$i] =  $arr['labels'][$i];
	   $sendarray['dmoney'][$i] =  $arr['dmoney'][$i];
	  
	 
	 }
	
		
	
	echo json_encode($sendarray);



break;


case 3:   ///////// Payout Stats in Idea!//////////////////



$payOutStats = new PayOut($path,$page);	
echo json_encode($payOutStats->getSubMRCharting());

	
break;



}


 ?>