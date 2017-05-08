<?php
require_once('startsession.php');


  $root = realpath($_SERVER["DOCUMENT_ROOT"]); 
  require_once($root.'/appvars.php');
  require_once($root.'/connectvars.php');
  
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
if(isset($_GET['file'])){
    
    
     
  $fileurl = $_GET['file'];
     
 $file_path = dirname($fileurl); 
  
  if (dirname($file_path) == '.'){
  $file_path = '/files'; // . dirname($file_path); 
  }else{
    $file_path = '/files/' . dirname($file_path); 
  }
 
  $file_name = dirname($fileurl);
   $file_name = basename($file_name);
   
 
 $file = basename($fileurl);
 
 //$file = str_replace('thum63820', '',  $file);
 
//echo $fileurl .'<br />' . $file_path .'<br />' . $file_name  . '<br />' . $file;
  
 $viewokay = true;
 
  $query777 = "SELECT * FROM cbpfiles WHERE file_name = '" . $file_name . "' AND file_path = '". $file_path. "'";
  $data777 = mysqli_query($dbc, $query777);
  $row777 = mysqli_fetch_array($data777);

  
 if ($row777['file_private'] == 1) {
       $viewokay = false;
       $query432 = "SELECT * FROM folderprivacy WHERE folderID = '" . $row777['file_id'] . "'";
       $data432= mysqli_query($dbc, $query432);
        while($row432 = mysqli_fetch_array($data432)) { 
        	if($_SESSION['username'] == $row432['user_name']){
			$viewokay = true;
			 }
			}
		}
   
   
  $query787 = "SELECT * FROM creativebrainpower WHERE filename = '" . $file . "' AND file_id = '". $file_path . '/' . $file_name . "'";
  $data787 = mysqli_query($dbc, $query787);
  $row787 = mysqli_fetch_array($data787);

  
 if ($row787['private'] == 1) {
       $viewokay = false;
		}   
 //echo !$viewokay;  
   	
       
       
       
if (!$viewokay) {
  

    $browse_url = 'http://www.cirrusidea.com';
      header('Location: ' . $browse_url);
       exit();
        
  } else {

//////////////////////////////////////////////////////////////////////////////////////////////

/////This section of code has to do with downloading a file from the current index folder////

 
//echo  $fileextenstion;
// Now get the filename from the user
  $path_parts=pathinfo($file);
  $filenameonly =  $path_parts['filename'];
  $fileextenstion = $path_parts['extension'];

  
            switch(strtolower($path_parts['extension']))
            {
            case "gif":
                 header("Content-type: image/gif");
                 break;
            case "jpg":
            case "jpeg":
                 header("Content-type: image/jpeg");
                break;
            case "png":
                header("Content-type: image/png");
                break;
            case "bmp":
                header("Content-type: image/bmp");
                break;
           default:
               
               $browse_url = 'http://www.cirrusidea.com' . $file_path.'/'. $file_name;
                header('Location: ' . $browse_url);
                exit();
            
            }      
            
             
            header("Accept-Ranges: bytes");
            header('Content-Length: ' . filesize($root. $file_path.'/'. $file_name . '/' . $file));
                                  
            readfile($root. $file_path.'/'. $file_name . '/' . $file);

 
        
  
 /*
  header("Content-disposition: attachment; filename=$pathforfile/$filename12");
 
  header("Content-type: application/octet-stream");
  
 //  header('Content-Disposition: attachment; filename='.basename($filename12));
  //  header('Content-Transfer-Encoding: binary');
//    header('Expires: 0');
 //   header('Cache-Control: must-revalidate');
 //   header('Pragma: public');
 //   ob_clean();
 //   flush();
 
$_SERVER['http://www.cirrusidea.com' . $file_path.'/'. $file_name . '/' . $file];

  //readfile($root . '/' . $file_path.'/'. $file_name . '/' . $file,1);
//  fopen('http://www.cirrusidea.com' . $file_path.'/'. $file_name . '/' . $file, 'r');
  // Exit successfully. We could just let the script exit
  // normally at the bottom of the page, but then blank lines 
  // after the close of the script code would potentially cause 
  // problems after the file download.
  
     //  $browse_url = 'http://www.cirrusidea.com' . $file_path.'/'. $file_name;
      // header('Location: ' . $browse_url);
 
  */
 }
  
 
  
 } 
    else { exit();
    }


/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////


