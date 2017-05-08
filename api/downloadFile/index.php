<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  $file = $_GET['file'];

  
   
if(isset($file)){
 

//$safeFilename = '/^\w+\.\w+$/';


// Now get the filename from the user
$pathforfile =  dirname($file);
$filename12 = basename($file);


  // MAKE SURE THE FILENAME IS SAFE!
 if (!file_exists(urldecode('../../'.$pathforfile . '/' . $filename12))) {
 echo 'File Does not exits!';
 
    exit(0);
  }



 $file_path = dirname($pathforfile); 
  
  if (dirname($file_path) == '.' ){
  $file_path = '/files'; // . dirname($file_path); 
  }else{
    $file_path = '/files/' . dirname($file_path); 
  }
 
  $file_name = dirname($file);
   $file_name = basename($file_name);


  
 $viewokay = false;
 

 
  $query777 = "SELECT * FROM ideas WHERE file_name = '" . $file_name . "' AND file_path = '". $file_path. "'";
  $data777 = mysqli_query($dbc, $query777);
  $row777 = mysqli_fetch_array($data777);

  
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
   
       
if (!$viewokay) {
  

    $browse_url = 'http://www.cirrusidea.com';
     $redir_url = 'https://www.cirrusidea.com/#/';
     header('Location: ' .$redir_url);
        exit();
  } else {








 // header("Content-disposition: attachment; filename=$pathforfile/$filename12");
 
 // header("Content-type: application/octet-stream");
  
  // header('Content-Disposition: attachment; filename='.basename($filename12));
  //  header('Content-Transfer-Encoding: binary');
 //   header('Expires: 0');
//    header('Cache-Control: must-revalidate');
  //  header('Pragma: public');
//    ob_clean();
 //   flush();
  
 $fileinfo77878 = pathinfo($filename12); 


//if(strtolower($fileinfo77878['extension']) == 'mov'){
  
//header('Content-type: video/mpeg');    
//header('Content-Length: ' . filesize('../../'.$pathforfile . '/' . $filename12));  
//header("Expires: -1");    
//header("Cache-Control: no-store, no-cache, must-revalidate");
//header("Cache-Control: post-check=0, pre-check=0", false);  

//readfile('../../'.$pathforfile . '/' . $filename12);
//  exit(0);

//}else{
 // readfile("$pathforfile/$filename12",1);
  // Exit successfully. We could just let the script exit
  // normally at the bottom of the page, but then blank lines 
  // after the close of the script code would potentially cause 
  // problems after the file download.
  //exit(0);
  
 //   header( 'Expires: Mon, 1 Apr 1974 05:00:00 GMT' );
//header( 'Pragma: no-cache' );
//header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
//header( 'Content-Description: File Download' );
//header( 'Content-Type: application/octet-stream' );
//header( 'Content-Length: '.filesize($pathforfile . '/' . $filename12 ) );

//header('Content-Disposition: attachment; filename="'.basename($pathforfile . '/' . $filename12).'"');
//header( 'Content-Transfer-Encoding: binary' );
//  readfile($pathforfile . '/' . $filename12);
//  exit(0);
  
  

  
  
  
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="'.$filename12.'"'); 
header("Content-Type: application/force-download");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", fasle);
 header("Content-Type: application/octet-stream");
//header("Content-Type: application/download");
header('Content-Transfer-Encoding: binary');
header('Connection: Keep-Alive');
header('Expires: 0');

header('Pragma: public');
header('Content-Length: ' . filesize('../../'.$pathforfile . '/' . $filename12));
//ob_clean();
//flush();


  readfile('../../'.$pathforfile . '/' . $filename12);
  exit(0);
  
//}
//  header('Content-Description: File Transfer');
//    header('Content-Type: application/octet-stream');
//    header('Content-Disposition: attachment; filename='.basename($pathforfile . '/' . $filename12));
//    header('Expires: 0');
//    header('Cache-Control: must-revalidate');
//    header('Pragma: public');
 //   header('Content-Length: ' . filesize($pathforfile . '/' . $filename12));
 //   readfile($pathforfile . '/' . $filename12);
 //   exit;  
  
  
}

}
 
/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////


 
 

?>