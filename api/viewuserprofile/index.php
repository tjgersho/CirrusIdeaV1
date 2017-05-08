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


$otherusername = $request->otherusername;


/////////First Check if idea is public ////////////

   $query = "SELECT * FROM users WHERE username = '". $otherusername."'";
   $data = mysqli_query($dbc, $query);
   $row = mysqli_fetch_array($data);
        if(mysqli_num_rows($data)>0){ //////User Exists//////
                $arr = array();
                 $arr['user_id'] = $row['user_id']; 
                 $arr['username'] = $row['username']; 

                 $arr['first_name'] = $row['first_name'];
	         $arr['last_name'] = $row['last_name'];
                 $arr['email'] = $row['email'];
                 $arr['join_date'] = $row['join_date'];
                 $arr['interest'] = $row['interest'];
                 $arr['cred'] = $row['cred'];
                 
                 $arr['about'] = $row['about'];
                  $arr['privateprofile'] = $row['privateprofile'];

                 
    $query = "SELECT cred FROM users ORDER by cred DESC LIMIT 1";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);
                 $arr['percentcred'] = round($arr['cred']/$row['cred']*100);
                
                
               $arr['percentcredstyle']['width'] = $arr['percentcred'].'%';
              
                
                
                
                
	       $jsn = json_encode($arr);
		 print_r($jsn);
                 exit();
         }else{
         
            header(' ', true, 400);
	    	$arr = array('msg' => "User Does not Exist", 'error' => '');
                $jsn = json_encode($arr);
		  print_r($jsn);
                  exit();
         
         
         }
                          
?>