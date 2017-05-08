<?php

////////////////////////////////////////////////////


require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $thought_id = $request->tht_id;


$thought = array();

     
                 
  
$query = "SELECT * FROM thoughts WHERE id = '". $thought_id."'";
 $data = mysqli_query($dbc, $query);

   $row = mysqli_fetch_array($data);
          
                	 
 $thought['id']  = $row['id'];          	 
 $thought['thought']  = $row['headline'];
	$thought['file_name'] = $row['filename'];
	          
	           $thought['path'] =  ltrim ($row['path'] . '/' . $row['filename'], '/');   
	                       
echo json_encode($thought); 



?>