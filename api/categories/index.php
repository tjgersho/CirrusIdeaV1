<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){

  if (!isset($_SESSION['user_id'])) {
    exit();  
  }
  




$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
 

  $new_idea = mysqli_real_escape_string($dbc, trim($request->idea));
  $private = $request->file_private;
  
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
	    	$arr = array('msg' => "There are ideas in this Category, so it cannot be deleted", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();
                }         
    
   $query5 = "SELECT * FROM thoughts WHERE path LIKE '".$row3['file_path']."/".$row3['file_name']."/%'";
   $data5 = mysqli_query($dbc, $query5);
   $row5 = mysqli_fetch_array($data5);
           if(mysqli_num_rows($data5)>0){
                header(' ', true, 400);
	    	$arr = array('msg' => "There are thoughts in this Category, so it cannot be deleted.", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();
                }
 
    //////Okay to delete if it makes it here.. /////////
    
             // Delete the score data from the database
      $query1 = "DELETE FROM ideas WHERE file_id = '".$file_id."'";
      mysqli_query($dbc, $query1);
      
       rmdir ('../..'.$row3['file_path'].'/'.$row3['file_name']);

    exit();
  
  
  }else{
  
  
  if(!$private){
  $private = 0;

  }else{
  $private = 1;
  }
  
 
 
  
  ///// First Check to see if the file if public exists ///

  
  $query3 = "SELECT * FROM ideas WHERE file_path = '/files' AND file_name = '".$new_idea ."' ORDER by file_id DESC LIMIT 1";
   $data3 = mysqli_query($dbc, $query3);
   $row3 = mysqli_fetch_array($data3);
           if(mysqli_num_rows($data3)>0){
                header(' ', true, 400);
	    	$arr = array('msg' => 1, 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();
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

		  $query = "INSERT INTO ideas (file_name, file_path,  creator, file_private) VALUES('" .
		                $new_idea . "', '/files', '".$_SESSION['user_id']."', '".$private."')";
		  mysqli_query($dbc, $query);
		  
		  
		  mkdir('../../files/'.$new_idea , 0755);
		
		   }else{
		          header(' ', true, 400);
		    	$arr = array('msg' => 2, 'error' => '');
	                $jsn = json_encode($arr);
			echo $jsn;
	                 exit();

		  }

   
   if($private){
   $query2 = "SELECT * FROM ideas WHERE file_path = '/files' AND file_name = '".$new_idea ."' ORDER by file_id DESC LIMIT 1";
   $data2 = mysqli_query($dbc, $query2);
   $row2 = mysqli_fetch_array($data2);
   $query3 = "INSERT INTO folderprivacy (user_name, folderID) VALUES('".$_SESSION['username']."', '" .$row2['file_id']."')";
   mysqli_query($dbc, $query3);
   }
   
   
exit();

}






}


          


$categories = array();


$query = "SELECT * FROM ideas WHERE file_path = '/files' AND creator = '". $_SESSION['user_id']."'";
         $data = mysqli_query($dbc, $query);
         
       
         $categories = array();
      
         $i = 0;
         while ($row = mysqli_fetch_array($data)){
          
          if($row['file_private'] == 1){
              $query1 = "SELECT * FROM folderprivacy WHERE folderID = '".$row['file_id']."' AND user_name = '".$_SESSION['username']."'";
              $data1 = mysqli_query($dbc, $query1);
              
             	 if(mysqli_num_rows($data1)>0){
          
	          $categories['owner'][$i]['page'] = $row['file_name'];
	         
	           $categories['owner'][$i]['type']['publicidea'] = 0;
	          $categories['owner'][$i]['type']['privateidea'] = 1;
	          $categories['owner'][$i]['type1']['btn btn-success'] = 0;
	           $categories['owner'][$i]['type1']['btn btn-info'] = 1;
	          
	         
	           }
           
           }else{
           
        
         $categories['owner'][$i]['page'] = $row['file_name'];
         
         $categories['owner'][$i]['type']['publicidea'] = 1;
         $categories['owner'][$i]['type']['privateidea'] = 0;
         $categories['owner'][$i]['type1']['btn btn-success'] = 1;
         $categories['owner'][$i]['type1']['btn btn-info'] = 0;
          
          
           }
           
            $categories['owner'][$i]['id'] = $row['file_id'];
            $i++;
         }
            
            
            
       $query = "SELECT * FROM ideas WHERE file_path = '/files' AND creator != '". $_SESSION['user_id']."'";
       $data = mysqli_query($dbc, $query);
         
       

       $i = 0;
         while ($row = mysqli_fetch_array($data)){
         
          if($row['file_private'] == 1){
         
              $query1 = "SELECT * FROM folderprivacy WHERE folderID = '".$row['file_id']."' AND user_name = '".$_SESSION['username']."'";
              $data1 = mysqli_query($dbc, $query1);
              
             	 if(mysqli_num_rows($data1)>0){
          
	         $categories['public'][$i]['page'] = $row['file_name'];
	         
	          $categories['public'][$i]['type']['publicidea'] = 0;
	          $categories['public'][$i]['type']['privateidea'] = 1;
	          $categories['public'][$i]['type1']['btn btn-success'] = 0;
	           $categories['public'][$i]['type1']['btn btn-info'] = 1;
	          
	           
	          
	           }
           
           }else{
           
           
         $categories['public'][$i]['page'] = $row['file_name'];
         
          $categories['public'][$i]['type']['publicidea'] = 1;
          $categories['public'][$i]['type']['privateidea'] = 0;
          $categories['public'][$i]['type1']['btn btn-success'] = 1;
          $categories['public'][$i]['type1']['btn btn-info'] = 0;
          
          
          
           }
           $categories['public'][$i]['id'] = $row['file_id'];
           $i++;
           
         }
                 
        $categories['current'] = 1;    
            
echo json_encode($categories); 


?>