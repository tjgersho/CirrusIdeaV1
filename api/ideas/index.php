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


  $path = $request->path;
  $new_idea = mysqli_real_escape_string($dbc, trim($request->idea));
  $private = $request->file_private;
    $headline = mysqli_real_escape_string($dbc, trim($request->headline)); 
  $synopsis = mysqli_real_escape_string($dbc, trim($request->synopsis));
  $slogan = mysqli_real_escape_string($dbc, trim($request->slogan)); 
  
  
  
  $getmodel = $request->get;
  
  
  $file_id = $request->file_id;
  $delete = $request->delete;
  
  
  
  
  if($delete == 1){
  
   $query3 = "SELECT * FROM ideas WHERE file_id = '".$file_id ."' AND creator = '".$_SESSION['user_id']."'";
   $data3 = mysqli_query($dbc, $query3);
   $row3 = mysqli_fetch_array($data3);
           if(mysqli_num_rows($data3)<1){
                header(' ', true, 400);
	    	$arr = array('msg' => "You are not the owner", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();
                }
                
   $query4 = "SELECT * FROM ideas WHERE file_path LIKE '".$row3['file_path']."/".$row3['file_name']."/%'";
   $data4 = mysqli_query($dbc, $query4);
   $row4 = mysqli_fetch_array($data4);
           if(mysqli_num_rows($data4)>0){
                header(' ', true, 400);
	    	$arr = array('msg' => "There are other ideas in this Idea, so it cannot be deleted", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();
                }         
    
   $query5 = "SELECT * FROM thoughts WHERE path LIKE '".$row3['file_path']."/".$row3['file_name']."/%'";
   $data5 = mysqli_query($dbc, $query5);
   $row5 = mysqli_fetch_array($data5);
           if(mysqli_num_rows($data5)>0){
                header(' ', true, 400);
	    	$arr = array('msg' => "There are thoughts in this Idea, so it cannot be deleted.", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();
                }
 
    //////Okay to delete if it makes it here.. /////////
    
             // Delete the score data from the database
      $query1 = "DELETE FROM ideas WHERE file_id = '".$file_id."'";
      mysqli_query($dbc, $query1);

       rmdir ('../..'.$row3['file_path']."/".$row3['file_name']);
       exit();
  
}else{ ///////////////// is a get model or adding a new sub_idea...////////////////
 
	if($private){
	$private = 1;
	}else{
	$private = 0;
	}
	
	
	  if($getmodel != 1){
	  
	    ///// First Check to see if the file exists ///
	
	  $query3 = "SELECT * FROM ideas WHERE file_path = '".$path. "' AND file_name = '".$new_idea ."' ORDER by file_id DESC LIMIT 1";
	   $data3 = mysqli_query($dbc, $query3);
	   $row3 = mysqli_fetch_array($data3);
	           if(mysqli_num_rows($data3)>0){
	                header(' ', true, 400);
		    	$arr = array('msg' => 1, 'error' => '');
	                $jsn = json_encode($arr);
			echo $jsn;
	                 exit();
	                }
	                
	        $parent_path =  dirname($path);
	         $parent_name = basename($path);
	        
	         if($parent_path == "."){
	         $parent_path = '/files';
	         }
	        
	         
	     //Is parent folder private? // Enforce privacy below..///
	      $query3 = "SELECT * FROM ideas WHERE file_path = '".$parent_path. "' AND file_name = '".$parent_name."'";
	      $data3 = mysqli_query($dbc, $query3);
	      $row3 = mysqli_fetch_array($data3);
	           if($row3['file_private'] == 1){
	                $private = 1;
	                }
	                
	  
	   $pos = strpos($new_idea, "!");
	  $pos1 = strpos($new_idea, "@");
	  $pos2 = strpos($new_idea, "$");
	  $pos3 = strpos($new_idea, "%");
	  $pos4 = strpos($new_idea, "^");
	  $pos5 = strpos($new_idea, "&");
	  $pos6 = strpos($new_idea, "?");
	  $pos7 = strpos($new_idea, "index.php");
	  $pos8 = strpos($new_idea, "*");
	  $pos9 = strpos($new_idea, "(");
	  $pos10 = strpos($new_idea, ")");
	  $pos11 = strpos($new_idea, "=");
	  $pos12 = strpos($new_idea, "+");
	  $pos13 = strpos($new_idea, "/");
	  $pos14 = strpos($new_idea, "\\");
	  $pos15 = strpos($new_idea, "'");
	  
	  
		  $charactersok =true;
		 if ($pos !== false || $pos1 !== false  || $pos2 !== false  || $pos3 !== false  || $pos4 !== false  || $pos5 !== false  || $pos6 !== false  || $pos7 !== false){
		     $charactersok =false;
		
		 }
		  if ($pos8 !== false || $pos9 !== false  || $pos10 !== false  || $pos11 !== false  || $pos12 !== false  || $pos13 !== false  || $pos14 !== false || $pos15 !== false){
		  
		     $charactersok =false;
		 
		 }
		 
		 if ("path" == $new_idea || "page" == $new_idea){
		  
		     $charactersok =false;
		 
		 }	 
		 
		 
		 
		 if ($charactersok){
		 
		 /////Insert into database////
			    $query = "INSERT INTO ideas (file_name, file_path,  creator, file_private, p_heading, p_descript, p_slogan) VALUES('" .
			                $new_idea . "', '".$path. "', '".$_SESSION['user_id']."', '".$private."', '".$headline."', '".$synopsis."', '".$slogan."')";
			  mysqli_query($dbc, $query);
			
			////Create actual directory///
			
			mkdir('../../'.$path.'/'.$new_idea , 0755);
			
			
		  }else{
		    header(' ', true, 400);
		    	$arr = array('msg' => 2, 'error' => '');
	                $jsn = json_encode($arr);
			echo $jsn;
	                 exit();

		  }
	   
	   if($private){
	
	
	   $query2 = "SELECT * FROM ideas WHERE file_path = '".$path. "' AND file_name = '".$new_idea ."' ORDER by file_id DESC LIMIT 1";
	   $data2 = mysqli_query($dbc, $query2);
	   $row2 = mysqli_fetch_array($data2);
	 
	   $query3 = "INSERT INTO folderprivacy (user_name, folderID) VALUES('".$_SESSION['username']."', '" .$row2['file_id']."')";
	   mysqli_query($dbc, $query3);
	   }
	   
	  
	  }else{
	
	 
	$ideas = array();
	
	
	
	$query = "SELECT * FROM ideas WHERE file_path = '".$path."' AND creator = '". $_SESSION['user_id']."'";
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
	            
	            
	                
	       $query = "SELECT * FROM ideas WHERE file_path = '".$path."' AND creator <> '". $_SESSION['user_id']."'";
	       $data = mysqli_query($dbc, $query);
	         
	       
	        $i = 0;
	      
	         while ($row = mysqli_fetch_array($data)){
	          
	          if($row['file_private'] == 1){
	              $query1 = "SELECT * FROM folderprivacy WHERE folderID = '".$row['file_id']."' AND user_name = '".$_SESSION['username']."'";
	              $data1 = mysqli_query($dbc, $query1);
	              
	             	 if(mysqli_num_rows($data1)>0){
	                 $ideas['public'][$i]['path'] = $row['file_path'];
		         $ideas['public'][$i]['page'] = $row['file_name'];
		         
		          $ideas['public'][$i]['type']['publicidea'] = 0;
		          $ideas['public'][$i]['type']['privateidea'] = 1;
		          $ideas['public'][$i]['type1']['btn btn-success'] = 0;
		           $ideas['public'][$i]['type1']['btn btn-info'] = 1;
		          
		           }
	           
	           }else{
	           
	           $ideas['public'][$i]['path'] = $row['file_path'];
	         $ideas['public'][$i]['page'] = $row['file_name'];
	         
	          $ideas['public'][$i]['type']['publicidea'] = 1;
	          $ideas['public'][$i]['type']['privateidea'] = 0;
	          $ideas['public'][$i]['type1']['btn btn-success'] = 1;
	          $ideas['public'][$i]['type1']['btn btn-info'] = 0;
	          
	        
	           }
	            $ideas['public'][$i]['id'] = $row['file_id'];
	            $i++;
	         }
	                 
	                 $ideas['current'] = 1;
	            
	            
	echo json_encode($ideas); 
	
	 }
	 
 
} 

?>