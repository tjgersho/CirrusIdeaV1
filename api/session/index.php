<?php

 // Start the session
require_once('../startsession.php');



//echo 'Session User_id ' . $_SESSION['user_id'] . '       Session USER NAME   ' . $_SESSION['username']   . '      E';

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
    
    
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
      
      $arr['user_id'] =   $_SESSION['user_id'];
      $arr['username'] =   $_SESSION['username'];
     
      require_once('../connectvars.php');
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $query11 =  "SELECT * FROM users WHERE username = '". $arr['username']."' AND user_id='".$arr['user_id']."'";    
  $data11 = mysqli_query($dbc, $query11);
  $row11 = mysqli_fetch_array($data11);
  
      $arr['interest'] =   $row11['interest'];
      
      if($_SESSION['username'] == 'tjgersho' && $_SESSION['user_id'] == 1){  
       $arr['admin'] = true;
      }else{
       $arr['admin'] = false;
      }
      
      $jsn = json_encode($arr);
      print_r($jsn);
    }else{
    
     //echo  http_response_code(400);
     
      header(' ', true, 400);
	    	$arr = array('msg' => "Session for User Does not Exist.", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();

     
    }
  }else{
  


      $arr['user_id'] =   $_SESSION['user_id'];
      $arr['username'] =   $_SESSION['username'];
     
     require_once('../connectvars.php'); 
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);   
  $query11 =  "SELECT * FROM users WHERE username = '". $arr['username']."' AND user_id = '".$arr['user_id']."'";    
  $data11 = mysqli_query($dbc, $query11);
  $row11 = mysqli_fetch_array($data11);
  
      $arr['interest'] =   $row11['interest'];
       if($_SESSION['username'] == 'tjgersho' && $_SESSION['user_id'] == 1){  
       $arr['admin'] = true;
      }else{
       $arr['admin'] = false;
      }
      $jsn = json_encode($arr);
      print_r($jsn);
  }


?>