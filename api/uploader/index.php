<?php


////////////////////////////////////////////////////
///////////////////Thumbnail Function////////////////////

function resizepics($pics, $newwidth, $newheight, $gallery=NULL){

$newpicname = basename($pics);
  $pic_parts = pathinfo( $newpicname);
 // echo "hello";
 if($gallery){
     $newpicname = $pic_parts['filename'] . 'gallery4434';
     
 } else{
  $newpicname = $pic_parts['filename'] . 'thum63820';
 }
 
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

 $newthought = mysqli_real_escape_string($dbc, trim($_POST['newthought']));
$newthought = str_replace('HTTPPROTOCOL234234', 'http://', $newthought);
$newthought = str_replace('HTTPPROTOCOLsss234234', 'https://', $newthought);


$path = mysqli_real_escape_string($dbc, trim($_POST['ideaPath']));

$page = mysqli_real_escape_string($dbc, trim($_POST['ideaPage']));

$thoughtdate = date("Y-m-d H:i:s");   

 $response = array();
 
 $response['path'] = $path;
 $response['page'] = $page;
 $response['thoughtdate'] = $thoughtdate;
 $response['thought'] =$newthought;
 
 
 
if(!empty($_FILES)) {
echo 'In Files';

                $fileCount = count($_FILES['userFile']['name']);
echo 'File Count ' . $fileCount;
                for ($i = 0; $i < $fileCount; $i++) { 
                  echo $i . ' var dump $FILES ' . var_dump($_FILES);
		
			if(is_uploaded_file($_FILES['userFile']['tmp_name'][$i])) {
			
			echo 'Is an uploaded file';
			
			
			
			 $file_type = $_FILES['userFile']['type'][$i];
                         $file_size = $_FILES['userFile']['size'][$i]; 
                         
	                 $fileinfo = pathinfo($_FILES['userFile']['name'][$i]);
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

			
			
			
			
			$sourcePath = $_FILES['userFile']['tmp_name'][$i];
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
 
				if(move_uploaded_file($sourcePath,$target)) {
				  echo '      Move uploaded file success  - Source:' . $sourcePath;
				echo '      Move uploaded file success  - Target:' . $target;
				          //// insert into database
				          
			 $query = "INSERT INTO thoughts (date, headline, filename, member_id, path, filesize, rating) VALUES ('" .
			  $thoughtdate . "', '" . $newthought . "', '" . $newfilename . "', '" . $_SESSION['user_id'] . 
			  "', '/" . $path. '/' . $page . "', " . $file_size . ", " . 0 . ")";
	
	                         mysqli_query($dbc, $query);
				          
				
				  if($fileext == 'jpg' || $fileext == 'JPG' ||  $fileext == 'jpeg' ||  $fileext == 'JPEG' ||  $fileext == 'png' || $fileext == 'PNG' ||  $fileext == 'gif' ||  $fileext == 'GIF' ){
	          	               
				            
				             resizepics($target , 300, 225);  // Create Thubnail Pic
				             resizepics($target , 1000, 1500, 1);  /// Create Gallery Pic	
                                                
				       }

				
			  $query877= "SELECT id FROM thoughts WHERE date = '".$thoughtdate. "' AND path = '/".$path. '/' . $page ."' AND member_id = '".$_SESSION['user_id']."'";
                            $data877 = mysqli_query($dbc, $query877);
                            $row877 = mysqli_fetch_array($data877);
				$thought_id = 	$row877['id'];
					
				require_once("../Classes/CirrusEmail.php");			
				
/////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////Email Members! ///
/////////////////////////////////////////////////////////////////////////////////////////////////				
			    
			    $query8787= "SELECT DISTINCT(member_id) AS member_id FROM thoughts WHERE path = '/".$path. '/' . $page ."'";
                            $data8787 = mysqli_query($dbc, $query8787);
                           //echo ' FILE PATH ' . $path;
//echo ' FILE Name ' . $page;
                            $query8898 = "SELECT file_id, file_private FROM ideas WHERE file_path = '/".$path . "' AND file_name =  '". $page ."'";
                            $data8898 = mysqli_query($dbc, $query8898);
                            $row8898 = mysqli_fetch_array($data8898);

 			   $filePrivate = $row8898['file_private'];
                           $folder_id = $row8898['file_id'];
                           
                        //  echo ' FILE PRIVATE  ' . $filePrivate;
                          
                          
                          
                              $j = 0;
                            while ($row8787 = mysqli_fetch_array($data8787)) { 	
                            $emailOK = false;
                       //   echo '    MEMBER ID    ' . $row8787['member_id'];
                             
                           	
                            $query888 = "SELECT * FROM users WHERE user_id = '" . $row8787['member_id'] . "' LIMIT 1";
                            $data888 = mysqli_query($dbc, $query888);
                            $row888 = mysqli_fetch_array($data888);
                            
                           if($filePrivate == 1){
                           $query8998 = "SELECT * FROM folderprivacy WHERE folderID = '".$folder_id . "' AND user_name =  '". $row888['username']."'";
                           $data8998 = mysqli_query($dbc, $query8998);
                            
                             if(mysqli_num_rows($data8998)>0){
                               $emailOK = true;
                             }
                           }else{
                           $emailOK = true;
                           
                           }
                            
	                 echo 'MAIL : ' .  $row888['username'] . ' EMAIL OK : ' . $emailOK . '     ';
                                if ($row888['mailme'] == 1 && $row888['username'] != $_SESSION['username'] && $emailOK){	
                                
                                
                                
				                                 //Create a new PHPMailer instance
				$memberinThreadEmail[$j] = new CirrusEmail('membersinthreadEmail',  $_SESSION['username'], $_SESSION['user_id']);
				
				
				$injectArray['tousername'] = $row888['username']; 
				$injectArray['postername'] = $_SESSION['username'];
				$injectArray['page'] = $page;
				$injectArray['path'] = $path;
				$injectArray['newthought'] = $newthought;
				$injectArray['thought_id'] = $thought_id;
				$injectArray['filename'] = $newfilename;
				
				$memberinThreadEmail[$j]->getEmail($injectArray);
				                        $toA = array();
							$toA['email'] = $row888['email'];
				                        $toA['name'] = $row888['username'];				                   
				                        
				                        $fromA = array();
							$fromA['email'] = 'cirrusidea@cirrusidea.com';
				                        $fromA['name'] = 'CirrusIdea';
				                        
				$memberinThreadEmail[$j]->sendEmail($toA, $fromA); 
				

                            	 $j++;
	
	                                }
                        	
	
                        }
				
				
/////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
				
				
				
                                 @unlink($_FILES['userFile']['tmp_name'][$i]);
                                 
				}
			}
		}
		
		
	echo json_encode($response);	

}elseif(isset($_POST['newthought'])){


  //// insert into database
				          
			 $query = "INSERT INTO thoughts (date, headline,  member_id, path,  rating) VALUES ('" .
			  $thoughtdate . "', '" . $newthought . "', '" . $_SESSION['user_id'] . 
			  "', '/" . $path. '/' . $page . "',  0 )";
	
	                         mysqli_query($dbc, $query);
				          
				$query877= "SELECT id FROM thoughts WHERE date = '".$thoughtdate. "' AND path = '/".$path. '/' . $page ."' AND member_id = '".$_SESSION['user_id']."'";
                            $data877 = mysqli_query($dbc, $query877);
                            $row877 = mysqli_fetch_array($data877);
				$thought_id = 	$row877['id'];
					          
				          
			require_once("../Classes/CirrusEmail.php");	
/////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////Email Members! ///
/////////////////////////////////////////////////////////////////////////////////////////////////				
			    
			    $query8787= "SELECT DISTINCT(member_id) AS member_id FROM thoughts WHERE path = '/".$path. '/' . $page ."'";
                            $data8787 = mysqli_query($dbc, $query8787);
                           

                            $query8898 = "SELECT file_private, file_id  FROM ideas WHERE file_path = '/".$path . "' AND file_name =  '". $page ."'";
                            $data8898 = mysqli_query($dbc, $query8898);
                            $row8898 = mysqli_fetch_array($data8898);
//echo ' FILE PATH ' . $path;
//echo ' FILE Name ' . $page;
 			   $filePrivate = $row8898['file_private'];
                           $folder_id = $row8898['file_id'];
                          //echo ' FILE PRIVAT ' . $filePrivate;
                              $j = 0;
                            while ($row8787 = mysqli_fetch_array($data8787)) { 	
                            $emailOK = false;
                          
                            //   echo '    MEMBER ID    ' . $row8787['member_id'];
                           	
                            $query888 = "SELECT * FROM users WHERE user_id = '" . $row8787['member_id'] . "' LIMIT 1";
                            $data888 = mysqli_query($dbc, $query888);
                            $row888 = mysqli_fetch_array($data888);
                            
                           if($filePrivate == 1){
                           $query8998 = "SELECT * FROM folderprivacy WHERE folderID = '".$folder_id . "' AND user_name =  '". $row888['username']."'";
                           $data8998 = mysqli_query($dbc, $query8998);
                            
                            if(mysqli_num_rows($data8998)>0){
                               $emailOK = true;
                             }
                           }else{
                           $emailOK = true;
                           
                           }
                            
	echo 'MAIL : ' .  $row888['username'] . ' EMAIL OK : ' . $emailOK . '     ';
                                if ($row888['mailme'] == 1 && $row888['username'] != $_SESSION['username'] && $emailOK){	
                                
                                
                                
                                                             //Create a new PHPMailer instance
				$memberinThreadEmail[$j] = new CirrusEmail('membersinthreadEmail',  $_SESSION['username'], $_SESSION['user_id']);
				
				
				$injectArray['tousername'] = $row888['username']; 
				$injectArray['postername'] = $_SESSION['username'];
				$injectArray['page'] = $page;
				$injectArray['path'] = $path;
				$injectArray['newthought'] = $newthought;
				$injectArray['thought_id'] = $thought_id;
				
				
				$memberinThreadEmail[$j]->getEmail($injectArray);
				                        $toA = array();
							$toA['email'] = $row888['email'];
				                        $toA['name'] = $row888['username'];				                   
				                        
				                        $fromA = array();
							$fromA['email'] = 'cirrusidea@cirrusidea.com';
				                        $fromA['name'] = 'CirrusIdea';
				                        
				$memberinThreadEmail[$j]->sendEmail($toA, $fromA); 
				
                            	
	                               $j++;
	                                }
                        	
	
                        }
				
				
/////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////Email Members! ///
/////////////////////////////////////////////////////////////////////////////////////////////////
				
				
		
	echo json_encode($response);	



}
?>

