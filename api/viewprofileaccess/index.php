<?php

 // Start the session
require_once('../startsession.php');
require_once('../connectvars.php');
   
  
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


if(isset($request->otheruser) && isset($_SESSION['user_id'])){
$otheruser = $request->otheruser;


/////////First Check if idea is public ////////////

   $query = "SELECT * FROM users WHERE username = '". $otheruser."'";
   $data = mysqli_query($dbc, $query);
   $row = mysqli_fetch_array($data);
  if(mysqli_num_rows($data)>0){ //////File Exists//////
         if($row['privateprofile'] == 1){
               header(' ', true, 400);
	    	$arr = array('msg' => "Page Load Failure", 'error' => '');
                $jsn = json_encode($arr);
		  print_r($jsn);
                  exit();
         }else{
         
           header(' ', true, 200);
	        $arr = array('msg' => " " . $_SESSION['username'] . " -  Access Granted", 'error' => '');
                $jsn = json_encode($arr);
		 print_r($jsn);
                 exit();

         
         
         }
                          
    }else{
    ///////////User Does not Exist ////////////
    	     header(' ', true, 400);
	    	$arr = array('msg' => "Page Load Failure", 'error' => '');
                $jsn = json_encode($arr);
		  print_r($jsn);
                  exit();

    }



			       
          
	    	} else {
	    	header(' ', true, 400);
	    	$arr = array('msg' => "Page Load Failure", 'error' => '');
                $jsn = json_encode($arr);

	    	
		  print_r($jsn);

}

?>