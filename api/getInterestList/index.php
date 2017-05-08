<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);




  if (!isset($_SESSION['user_id'])) {
    exit();  
  }
  


  ///// First Check to see if the file if public exists ///

  
  $query3 = "SELECT * FROM ideas WHERE file_path = '/files' AND file_private != 1 ORDER by file_name ASC";
   $data3 = mysqli_query($dbc, $query3);
    $categories = array();
$i = 0;
   while ($row3 = mysqli_fetch_array($data3)){
   
   
   $categories[$i]['ideaname'] = $row3['file_name'];
	         
   $i++;
   }
                     
            

            
echo json_encode($categories); 


?>