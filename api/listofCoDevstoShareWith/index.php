<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $path = $request->path;
  $page = $request->page;
  $getlist = $request->getlistofmembers;


if($getlist == 1){


$query = "SELECT * FROM codevelopers WHERE member = '".$_SESSION['username']."'";
$data =  mysqli_query($dbc, $query);

  $query3 = "SELECT * FROM ideas WHERE file_path = '/".$path. "' AND file_name = '".$page."' ORDER by file_id DESC LIMIT 1";
   $data3 = mysqli_query($dbc, $query3);
   $row3 = mysqli_fetch_array($data3);
     $listofCoDevs = array();
     $i = 0;
     while($row = mysqli_fetch_array($data)){

     if ($row3['file_private'] == 1){   
       
            $query1 = "SELECT * FROM folderprivacy WHERE folderID = '".$row3['file_id']."' AND user_name ='".$row['codeveloper']."'";
           $data1 = mysqli_query($dbc, $query1);
           if(mysqli_num_rows($data1)>0){
         
                 $listofCoDevs[$i]['id'] = $row['codevelopers_id'];
                 $listofCoDevs[$i]['membername'] = $row['codeveloper'];
                 $i++;
             	 }
          
         }else{
            $listofCoDevs[$i]['id'] = $row['codevelopers_id'];
                 $listofCoDevs[$i]['membername'] = $row['codeveloper'];
                  $i++;
        }
      
      }
  
       $jsn = json_encode($listofCoDevs);
      echo $jsn;
      exit();
      

 }
	

?>