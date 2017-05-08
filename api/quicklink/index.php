<?php


require_once('../startsession.php');


if (!isset($_SESSION['user_id'])) {
echo 'EXIT';
  exit();
  
}
  
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

   


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);



  $path = $request->path;
  $page = $request->page;
  $addit= $request->addit;
  $isin = $request->isin;
  
  $getqlinklist = $request->getlist;
  
  $delQlink = $request->delete;
  
  
if($addit == 1){ 

 $query = "SELECT * FROM quicklinks WHERE member_id = '".$_SESSION['user_id']."' AND path = '".$path."' AND page = '".$page."'";
 $data =  mysqli_query($dbc, $query);
		 if(mysqli_num_rows($data)<1){ 
		
		           $query = "INSERT INTO quicklinks (member_id, path, page) VALUES ('" .
				 $_SESSION['user_id'] . "', '" . $path . "', '" . $page. "')";
			
			                         mysqli_query($dbc, $query);
			
			}
			
	}elseif($isin == 1){
	
	
 $query = "SELECT * FROM quicklinks WHERE member_id = '".$_SESSION['user_id']."' AND path = '".$path."' AND page = '".$page."'";
 $data =  mysqli_query($dbc, $query);
		 if(mysqli_num_rows($data)<1){ 
		         header(' ', true, 400);
	    	        $arr = array('msg' => "Not in quicklink list", 'error' => '');
                        $jsn = json_encode($arr);
			 print_r($jsn);

		           			
			}else{
			  header(' ', true, 200);
	                  $arr = array('msg' => "Is in quicklink list", 'error' => '');
                         $jsn = json_encode($arr);
                         print_r($jsn);
			
			}

	
	}elseif($getqlinklist == 1){
	 
	 if($_SESSION['user_id'] == $request->user_id && $_SESSION['username'] == $request->username){
           

	$query = "SELECT * FROM quicklinks WHERE member_id = '".$_SESSION['user_id']."'";
       $data =  mysqli_query($dbc, $query);
	
	$qlinklist = array();
	$i = 0;
	while($row = mysqli_fetch_array($data)){
	$qlinklist[$i]['id'] = $row['quicklink_id'];
	$qlinklist[$i]['path'] = $row['path'];
	$qlinklist[$i]['page'] = $row['page'];
	
       $query1 = "SELECT * FROM ideas WHERE file_path = '".$row['path']."' AND file_name = '".$row['page']."'";
       $data1 =  mysqli_query($dbc, $query1);	
       $row1 = mysqli_fetch_array($data1);

	$qlinklist[$i]['p_descript'] = $row1['p_descript'];
	
	if($row1['file_path'] == "/files"){
	$qlinklist[$i]['isCat']  = true;
	
	}else{
	$qlinklist[$i]['isCat']  = false;
	}
	
	$i++;
	}
	

	
	 $jsn = json_encode($qlinklist);
                         print_r($jsn);

	  }
	}elseif($delQlink == 1){
	  
  $delQlink_id = $request->quicklink_id;
	
	$query = "DELETE FROM quicklinks WHERE quicklink_id = '".$delQlink_id. "'";
       mysqli_query($dbc, $query);

	
	}	
			          
		 
	 
 mysqli_close($dbc); 
 
 

 
?>

