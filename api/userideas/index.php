<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


 ///Model Prototype ///      
//      idserv.ideas = {owner: [{path: 'fun/neet', page: 'cool',  isOwner: 0,
//		       type: {'publicidea': 1, 'privateidea': 0},
//		       type1: {'btn btn-success': 1, 'btn btn-info': 0}},                   
  //                   {path: 'fun', page: 'neet',  isOwner: 1,
//		       type: {'publicidea': 0, 'privateidea': 1},
//		       type1: {'btn btn-success': 0, 'btn btn-info': 1}}],
//		      public:  [{path: 'fun/neet', page: 'cool',  isOwner: 0,
//		       type: {'publicidea': 1, 'privateidea': 0},
//		       type1: {'btn btn-success': 1, 'btn btn-info': 0}},                   
  //                   {path: 'fun', page: 'neet',  isOwner: 1,
///		       type: {'publicidea': 0, 'privateidea': 1},
//		       type1: {'btn btn-success': 0, 'btn btn-info': 1}}]};

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $uid = $request->user_id;
 
 
	$ideas = array();
	
	if($uid == $_SESSION['user_id']){
	
	$query = "SELECT * FROM ideas WHERE creator = '". $_SESSION['user_id']."' ORDER by file_name ASC";
	        $data = mysqli_query($dbc, $query);
	        
	    
	       
	         $ideas = array();
	         $i = 0;
	         while ($row = mysqli_fetch_array($data)){
	        
	    
	          if($row['file_private'] == 1){
	              $query1 = "SELECT * FROM folderprivacy WHERE folderID = '".$row['file_id']."' AND user_name = '".$_SESSION['username']."'";
	              $data1 = mysqli_query($dbc, $query1);
	              
	             	 if(mysqli_num_rows($data1)>0){
	                 
	                   $ideas['owner'][$i]['path'] = $row['file_path'];
		          $ideas['owner'][$i]['page'] = $row['file_name'];
		         
		           $ideas['owner'][$i]['type']['publicidea'] = 0;
		          $ideas['owner'][$i]['type']['privateidea'] = 1;
		          $ideas['owner'][$i]['type1']['btn btn-success'] = 0;
		           $ideas['owner'][$i]['type1']['btn btn-info'] = 1;
		          
		          
		           }
	           
	           }else{
	           
	         $ideas['owner'][$i]['path'] = $row['file_path'];
	         $ideas['owner'][$i]['page'] = $row['file_name'];
	         
	         $ideas['owner'][$i]['type']['publicidea'] = 1;
	         $ideas['owner'][$i]['type']['privateidea'] = 0;
	         $ideas['owner'][$i]['type1']['btn btn-success'] = 1;
	         $ideas['owner'][$i]['type1']['btn btn-info'] = 0;
	          
	          
	           }
	            $ideas['owner'][$i]['id'] = $row['file_id'];
	            $i++;
	         }
	            
	            
	      
	                 
	   $ideas['current'] = 1;
	            
	            
	echo json_encode($ideas); 
	
	 }
	 
 


?>