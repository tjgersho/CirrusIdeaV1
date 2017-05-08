<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $path = $request->path;
  $page = $request->page;
  $removemember = $request->removemember;
  $who = $request->who;
  $user_id = $request->uid;
  $idea_id = $request->idea_id;
  
	        
$path  = ltrim($path, '/');

if($removemember == 1){

  $query3 = "SELECT * FROM ideas WHERE file_path = '/".$path. "' AND file_name = '".$page."'";
   $data3 = mysqli_query($dbc, $query3);
   $row3 = mysqli_fetch_array($data3);
   if($_SESSION['username'] != $who){
    if ($row3['file_id'] ==  $idea_id){
    
     if ($row3['file_private'] == 1){   
    
       if ($row3['creator'] == $_SESSION['user_id']  && $row3['creator'] ==  $user_id){
       
              $query4 = "SELECT * FROM folderprivacy WHERE folderID = '".$idea_id."' AND user_name = '".$who."'";
              $data4 = mysqli_query($dbc, $query4);
                if(mysqli_num_rows($data4)>0){
                   $query6 = "DELETE FROM folderprivacy WHERE folderID = '".$idea_id."' AND user_name = '".$who."'";
                   mysqli_query($dbc, $query6);
                 }
                 
           }
        }
      
      }
    }
      
}else{

$query3 = "SELECT * FROM ideas WHERE file_path = '/".$path. "' AND file_name = '".$page."'";
$data3 = mysqli_query($dbc, $query3);
$row3 = mysqli_fetch_array($data3);

    if ($row3['file_id'] ==  $idea_id){
  
     if ($row3['file_private'] == 1){   
    
       if ($row3['creator'] == $_SESSION['user_id'] && $row3['creator'] ==  $user_id){
      
  foreach ($who as $pers){
      
   $query4 = "SELECT * FROM folderprivacy WHERE folderID = '".$idea_id. "' AND user_name = '".$pers."'";
      $data4 = mysqli_query($dbc, $query4);
      if(mysqli_num_rows($data4)<1){
         
            $query5 = "INSERT INTO folderprivacy (user_name, folderID) VALUES ('".$pers."', '".$idea_id."')";
            mysqli_query($dbc, $query5);
   
               }
              
              }
     
     
       }
     
     }
     
   }
     
     
     
     

   }
  
 ?>