<?php
// Start the session
  require_once('../../startsession.php');
 $root = realpath($_SERVER["DOCUMENT_ROOT"]).'/cirrusidea'; 
  require_once('../../connectvars.php');

  // Make sure the user is logged in before going any further.

  if (!isset($_SESSION['user_id'])) {
           header(' ', true, 400);
	    	$arr = array('msg' => "You do not have access to this page", 'error' => '');
                $jsn = json_encode($arr);
                print_r($jsn);
    exit();
  
  }
 if ($_SESSION['username']!=tjgersho){
    header(' ', true, 400);
	    	$arr = array('msg' => "You do not have access to this page", 'error' => '');
                $jsn = json_encode($arr);

                print_r($jsn);
    exit();
  
  }
  ///////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
/////////////////SCRATCH/////////////////////////////////////////// 
 ///////////////DO SOMETHING!!!!!!!//////////////////////////////
 /////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////
 
       // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
      
      
      
      
 echo "HELLO";     
      
 exit();     
      
      
      
      
      
      
	  
	 $query = "SELECT * FROM ideas";
         $data = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($data);
	 
	while ($row = mysqli_fetch_array($data)) { 
	
	
   } 
	
//	copy($root . '/templates/index.php' , $root . '/files/Biology/index.php');
 //   copy($root . '/templates/uploader.php' , $root . '/files/Biology/uploader.php');
	//chmod($root . '/files/Biology/index.php',0777);

      mysqli_close($dbc);

  ?>
