<?php


require_once('../startsession.php');
require_once('../connectvars.php');

$GLOBALS['total'];	

$GLOBALS['total'] = 0;
 
require_once('../Classes/PayOut.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  
  $path = $request->path;
 $page = $request->page;



$payOutStats = new PayOut($path,$page);	
echo json_encode($payOutStats->getSubMRData());



?>