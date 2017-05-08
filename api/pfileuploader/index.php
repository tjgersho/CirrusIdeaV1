<?php


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
   echo 'ECHO THE FILE DIR VARIABLE IN RESIZE PICS ' . $filedir;
   
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

require_once('../startsession.php');


if (!isset($_SESSION['user_id'])) {

  exit();
  
}
  
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

 
 
$path = mysqli_real_escape_string($dbc, trim($_POST['ideaPath']));

$page = mysqli_real_escape_string($dbc, trim($_POST['ideaPage']));



 $response = array();
 
 $response['path'] = $path;
 $response['page'] = $page;

		  
	                   $query = "SELECT * FROM ideas WHERE file_path = '/".$path."' AND file_name = '".$page."'";
                            $data =  mysqli_query($dbc, $query);
                               $row = mysqli_fetch_array($data);
                               			  
			 if(empty($row['p_file6'])){
			 $p_fileNUM = 'p_file6';
			 }
			
			 if(empty($row['p_file5'])){
			 $p_fileNUM = 'p_file5';
			 }
			
			if(empty($row['p_file4'])){
			 $p_fileNUM = 'p_file4';
			 }
			 
			  if(empty($row['p_file3'])){
			 $p_fileNUM = 'p_file3';
			 }
			
			
			 if(empty($row['p_file2'])){
			 $p_fileNUM = 'p_file2';
			 }
			 
			 if(empty($row['p_file1'])){
			 $p_fileNUM = 'p_file1';
			 }
			 

if(!empty($_FILES) && $_SESSION['user_id'] == $row['creator'] && !empty($p_fileNUM)) {
echo 'In Files';

                $fileCount = count($_FILES['p_File']['name']);
echo 'File Count ' . $fileCount;
                
                  echo $i . ' var dump $FILES ' . var_dump($_FILES);
		
			if(is_uploaded_file($_FILES['p_File']['tmp_name'])) {
			
			echo 'Is an uploaded file';
			
			
			
			 $file_type = $_FILES['p_File']['type'];
                         $file_size = $_FILES['p_File']['size']; 
                         
	                 $fileinfo = pathinfo($_FILES['p_File']['name']);
                         $fileext = $fileinfo['extension'];
                         $file_name = $fileinfo['filename'];

			
			if (strlen($file_name) > 15) 
		              {
                                 $maxLength = 14;
                                 $file_name = substr($file_name, 0, $maxLength);
		               }
			$file_name = str_replace( '"', '' , $file_name);
                        $file_name = str_replace( "'", "" , $file_name);
                        $file_name= str_replace( ";", "" , $file_name);
                        $file_name = str_replace( "<?php", "" , $file_name);	
                        $file_name = str_replace( "<script>", "" , $file_name);	

			
			
			
			
			$sourcePath = $_FILES['p_File']['tmp_name'];
			$target =  "../../".$path.'/'.$page .'/'.$file_name. '.' . $fileext;
			
			    echo '      Pre Check if Exists Target path:' . $target;
			    echo '      File Exists check: ' . file_exists($target);
		     
		     if(file_exists($target)){	    
			while(file_exists($target)) {
                             srand((double)microtime()*1000000);
 
                            $newfilename = $file_name . rand(1000,20000) . '.' . $fileext;
                           
                        $target =  "../../".$path.'/'.$page .'/'.$newfilename;
                        }
                        }else{
                        $newfilename = $file_name . '.' . $fileext;
		          }
		          
			 $target =  "../../".$path.'/'.$page .'/'.$newfilename;
                          echo 'Target ! ' .  $target;
                          
			if(move_uploaded_file($sourcePath, $target)) {
				 echo '      Move uploaded file success  - Source:' . $sourcePath;
				echo '      Move uploaded file success  - Target:' . $target;
				          //// insert into database
				          ///Determine what p_file Slot is available //
				  
		
			
			
		          if (empty( $p_fileNUM)){
		          unlink($target);
		          }
		          
			 $query = "UPDATE ideas SET ".$p_fileNUM." = '".$newfilename ."' WHERE file_path = '/".$path."' AND file_name = '".$page."'";
			   mysqli_query($dbc, $query);
				          
				
if($fileext == 'jpg' || $fileext == 'JPG' ||  $fileext == 'jpeg' ||  $fileext == 'JPEG' ||  $fileext == 'png' || $fileext == 'PNG' ||  $fileext == 'gif' ||  $fileext == 'GIF' ){
	          	               
				            
				             resizepics($target , 300, 225);  // Create Thubnail Pic
				             resizepics($target , 1000, 1500, 1);  /// Create Gallery Pic	
                                                
				       }

				
				
								
								
				
                                 @unlink($_FILES['p_File']['tmp_name']);
                                 
				}
			}
		
		
		
	echo json_encode($response);	

}

?>

