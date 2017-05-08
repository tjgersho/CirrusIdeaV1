<?php

 // Start the session
require_once('../startsession.php');
//require_once('connectvars.php');
   
  // Clear the error message
  $error_msg = "";
  
  
 //$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}

if(isset($request->comment)){
$code =   $request->code;
$page = $request->page;
$comment = $request->comment;
$baddata = false;

  if($baddata){
             header(' ', true, 400);
		$arr = array('msg' => "You must enter both username and password", 'error' => '');
                $jsn = json_encode($arr);
                print_r($jsn);
   exit();
      }

}else{
$code =   $request->code;
$page = $request->page;


//Mysqli lookup...    
for ($i=0; $i<4; $i++){
$arr[$i]['comment'] = 'Code ' . $code . ' Page ' . $page . ' - Neet program to the ' . $i;
$arr[$i]['userid'] = 1;
$arr[$i]['username'] = 'tjgersho';
$arr[$i]['fileid'] = 1;
$arr[$i]['filename'] = 'fig.jpg';
}


 $jsn = json_encode($arr);

	    	 
		 print_r($jsn);
}





?>