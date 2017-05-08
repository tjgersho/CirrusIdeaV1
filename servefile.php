<?php

 $root = realpath($_SERVER["DOCUMENT_ROOT"]);  

  //session_start();
         
 require_once('api/startsession.php');

 require_once('api/connectvars.php');
//  $a = session_id();
//if(empty($a)) session_start();
//echo "SID: ".SID."<br>session_id(): ".session_id()."<br>COOKIE: ".$_COOKIE["PHPSESSID"];

 //echo $_SESSION['username'];
if(isset($_GET['file'])){
    
 //echo $_GET['file'];
     
  $fileurl = $_GET['file'];
  
     $fileurl = urldecode ($fileurl);
     
      $file_path = dirname($fileurl); 
  
  if (dirname($file_path) == '.'){
  $file_path = '/files'; // . dirname($file_path); 
  }else{
    $file_path = '/files/' . dirname($file_path); 
  }
 
  $file_name = dirname($fileurl);
   $file_name = basename($file_name);
   

 
 $file = basename($fileurl);


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if($file == 'index.html.var'){
 $redir_url = 'https://cirrusidea.com/login';
 header('Location: ' .$redir_url);
 exit();
}	  

//echo $file_name . '   ' . $file_path . '   ';
  
 $viewokay = false;
 
  $query777 = "SELECT * FROM ideas WHERE file_name = '" . $file_name . "' AND file_path = '". $file_path. "'";
  $data777 = mysqli_query($dbc, $query777);
  $row777 = mysqli_fetch_array($data777);

 

 // echo '  File Private ' . $row777['file_private'];
 if ($row777['file_private'] == 1) {
       $viewokay = false;
       $query432 = "SELECT * FROM folderprivacy WHERE folderID = '" . $row777['file_id'] . "' AND user_name = '".$_SESSION['username']."'";
       $data432= mysqli_query($dbc, $query432);
       
        	if(mysqli_num_rows($data432)>0){
			$viewokay = true;
			 }else{
			 $viewokay = false;
			}
		}else{
		$viewokay = true;
		
		}

 //echo 'View Ok ' . $viewokay;
 
       
if (!$viewokay) {
  


     $redir_url = 'https://cirrusidea.com/login';
     header('Location: ' .$redir_url);
     exit();
        
  } else {

//////////////////////////////////////////////////////////////////////////////////////////////

/////This section of code has to do with downloading a file from the current index folder////
 $finfo = finfo_open(FILEINFO_MIME_TYPE); 
            
  $content_type =  finfo_file($finfo, substr($file_path, 1).'/'. $file_name . '/'. $file);
  finfo_close($finfo);
  

// Now get the filename from the user
  //$path_parts=pathinfo($file);
  //$filenameonly =  $path_parts['filename'];
  //$fileextenstion = $path_parts['extension'];
  //echo  $fileextenstion;

 header("Content-type: ". $content_type);


 ob_start();
                
          // echo $file_path. '             ';
          // echo   substr($file_path, 1).'/'. $file_name . '/'. $file;
             
            //header("Accept-Ranges: bytes");
            
               
            header('Content-Length: ' . filesize( substr($file_path, 1).'/'. $file_name . '/'. $file));
                     
                             
                               
            readfile( substr($file_path, 1).'/'. $file_name . '/'. $file);

 
        ob_end_flush();

 }
  exit();
 
  switch(strtolower($fileextenstion))
            {
            case "gif":
                 header("Content-type: image/gif");
                 break;
            case "jpg":
            case "jpeg":
           header("Content-Type: application/octet-stream");

                // header("Content-type: image/jpeg");
                break;
            case "png":
                header("Content-type: image/png");
                break;
            case "bmp":
                header("Content-type: image/bmp");
                break;
            case "mp3":
                header("Content-type: audio/mpeg");
                break;
            case "mov":
                
                   // header("Content-type: video/mp4");   
                
                
                    header("Content-Type: application/octet-stream");
 
               // header("Expires: -1");    
                //header("Cache-Control: no-store, no-cache, must-revalidate");
	        //header("Cache-Control: post-check=0, pre-check=0", false);  
                               
               // readfile( substr($file_path, 1).'/'. $file_name . '/'. $file);
                
               // exit();
        
                break;
            case "mp4":
                header("Content-type: video/mpeg");    
                
                   // header("Content-Type: application/octet-stream");
 
               // header("Expires: -1");    
                //header("Cache-Control: no-store, no-cache, must-revalidate");
	        //header("Cache-Control: post-check=0, pre-check=0", false);  
                               
                //readfile( substr($file_path, 1).'/'. $file_name . '/'. $file);
                
              //  exit();  
                break;
           case "webm":
                header("Content-type: video/webm");  
                
                 //   header("Content-Type: application/octet-stream");
 
               // header("Expires: -1");    
                //header("Cache-Control: no-store, no-cache, must-revalidate");
	        //header("Cache-Control: post-check=0, pre-check=0", false);  
                               
                readfile( substr($file_path, 1).'/'. $file_name . '/'. $file);
                
                exit();    
                break;     
           case "ogg":
                header("Content-type: video/ogg");   
                
                  //  header("Content-Type: application/octet-stream");
 
               // header("Expires: -1");    
                //header("Cache-Control: no-store, no-cache, must-revalidate");
	        //header("Cache-Control: post-check=0, pre-check=0", false);  
                               
               // readfile( substr($file_path, 1).'/'. $file_name . '/'. $file);
                
               // exit();   
                break; 
           default:
               $browse_url = 'https://cirrusidea.com/cirrus/path/' . substr($file_path, 1).'/page/'. $file_name;
               var_dump($browse_url);
                 header('Location: ' . $browse_url);
                exit();
            
            } 
 } else { 
 
 exit();
    }


/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////


