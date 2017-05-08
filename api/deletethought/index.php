<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(!isset($_SESSION['user_id'])){
exit();
}

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $thought_id = $request->thought_id;
  
$query = "SELECT * FROM thoughts WHERE id = '". $thought_id."'";
 $data = mysqli_query($dbc, $query);

 $row = mysqli_fetch_array($data);
 
 
 if($_SESSION['user_id'] != $row['member_id']){
 
 exit();
 }else{
 /////Good to delete ///////
 
 	if ($row['filename']!=NULL){
	
	unlink('../..'.$row['path'] . '/' . $row['filename']);

                       
                        $pic_parts = pathinfo($row['filename']);
                        
                        $thumbpicname = $pic_parts['filename'] . 'thum63820.' . $pic_parts['extension'];
                        
                        $gallpicname = $pic_parts['filename'] . 'gallery4434.' . $pic_parts['extension'];
	 
	if (file_exists('../..' . $row['path']  . '/' .$thumbpicname)){


                           unlink('../..' . $row['path']  . '/' .$thumbpicname);
                           
                        }
                        
     if (file_exists('../..' . $row['path']  . '/' . $gallpicname)){


                           unlink('../..' . $row['path']  . '/' . $gallpicname);
                           
                        }       
                        

        }

 

      // Delete the score data from the database
      $query1 = "DELETE FROM thoughts WHERE id = '".$thought_id."'";
      mysqli_query($dbc, $query1);
	
		 
	 
 mysqli_close($dbc); 
 
 
 }
 
 

?>