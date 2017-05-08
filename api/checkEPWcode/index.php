<?php
 // Start the session
require_once('../startsession.php');


// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


       $loggedinCheck = $request->loggedInCheck;
       $user= $request->user;
         $code  = $request->code;
           
 
      // Connect to the database
        require_once('../connectvars.php');
   
  
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // Look up the username and password in the database
       // $query = "SELECT * FROM zusers WHERE username = '" . $user_username . "' AND password = SHA('" . $user_password . "') AND validated != 0";
       // $data = mysqli_query($dbc, $query);


if(!isset($loggedinCheck)){

 $query = "SELECT * FROM users WHERE username = '".$user."' AND validated = '".$code."'";
 $data = mysqli_query($dbc, $query);

if(mysqli_num_rows($data)>0){

 header(' ', true, 200);
	     $returnArray = array();
	     $returnArray['msg'] = 'Correct Code and Username.';
	     
	      $returnArray['username'] = $username;
            
	       
                $jsn = json_encode($returnArray);

	  print_r($jsn);
                 exit();

}else{
            header(' ', true, 400);
	    	$arr = array('msg' => "Code and username do not match.", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();





}

}else{


  if(isset($_SESSION['username'])){

      $arr['user_id'] =   $_SESSION['user_id'];
      $arr['username'] =   $_SESSION['username'];
 
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);   
  $query11 =  "SELECT * FROM users WHERE username = '". $arr['username']."' AND user_id = '".$arr['user_id']."'";    
  $data11 = mysqli_query($dbc, $query11);
  $row11 = mysqli_fetch_array($data11);
  
     if($arr['username'] == $user){
      $jsn = json_encode($arr);
      print_r($jsn);
  

        }else{
          header(' ', true, 400);
	    	$arr = array('msg' => "User is not the user that is logged on.", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();

        
        }

  }else{
  
               header(' ', true, 400);
	    	$arr = array('msg' => "User is not logged in.", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();


  }

}


   

?>