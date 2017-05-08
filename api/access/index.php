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


if(isset($request->cirruspath) && isset($request->cirruspage)){
$path = $request->cirruspath;
$page = $request->cirruspage;


/////////First Check if idea is public ////////////

 $query = "SELECT file_id, creator, file_private FROM ideas WHERE file_path = '/". $path."' AND file_name = '".$page."' ORDER by file_id DESC LIMIT 1";
   $data = mysqli_query($dbc, $query);
   $row = mysqli_fetch_array($data);
  if(mysqli_num_rows($data)>0){ //////File Exists//////
         if($row['file_private'] != 1){
               header(' ', true, 200);
	        $arr = array('msg' => " " . $request->cirruspage . " Course Access Granted - Not Private", 'error' => '');
                $jsn = json_encode($arr);
		 print_r($jsn);
		 exit();

         }
         if($row['creator'] == $_SESSION['username']){
         
                 header(' ', true, 200);
	        $arr = array('msg' => " " . $request->cirruspage . " Course Access Granted - Is Creator", 'error' => '');
                $jsn = json_encode($arr);
		 print_r($jsn);
                 exit();
           }
                 
    }else{
    ///////////File Does not Exist ////////////
    	header(' ', true, 400);
	    	$arr = array('msg' => "Page Load Failure", 'error' => '');
                $jsn = json_encode($arr);
		  print_r($jsn);
                  exit();
    
    }


////////////////////////////////////////////////////////////////
/////////// ELSE if Private see if user has access //////////////
/////////////////////////////////////////////////////////////////
  $query1 = "SELECT * FROM folderprivacy WHERE folderID = '".$row['file_id']."' AND user_name = '".$_SESSION['username']."'";
  $data1 = mysqli_query($dbc, $query1);
              
             	 if(mysqli_num_rows($data1)>0){
                      header(' ', true, 200);
	        $arr = array('msg' => " " . $request->cirruspage . " Course Access Granted", 'error' => '');
                $jsn = json_encode($arr);
		 print_r($jsn);
                 exit();
	           }else{
	           
	           header(' ', true, 400);
	    	$arr = array('msg' => "Page Load Failure", 'error' => '');
                $jsn = json_encode($arr);

	    	
		  print_r($jsn);

	           
	           }



			       
          
	    	} else {
	    	
	    	
	    	
	    	header(' ', true, 400);
	    	$arr = array('msg' => "Page Load Failure", 'error' => '');
                $jsn = json_encode($arr);

	    	
		  print_r($jsn);

}

?>