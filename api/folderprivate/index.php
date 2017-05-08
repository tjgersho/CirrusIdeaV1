<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $path = $request->path;
  $page = $request->page;
  $getlist = $request->getlistofmembers;

$path  = ltrim($path, '/');

if($getlist == 1){

  $query3 = "SELECT * FROM ideas WHERE file_path = '/".$path. "' AND file_name = '".$page."' ORDER by file_id DESC LIMIT 1";
   $data3 = mysqli_query($dbc, $query3);
   $row3 = mysqli_fetch_array($data3);
     $listofMembers = array();
     
     if ($row3['file_private'] == 1){     
            $query1 = "SELECT * FROM folderprivacy WHERE folderID = '".$row3['file_id']."'";
           $data1 = mysqli_query($dbc, $query1);
           $i=0;
           while($row1 = mysqli_fetch_array($data1)){
                 $listofMembers['members'][$i] = $row1['user_name'];
                 $i++;
             	 }
            $listofMembers['isPrivate'] = true;

      }else{
             $listofMembers['isPrivate'] = false;
      }
      
      if($row3['creator'] == $_SESSION['user_id']){ 
       $listofMembers['isCreator'] = true;
      }else{
      $listofMembers['isCreator'] = false;
      }
      
      $listofMembers['idea_id'] = $row3['file_id']; 
      
       $jsn = json_encode($listofMembers);
      echo $jsn;
      exit();
      
}else{

  $query3 = "SELECT * FROM ideas WHERE file_path = '/".$path. "' AND file_name = '".$page."' ORDER by file_id DESC LIMIT 1";
   $data3 = mysqli_query($dbc, $query3);
   $row3 = mysqli_fetch_array($data3);
     
     if ($row3['file_private']){     
       header(' ', true, 400);
      $arr = array('msg' => "1", 'error' => '');
      $jsn = json_encode($arr);
      echo $jsn;
      exit();
      }else{
      echo 'Public';
      exit();

     }
  }
 ?>