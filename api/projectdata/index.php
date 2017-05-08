<?php
ignore_user_abort(true);
set_time_limit(0);
////////////////////////////////////////////////////
///////////////////Thumbnail Function////////////////////

function resizepics($pics, $newwidth, $newheight){

$newpicname = basename($pics);
  $pic_parts = pathinfo( $newpicname);
 // echo "hello";
   $newpicname = $pic_parts['filename'] . 'thum63820';
 
 
$extension = $pic_parts['extension'];

//$pics = str_replace(" ", "%20" , $pics);
//echo $pics;
list($width, $height) = getimagesize($pics);
  

if (($width/$height) > 1.333)
{  
 $newheight = ($height / $width) * $newwidth;   

}else {
           $newwidth = ($width / $height) * $newheight; 
} 

    if(preg_match("/.jpg/i", basename($pics) )){
    $source = imagecreatefromjpeg($pics);
    }
   
    if(preg_match("/.jpeg/i", basename($pics))){
    $source = imagecreatefromjpeg($pics);
    }
    if(preg_match("/.png/i", basename($pics))){
    $source = imagecreatefrompng($pics);
    imageAlphaBlending( $source, true);
    imageSaveAlpha( $source, true);
    }
    if(preg_match("/.gif/i", basename($pics))){
    $source = imagecreatefromgif($pics);
    }
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
   
   $filedir = dirname($pics);
   //echo 'ECHO THE FILE DIR VARIABLE IN RESIZE PICS ' . $filedir;
   
  if(preg_match("/.jpg/i", basename($pics))){ 
	if(ctype_upper($extension)){
	   return imagejpeg($thumb, $filedir .'/'. $newpicname . '.JPG');
	}
	else {
	     return imagejpeg($thumb, $filedir .'/'. $newpicname . '.jpg');
	} 
    }
   

    if(preg_match("/.jpeg/i", basename($pics))){
    return imagejpeg($thumb, $filedir . '/'.$newpicname . '.jpeg');
   }
    if(preg_match("/.png/i", basename($pics))){
      if(ctype_upper($extension)){  
    return imagepng($thumb, $filedir . '/'.$newpicname . '.PNG');
      
      }else {
    return imagepng($thumb, $filedir . '/'.$newpicname . '.png');
    }
    
   }
    if(preg_match("/.gif/i", basename($pics))){
    return imagegif($thumb, $filedir .'/'. $newpicname . '.gif');
    }
    

}


////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////




function p_file_type($filename){

 $path_parts = pathinfo($filename);

	          
	          switch ($path_parts['extension']){
	            case 'mpg':	               
	            case 'MPG':
                    case 'mp4':
                    case 'oog':
                    case 'OOG':
                    case 'webm':
                    case 'avi':
                    case 'mov':
                    case 'MOV':
	              return 'video';
	              	           
                    case 'mp3':
	              return 'audio';
	               
	            	               
	            case 'jpg':
	            case 'JPG':
	            case 'png':
	            case 'PNG':
	            case 'gif':
	            case 'GIF':
	             return 'image';	              
	           
	           default:
	               return 'other';
	              
	           }

}



require_once('../startsession.php');

  
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

  

  $path = $request->path;
  $page = $request->page;
  
  
  $headline = $request->headline;
    
  $synopsis = $request->synopsis;
  
  $slogan = $request->slogan;
  
  $update = $request->update;
  
  
  $isDelcall = $request->del;
  
  if( $isDelcall == 1 ){
  echo 'DELETE THAT BABY ';
  
 $p_file_num = $request->p_file_num;
 
 $query = "SELECT * FROM ideas WHERE file_path = '/".$path."' AND file_name = '".$page."'";
                            $data =  mysqli_query($dbc, $query);
                               $row = mysqli_fetch_array($data);
                               
   $path_parts = pathinfo($row['p_file'.($p_file_num+1)]);                            			  
 $idea_id = $row['file_id'];	 
 $p_fileNUM = 'p_file'.($p_file_num+1);
 
 echo  $p_file_num;
 
 echo '       ' .$path . ' ' . $page;
 
  $query = "UPDATE ideas SET ".$p_fileNUM." = NULL WHERE file_id = '". $idea_id ."'";
	 mysqli_query($dbc, $query);

 
 $filepath = '../../' . $path .'/'.$page .'/'.$path_parts['filename'].'.'.$path_parts['extension'];
 
 $thumfilepath = '../../' .$path .'/'.$page .'/'.$path_parts['filename'].'thum63820.'.$path_parts['extension'];
 
 echo 'File Path      ' .$filepath;
 if(file_exists($filepath)){	
 unlink($filepath);
 }
 if(file_exists($thumfilepath)){
  unlink($thumfilepath);
  }
  
  }else{
  
$ideadataarray = array();
$ideadataarray['isOwner'] = false;


 $query = "SELECT * FROM ideas WHERE file_path = '/".$path."' AND file_name = '".$page."'";
 $data =  mysqli_query($dbc, $query);
  $row = mysqli_fetch_array($data);
 $ideadataarray['headline'] = $row['p_heading'];
  $ideadataarray['synopsis'] = $row['p_descript'];
   $ideadataarray['slogan'] = $row['p_slogan'];
   
   
   
   $ideadataarray['isuptodate'] = false;
   
   
 if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['creator']){ 	
 	
	$ideadataarray['isOwner'] = true;
			
			if($update == 1){
			
			 $query = "UPDATE ideas SET p_heading = '".$headline ."', p_descript = '". $synopsis."', p_slogan ='".$slogan."' WHERE file_path = '/".$path."' AND file_name = '".$page."'";
                          mysqli_query($dbc, $query);
			
			  $ideadataarray['headline'] = $headline ;
                          $ideadataarray['synopsis'] = $synopsis;
                           $ideadataarray['slogan'] = $slogan;
			
			 $ideadataarray['isuptodate'] = true;
			
			}
			
    }       
           



   
     ///////////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////////////////////////////////////////////////////////////
      
      for ($i=0; $i<6; $i++){
      $ideadataarray['p_files'][$i]['iter'] = $i;
     
     if(!empty($row['p_file'.($i+1)])){
      
     $ideadataarray['p_files'][$i]['fname'] = $row['p_file'.($i+1)];

     $path_parts = pathinfo($row['p_file'.($i+1)]);


     
     $ideadataarray['p_files'][$i]['ftype'] =  p_file_type($row['p_file'.($i+1)]);
     
      if($ideadataarray['p_files'][$i]['ftype'] == 'image'){  
     $ideadataarray['p_files'][$i]['fthumb'] = $path."/". $page . "/". $path_parts['filename'] .'thum63820.' . $path_parts['extension'];
       
            if (!file_exists('../../'. ltrim ($ideadataarray['p_files'][$i]['fthumb'] , '/'))) {                                                   
                                 resizepics('../../'. ltrim ($ideadataarray['p_files'][$i]['fthumb'] , '/') , 300, 225);
                               }
            }
     
     $ideadataarray['p_files'][$i]['fpath'] = $path."/". $page . "/". $row['p_file'.($i+1)];
     $ideadataarray['p_files'][$i]['fsize'] =  filesize('../../'.$ideadataarray['p_files'][$i]['fpath']); 
       
       }
       
       }
     
   ///////////////////////////////////////////////////////////////////////////////////////    
     ///////////////////////////////////////////////////////////////////////////////////////   
        ///////////////////////////////////////////////////////////////////////////////////////   
                  
     
     
     
         if(empty($row['p_file1']) || empty($row['p_file2']) ||  empty($row['p_file3']) || empty($row['p_file4'])  || empty($row['p_file5'])  || empty($row['p_file6']) ){
         $ideadataarray['empty_p_files'] = true;
         }else{
          $ideadataarray['empty_p_files'] = false;
         }
         
         
  
       
     echo json_encode($ideadataarray);
	           			
	}
	
		
 mysqli_close($dbc); 
 
 

 
?>

