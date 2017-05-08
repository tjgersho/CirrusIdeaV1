<?php


$root = realpath($_SERVER["DOCUMENT_ROOT"]); 
  require_once($root.'/appvars.php');
  require_once($root.'/connectvars.php');
 // Start the session
  require_once($root.'/startsession.php');
   // Insert the page header

 $file_dir1 = dirname($_SERVER['PHP_SELF']); 
 $file_dir2 = dirname($file_dir1);
 $foldername1 = basename($file_dir1);

 if (!isset($_SESSION['user_id'])) {
     $page_title = $foldername1;
  require_once($root.'/header.php');
   require_once($root.'/navmenu.php');
   echo '<p> You are not logged in.  Enter your username and password above. </p>';
   
   // Insert the page footer
  require_once($root.'/footer.php');
    exit();
  
  }
  
function isIphone($user_agent=NULL) {
    if(!isset($user_agent)) {
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }
    return (strpos($user_agent, 'iPhone') !== FALSE);
}

$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');

 
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
 $viewokay = true;
 
  $query777 = "SELECT * FROM cbpfiles WHERE file_name = '$foldername1' AND file_path = '$file_dir2'";
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
	
if (!$viewokay) {
     $page_title = $foldername1;
  require_once($root.'/header.php');
     require_once($root.'/navmenu.php');
	echo '<p class="login">This is a private page, you must be invited by the owner to see this page.</p>';
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
      // Insert the page footer
  require_once($root.'/footer.php');
    exit();
  }

//////////////////////////////////////////////////////////////////////////////////////////////

/////This section of code has to do with downloading a file from the current index folder////

if(isset($_GET['path'])){
 

//$safeFilename = '/^\w+\.\w+$/';
 

// Now get the filename from the user
$pathforfile = $root . dirname($_GET['path']);
$filename12 = basename($_GET['path']);

  // MAKE SURE THE FILENAME IS SAFE!
 if (!file_exists($pathforfile . '/' . $filename12)) {
    exit(0);
  }

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


if($fileinfo77878['extension'] == 'mov'){
 
 
header('Content-type: video/mpeg');    
header('Content-Length: ' . filesize($pathforfile . '/' . $filename12));  
header("Expires: -1");    
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);  

   readfile($pathforfile . '/' . $filename12);
  exit(0);

}else{
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
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header('Content-Disposition: attachment; filename="'.basename($pathforfile . '/' . $filename12).'"'); 
header('Content-Transfer-Encoding: binary');
header('Connection: Keep-Alive');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($pathforfile . '/' . $filename12));
ob_clean();
flush();
   readfile($pathforfile . '/' . $filename12);
  exit(0);
  
}
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
 
/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////


  $page_title = $foldername1;
  require_once($root.'/header.php');
 
 
  require_once($root. '/indexhead.php');
     // Show the navigation menu
  require_once($root.'/navmenu.php');
  
 

 ////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////
 //////////////////////////Synopsis Post Reaction Code/////////////////////////
 /////////////////////////////////////////////////////////////////////////
 
 
 
 //////////////////Updates synopsis heading/slogan/description /////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
 
 if (isset($_POST['synopsissubmit'])){
     
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
  $headingsyn = mysqli_real_escape_string($dbc, trim($_POST['synheading']));
  $slogansyn = mysqli_real_escape_string($dbc, trim($_POST['synslogan']));
   $descriptionsyn = mysqli_real_escape_string($dbc, trim($_POST['syndescript']));
  
 $querysny = "UPDATE cbpfiles SET p_heading = '" .  $headingsyn . "', p_slogan = '" .  $slogansyn . "', p_descript = '" . $descriptionsyn . "' WHERE file_id = '" . $row777['file_id'] . "'";
    mysqli_query($dbc, $querysny); 
    
 }
 ////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

 
  if (isset($_POST['delete_p_file'])){
     
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
  $cbp_file_id = mysqli_real_escape_string($dbc, trim($_POST['cbp_file_id']));
  $p_file_id = mysqli_real_escape_string($dbc, trim($_POST['p_file_id']));
  
  
  if ($p_file_id == 1) {
      $oldpic = $row777['p_file1'];
     $querysnypic = "UPDATE cbpfiles SET p_file1 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
    
      $querysnypic = "UPDATE cbpfiles SET p_file1 ='".  $row777['p_file2'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file2 ='".  $row777['p_file3'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file3 ='".  $row777['p_file4'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file4 ='".  $row777['p_file5'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file5 ='".  $row777['p_file6'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file6 ='".  $row777['p_file7'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file7 ='".  $row777['p_file8'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
          $querysnypic = "UPDATE cbpfiles SET p_file8 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
     
  } else if ($p_file_id == 2){
      $oldpic = $row777['p_file2'];
       $querysnypic = "UPDATE cbpfiles SET p_file2 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
       
        $querysnypic = "UPDATE cbpfiles SET p_file2 ='".  $row777['p_file3'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file3 ='".  $row777['p_file4'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file4 ='".  $row777['p_file5'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file5 ='".  $row777['p_file6'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file6 ='".  $row777['p_file7'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file7 ='".  $row777['p_file8'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
          $querysnypic = "UPDATE cbpfiles SET p_file8 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
       
  } else if ($p_file_id == 3){
      $oldpic = $row777['p_file3'];
       $querysnypic = "UPDATE cbpfiles SET p_file3 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
          $querysnypic = "UPDATE cbpfiles SET p_file3 ='".  $row777['p_file4'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file4 ='".  $row777['p_file5'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file5 ='".  $row777['p_file6'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file6 ='".  $row777['p_file7'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file7 ='".  $row777['p_file8'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
          $querysnypic = "UPDATE cbpfiles SET p_file8 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
       
  } else if ($p_file_id == 4){
      $oldpic = $row777['p_file4'];
       $querysnypic = "UPDATE cbpfiles SET p_file4 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
          $querysnypic = "UPDATE cbpfiles SET p_file4 ='".  $row777['p_file5'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file5 ='".  $row777['p_file6'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file6 ='".  $row777['p_file7'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file7 ='".  $row777['p_file8'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
          $querysnypic = "UPDATE cbpfiles SET p_file8 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
       
       
  } else if ($p_file_id == 5){
      $oldpic = $row777['p_file5'];
       $querysnypic = "UPDATE cbpfiles SET p_file5 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
        $querysnypic = "UPDATE cbpfiles SET p_file5 ='".  $row777['p_file6'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file6 ='".  $row777['p_file7'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file7 ='".  $row777['p_file8'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
          $querysnypic = "UPDATE cbpfiles SET p_file8 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
       
  } else if ($p_file_id == 6){
      $oldpic = $row777['p_file6'];
       $querysnypic = "UPDATE cbpfiles SET p_file6 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file6 ='".  $row777['p_file7'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
         $querysnypic = "UPDATE cbpfiles SET p_file7 ='".  $row777['p_file8'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
          $querysnypic = "UPDATE cbpfiles SET p_file8 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
       
  } else if ($p_file_id == 7){
      $oldpic = $row777['p_file7'];
       $querysnypic = "UPDATE cbpfiles SET p_file7 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
       $querysnypic = "UPDATE cbpfiles SET p_file7 ='".  $row777['p_file8'] ."' WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
          $querysnypic = "UPDATE cbpfiles SET p_file8 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
       
  } else {
      $oldpic = $row777['p_file8'];
       $querysnypic = "UPDATE cbpfiles SET p_file8 = NULL WHERE file_id = '" . $cbp_file_id . "'";
       mysqli_query($dbc, $querysnypic);
  }    
  
  
 
	unlink($root. $row777['file_path'] . '/' . $row777['file_name']. '/' . $oldpic);

                       
                        //$testpicname = basename($root. $row777['file_path'] . '/' . $row777['file_name']. '/' . $oldpic);
                        $pic_parts1 = pathinfo( $oldpic);
                        $testpicname = $pic_parts1['filename'] . 'thum63820';
	 
	  if (file_exists($root .$row777['file_path'] . '/' . $row777['file_name']. '/' .$testpicname. '.jpg')){


                           unlink($root . $row777['file_path'] . '/' . $row777['file_name']. '/' .$testpicname. '.jpg');
                           
                        }

    
    
  }
 
///////////////////////////Uploads pic for synopsis/////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////
 

if (isset($_POST['addsynpic'])){
    
 
 $filesyn = mysqli_real_escape_string($dbc, trim($_FILES['filesyn']['name']));
 $cbp_file_idsyn = mysqli_real_escape_string($dbc, trim($_POST['cbp_file_idsyn']));
 

    $file_typesyn = $_FILES['filesyn']['type'];
    $file_sizesyn = $_FILES['filesyn']['size']; 
    $fileinfosyn = pathinfo($filesyn);
     $fileext23syn = $fileinfosyn['extension'];
     
       
      
		
		if (( $fileext23syn == 'png')|| ( $fileext23syn == 'PNG')||( $fileext23syn == 'jpg') || ( $fileext23syn == 'JPG') || ( $fileext23syn == 'gif') || ( $fileext23syn == 'jpeg') || ( $fileext23syn == 'jpeg')){
		
        
	        	if ($_FILES['filesyn']['error'] == 0 || $filesyn == NULL) {
                             
                        
  
                       if ($filesyn != NULL){ 
                          $targetsyn =  $root . $row777['file_path'] . '/' . $row777['file_name'] . '/' .$filesyn;
                            }
 
                        if (file_exists($targetsyn)) {
                            srand((double)microtime()*1000000);
 
                            $newfilenamesyn = basename($filesyn,'.'.$fileext23syn) . rand(1000,20000) . '.' . $fileext23syn;
                            }else {
 
                            $newfilenamesyn = $filesyn;
                            }

                        if (file_exists($targetsyn)) {
                                    srand((double)microtime()*1000000);
 
                             $newfilenamesyn = basename($newfilenamesyn,'.'.$fileext23syn) . rand(1000,20000) . '.' . $fileext23syn;
                            }else {
 
                                $newfilenamesyn = $newfilenamesyn;
                            }

                       if ($filesyn != NULL){
                        $targetsyn = $root . $row777['file_path'] . '/' . $row777['file_name'] . '/' . $newfilenamesyn;
                                }
 
                         if (move_uploaded_file($_FILES['filesyn']['tmp_name'], $targetsyn)) { // Move the file to the target upload folder
                                    // Write the data to the database
                             if ($row777['p_file1']==NULL){
	                         $query1234syn = "UPDATE cbpfiles SET p_file1 = '" . $newfilenamesyn . "' WHERE file_id = '" . $cbp_file_idsyn . "'";
                             }else if($row777['p_file2']==NULL){
                                 $query1234syn = "UPDATE cbpfiles SET p_file2 = '" . $newfilenamesyn . "' WHERE file_id = '" . $cbp_file_idsyn . "'";
                             }else if($row777['p_file3']==NULL){
                               $query1234syn = "UPDATE cbpfiles SET p_file3 = '" . $newfilenamesyn . "' WHERE file_id = '" . $cbp_file_idsyn . "'";
                             }else if($row777['p_file4']==NULL){
                                 $query1234syn = "UPDATE cbpfiles SET p_file4 = '" . $newfilenamesyn . "' WHERE file_id = '" . $cbp_file_idsyn . "'";
                             }else if($row777['p_file5']==NULL){
                                 $query1234syn = "UPDATE cbpfiles SET p_file5 = '" . $newfilenamesyn . "' WHERE file_id = '" . $cbp_file_idsyn . "'";
                             }else if($row777['p_file6']==NULL){
                                 $query1234syn = "UPDATE cbpfiles SET p_file6 = '" . $newfilenamesyn . "' WHERE file_id = '" . $cbp_file_idsyn . "'";
                             }else if($row777['p_file7']==NULL){
                                 $query1234syn = "UPDATE cbpfiles SET p_file7 = '" . $newfilenamesyn . "' WHERE file_id = '" . $cbp_file_idsyn . "'";
                             }else{
                                 $query1234syn = "UPDATE cbpfiles SET p_file8 = '" . $newfilenamesyn . "' WHERE file_id = '" . $cbp_file_idsyn . "'";                             
                             }
	                         mysqli_query($dbc, $query1234syn);
		
                         } else {
                             echo '<p class="error"> Your file did not upload, try again.</p>';
                         }
	        	}
        
        } else {
             echo '<p class="error"> Your your picture must be a jpg, png or gif, try again.</p>';
        }
                         
 }
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


 
 ///////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////
 
  $query777 = "SELECT * FROM cbpfiles WHERE file_name = '$foldername1' AND file_path = '$file_dir2'";
  $data777 = mysqli_query($dbc, $query777);
  $row777 = mysqli_fetch_array($data777);

 
 ////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////





 ////////////////////////////////////////////////////////////////  
//////Retrieval of input from add folder...../////////////
//////////////////////////////////////////////////////////////////  
if (isset($_POST['newfile'])){
$newfile = mysqli_real_escape_string($dbc, trim($_POST['newfile']));
$filetype = mysqli_real_escape_string($dbc, trim($_POST['filetype']));
$file_private = mysqli_real_escape_string($dbc, trim($_POST['fileprivate']));
    if ($file_private) {
	$file_private=1;
	}
	if ($filetype==NULL || $filetype==0) {
	$filetype=NULL;
	}

  
if (!empty($newfile) ) {
$charactersok = true;

  $pos = strpos($newfile, "!");
  $pos1 = strpos($newfile, "@");
  $pos2 = strpos($newfile, "$");
  $pos3 = strpos($newfile, "%");
  $pos4 = strpos($newfile, "^");
  $pos5 = strpos($newfile, "&");
  $pos6 = strpos($newfile, "?");
  $pos7 = strpos($newfile, "index.php");
  $pos8 = strpos($newfile, "*");
  $pos9 = strpos($newfile, "(");
  $pos10 = strpos($newfile, ")");
  $pos11 = strpos($newfile, "=");
  $pos12 = strpos($newfile, "+");
  $pos13 = strpos($newfile, "/");
  $pos14 = strpos($newfile, "\\");
  $pos15 = strpos($newfile, "'");
  
 if ($pos !== false || $pos1 !== false  || $pos2 !== false  || $pos3 !== false  || $pos4 !== false  || $pos5 !== false  || $pos6 !== false  || $pos7 !== false){
     $charactersok =false;

 }
  if ($pos8 !== false || $pos9 !== false  || $pos10 !== false  || $pos11 !== false  || $pos12 !== false  || $pos13 !== false  || $pos14 !== false || $pos15 !== false){
  
     $charactersok =false;
 
 }
 
 
if ($charactersok){
$file_dir = dirname($_SERVER['PHP_SELF']);
 
 $query = "SELECT * FROM cbpfiles WHERE file_name = '$newfile' AND file_path = '$file_dir'";
      $data = mysqli_query($dbc, $query);
      
      
      
      if (mysqli_num_rows($data) == 0) {
	
	$query = "INSERT INTO cbpfiles (file_name, file_path, file_approval, creator, file_private, type) VALUES ('" . $newfile . "', '" . $file_dir . "', 1, '" . $_SESSION['user_id'] . "', '" . $file_private . "', '" .$filetype. "')";
            mysqli_query($dbc, $query);
            
            
	      
if($file_private){
    $query123 = "SELECT * FROM cbpfiles WHERE file_name = '$newfile' AND file_path = '$file_dir'";
      $data123 = mysqli_query($dbc, $query123);
      $row123 = mysqli_fetch_array($data123);    
	
	$query654 = "SELECT * FROM cbp_user WHERE user_id = '". $row123['creator']. "'";
      $data654 = mysqli_query($dbc, $query654);
      $row654 = mysqli_fetch_array($data654);

$query321 = "INSERT INTO folderprivacy (user_name, folderID) VALUES ('" . $row654['username'] . "', '" . $row123['file_id'] . "')";
		mysqli_query($dbc, $query321);
}

mkdir($newfile);

$templatefile =  $root .  '/templates/index.php';
$copytofile = $root . '/' . $file_dir . '/' . $newfile . '/index.php';

copy($templatefile, $copytofile);

$templatefile1 =  $root .  '/templates/projectviewscount.txt';
$copytofile1 = $root . '/' . $file_dir . '/' . $newfile . '/projectviewscount.txt';

copy($templatefile1, $copytofile1);

$templatefile1 =  $root .  '/templates/uploader.php';
$copytofile1 = $root . '/' . $file_dir . '/' . $newfile . '/uploader.php';

copy($templatefile1, $copytofile1);


if ($file_private){
    echo '<p style="color:green"><b><i>' . $newfile  .'</i> is a private folder.  To allow another co-developer to view this folder you must edit and allow a co-developer to view this folder.</b></p>';
   }
}else {
	echo '<p class="error" style="">A file already exists with that name in this folder.  Try a different folder name.</p>';
	}

}else{
echo '<p class="error" style="">You used unallowed special characters in the folder name.  Try a different folder name.</p>';
	
}
  }
}



  

////////////////Bread Crumbs and Sub Folders///////////////////
////////////////////////////////////////////////////
$file_dir = dirname($_SERVER['PHP_SELF']);
$upfile = dirname($file_dir);


$crumb[0] = $_SERVER['PHP_SELF'];
$crumb_iter = 1;
while (dirname($crumb[$crumb_iter-1]) != "/files" ){

$crumb[$crumb_iter] = dirname($crumb[$crumb_iter-1]);

$crumb_iter++;

if($crumb_iter>100){
    break;
}

}



echo '<ul class="crumbs" id="crumbs">';
 echo '<li class="crumbs"><a href="/files/">Browse</a></li>';

for ($o=$crumb_iter; $o>0; $o--){
    if($o == 1){
        
        echo '<li class="crumbs">';
        echo basename($crumb[$o]);
        
        
  
 if ($_SESSION['newuser']){
?>
 <form method="post" action="http://www.cirrusidea.com/mycreativebrainpower.php" style="display:inline;">
 <input type="hidden" name="quicklink" value="<?php echo $_SERVER['PHP_SELF'] ?>"/>
<span class="hotspot" onmouseover="tooltip.show('Here is the button that will add this CirrusIdea folder to your quicklink list in your <i>CirrusIdea Home</i> tab.', 300);" onmouseout="tooltip.hide();">   
<input type="submit" name="addquicklink"  class="stylebutton"  value="Add to your Quick Link List"  
<?php 
if($_SESSION['username'] == 'Anonymous') {
echo 'disabled="disabled" />';}
else {
    echo '/>';
}

      echo '</span></form>';
  } else{
?>
<form method="post" action="http://www.cirrusidea.com/mycreativebrainpower.php" style="display:inline;">
<input type="hidden" name="quicklink" value="<?php echo $_SERVER['PHP_SELF'] ?>"/>
<input type="submit" name="addquicklink"  class="stylebutton"  value="Add to your Quick Link List"  
<?php 
if($_SESSION['username'] == 'Anonymous') {
echo 'disabled="disabled" />';}
else{
    echo '/>';
}

      echo '</form>';
  }
     
        
        
        
        
    echo '</li>';  
    }else{
   echo '<li class="crumbs"><a href="'; 
    echo $crumb[$o];
    echo '">' . basename($crumb[$o]);
    echo '</a></li>';
    }
}

echo '</ul><br />';

if ($_SESSION['newuser']){
?>
<span class="hotspot" onmouseover="tooltip.show('Here is a CirrusIdea folder. A CirrusIdea folder can be a general discussion page, a project folder, or a sub-folder.  The top of each folder page tells you what type of folder you\'re currently in.  You can put stake in Discussion folders and Project folders.  You create folders by clicking the button below <i>Add Folder</i>.  All folders can contain posts and posts with files attached. You add posts by clicking the button below, <i>Add Post</i>.', 800);" onmouseout="tooltip.hide();">
<div style="width: 300px; float:left;"<p>Hover-Help: </p></div></span>
<?php
}      


  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 $query = "SELECT * FROM cbpfiles WHERE file_approval = 1 AND file_path ='" . $file_dir . "' ORDER BY file_name";
  $data = mysqli_query($dbc, $query);

 $query1212 = "SELECT * FROM cbpfiles WHERE file_approval = 1 AND file_path ='" . $file_dir . "' ORDER BY file_name";
  $data1212 = mysqli_query($dbc, $query1212);
  $row1212 = mysqli_fetch_array($data1212);
  
if ($row1212['file_id'] != NULL){

$i=0;
$atleastoneprivate_folder = false;
$atleastoneyour_folder = false; 
$atleastonepublic_folder = false;
echo '<div>';
echo '<p style="position:relative; padding-left:50px;">Sub-folder/s:</p>';
echo '<ul style="text-align:center;">';

while ($row = mysqli_fetch_array($data)) { 
    
	  $query432 = "SELECT * FROM folderprivacy WHERE folderID = '" . $row['file_id'] . "'";
      $data432= mysqli_query($dbc, $query432);
     
	if($row['file_private'] == 0 || $row['file_private'] == NULL){
         if ($row['creator']==$_SESSION['user_id']){;
          echo '<li class="yourfoldercontainer">';
    	              echo '<div style="display:inline;"><a style="display:inline;" href="'. $file_dir .'/' .  $row['file_name'] . '/">' . $row['file_name'] . '</a>';
          
                        echo      '<form  style="display:inline;" action="http://www.cirrusidea.com/editdeletefolder.php" method="post">';
                        echo       '<input type="hidden" id="id" name="id" value="'.$row['file_id'].'"/>';
                        echo       '<input type="submit" class="yourfolderbutton" style="display:inline; display:none;" value="Edit">';
                         echo      '</form></div>';
                        
                        echo '</li>';
                                $i++; 
              $atleastoneyour_folder = true;  
			  
        }else{
            
			 echo '<li class="foldercontainer">';
    	              echo '<a style="display:inline;" href="'. $file_dir .'/' .  $row['file_name'] . '/">' . $row['file_name'] . '</a>';
                                  
                        echo '</li>';
                                $i++; 
								
        }
        $atleastonepublic_folder = true;
	
		}else{
			while($row432 = mysqli_fetch_array($data432)) { 
			if($_SESSION['username'] == $row432['user_name']){
		
             if ($row['creator']==$_SESSION['user_id']){;
    	
          
                  echo '<li class="yourprivatefoldercontainer">';
    	          echo '<div style="display:inline;"><a style="display:inline;" href="'. $file_dir .'/' .  $row['file_name'] . '/">' . $row['file_name'] . '</a>';
          
                        echo      '<form  style="display:inline;" action="http://www.cirrusidea.com/shareprivatefolders.php" method="post">';
                        echo       '<input type="hidden" id="id" name="id" value="'.$row['file_id'].'"/>';
                        echo       '<input type="submit" class="yourfolderbutton" style="display:inline; display:none;" value="Edit">';
                         echo      '</form></div>';
                        
                        echo '</li>';
                                $i++; 
              $atleastoneyour_folder = true;
               
                  }else{
            
                     echo '<li class="privatefoldercontainer">';
    	              echo '<a style="display:inline;" href="'. $file_dir .'/' .  $row['file_name'] . '/">' . $row['file_name'] . '</a>';
                                  
                        echo '</li>';
                                $i++; 
                  }
            
	           $atleastoneprivate_folder = true;		
			
			}
			}
		
		}
        
         if ($i%8==0){
        echo '</ul><ul style="text-align:center;">';
         }
        
		
  }

 echo '</div>';
 
if ($atleastoneprivate_folder){
echo '<p><div style="width:100px; heigth:50px;  background-image:url(\'http://www.cirrusidea.com/images/privatefolderlink.png\'); background-width:100%; float:right; margin:5px;" >';
echo '<font size="2">Private Folder</font>';
echo '</div></p>';
}

if ($atleastoneyour_folder){
echo '<p><div style="width:100px; heigth:50px; background-image:url(\'http://www.cirrusidea.com/images/yourfolder.png\'); background-width:100%; float:right; margin:5px; " >';
echo '<font size="2">Your Folder</font>';
echo '</div></p>';
}

if ($atleastonepublic_folder){
echo '<p><div style="width:100px; heigth:50px; background-image:url(\'http://www.cirrusidea.com/images/folderlink.png\'); background-width:100%; float:right; margin:5px; " >';
echo '<font size="2">Public Folder</font>';
echo '</div></p>';
}


 } 
 
 
 echo '<br />';


 
 //////////////////Updates description /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
 
 if (isset($_POST['descripsubmit'])){
     
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
 $upload_id = mysqli_real_escape_string($dbc, trim($_POST['cbp_upload_id']));
 
 $query = "UPDATE creativebrainpower SET description = '" . $description . "' WHERE id = '" . $upload_id . "'";
    mysqli_query($dbc, $query); 
	
 }
 ////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
 
 
 
 //////////////////Updates Member Cred Score /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
 
 if (isset($_POST['addcred'])){
     
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 $credusername = mysqli_real_escape_string($dbc, trim($_POST['credusername']));
 $cred = mysqli_real_escape_string($dbc, trim($_POST['credvote']));

 if ($cred  == 'positivecred'){
        
         $query3465 = "SELECT cred FROM cbp_user WHERE username = '" . $credusername . "'";
    $data3465 = mysqli_query($dbc, $query3465); 
    
      $row3465 = mysqli_fetch_array($data3465);
      $cred =  $row3465['cred'] +1;
       
     $query345 = "UPDATE cbp_user SET cred =  " . $cred . " WHERE username = '" . $credusername . "'";
    mysqli_query($dbc, $query345); 
    
 }elseif ($cred  == 'negativecred'){
    
     
      $query3465 = "SELECT cred FROM cbp_user WHERE username = '" . $credusername . "'";
    $data3465 = mysqli_query($dbc, $query3465); 
    
      $row3465 = mysqli_fetch_array($data3465);
      
    $cred =  $row3465['cred'] -1;
 
     $query345 = "UPDATE cbp_user SET cred =  " . $cred . " WHERE username = '" . $credusername . "'";
    mysqli_query($dbc, $query345); 
    
 }
 
 
 }
 ////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
 
  
 //////////////////Updates Post Cred Score /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
 
 if (isset($_POST['addpostcred'])){
     
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 $cred_post_id = mysqli_real_escape_string($dbc, trim($_POST['postid']));
 $cred = mysqli_real_escape_string($dbc, trim($_POST['credpostvote']));

 if ($cred  == 'positivepostcred'){
        
        $query3465 = "SELECT rating FROM creativebrainpower WHERE id = '" . $cred_post_id . "'";
    $data3465 = mysqli_query($dbc, $query3465); 
    
      $row3465 = mysqli_fetch_array($data3465);
      $cred =  $row3465['rating'] +1;
       
     $query345 = "UPDATE creativebrainpower SET rating =  " . $cred . " WHERE id = '" . $cred_post_id . "'";
    mysqli_query($dbc, $query345); 
    
 }elseif ($cred  == 'negativepostcred'){
    
     
      $query3465 = "SELECT rating FROM creativebrainpower WHERE id = '" . $cred_post_id . "'";
    $data3465 = mysqli_query($dbc, $query3465); 
    
      $row3465 = mysqli_fetch_array($data3465);
      
    $cred =  $row3465['rating'] -1;
 
    $query345 = "UPDATE creativebrainpower SET rating =  " . $cred . " WHERE id = '" . $cred_post_id . "'";
    mysqli_query($dbc, $query345); 
    
 }
 
 
 }
 ////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
  

///////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
if(isset($_POST['submit'])){
   $response =  "";
   
 

 // Get data from post
    $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
    $file = mysqli_real_escape_string($dbc, trim($_FILES['file']['name']));
    $private = mysqli_real_escape_string($dbc, trim($_POST['private']));
	if ($private == NULL){
	$private = 0;
	}else{
	$private = 1;
	}
    
    
    if ($row777['file_private'] == 1) {
    $private = 1;
    }
	
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size']; 
	$fileinfo = pathinfo($file);
     $fileext23=$fileinfo['extension'];
     
    // echo $_FILES['file']['error'];
     
     if (!empty($description) || $file_size>0 ) {
        	if ($file_size <= CBP_MAXFILESIZE) {

	        	if ($_FILES['file']['error'] == 0 || $file==NULL) {
                             
                        
  
                       if ($file!=NULL){ 
                          $target =  $root . $file_dir . '/' . $file;
                            }
 
                        if (file_exists($target)) {
                            srand((double)microtime()*1000000);
 
                            $newfilename = basename($file,'.'.$fileext23) . rand(1000,20000) . '.' . $fileext23;
                            }else {
 
                            $newfilename = $file;
                            }

                        if (file_exists($target)) {
                                    srand((double)microtime()*1000000);
 
                             $newfilename = basename($newfilename,'.'.$fileext23) . rand(1000,20000) . '.' . $fileext23;
                            }else {
 
                                $newfilename = $newfilename;
                            }

                       if ($file!=NULL){
                        $target =  $root . $file_dir . '/' . $newfilename;
                                }
 
                         if (move_uploaded_file($_FILES['file']['tmp_name'], $target) || $newfilename == NULL || $file == NULL) { // Move the file to the target upload folder
                                    // Write the data to the database
                            $postdate = date("Y-m-d H:i:s");
                            
	                         $query = "INSERT INTO creativebrainpower (date, description, filename, member_id, approved, file_id, startedproject, private, filesize, rating) VALUES ('" . $postdate . "', '" .
	                                 $description . "', '" . $newfilename . "', '" . $_SESSION['user_id'] . "', 1, '" . $file_dir . "', 0," . $private . ", " . $file_size . ", " . 0 . ")";
	
	                         mysqli_query($dbc, $query);
		
                            	if ($private==1){
                                    	$query33 = "SELECT id FROM creativebrainpower WHERE date ='".  $postdate ."' AND description='" . $description . "' AND member_id ='" . $_SESSION['user_id'] . "' AND file_id ='" . $file_dir . "'";
                                           $result33 = mysqli_query($dbc, $query33);
                                        	$row33 = mysqli_fetch_array($result33);
	
                                            	 $query55 = "INSERT INTO uploadprivacy (upload_id, user_name) VALUES ('" . $row33['id'] ."', '" . $_SESSION['username'] . "')";
	
                                    	mysqli_query($dbc, $query55);
	
                                    	}
	
                            	if ($private==1){
                                	 $query552 = "SELECT file_id FROM cbpfiles WHERE file_name='" . basename($file_dir). "' AND file_path ='" . dirname($file_dir) . "'";
                                    	$result552 = mysqli_query($dbc, $query552);
                                    	$row552 = mysqli_fetch_array($result552);
		
                                         $query331 = "SELECT user_name FROM folderprivacy WHERE folderID ='" . $row552['file_id'] . "'";
                                         $result331 = mysqli_query($dbc, $query331);	
	
	                                while($row331 = mysqli_fetch_array($result331)) { 
                                        			if($_SESSION['username'] <> $row331['user_name']){
       
	                                                 $query551 = "INSERT INTO uploadprivacy (upload_id, user_name) VALUES ('" . $row33['id'] ."', '" . $row331['user_name'] . "')";
	
	                                                 mysqli_query($dbc, $query551);
	                                                     }
	                                                 }
                                             }
	
                             // Confirm success with the user
                   $response .= '<p style="">Thanks for adding your project file!<br />';
			         $response .= 'This file may be removed if deemed inappropriate or violates any wrongfully used Intellectual Property.';
					$response .=  '<br />Use this <a href="'.$_SERVER['PHP_SELF'].'">link</a> to refresh this page</p>';
                               
                               // if($file!=NULL){
	                        	//	echo '<p style=""><strong>File Name:</strong> ' . $newfilename . '<br />';}
                                  //   echo '<strong>Comment/Description:</strong><p style="text-align:left"> ' . parsedescription($description) . '</p><br />';
	                            			
		                            //	echo '<p><a style="" href="http://www.cirrusidea.com'. $file_dir . '">&lt;&lt; Back to Project Folder.</a></p>';
			
                                      //      echo '<p><a style="" href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to My CirrusIdea page.</a></p>';

                                // Clear the score data to clear the form
           
                                      $description = "";
                                       $file = "";
	                                	$newfilename = "";
	
	
                                	$folder_name = basename($file_dir);
                                	 $basefile_dir = dirname($file_dir);

                                    	$query76 = "SELECT creator FROM cbpfiles WHERE file_path = '$basefile_dir' AND file_name = '$folder_name' LIMIT 1";
                                         $data76 = mysqli_query($dbc, $query76);
	                                        $row76 = mysqli_fetch_array($data76);
	
	                                        $query86 = "SELECT * FROM cbp_user WHERE user_id = '" . $row76['creator'] . "' LIMIT 1";
                                            $data86 = mysqli_query($dbc, $query86);
                                  	          $row86 = mysqli_fetch_array($data86);
                                        	$foldercreator = $row86['email'];
                                        	$username1 = $row86['username'];
	
                        if ($row86['mailme'] == 1){	
                                	$to = "$foldercreator";
                                	$subject = "CirrusIdea.com - Project Post";
                                	$message = "
                                        <html>
                                            <head>
                                     <title>A post to your project folder has been uploaded.</title>
                                        </head>
                                            <body>
                                            <p><br /><br />" . $username1 . ",  <a href='http://www.cirrusidea.com". $file_dir . "'>Log In</a>
                                             and checkout what has been posted to your project folder: " . $folder_name . ".<br /><br />
                                                </p>
                                                </body>
                                                </html>
                                                     ";
 
                                        $headers = "MIME-Version: 1.0" . "\r\n";
                                        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
                                        // More headers
                                         $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";
	
                                        	mail($to,$subject,$message,$headers);
	
	                            }
	
	                        $fileID =  $basefile_dir  . "/" . $folder_name;

                            $query8787= "SELECT member_id FROM creativebrainpower WHERE file_id = '$fileID'";
                            $data8787 = mysqli_query($dbc, $query8787);
                            $row8787 = mysqli_fetch_array($data8787);

                            $k=0;	
                            $memberinthread[$k] = 0;
                    
                            while ($row8787 = mysqli_fetch_array($data8787)) { 	


                                foreach($memberinthread as $done){

                                    if ($done == $row8787['member_id']){
                                        $sent = 1;
                                        break;
                                    }else {
                                        $sent=0;
                                    }

                                    }

                            $memberinthread[$k] = $row8787['member_id'];
	
                            $query888 = "SELECT * FROM cbp_user WHERE user_id = '" . $row8787['member_id'] . "' LIMIT 1";
                            $data888 = mysqli_query($dbc, $query888);
                            $row888 = mysqli_fetch_array($data888);
	
                                if ($row888['mailme'] == 1 && $sent==0){	

                            	$to_email = $row888['email'];
                            	$to = "$to_email";
                            	$subject = "CirrusIdea.com - Project Post";
                            	$message = "
                                 <html>
                                 <head>
                                 <title>An upload to a thread you have been involved in is now online.</title>
                                 </head>
                                 <body>
                                 <p><br /><br />" . $row888['username'] . ",  <a href='http://www.cirrusidea.com" . $file_dir . "'>Log In</a>
                                 and checkout what has been posted to the thread: " . $folder_name . ".<br /><br />
                                 </p>
                                 </body>
                                 </html>
                                    ";
 
                                 $headers = "MIME-Version: 1.0" . "\r\n";
                                 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                                 
                                // More headers
                                 $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";
                                	
                                	mail($to,$subject,$message,$headers);
	
	
	                                }
                        	$k=$k+1;
	
                        }

            //	require_once($root.'/footer.php');	
            	//exit;		
		
            } else {
		
                  $response .= '<p class="error" style="">Sorry, there was a problem uploading your file.</p>';
    
		  }
        }
      
      } else {

        $response .= '<p class="error" style="">The file should be no greater than ' . round((CBP_MAXFILESIZE / 1024),4) . ' KB in size.</p>';
   
	     }
   
   // Try to delete the temporary file
      @unlink($_FILES['file']['tmp_name']);
    } else {

                 $response .= '<p class="error" style="">Please fill in a comment or upload a file.</p>';
    
	}
  
  
} 
  
  
  
//echo '{"result": "' .  $response . '"}';
  
  

//////////////////Inserts Upload file if added to a post that doesn't have a file associated with the post yet/////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['addpostsubmit'])){
     
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 $file1x = mysqli_real_escape_string($dbc, trim($_FILES['file1x']['name']));
 $upload_id1x = mysqli_real_escape_string($dbc, trim($_POST['cbp_upload_id1x']));
 
 if ($row777['file_private'] == 1) {
    $private1x = 1;
    } else {
    $private1x = 0;
    }
    
    $file_type1x = $_FILES['file1x']['type'];
    $file_size1x = $_FILES['file1x']['size']; 
	$fileinfo1x = pathinfo($file1x);
     $fileext231x = $fileinfo1x['extension'];
     
       
    
        	if ($file_size1x <= CBP_MAXFILESIZE) {

	        	if ($_FILES['file1x']['error'] == 0 || $file1x == NULL) {
                             
                        
  
                       if ($file1x != NULL){ 
                          $target1x =  $root . $file_dir . '/' . $file1x;
                            }
 
                        if (file_exists($target1x)) {
                            srand((double)microtime()*1000000);
 
                            $newfilename1x = basename($file1x,'.'.$fileext231x) . rand(1000,20000) . '.' . $fileext231x;
                            }else {
 
                            $newfilename1x = $file1x;
                            }

                        if (file_exists($target1x)) {
                                    srand((double)microtime()*1000000);
 
                             $newfilename1x = basename($newfilename1x,'.'.$fileext231x) . rand(1000,20000) . '.' . $fileext231x;
                            }else {
 
                                $newfilename1x = $newfilename1x;
                            }

                       if ($file1x != NULL){
                        $target1x =  $root . $file_dir . '/' . $newfilename1x;
                                }
 
                         if (move_uploaded_file($_FILES['file1x']['tmp_name'], $target1x)) { // Move the file to the target upload folder
                                    // Write the data to the database
                                                       
	                         $query1234x = "UPDATE creativebrainpower SET filename = '" . $newfilename1x . "',  private = '" .  $private1x . "', filesize = '" . $file_size1x . "' WHERE id = '" . $upload_id1x . "'";
	
	                         mysqli_query($dbc, $query1234x);
		
                         } else {
                             echo '<p class="error"> Your file did not upload, try again.</p>';
                         }
	        	}
        
        }
                         
 }
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


////////////Copy Post to a differnet Folder///////////////////
/////////////////////////////////////////////////////////////

 if (isset($_POST['movefolder'])){
 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 $move_folder = mysqli_real_escape_string($dbc, trim($_POST['folder']));
 $upload_id = mysqli_real_escape_string($dbc, trim($_POST['upload_id']));

                    

$query45 = "SELECT * FROM creativebrainpower WHERE id = '".$upload_id."'";
$data45 = mysqli_query($dbc, $query45);
$row45 = mysqli_fetch_array($data45);
	 
    
    
     if ($row45['filename']!=NULL && $row45['filename']!=""){ 
          $oldfilename = $row45['filename'];
          
           $fileinfo = pathinfo($oldfilename);
           
           $fileext23=$fileinfo['extension'];
    
                          $target =  $root . $move_folder . '/' . $oldfilename;
          
 
                        if (file_exists($target)) {
                            srand((double)microtime()*1000000);
 
                            $newfilename = basename($oldfilename,'.'.$fileext23) . rand(1000,20000) . '.' . $fileext23;
                            }else {
 
                            $newfilename = $oldfilename;
                            }
               } else {
         
                $newfilename = $row45['filename'];
         
           }
  
  
    
$query232 = "INSERT INTO `creativebrainpower` (date, description, filename, member_id, approved, file_id, startedproject, private, filesize, rating) VALUES ('" . $row45['date'] . "', '" . 
$row45['description'] . "', '" . $newfilename . "', '" . $row45['member_id'] . "', 1, '" . $move_folder . "', 0, '" . $row45['private'] . "', '" . $row45['filesize'] . "', '" . $row45['rating'] . "')";
$result = mysqli_query($dbc, $query232);






if ($row45['private']){

$query33 = "SELECT id FROM creativebrainpower WHERE date ='".  $row45['date'] ."' AND description='" . $row45['description'] . "' AND member_id ='" . $row45['member_id'] . "' AND file_id ='" . $move_folder . "'";
   $result33 = mysqli_query($dbc, $query33);
$row33 = mysqli_fetch_array($result33);
	
    	 $query55 = "INSERT INTO uploadprivacy (upload_id, user_name) VALUES ('" . $row33['id'] ."', '" . $_SESSION['username'] . "')";
	
    	mysqli_query($dbc, $query55);
	
                                    	
}
if($result){
echo '<p>Copy Successfull </p>';

if ($row45['filename']!=NULL && $row45['filename']!=""){
    
$originalfile =  $root  . $row45['file_id'] . '/' .  $oldfilename;
$copytofile1 = $root . $move_folder . '/' .  $newfilename;

copy($originalfile, $copytofile1);
}
}
else{
    echo '<p class="error">Copy Unsuccessful - There is an issue with copying this file. You may have to upload a new. </p>';
    }


 }

///////////////////////////////////////////////////////////////////////////////////////////////
 	

function parsedescription($descip){
    
  $data = explode("\\",$descip);
       $descip = implode("",$data);
       $descip = stripslashes($descip); 

        return $descip;   
}



  
if($_SESSION['username'] == 'Anonymous'){
 echo '<p class="error" style="font-size:12px;">Inputs disabled, you cannot add to this folder; you are using a public browsing account.<br />';
   echo 'Please <a href="http://www.cirrusidea.com/signup.php">sign up</a> and create your own profile.</p>';
 }
 
 
 /////////////////////////////////////////////////////
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

    if(preg_match("/.jpg/i", basename($pics))){
    $source = imagecreatefromjpeg(basename(basename($pics)));
    }
   
    if(preg_match("/.jpeg/i", basename($pics))){
    $source = imagecreatefromjpeg(basename($pics));
    }
    if(preg_match("/.png/i", basename($pics))){
    $source = imagecreatefrompng(basename($pics));
    imageAlphaBlending( $source, true);
    imageSaveAlpha( $source, true);
    }
    if(preg_match("/.gif/i", $pics)){
    $source = imagecreatefromgif(basename($pics));
    }
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
   
   
  if(preg_match("/.jpg/i", basename($pics))){ 
if(ctype_upper($extension)){
   return imagejpeg($thumb, $root.$filedir . $newpicname . '.JPG');
}
else {
     return imagejpeg($thumb, $root.$filedir . $newpicname . '.jpg');
} 
  }
   

    if(preg_match("/.jpeg/i", basename($pics))){
    return imagejpeg($thumb, $root.$filedir . $newpicname . '.jpeg');
   }
    if(preg_match("/.png/i", basename($pics))){
      if(ctype_upper($extension)){  
    return imagepng($thumb, $root.$filedir . $newpicname . '.PNG');
      }
else {
    return imagepng($thumb, $root.$filedir . $newpicname . '.png');
    
}
    
   }
    if(preg_match("/.gif/i", basename($pics))){
    return imagegif($thumb, $root.$filedir . $newpicname . '.gif');
    }
    

}

//Get max membercred variable///////////
/////////////////////////////////////////
 $query554 = "SELECT MAX(cred) AS max_cred FROM cbp_user";
 $data554 = mysqli_query($dbc, $query554);
   $row554  = mysqli_fetch_array($data554 );
  $max_memcred = $row554['max_cred'];
 
 
 //Get maxpostcred variable///////////
/////////////////////////////////////////
 $query554 = "SELECT MAX(rating) AS max_postcred FROM creativebrainpower";
  $data554 = mysqli_query($dbc, $query554);
  $row554  = mysqli_fetch_array($data554 );
  $max_postcred = $row554['max_postcred'];
  
  

  
 ?>

<script language="javascript">
 function forceReturn(iMaxLength, sValue){
 if (sValue.length > iMaxLength){
 sValue = sValue + "\r";
 }
 }
 </script>

<script>
$(document).ready(function(){

  $("#addfolderbutton").click(function(){
   
    $("#boldAddNewSubFolder").fadeToggle();
    $("#FolderName").fadeToggle();
    $("#Pirvate").fadeToggle();
    $("#SelectFolder").fadeToggle();
    $("#filetype1").fadeToggle();
    $("#filetype2").fadeToggle();
    $("#filetype3").fadeToggle();
    $("#filetype4").fadeToggle();
    $("#FormSubmit").fadeToggle();
            
    $("#addfoldertable").fadeToggle();
              
  });
});

    
</script>

 <div style="margin-left:auto; margin-right:auto;"> 
   <div style="float:left; padding-left:30px;">
  <?php
  if ($_SESSION['newuser']){
    ?>
<span class="hotspot" onmouseover="tooltip.show('Click this button to add a new sub folder. You can make a public folder if you\'re currently in a public folder, or you can create a private folder where only you or any Co-Developer of yours that you invte to view can access.', 300);" onmouseout="tooltip.hide();">   
  <?php
  }
  ?>
  
  <button id="addfolderbutton" class="stylebutton"  style="width:200px;">Add Folder</button>
   <?php
  if ($_SESSION['newuser']){
      echo '</span>';
  }
    ?>
  
 </div>
 </div>
 <br />
 <div style="width:1200px;">
<form style="" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table id="addfoldertable" class="brain_table" style="width:700px; background-color:  #FFECA3; display:none;">
     <tr><td><legend><b id="boldAddNewSubFolder" style="display:none;">Add New Sub-Folder</b></legend></td></tr>
    <tr><td id="FolderName" style="display:none;" colspan=3>Folder Name (No special characters allowed in folder name "/?$@='):
    <input type="text" id="newfile" name="newfile" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> /></td>
   <td id="Pirvate" style="display:none;"> <label for="fileprivate"><?php if($row777['file_private'] == 1) {echo 'Folder will be Private';}else{ echo ' Make Private:';}?>
   </label>
   <input type="checkbox" id="fileprivate" name="fileprivate" <?php if($_SESSION['username'] == 'Anonymous'){ echo 'disabled="disabled"';} if($row777['file_private'] == 1) {echo 'checked="checked"'; echo ' style="display:none;"'; }?> /></td></tr>
   
  
<?php

     
if ($row777['type']==3) {
echo '<tr><td colspan="3" id="SelectFolder" style="display:none;"><b>Select the Folder Type:</b></td></tr>';
echo '<tr><td width="150" id="filetype1" style="display:none;"><input type="radio" name="filetype" value="3"  ';
if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"';
echo ' />General Discipline</td>';
echo '<td width="150"  id="filetype2" style="display:none;"><input type="radio" name="filetype" value="5" ';
if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"';
echo '/>Discussion Page</td>';
echo '<td width="150"  id="filetype3" style="display:none;"><input type="radio" name="filetype" value="1"';
if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"';
echo '/>Main Project Folder</td>';
echo '<td width="150"  id="filetype4" style="display:none;"><input type="radio" name="filetype" value="2"';
if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"';
echo '/>Sub Project Folder</td></tr>';

}else{

echo '<input type="hidden" ';
 if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"';
 echo 'name="filetype" value="2"/>';

}

?>
   
   
<tr><td></td><td></td><td></td><td id="FormSubmit" style="display:none;"><input type="submit"  class="stylebutton" value="Add" name="add" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> /></td></tr>
 </table>  
  </form>
</div>
  
  <br />
  
 <div style="width:1300px; float:left; margin-left:auto; margin-right:auto; clear:both;"> 
<div class="content_underline"></div>
</div>


<?php
  //////////////PROJECT/Folder/Discussion OVERVIEW /////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if ($row777['type'] == 5 ||  $row777['type'] == 1){

    
 echo '<div style="width:1300px; overflow:hidden; ">'; 
 if ($row777['creator']==$_SESSION['user_id']){
    echo '<div style="clear:both; overflow:hidden;"><button id="synEdit" style="float:right;" class="stylebutton" type="button">Edit Synopsis</button></div>';
}
 
 
 echo '<div id="synopsisEdit">';
  echo '<div style="margin:10px;">';
 echo '<form enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo 'Edit Project Heading: <input type="text" id="synheading" name="synheading" value="' . $row777['p_heading'] . '" />';
 echo '<br /><br />';
 echo 'Edit Project Slogan: <input type="text" id="synslogan" name="synslogan" value="' . $row777['p_slogan'] . '" /><br /><br />';
 echo 'Edit Project Description: <textarea style="max-height:300px;" rows="5" cols="120" onKeyUp="forceReturn("120", this.value);"  id="syndescript" name="syndescript">';
 echo parsedescription($row777['p_descript']);
 echo '</textarea><br /><br />';
 echo '<input type="hidden" name="cbp_file_id" id="cbp_file_id" value="'. $row777['file_id'] . '"/>';
 echo '<input name="synopsissubmit"  class="stylebutton" style="position:relative; left:300px; width:200px;" type="submit" id="synopsissubmit" value="Update" />';
 echo '</form>';
 
if ($row777['p_file1']!=NULL){
    
    $filesyn = $row777['p_file1'];
			
                     $src = $root . $row777['file_path']  . '/' . $row777['file_name']. '/' . $filesyn;

                        $testpicnamesyn1 = basename($src);
                        $pic_partssyn = pathinfo( $testpicnamesyn1);
                        $testpicnamesyn1 = $pic_partssyn['filename'] . 'thum63820' . '.' .  $pic_partssyn['extension'];

                        
                        if (!file_exists($root . $row777['file_path']  . '/' . $row777['file_name']. '/' .$testpicnamesyn1)){
                            
                            resizepics($src , 800, 600);  /// Create Thumbnail
                            
                        }
         
		                    
    
    
 echo '<br /><br /><br /><div style="width:80px; padding:10px; float:left;">';
 echo '<img  src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn1 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';
   echo '<form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo '<input type="hidden" name="cbp_file_id" id="cbp_file_id" value="'. $row777['file_id'] . '"/>';
 echo '<input type="hidden" name="p_file_id" id="p_file_id" value="1"/>';
 echo '<input name="delete_p_file"  class="stylebutton" type="submit" id="delete_p_file" value="Remove" />';
 echo '</form>';
 echo '</div>';
}

if ($row777['p_file2']!=NULL){
    $filesyn = $row777['p_file2'];
    		
                     $src =  $root . $row777['file_path']  . '/' . $row777['file_name']. '/' . $filesyn;

                        $testpicnamesyn2 = basename($src);
                        $pic_partssyn = pathinfo( $testpicnamesyn2);
                        $testpicnamesyn2 = $pic_partssyn['filename'] . 'thum63820' . '.' .  $pic_partssyn['extension'];

                        
                        if (!file_exists($root . $row777['file_path']  . '/' . $row777['file_name']. '/' .$testpicnamesyn2)){
                            
                            resizepics($src , 800, 600);  /// Create Thumbnail
                            
                        }
         


    
 echo '<div style="width:80px; padding:10px; float:left;">';
 echo '<img  src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn2 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';
    echo '<form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo '<input type="hidden" name="cbp_file_id" id="cbp_file_id" value="'. $row777['file_id'] . '"/>';
 echo '<input type="hidden" name="p_file_id" id="p_file_id" value="2"/>';
 echo '<input name="delete_p_file"  class="stylebutton" type="submit" id="delete_p_file" value="Remove" />';
 echo '</form>';
 echo '</div>';
}

if ($row777['p_file3']!=NULL){
        $filesyn = $row777['p_file3'];
       	    
           
                     $src = $root . $row777['file_path']  . '/' . $row777['file_name']. '/' . $filesyn;

                        $testpicnamesyn3 = basename($src);
                        $pic_partssyn = pathinfo( $testpicnamesyn3);
                        $testpicnamesyn3 = $pic_partssyn['filename'] . 'thum63820' . '.' .  $pic_partssyn['extension'];

                        
                        if (!file_exists($root . $row777['file_path']  . '/' . $row777['file_name']. '/' .$testpicnamesyn3)){
                            
                            resizepics($src , 800, 600);  /// Create Thumbnail
                            
                        }
                                            
    
    
 echo '<div style="width:80px; padding:10px; float:left;">';
 echo '<img  src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn3 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';
 
   echo '<form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo '<input type="hidden" name="cbp_file_id" id="cbp_file_id" value="'. $row777['file_id'] . '"/>';
 echo '<input type="hidden" name="p_file_id" id="p_file_id" value="3"/>';
 echo '<input name="delete_p_file"  class="stylebutton" type="submit" id="delete_p_file" value="Remove" />';
 echo '</form>';
 echo '</div>';
}

if ($row777['p_file4']!=NULL){
         $filesyn = $row777['p_file4'];
      	
	     
           
                     $src = $root . $row777['file_path']  . '/' . $row777['file_name']. '/' . $filesyn;

                        $testpicnamesyn4 = basename($src);
                        $pic_partssyn = pathinfo( $testpicnamesyn4);
                        $testpicnamesyn4 = $pic_partssyn['filename'] . 'thum63820' . '.' .  $pic_partssyn['extension'];

                        
                        if (!file_exists($root . $row777['file_path']  . '/' . $row777['file_name']. '/' .$testpicnamesyn4)){
                            
                            resizepics($src , 800, 600);  /// Create Thumbnail
                            
                        }
         
                                    
    
 echo '<div style="width:80px; padding:10px; float:left;">';
 echo '<img  src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn4 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';
    echo '<form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo '<input type="hidden" name="cbp_file_id" id="cbp_file_id" value="'. $row777['file_id'] . '"/>';
 echo '<input type="hidden" name="p_file_id" id="p_file_id" value="4"/>';
 echo '<input name="delete_p_file"  class="stylebutton" type="submit" id="delete_p_file" value="Remove" />';
 echo '</form>';
 echo '</div>';
}

if ($row777['p_file5']!=NULL){
    $filesyn = $row777['p_file5'];
           
           
                     $src = $root . $row777['file_path']  . '/' . $row777['file_name']. '/' . $filesyn;

                        $testpicnamesyn5 = basename($src);
                        $pic_partssyn = pathinfo( $testpicnamesyn5);
                        $testpicnamesyn5 = $pic_partssyn['filename'] . 'thum63820' . '.' .  $pic_partssyn['extension'];

                        
                        if (!file_exists($root . $row777['file_path']  . '/' . $row777['file_name']. '/' .$testpicnamesyn5)){
                            
                            resizepics($src , 800, 600);  /// Create Thumbnail
                            
                        }
         
                                        
    
 echo '<div style="width:80px; padding:10px; float:left;">';
 echo '<img  src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn5 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';
    echo '<form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo '<input type="hidden" name="cbp_file_id" id="cbp_file_id" value="'. $row777['file_id'] . '"/>';
 echo '<input type="hidden" name="p_file_id" id="p_file_id" value="5"/>';
 echo '<input name="delete_p_file"  class="stylebutton" type="submit" id="delete_p_file" value="Remove" />';
 echo '</form>';
 echo '</div>';
}


if ($row777['p_file6']!=NULL){
    $filesyn = $row777['p_file6'];
        
           
                     $src = $root . $row777['file_path']  . '/' . $row777['file_name']. '/' . $filesyn;

                        $testpicnamesyn6 = basename($src);
                        $pic_partssyn = pathinfo( $testpicnamesyn6);
                        $testpicnamesyn6 = $pic_partssyn['filename'] . 'thum63820' . '.' .  $pic_partssyn['extension'];

                        
                        if (!file_exists($root . $row777['file_path']  . '/' . $row777['file_name']. '/' .$testpicnamesyn6)){
                            
                            resizepics($src , 800, 600);  /// Create Thumbnail
                            
                        }
        
    
 echo '<div style="width:80px; padding:10px; float:left;">';
 echo '<img  src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn6 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';
   echo '<form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo '<input type="hidden" name="cbp_file_id" id="cbp_file_id" value="'. $row777['file_id'] . '"/>';
 echo '<input type="hidden" name="p_file_id" id="p_file_id" value="6"/>';
 echo '<input name="delete_p_file"  class="stylebutton" type="submit" id="delete_p_file" value="Remove" />';
 echo '</form>';
 echo '</div>';
}


if ($row777['p_file7']!=NULL){
    $filesyn = $row777['p_file7'];
         
           
                     $src = $root . $row777['file_path']  . '/' . $row777['file_name']. '/' . $filesyn;

                        $testpicnamesyn7 = basename($src);
                        $pic_partssyn = pathinfo( $testpicnamesyn7);
                        $testpicnamesyn7 = $pic_partssyn['filename'] . 'thum63820' . '.' .  $pic_partssyn['extension'];

                        
                        if (!file_exists($root . $row777['file_path']  . '/' . $row777['file_name']. '/' .$testpicnamesyn7)){
                            
                            resizepics($src , 800, 600);  /// Create Thumbnail
                            
                        }
                             
    
    
 echo '<div style="width:80px; padding:10px; float:left;">';
 echo '<img  src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn7 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';
   echo '<form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo '<input type="hidden" name="cbp_file_id" id="cbp_file_id" value="'. $row777['file_id'] . '"/>';
 echo '<input type="hidden" name="p_file_id" id="p_file_id" value="7"/>';
 echo '<input name="delete_p_file"  class="stylebutton" type="submit" id="delete_p_file" value="Remove" />';
 echo '</form>';
 echo '</div>';
}

if ($row777['p_file8']!=NULL){
    $filesyn = $row777['p_file8'];
      
           
                     $src = $root . $row777['file_path']  . '/' . $row777['file_name']. '/' . $filesyn;

                        $testpicnamesyn8 = basename($src);
                        $pic_partssyn = pathinfo( $testpicnamesyn8);
                        $testpicnamesyn8 = $pic_partssyn['filename'] . 'thum63820' . '.' .  $pic_partssyn['extension'];

                        
                        if (!file_exists($root . $row777['file_path']  . '/' . $row777['file_name']. '/' .$testpicnamesyn8)){
                            
                            resizepics($src , 800, 600);  /// Create Thumbnail
                            
                        }                          
    
    
 echo '<div style="width:80px; padding:10px; float:left;">';
 echo '<img  src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn8 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';
    echo '<form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo '<input type="hidden" name="cbp_file_id" id="cbp_file_id" value="'. $row777['file_id'] . '"/>';
 echo '<input type="hidden" name="p_file_id" id="p_file_id" value="8"/>';
 echo '<input name="delete_p_file"  class="stylebutton" type="submit" id="delete_p_file" value="Remove" />';
 echo '</form>';
 echo '</div>';
}



if ($row777['p_file1']==NULL ||  $row777['p_file2']==NULL ||  $row777['p_file3']==NULL ||  $row777['p_file4']==NULL ||  $row777['p_file5']==NULL ||  $row777['p_file6']==NULL ||  $row777['p_file7']==NULL ||  $row777['p_file8']==NULL){
    echo '<div style="height:200px; float:right;">';
 echo '<form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
 echo '<input type="file" id="filesyn"  name="filesyn" ';
 if($_SESSION['username'] == 'Anonymous') {
     echo 'disabled="disabled"'; 
     }
 echo ' />';
 echo '<input type="hidden" name="cbp_file_idsyn" id="cbp_file_idsyn" value="'. $row777['file_id'] . '"/>';
 echo '<input name="addsynpic"  class="stylebutton" type="submit" id="addsynpic" value="Add Pic" />';
 echo '</form>';
 echo '</div>';
}



  echo '</div>';
 
 echo '</div>';
 
 
 
 
echo '<div id="synopsis">';







if ($row777['p_heading']!=NULL ){
echo '<h2 id="synH">' .  $row777['p_heading'] . '</h2>';
}
if ($row777['p_slogan']!=NULL ){
echo '<h3 id="synSl">' .  $row777['p_slogan'] .'</h3>';
}
if ($row777['p_descript']!=NULL ){
echo '<p id="synDesc">' .  $row777['p_descript']  . '</p><br />';
}

if ($row777['p_file1']!=NULL){
    
        $filesyn = $row777['p_file1'];
 	   
           
                     $src = $root . $row777['file_path']  . '/' . $row777['file_name']. '/' . $filesyn;

                        $testpicnamesyn = basename($src);
                        $pic_partssyn = pathinfo( $testpicnamesyn);
                        $testpicnamesyn = $pic_partssyn['filename'] . 'thum63820' . '.' .  $pic_partssyn['extension'];

                        
                        if (!file_exists($root . $row777['file_path']  . '/' . $row777['file_name']. '/' .$testpicnamesyn)){
                            
                            resizepics($src , 500, 400);  /// Create Thumbnail
                            
                        }

        
echo '<div style="float:left; width:600px;">';
echo '<img id="synpic1" src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn1 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image"  style="width:450px; margin:10px; float:right;" /><br />';
echo '</div>';
}
echo '<div style="float:left; width:500px;">';
if ($row777['p_file2']!=NULL){
                               
echo '<img id="synpic2" src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn2 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';

}

if ($row777['p_file3']!=NULL){
   
                                        
echo '<img id="synpic3" src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn3 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';

}

if ($row777['p_file4']!=NULL){
                                         
echo '<img id="synpic4" src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn4 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';

}

if ($row777['p_file5']!=NULL){
         
                                        
echo '<img id="synpic5" src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn5 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';

}

if ($row777['p_file6']!=NULL){
   
                                        
echo '<img id="synpic6" src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn6 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';

}

if ($row777['p_file7']!=NULL){
           
                                        
echo '<img id="synpic7" src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn7 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';

}

if ($row777['p_file8']!=NULL){

   
                                        
echo '<img id="synpic8" src="http://www.cirrusidea.com' . $row777['file_path'] . '/'.  $row777['file_name'] . '/'. $testpicnamesyn8 . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" style="width:75px; margin:10px; float:left;" />';

}
echo '</div>';

echo '</div>';

echo '</div>';  
    
    
    



}


 
 ////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
?>
<script>

$(document).ready(function(){


  $("#synEdit").click(function(){
   
    $("#synopsis").toggle(0);
    $("#synopsisEdit").fadeToggle();
    if ($("#synEdit").html()=="Edit Synopsis"){
    $("#synEdit").html("Close Synopsis Edit");
    }else{
    $("#synEdit").html("Edit Synopsis");
    }
            
  });
});

</script>

<script>
$(document).ready(function(){
  $('img#synpic1').bind('mouseover', function() {
    $('img#synpic1').attr("src","http://www.cirrusidea.com<?php echo $row777['file_path']. '/' . $row777['file_name'] . '/'. $testpicnamesyn1; ?>");
  });
  
   $('img#synpic2').bind('mouseover', function() {
    $('img#synpic1').attr("src","http://www.cirrusidea.com<?php echo $row777['file_path']. '/' . $row777['file_name'] . '/'. $testpicnamesyn2; ?>");
  });
  
   $('img#synpic3').bind('mouseover', function() {
    $('img#synpic1').attr("src","http://www.cirrusidea.com<?php echo $row777['file_path']. '/' . $row777['file_name'] . '/'. $testpicnamesyn3; ?>");
  });
  
  
   $('img#synpic4').bind('mouseover', function() {
    $('img#synpic1').attr("src","http://www.cirrusidea.com<?php echo $row777['file_path']. '/' . $row777['file_name'] . '/'. $testpicnamesyn4; ?>");
  });
  
   $('img#synpic5').bind('mouseover', function() {
    $('img#synpic1').attr("src","http://www.cirrusidea.com<?php echo $row777['file_path']. '/' . $row777['file_name'] . '/'. $testpicnamesyn5; ?>");
  });
  
   $('img#synpic6').bind('mouseover', function() {
    $('img#synpic1').attr("src","http://www.cirrusidea.com<?php echo $row777['file_path']. '/' . $row777['file_name'] . '/'. $testpicnamesyn6; ?>");
  });
  
   $('img#synpic7').bind('mouseover', function() {
    $('img#synpic1').attr("src","http://www.cirrusidea.com<?php echo $row777['file_path']. '/' . $row777['file_name'] . '/'. $testpicnamesyn7; ?>");
  });
  
   $('img#synpic8').bind('mouseover', function() {
    $('img#synpic1').attr("src","http://www.cirrusidea.com<?php echo $row777['file_path']. '/' . $row777['file_name'] . '/'. $testpicnamesyn8; ?>");
  });
  
 });
 
 </script>
<br />






<script>
$(document).ready(function(){


  $("#addpostbutton").click(function(){
   
    $("#CommentDescript").fadeToggle();
    $("#textAREATD").fadeToggle();
    $("#PrivateUpload").fadeToggle();
    $("#FILEUP").fadeToggle();
    $("#SubMitButton").fadeToggle();
    $("#addposttable").fadeToggle();
         
  });
});
</script>
 <div style="margin-left:auto; margin-right:auto;"> 
  <div style="float:left; padding-left:30px;">
  
  <?php
  if ($_SESSION['newuser']){
    ?>
<span class="hotspot" onmouseover="tooltip.show('Click this button to add a new post. Put your CirrusIdea in the mix!', 300);" onmouseout="tooltip.hide();">   
  <?php
  }
  ?>
  <button id="addpostbutton" class="stylebutton"  style="width:200px;">Add Post</button>
  
    <?php
  if ($_SESSION['newuser']){
      echo '</span>';
  }
    ?>
  
</div>
</div>

<div style="text-align:center; width:1300px;">
  <form  action="<?php echo $_SERVER['php_self']; ?>" method="post" enctype="multipart/form-data"  name="uploadform" id="uploadform" > 
    <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
    <table class="center" id="addposttable" style="display:none;"><tr><td colspan="4"> 
	<legend><p class="italic">What is your thought?</p></legend></td></tr>
	<tr><td id="CommentDescript" style="display:none;"><label for="description">Say Something:</label></td>
	<td id="textAREATD" style="display:none;"><textarea style="max-height: 150px;"  <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> rows="4" cols="70"  onKeyUp="forceReturn('70', this.value);" id="description" name="description" value="<?php if (!empty($description)) echo $description; ?>"></textarea></td></tr>
    <tr><td  style="width:40px; display:none;" id="PrivateUpload"><label  for="private">Private upload:</label><input type="checkbox" id="private" name="private" <?php if($_SESSION['username'] == 'Anonymous' || $row777['file_private'] == 1) { echo ' disabled="disabled"'; echo ' checked="checked"'; }?>/></td>
	<td style="text-align:right; display:none;" id="FILEUP"><label for="file">File:</label>
    
 <?php
 if(isIphone() || $isiPad) {
  ?>
  
   <input type="file" id="file"   name="file" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?>/>

<?php
 }else{
?>
<input type="file" id="file"   name="file" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> multiple>

 <?php    
 }
?>    
    </td></tr>
	    
    <tr><td></td><td style="text-align:right; display:none;" id="SubMitButton">
	
<!----> 
 
<div id="updiv"></div>
 
	<input type="submit" id="submit" name="submit"  class="stylebutton" style="width:200px;"  value="Add Post" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> />
 </form> 
  <button id="submit1" name="submit1"  class="stylebutton" style="width:200px; display:none;"  <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?>>Add Post</button></td></tr></table>

</div> 

<div id="progress1" class="progress" style="width:85%; margin-left:auto; margin-right:auto;">
                <div class="bar" style="width: 0%;"></div>
     </div>


<br />
 <div style="width:1300px; float:left; margin-left:auto; margin-right:auto; clear:both;"> 
<div class="content_underline1"></div>
</div>
<br />




<script src="http://www.cirrusidea.com/js/jquery.ui.widget.js"> </script>
<script src="http://www.cirrusidea.com/js/jquery.iframe-transport.js"> </script>
<script src="http://www.cirrusidea.com/js/jquery.fileupload.js"> </script>

<script> 
$("#file").click(function(){
$("#submit1").toggle();
$("#submit").toggle();

});


$('#uploadform').fileupload({
    url: 'uploader.php',
    sequentialUploads: true,
    maxFileSize: 10000000,
    replaceFileInput: false,
       add: function (e, data) {
          
                $("#submit1").on('click', function (e) {
               // var vfile = $("#file");
               
                //if(vfile.val() == ''){
               
               //data.url = '';
               // alert(data.url);
               // }
                
         //   data.url = 'customURL'
             //   alert(file.val());
            
                    e.preventDefault();
                    data.submit();
                });
        },
        start: function(e){
        //alert("Upload Started");
         
       $("#updiv").html("<p style='font-size:14px;'><img src='http://www.cirrusidea.com/images/loading.gif' />Please be patient while your file uploads. Do not refresh your browser during or after upload.</p>");

        },

         done: function (e, data) {
         
       // var arr = jQuery.parseJSON(data.result);
       //      var r =  data.result;
           //     alert(r);
           // alert(r);    
         //$("#updiv").append(arr.result);
         
                    
                var activeUploads = $('#uploadform').fileupload('active');
     
                if (activeUploads == 1){         
                window.location.reload();
                }
    
        },
     
         progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress1 .bar').css(
            'width',
            progress + '%'
            
        );
           
 
        
    }
    });


</script>



 <?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////Folder headder/////////////////////////////////////////////////////////////////////////////
if ($row777['type'] == 1) {  //project folder
    
echo '<h2 style="display:inline; padding-left:200px;">Project: ' . basename($file_dir) . ' &nbsp;&nbsp;</h2>';

} elseif ($row777['type'] == 2){ // Sub-folder to project or discussion
    
    echo '<h2 style="display:inline; padding-left:200px;">Posts for ' . basename($file_dir) . ' &nbsp;&nbsp;</h2>';
    
} elseif ($row777['type'] == 3){  /// General Subject Matter Folder
    
     echo '<h2 style="display:inline; padding-left:200px;">General Posts for ' . basename($file_dir) . ' &nbsp;&nbsp;</h2>';
    
} elseif ( $row777['type'] == 4) {  /// Not used
    
      echo '<h2 style="display:inline; padding-left:200px;">Posts for ' . basename($file_dir) . ' &nbsp;&nbsp;</h2>';
      
} elseif ( $row777['type'] == 5) {  //Discussion folder
    
      echo '<h2 style="display:inline; padding-left:200px;">Discussion: ' . basename($file_dir) . ' &nbsp;&nbsp;</h2>';
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  
  
 if($_GET['order_it']=='ASC'){
 $orderit = 'ASC';
 }else if ($_GET['order_it'] == 'DESC'){
 $orderit = 'DESC';
 } else {
 $orderit = 'DESC';
 }
 
 

  echo '<div style="text-align:center; width:400px; margin-left:auto; margin-right:auto;">';
 if($orderit == 'DESC'){
 echo '<a href="';
 echo $_SERVER['PHP_SELF'];
 echo '?order_it=ASC"><p>Order by Oldest First</p></a>';
 }else{
 echo '<a href="';
 echo $_SERVER['PHP_SELF'];
 echo '?order_it=DESC"><p>Order by Most Recent First</p></a>';
 }
 echo '</div>';
 
 
  function findexts ($filename) 
 { 
 $filename = strtolower($filename) ; 
 $exts = split("[/\\.]", $filename) ; 
 $n = count($exts)-1; 
 $exts = $exts[$n]; 
 return $exts; 
 } 

//$gallery = '<div id="links"><h3>Click image to gallery:</h3>';
 $gallery =    '';
 $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $results_per_page = 15;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);



?>
<br /><button  class="openLightbox stylebutton" style="margin-left:100px;">View Folder Images in Gallery</button><br />
<?php




// This function builds navigational page links based on the current page and the number of pages
  function generate_page_links($cur_page, $num_pages) {
    $page_links = '';
 
 // If this page is not the first page, generate the "previous" link
    if ($cur_page > 1) {
      $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page - 1) . '" style="padding:10px;"><-</a> ';
    }
    else {
      $page_links .= '<- ';
    }

    // Loop through the pages generating the page number links
    for ($i = 1; $i <= $num_pages; $i++) {
      if ($cur_page == $i) {
        $page_links .= ' ' . $i;
      }
      else {
        $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '" style="padding:10px;"> ' . $i . '</a>';
      }
    }
	
 // If this page is not the last page, generate the "next" link
    if ($cur_page < $num_pages) {
      $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page + 1) . '" style="padding:10px;">-></a>';
    }
    else {
      $page_links .= ' ->';
    }

    return $page_links;
  }



$file_dir = dirname($_SERVER['PHP_SELF']);

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 $query = "SELECT ALL * FROM creativebrainpower WHERE file_id ='" . $file_dir . "' ORDER BY date " . $orderit;
 $result = mysqli_query($dbc, $query);
  $total = mysqli_num_rows($result);
  $num_pages = ceil($total / $results_per_page);
 
 $query = "SELECT ALL * FROM creativebrainpower WHERE file_id ='" . $file_dir . "' ORDER BY date " . $orderit . " LIMIT $skip, $results_per_page";
  $data = mysqli_query($dbc, $query);
  
 if ($data!=NULL){
 
 
  if ($num_pages > 1) {
 echo '<p class="pagelinks" style="text-align:center;">'; 
    echo generate_page_links($cur_page, $num_pages);
    echo '</p>';
  }

$i=0;
while ($row  = mysqli_fetch_array($data)) { 
$show=0;


if ($row['private']=='1'){

$query99 = "SELECT user_name FROM uploadprivacy WHERE upload_id ='"  . $row['id'] . "'";
  $data99 = mysqli_query($dbc, $query99);
    
 while($row99 = mysqli_fetch_array($data99)){
 if($row99['user_name']==$_SESSION['username']){
 $show=1;
 break;
  }
 }
 

if($show==1){  /// is private and has read access view.

  $query2 = "SELECT * FROM cbp_user WHERE user_id ='"  . $row['member_id'] . "'";
  $data2 = mysqli_query($dbc, $query2);
  $row2 = mysqli_fetch_array($data2);


echo '<table class="brain_table">';
echo '<tr><td width="180"><b>Private Post</b><br /><br />Something Said: <br />';
 echo '<br />Said On: ' .  $row['date'] . '</td>';

  if ($_SESSION['user_id']==$row['member_id']){
        
        echo '<td colspan="4"><form  enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
        echo '<textarea rows="5" cols="120" onKeyUp="forceReturn("120", this.value);"  id="description" name="description">';
        echo parsedescription($row['description']);
        echo '</textarea>';
        echo '<input type="hidden" name="cbp_upload_id" id="cbp_upload_id" value="'. $row['id'].'"/>';
        echo '<input name="descripsubmit"  class="stylebutton" type="submit" id="descripsubmit" value="Update" />';
        echo '</form></td></tr>';
        
   }else{
   echo '<td colspan="4">';
   echo '<textarea rows="5" cols="120" style="background:#E3E3E5" onKeyUp="forceReturn("120", this.value);"  id="description" name="description">';
   echo  parsedescription($row['description']);
   echo '</textarea>';
        echo '</td></tr>';
		
    }
    
  ///////Cred Calcs and script for display /////////
     $postcredpercentage = round(($row['rating']/$max_postcred)*100,0);
       
    
    
      if ($_SESSION['user_id']!=$row['member_id']){
 
  echo '<tr><td></td><td>Post-Cred:</td><td> <div style ="width:200px; border-style:solid; border-width:1px;"><div id="postcred' . $row['id'].'" style=""><div style ="width:100px;"><img src="http://www.cirrusidea.com/images/membercred.png" height="25px" style="z-index:+2"/>' . $row['rating'] . '</div></div></div></td>';
        echo '<td width="400"><form id="formpostcred' . $row['id'].'" action="">Give Post-Cred: <input type="radio" name="postcredvote' . $row['id'].'" value="positivepostcred">+Post Cred<input type="radio" name="postcredvote' . $row['id'].'" value="negativepostcred"> -Post Cred';
       echo ' <input type="hidden" id ="postid' . $row['id'].'" name="postid" value="' . $row['id'] . '" />';
       echo '<input type="submit"  class="stylebutton"  id="addpostcred" name="addpostcred" value="PostCred" /></form></td></tr>';
?>
<script>
      
            $('#formpostcred<?php echo $row["id"]; ?>').submit(function(event) {
                   
            event.preventDefault();    /* stop form from submitting normally */
            
            var postid = $("#postid<?php echo $row['id']; ?>").val();
            var postcredvote = $("input:radio[name=postcredvote<?php echo $row['id']; ?>]:checked").val();
            
           //alert(postid +"\n" + postcredvote);
            
                $.post('http://www.cirrusidea.com/ajaxpostcred.php',
                    {
                    postid: postid,
                    postcredvote: postcredvote                    
                    },
                
                    function(data,status){
                    
                    var arr = jQuery.parseJSON(data);
                                                          
                    //alert("postcredpercentage:" + arr.postcredpercentage + "\n postcredvote: " + arr.postcredvote +  "\nStatus: " + status);
                
                           
                 if (arr.postcredvote < 0){
                    $('#postcred<?php echo $row["id"]; ?>').css("background-color", "red");
                    $('#postcred<?php echo $row["id"]; ?>').css("width", "100%");
             
                }else{
                    $('#postcred<?php echo $row["id"]; ?>').css("width", arr.postcredpercentage + "%" );
                }

                     $('#postcred<?php echo $row["id"]; ?>').html("<div style ='width:100px;'><img src='http://www.cirrusidea.com/images/membercred.png' height='25px' style='z-index:+2'/>" + arr.postcredvote + "</div>" );
                
                     $('#formpostcred<?php echo $row["id"]; ?>').hide();
                     
                    
                 
                   
                   
                });
            
             });     
</script>


<?php
  
  
  } else {
        
        echo '<tr><td></td><td>Post-Cred:</td><td> <div style ="width:200px; border-style:solid; border-width:1px;"><div id="postcred' . $row['id'].'" style=""><div style ="width:100px;"><img src="http://www.cirrusidea.com/images/membercred.png" height="25px" style="z-index:+2"/>' . $row['rating'] . '</div></div></div></td></tr>';  
    }
 
if ($postcredpercentage >= 0) {
?>
<script language="javascript">
document.getElementById("postcred<?php echo $row['id']; ?>").style.backgroundColor="#FFFF71";
document.getElementById("postcred<?php echo $row['id']; ?>").style.width=<?php echo $postcredpercentage; ?> + "%";
</script>
<?php
} else {
 ?>
<script language="javascript">
document.getElementById("postcred<?php echo $row['id']; ?>").style.backgroundColor="red";
document.getElementById("postcred<?php echo $row['id']; ?>").style.width="100%";
</script>
<?php     
}

 
   
	if ($row['filename']!=NULL){
		$file1 = $row['filename'];
		$fileext = findexts ($file1);
		
		if (($fileext == 'png')|| ($fileext == 'jpg') || ($fileext == 'gif') || ($fileext == 'jpeg') || ($fileext == 'jpeg')){
            
            
                       
                                 $src = $root  . $row['file_id']  . '/' . $row['filename'];

                        $testpicname = basename($src);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'thum63820' . '.' .  $pic_parts1['extension'];

                        
                        if (!file_exists($root . $row['file_id']  . '/' .$testpicname)){
                            
                            resizepics($src , 300, 225);  /// Create Thumbnail
                            
                        }
         
                                            
        				echo '<tr><td style="text-align:center;" colspan = "4"><a href="http://www.cirrusidea.com' . $_SERVER['PHP_SELF'] . '?path=' . $row['file_id'] . '/' . $row['filename'] . '"><img src="http://www.cirrusidea.com' . $row['file_id'] . '/'. $testpicname . '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" width="300" /></a>';
						
                 
                        
                        if(isset($row['filesize'])){
						echo '  file size: ' . number_format($row['filesize']/1024/1024,1) . 'M'; 
						} 
						echo '</td></tr>';
	    	
    	}else if($fileext == 'mp4' || $fileext == 'ogv' || $fileext == 'webm' || $fileext == 'mov'){
                        
             echo '<tr><td style="text-align:center;" colspan = "4">';
             if ( $fileext == 'mov'){
                  
                 
                echo ' <div id="embedvideo'.$row["id"].'"></div> ';
     

                   echo ' <button class="stylebutton" id="videobutton'.$row["id"].'" onclick="loadVideo('.$row["id"].', \'http://www.cirrusidea.com' . $row['file_id'] . '/' . $row['filename'] . '\',1);">Open Video</button>';
              echo '<br /><a href="' . $row['file_id'] . '/' . $row['filename'] . '">Download Cirrus Idea File: ' . $row['filename'] . '</a>';
                 if(isset($row['filesize'])){
                        				echo '  file size: ' . number_format($row['filesize']/1024/1024,1) . 'M'; 
                						} 
             
             }else{
              echo '    <video id="video'.$row["id"].'" width="640" height="360" controls  width="640" height="360" alt="'.$row['filename'].'"> ';
                      
                         if($fileext == 'mp4' ){
                    echo '  <source id="src'.$row["id"].'"  type="video/mp4"  />';
                      }
                      
                      
                      
                        if($fileext == 'ogv'){
                    echo '  <source id="src'.$row["id"].'"  type="video/ogg"  />';
                      }
                      
                       if($fileext == 'ogv'){
                    echo '  <source id="src'.$row["id"].'"  type="video/webm />';
                      }
                     
                      
                	//	<!-- fallback image -->
                  echo '		<img src="http://www.cirrusidea.com/images/CirrusIdeaLogo1.png" width="640" height="360" alt="'.$row['filename'].'"';
                	  echo '	     title="No video playback capabilities, please download the video below" />';
                	  echo '</object>';
                  echo '</video>';
             
                 
                  echo ' <button class="stylebutton" id="videobutton'.$row["id"].'" onclick="loadVideo('.$row["id"].', \''. $_SERVER['PHP_SELF'] . '?path=' . $row['file_id'] . '/' . $row['filename'] . '\');">Open Video</button>';
             
                            echo '<br /><a href="' . $_SERVER['PHP_SELF'] . '?path=' . $row['file_id'] . '/' . $row['filename'] . '">Download Cirrus Idea File: ' . $row['filename'] . '</a>';
                 if(isset($row['filesize'])){
                    					echo '  file size: ' . number_format($row['filesize']/1024/1024,1) . 'M'; 
                						} 
                						
             }
                 echo '</td></tr>';

	}else{
	echo '<tr><td style="text-align:center;" colspan = "4"><a href="' . $_SERVER['PHP_SELF']. '?path=' . $row['file_id'] . '/' . $row['filename'] . '">Download Cirrus Idea File: ' . $row['filename'] . '</a>';
	
                  
                        
                        
    if(isset($row['filesize'])){
						echo '  file size: ' . number_format($row['filesize']/1024/1024,1) . 'M'; 
						} 
						echo '</td></tr>';
		}
	 }
    echo '<tr><td>';
	if ($_SESSION['user_id']==$row['member_id']){
	echo '<a href="http://www.cirrusidea.com/postremove.php?member_id=' . $row['member_id'] . '&id=' . $row['id']. '">Remove</a>';
	}
	if ($_SESSION['user_id']==$row['member_id']){
	echo '</td><td colspan="2">';
	
	
// Sharefile FORM:	
	echo '<form enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
	

	
	echo '<iframe id="sharefile' . $row['id'] . '" src="" width="800px" height="170px" style="display:none; position:relative;" scrolling="no" frameborder="0"></iframe>';
	echo '<input type="button"  class="stylebutton"  name="sharefile" value="Share Post"';
	
	?>
	
	onclick="function set(){ f=document.getElementById('sharefile<?php echo $row['id']; ?>'); f.style.display='block'; f.src='http://www.cirrusidea.com/sharefile.php?id=<?php echo $row['id']; ?>';} setTimeout(set);" />
	
	
	
	<?php
	
	echo '</form>';
	
	}
	
	
    echo '</td><td>';
    if ($row['filename'] == NULL && $_SESSION['user_id']==$row['member_id']){
?>    
 <script language="javascript">   
    function onUpload<?php echo $i; ?>(){

document.getElementById("updiv<?php echo $i; ?>").innerHTML="<p style='font-size:14px;'><img src='http://www.cirrusidea.com/images/loading.gif' />Please be patient while your file uploads. Do not refresh your browser during or after upload.</p>";


}
</script>
    
    <form  enctype="multipart/form-data"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="onUpload<?php echo $i; ?>()" name="uploadform1x" id="uploadform1x"> 
    
     
	<label for="file">Add a file to this post:</label>
    <input type="file" id="file1x" name="file1x" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> />
	    
   	<input  type="hidden" name="cbp_upload_id1x" value="<?php echo $row['id']; ?>" />
<!----> 

<div id="updiv<?php echo $i; ?>"></div>
    

    <input name="addpostsubmit" type="submit"  class="stylebutton" id="addpostsubmit" value="Add" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?>      />
  </form> 
    
      
  
 <?php 
    
    }
    
    echo '</td></tr>';
    
    
    
    
    
        echo '<tr><td>Cirrus Member:  <a href="http://www.cirrusidea.com/viewprofile.php?username=' . $row2['username'] . '">'. $row2['username'] . '</a></td>';
    
  ///////Cred Calcs and script for display /////////
     $credpercentage = round(($row2['cred']/$max_memcred)*100,0);
   
    if ($_SESSION['user_id']!=$row['member_id']){
 
  echo '<td>Member-Cred:</td><td> <div style ="width:200px; border-style:solid; border-width:1px;"><div id="memcred' . $row2['user_id'].$i.'" style=""><div style ="width:100px;"><img src="http://www.cirrusidea.com/images/postcredbrain.png" height="25px" style="z-index:+2"/>' . $row2['cred'] . '</div></div></div></td>';
        echo '<td width="400"><form id="formmemcred' . $row2['user_id'].$i.'" action="">Give Member-Cred: <input type="radio" name="credvote' . $row2['user_id'].$i.'" value="positivecred">+Cred<input type="radio" name="credvote' . $row2['user_id'].$i.'" value="negativecred"> -Cred';
       echo ' <input type="hidden" id="credusername' . $row2['user_id'].$i.'" name="credusername' . $row2['user_id'].$i.'" value="' . $row2['username'] . '" />';
       echo '<input type="submit" id="addcred"  class="stylebutton"  name="addcred" value="MemberCred" /></form></td></tr>';
  
  ?>
            	
<script>
      
            $('#formmemcred<?php echo $row2["user_id"].$i; ?>').submit(function(event) {
                   
            event.preventDefault();    /* stop form from submitting normally */
            
            var credusername = $("#credusername<?php echo $row2['user_id'].$i; ?>").val();
            var credvote = $("input:radio[name=credvote<?php echo $row2['user_id'].$i; ?>]:checked").val();
            
          //  alert( credusername);
            
                $.post('http://www.cirrusidea.com/ajaxmembercred.php',
                    {
                    credusername: credusername,
                    credvote: credvote                    
                    },
                
                    function(data,status){
                    
                    var arr = jQuery.parseJSON(data);
                                                          
                   // alert("Username:" + arr.credusername + "\nCredvote: " + arr.credvote + "\nCredpercentage: " + arr.credpercentage + "\nStatus: " + status);
                
                 if (arr.credvote < 0){
                  $('[id^="memcred<?php echo $row2["user_id"]; ?>"]').css("background-color", "red" );
                   $('[id^="memcred<?php echo $row2["user_id"]; ?>"]').css("width", "100%");
                   }else{
                    $('[id^="memcred<?php echo $row2["user_id"]; ?>"]').css("width", arr.credpercentage + "%" );
                   }

                     $('[id^="memcred<?php echo $row2["user_id"]; ?>"]').html("<div style ='width:100px;'><img src='http://www.cirrusidea.com/images/postcredbrain.png' height='25px' style='z-index:+2'/>"+ arr.credvote + "</div>" );
                
                     $('[id^="formmemcred<?php echo $row2["user_id"]; ?>"]').hide();
                
                
                 if (arr.credvote < 0){
                    $('#memcred<?php echo $row2["user_id"].$i; ?>').css("background-color", "red");
                    $('#memcred<?php echo $row2["user_id"].$i; ?>').css("width", "100%");
             
                }else{
                    $('#memcred<?php echo $row2["user_id"].$i; ?>').css("width", arr.credpercentage + "%" );
                }

                     $('#memcred<?php echo $row2["user_id"].$i; ?>').html("<div style ='width:100px;'><img src='http://www.cirrusidea.com/images/postcredbrain.png' height='25px' style='z-index:+2'/>"+ arr.credvote + "</div>" );
                
                     $('#formmemcred<?php echo $row2["user_id"].$i; ?>').hide();
                     
                    
                 
                   
                   
                });
            
             });     
    </script>


<?php
  
  
   
   } else {
        
        echo '<td>Member-Cred:</td><td> <div style ="width:200px; border-style:solid; border-width:1px;"><div id="memcred' . $row2['user_id'].$i.'" style=""><div style ="width:100px;"><img src="http://www.cirrusidea.com/images/postcredbrain.png" height="25px" style="z-index:+2"/>' . $row2['cred'] . '</div></div></div></td></tr>';
    
    }
    
if ($credpercentage >= 0) {
?>
<script language="javascript">
document.getElementById("memcred<?php echo $row2['user_id'].$i; ?>").style.backgroundColor="#5CE62E";
document.getElementById("memcred<?php echo $row2['user_id'].$i; ?>").style.width=<?php echo $credpercentage; ?> + "%";
</script>
<?php
} else {
 ?>
<script language="javascript">
document.getElementById("memcred<?php echo $row2['user_id'].$i; ?>").style.backgroundColor="red";
document.getElementById("memcred<?php echo $row2['user_id'].$i; ?>").style.width="100%";
</script>

<?php     
}

    
    
    echo '<tr>';
	
	
if ($_SESSION['user_id']==$row['member_id']){	
	echo '<td  colspan="4"><form enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
	echo '<input type="hidden" name="upload_id" value="' . $row['id']  . '" />';

	echo '<label for="move_file_location">Copy Post to Folder:</label>';
      
	 echo '<select id="folder" name="folder">';
 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query5 = "SELECT * FROM cbpfiles ORDER BY file_path ASC";
$data5 = mysqli_query($dbc, $query5);

while($row5 = mysqli_fetch_array($data5)) { 
 
$query778 = "SELECT * FROM folderprivacy WHERE folderID = '".$row5['file_id']."'";
$data778 = mysqli_query($dbc, $query778);

$showoption = false;
while($row778 = mysqli_fetch_array($data778)) { 
    
    if($row778['user_name']==$_SESSION['username']){
        $showoption = true;
        break;
    }
    
}
 
 if($showoption || $row5['file_private']==0){
echo '<option value="' . $row5['file_path'] . '/' . $row5['file_name'] . '" >' . $row5['file_path'] . '/' . $row5['file_name'] .  '</option>';
}

}

    echo '</select><br /><input type="submit"  id="movefolder" class="stylebutton" value="Copy Post To:" name="movefolder"/></td></form>';
    
    }else{
     echo '<td colspan="4"></td>';   
    }
    
  
      if ($_SESSION['user_id']!=$row['member_id']){   
    echo '<td colspan="2"><form enctype="multipart/form-data" method="post" action="http://www.cirrusidea.com/reportpost.php" style="display:block; float:left;">';
    echo '<input type="hidden" name="upload_id" value="' . $row['id']  . '" />';
    echo '<input type="hidden" name="project_file" value="' .  $row['file_id'] .  '" />';
    echo '<input type="submit"  class="stylebutton"   value="Report Post" name="reportpost' . $i. '"/></form>';
   echo '<button  class="commentonpostbutton stylebutton" style="display:block; float:left; margin-left:20px;" id="commentpostB_'.$row['id'].'" name="commentpostB_'.$row['id'].'">Comment on Post</button>';
   echo '</td>';
      }
    
    echo '</tr></table><br />';
 
  $queryPC1 = "SELECT * FROM postcomments  WHERE ref_post_id ='"  . $row['id'] . "'";
 $dataPC1 = mysqli_query($dbc, $queryPC1);
 if(mysqli_num_rows($dataPC1)> 0){
    echo '<div class="postCommentOUTERDIV">';
     echo '<button class="hidecommments" id="hidecomments_'.$row['id'].'">Post Comments</button>';
     echo '<div class="postCommentDIV" id="postCommentDiv_ID_'.$row['id'].'" style="display:none;">';
 while($rowPC1 = mysqli_fetch_array($dataPC1)){
 echo '<table class="postCommentTable"><tr><td width="20%">';
 echo 'Comment on Post: </td>';
 echo '<td width="60%">' . $rowPC1['comment'] . '</td>';
  if ($_SESSION['user_id']!=$row['member_id']){  
  echo '<td width="20%"><div style="float:right;"><button  class="deletecommentonpostbutton stylebutton" id="commentpostID_'.$rowPC1['postcomment_id'].'" name="commentpostID_'.$rowPC1['postcomment_id'].'">Delete Comment</button></div><td>';
  }
 echo '</tr></table>';
 }
 echo '</div></div>';
 }
      
 }
 
 }else{
 
//end of  $show = 1;
 
 if($show == 0){  /// Is a public post.
 
 $query2 = "SELECT * FROM cbp_user WHERE user_id ='"  . $row['member_id'] . "'";
  $data2 = mysqli_query($dbc, $query2);
  $row2 = mysqli_fetch_array($data2);


echo '<table class="brain_table">';
echo '<tr><td width="180">Something Said: <br />';
 echo '<br />Said On: ' .  $row['date'] . '</td>';
 
   if ($_SESSION['user_id']!=$row['member_id']){
        
      echo '<td colspan="4">';
   echo '<textarea rows="5" cols="120" style="background:#E3E3E5" onKeyUp="forceReturn("120", this.value);"  id="description" name="description">';
   echo parsedescription($row['description']);
   echo '</textarea>';
        echo '</td></tr>';
		
    }else{
   echo '<td colspan="4"><form style="" enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
   echo '<textarea rows="5" cols="120" onKeyUp="forceReturn("120", this.value);"  id="description" name="description">';
   echo parsedescription($row['description']);
   echo '</textarea>';
      echo '<input type="hidden" name="cbp_upload_id" id="cbp_upload_id" value="'. $row['id'] . '"/>';
        echo '<input name="descripsubmit"  class="stylebutton" type="submit" id="descripsubmit" value="Update" />';
        echo '</form></td></tr>';
        
    }

         ///////Cred Calcs and script for display /////////
     $postcredpercentage = round(($row['rating']/$max_postcred)*100,0);
       
    
    
      if ($_SESSION['user_id']!=$row['member_id']){
 
  echo '<tr><td></td><td>Post-Cred:</td><td> <div style ="width:200px; border-style:solid; border-width:1px;"><div id="postcred' . $row['id'].'" style=""><div style ="width:100px;"><img src="http://www.cirrusidea.com/images/membercred.png" height="25px" style="z-index:+2"/>' . $row['rating'] . '</div></div></div></td>';
        echo '<td width="400"><form id="formpostcred' . $row['id'].'" action="">Give Post-Cred: <input type="radio" name="postcredvote' . $row['id'].'" value="positivepostcred">+Post Cred<input type="radio" name="postcredvote' . $row['id'].'" value="negativepostcred"> -Post Cred';
       echo ' <input type="hidden" id ="postid' . $row['id'].'" name="postid" value="' . $row['id'] . '" />';
       echo '<input type="submit"  class="stylebutton"  id="addpostcred" name="addpostcred" value="PostCred" /></form></td></tr>';
?>
<script>
      
            $('#formpostcred<?php echo $row["id"]; ?>').submit(function(event) {
                   
            event.preventDefault();    /* stop form from submitting normally */
            
            var postid = $("#postid<?php echo $row['id']; ?>").val();
            var postcredvote = $("input:radio[name=postcredvote<?php echo $row['id']; ?>]:checked").val();
            
           //alert(postid +"\n" + postcredvote);
            
                $.post('http://www.cirrusidea.com/ajaxpostcred.php',
                    {
                    postid: postid,
                    postcredvote: postcredvote                    
                    },
                
                    function(data,status){
                    
                    var arr = jQuery.parseJSON(data);
                                                          
                    //alert("postcredpercentage:" + arr.postcredpercentage + "\n postcredvote: " + arr.postcredvote +  "\nStatus: " + status);
                
                           
                 if (arr.postcredvote < 0){
                    $('#postcred<?php echo $row["id"]; ?>').css("background-color", "red");
                    $('#postcred<?php echo $row["id"]; ?>').css("width", "100%");
             
                }else{
                    $('#postcred<?php echo $row["id"]; ?>').css("width", arr.postcredpercentage + "%" );
                }

                     $('#postcred<?php echo $row["id"]; ?>').html("<div style ='width:100px;'><img src='http://www.cirrusidea.com/images/membercred.png' height='25px' style='z-index:+2'/>" + arr.postcredvote + "</div>" );
                
                     $('#formpostcred<?php echo $row["id"]; ?>').hide();
                     
                    
                 
                   
                   
                });
            
             });     
</script>


<?php
    } else {
        
        echo '<tr><td></td><td>Post-Cred:</td><td> <div style ="width:200px; border-style:solid; border-width:1px;"><div id="postcred' . $row['id'].'" style=""><div style ="width:100px;"><img src="http://www.cirrusidea.com/images/membercred.png" height="25px" style="z-index:+2"/>' . $row['rating'] . '</div></div></div></td></tr>';  
    }
  
if ($postcredpercentage >= 0) {
?>
<script language="javascript">
document.getElementById("postcred<?php echo $row['id']; ?>").style.backgroundColor="#FFFF71";
document.getElementById("postcred<?php echo $row['id']; ?>").style.width=<?php echo $postcredpercentage; ?> + "%";
</script>
<?php
} else {
 ?>
<script language="javascript">
document.getElementById("postcred<?php echo $row['id']; ?>").style.backgroundColor="red";
document.getElementById("postcred<?php echo $row['id']; ?>").style.width="100%";
</script>
<?php     
}


     
  

	if ($row['filename']!=NULL){
		$file1 = $row['filename'];
		$fileext = findexts ($file1);
		
		if (($fileext == 'png')|| ($fileext == 'jpg') || ($fileext == 'gif') || ($fileext == 'jpeg') || ($fileext == 'jpeg')){
						
                        
                        
                        
                         $src = $root . $row['file_id']  . '/' . $row['filename'];
                        
                        
                        $testpicname = basename($src);
                        $pic_parts1 = pathinfo( $testpicname);
                            $testpicname = $pic_parts1['filename'] . 'thum63820' . '.' . $pic_parts1['extension'];
                            
                      
                      if (!file_exists($root . $row['file_id']  . '/' .$testpicname)){
                            resizepics($src , 300, 225);  /// Create Thumbnail
                    }
         
                                            
    					echo '<tr><td style="text-align:center;" colspan = "4"><a href="http://www.cirrusidea.com' . $_SERVER['PHP_SELF'] . '?path=' . $row['file_id'] . '/' . $row['filename'] . '"><img src="http://www.cirrusidea.com' . $row['file_id'] . '/'. $testpicname. '?v=' . Date("Y.m.d.G.i.s") . '" alt="Creative Image" width="300" /></a>';
						
                
                    
                        if(isset($row['filesize'])){
						echo '  file size: ' . number_format($row['filesize']/1024/1024,1) . 'M'; 
						} 
						echo '</td></tr>';				
						
	

		}else if($fileext == 'mp4' || $fileext == 'ogv' || $fileext == 'webm' || $fileext == 'mov'){
                        
             echo '<tr><td style="text-align:center;" colspan = "4">';
             if ( $fileext == 'mov'){
                 
                   
    echo ' <div id="embedvideo'.$row["id"].'"></div> ';
            
                   echo ' <button class="stylebutton" id="videobutton'.$row["id"].'" onclick="loadVideo('.$row["id"].', \'http://www.cirrusidea.com' . $row['file_id'] . '/' . $row['filename'] . '\',1);">Open Video</button>';
              echo '<br /><a href="' . $row['file_id'] . '/' . $row['filename'] . '">Download Cirrus Idea File: ' . $row['filename'] . '</a>';
                 if(isset($row['filesize'])){
                        				echo '  file size: ' . number_format($row['filesize']/1024/1024,1) . 'M'; 
                						} 
                  
             }else{
              echo '    <video id="video'.$row["id"].'" width="640" height="360" controls  width="640" height="360" alt="'.$row['filename'].'"> ';
                      
                         if($fileext == 'mp4' ){
                    echo '  <source id="src'.$row["id"].'"  type="video/mp4"  />';
                      }
                      
                      
                      
                        if($fileext == 'ogv'){
                    echo '  <source id="src'.$row["id"].'"  type="video/ogg"  />';
                      }
                      
                       if($fileext == 'ogv'){
                    echo '  <source id="src'.$row["id"].'"  type="video/webm />';
                      }
                     
                      
                	//	<!-- fallback image -->
                  echo '		<img src="http://www.cirrusidea.com/images/CirrusIdeaLogo1.png" width="640" height="360" alt="'.$row['filename'].'"';
                	  echo '	     title="No video playback capabilities, please download the video below" />';
                	  echo '</object>';
                  echo '</video>';
             
                 
                  echo ' <button class="stylebutton" id="videobutton'.$row["id"].'" onclick="loadVideo('.$row["id"].', \''. $_SERVER['PHP_SELF'] . '?path=' . $row['file_id'] . '/' . $row['filename'] . '\');">Open Video</button>';
             
                            echo '<br /><a href="' . $_SERVER['PHP_SELF'] . '?path=' . $row['file_id'] . '/' . $row['filename'] . '">Download Cirrus Idea File: ' . $row['filename'] . '</a>';
                 if(isset($row['filesize'])){
                    					echo '  file size: ' . number_format($row['filesize']/1024/1024,1) . 'M'; 
                						} 
                					
             }
                 echo '</td></tr>';	

	}else{
	echo '<tr><td style="text-align:center;" colspan = "4"><a href="' . $_SERVER['PHP_SELF'] . '?path=' . $row['file_id'] . '/' . $row['filename'] . '">Download Cirrus Idea File: ' . $row['filename'] . '</a>';


                        
                        
    if(isset($row['filesize'])){
						echo '  file size: ' . number_format($row['filesize']/1024/1024,1) . 'M'; 
						} 
						echo '</td></tr>';
	
	
		}
	 }
    echo '<tr><td>';
	if ($_SESSION['user_id']==$row['member_id']){
	echo '<a href="http://www.cirrusidea.com/postremove.php?member_id=' . $row['member_id'] . '&id=' . $row['id'].'">Remove</a>';
	}
	echo '</td><td colspan="2">';
	
	
// Sharefile FORM:	
	echo '<form enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
	

	
	echo '<iframe id="sharefile' . $row['id'] . '" src="" width="800px" height="170px" style="display:none; position:relative;" scrolling="no" frameborder="0"></iframe>';
	echo '<input type="button"  class="stylebutton" name="sharefile" value="Share Post"';
	
	?>
	
	onclick="function set(){ f=document.getElementById('sharefile<?php echo $row['id']; ?>'); f.style.display='block'; f.src='http://www.cirrusidea.com/sharefile.php?id=<?php echo $row['id']; ?>';} setTimeout(set);" />
	
	
	
	<?php
	
	echo '</form>';
	
    echo '</td><td>';
    if ($row['filename'] == NULL && $_SESSION['user_id']==$row['member_id']){
?>    
     <script language="javascript">   
    function onUpload<?php echo $i; ?>(){

document.getElementById("updiv<?php echo $i; ?>").innerHTML="<p style='font-size:14px;'><img src='http://www.cirrusidea.com/images/loading.gif' />Please be patient while your file uploads. Do not refresh your browser during or after upload.</p>";


}
</script>
    <form  enctype="multipart/form-data"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="onUpload<?php echo $i; ?>()" name="uploadform1x" id="uploadform1x"> 
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo CBP_MAXFILESIZE; ?>" />   
    
     
    <label for="file">Add a file to this post:</label>
    <input type="file" id="file1x" name="file1x" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> />
	    
   	<input  type="hidden" name="cbp_upload_id1x" value="<?php echo $row['id']; ?>" />
<!----> 

	<div id="updiv<?php echo $i; ?>"></div>
    

    <input name="addpostsubmit"  class="stylebutton" type="submit" id="addpostsubmit" value="Add" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?>  />
  </form> 
    
      
  
 <?php 
    
    }
    
    echo '</td></tr>';
    
    
    
        echo '<tr><td>Cirrus Member:  <a href="http://www.cirrusidea.com/viewprofile.php?username=' . $row2['username'] . '">'. $row2['username'] . '</a></td>';
             
           
 ///////Cred Calcs and script for display /////////
     $credpercentage = round(($row2['cred']/$max_memcred)*100,0);
   
    if ($_SESSION['user_id']!=$row['member_id']){
 
  echo '<td>Member-Cred:</td><td> <div style ="width:200px; border-style:solid; border-width:1px;"><div id="memcred' . $row2['user_id'].$i.'" style=""><div style ="width:100px;"><img src="http://www.cirrusidea.com/images/postcredbrain.png" height="25px" style="z-index:+2"/>' . $row2['cred'] . '</div></div></div></td>';
        echo '<td width="400"><form id="formmemcred' . $row2['user_id'].$i.'" action="">Give Member-Cred: <input type="radio" name="credvote' . $row2['user_id'].$i.'" value="positivecred">+Cred<input type="radio" name="credvote' . $row2['user_id'].$i.'" value="negativecred"> -Cred';
       echo ' <input type="hidden" id="credusername' . $row2['user_id'].$i.'" name="credusername' . $row2['user_id'].$i.'" value="' . $row2['username'] . '" />';
       echo '<input type="submit" id="addcred"  class="stylebutton"  name="addcred" value="MemberCred" /></form></td></tr>';
  
  ?>
                
<script>
      
            $('#formmemcred<?php echo $row2["user_id"].$i; ?>').submit(function(event) {
                   
            event.preventDefault();    /* stop form from submitting normally */
            
            var credusername = $("#credusername<?php echo $row2['user_id'].$i; ?>").val();
            var credvote = $("input:radio[name=credvote<?php echo $row2['user_id'].$i; ?>]:checked").val();
            
          //  alert( credusername);
            
                $.post('http://www.cirrusidea.com/ajaxmembercred.php',
                    {
                    credusername: credusername,
                    credvote: credvote                    
                    },
                
                    function(data,status){
                    
                    var arr = jQuery.parseJSON(data);
                                                          
                   // alert("Username:" + arr.credusername + "\nCredvote: " + arr.credvote + "\nCredpercentage: " + arr.credpercentage + "\nStatus: " + status);
                
                if (arr.credvote < 0){
                  $('[id^="memcred<?php echo $row2["user_id"]; ?>"]').css("background-color", "red" );
                   $('[id^="memcred<?php echo $row2["user_id"]; ?>"]').css("width", "100%");
                   }else{
                    $('[id^="memcred<?php echo $row2["user_id"]; ?>"]').css("width", arr.credpercentage + "%" );
                   }

                     $('[id^="memcred<?php echo $row2["user_id"]; ?>"]').html("<div style ='width:100px;'><img src='http://www.cirrusidea.com/images/postcredbrain.png' height='25px' style='z-index:+2'/>"+ arr.credvote + "</div>" );
                
                     $('[id^="formmemcred<?php echo $row2["user_id"]; ?>"]').hide();
                
                
                 if (arr.credvote < 0){
                    $('#memcred<?php echo $row2["user_id"].$i; ?>').css("background-color", "red");
                    $('#memcred<?php echo $row2["user_id"].$i; ?>').css("width", "100%");
             
                }else{
                    $('#memcred<?php echo $row2["user_id"].$i; ?>').css("width", arr.credpercentage + "%" );
                }

                     $('#memcred<?php echo $row2["user_id"].$i; ?>').html("<div style ='width:100px;'><img src='http://www.cirrusidea.com/images/postcredbrain.png' height='25px' style='z-index:+2'/>"+ arr.credvote + "</div>" );
                
                     $('#formmemcred<?php echo $row2["user_id"].$i; ?>').hide();
                     
                   
                   
                });
            
             });     
    </script>

 <?php  
   } else {
        
        echo '<td>Member-Cred:</td><td> <div style ="width:200px; border-style:solid; border-width:1px;"><div id="memcred' . $row2['user_id'] . $i. '" style=""><div style ="width:100px;"><img src="http://www.cirrusidea.com/images/postcredbrain.png" height="25px" style="z-index:+2"/>' . $row2['cred'] . '</div></div></div></td></tr>';
    
    }
    
if ($credpercentage >= 0) {
?>
<script language="javascript">
document.getElementById("memcred<?php echo $row2['user_id'].$i; ?>").style.backgroundColor="#5CE62E";
document.getElementById("memcred<?php echo $row2['user_id'].$i; ?>").style.width=<?php echo $credpercentage; ?> + "%";
</script>
<?php
} else {
 ?>
<script language="javascript">
document.getElementById("memcred<?php echo $row2['user_id'].$i; ?>").style.backgroundColor="red";
document.getElementById("memcred<?php echo $row2['user_id'].$i; ?>").style.width="100%";
</script>
<?php     
}

    
   echo '<tr>';
	
	
	echo '<td  colspan="4"><form enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
	echo '<input type="hidden" name="upload_id" value="' . $row['id']  . '" />';
 
	echo '<label for="move_file_location">Copy Post to Folder:</label>';
      
	 echo '<select id="folder" name="folder">';


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query5 = "SELECT * FROM cbpfiles ORDER BY file_path ASC";
$data5 = mysqli_query($dbc, $query5);

while($row5 = mysqli_fetch_array($data5)) { 
 
$query778 = "SELECT * FROM folderprivacy WHERE folderID = '".$row5['file_id']."'";
$data778 = mysqli_query($dbc, $query778);

$showoption = false;
while($row778 = mysqli_fetch_array($data778)) { 
    
    if($row778['user_name']==$_SESSION['username']){
        $showoption = true;
        break;
    }
    
}
 
 if($showoption || $row5['file_private']==0){
echo '<option value="' . $row5['file_path'] . '/' . $row5['file_name'] . '" >' . $row5['file_path'] . '/' . $row5['file_name'] .  '</option>';
}

}

      echo '</select><br /><input type="submit" id="movefolder" class="stylebutton" value="Copy Post To:" name="movefolder"/></td></form>';
      
   if ($_SESSION['user_id']!=$row['member_id']){     
    echo '<td colspan="2"><form enctype="multipart/form-data" method="post" action="http://www.cirrusidea.com/reportpost.php" style="display:block; float:left;">';
	echo '<input type="hidden" name="upload_id" value="' . $row['id']  . '" />';
    echo '<input type="hidden" name="project_file" value="' .  $row['file_id'] .  '" />';
    echo '<input type="submit"  class="stylebutton" value="Report Post"  name="reportpost' . $i. '""/></form>';
    echo '<button  class="commentonpostbutton stylebutton" style="display:block; float:left; margin-left:20px;" id="commentpostB_'.$row['id'].'" name="commentpostB_'.$row['id'].'">Comment on Post</button>';
   echo '</td>';
   }
   
  
   
   echo '</tr></table><br />';
 
 $queryPC2 = "SELECT * FROM postcomments  WHERE ref_post_id ='"  . $row['id'] . "'";
 $dataPC2 = mysqli_query($dbc, $queryPC2);
 if(mysqli_num_rows($dataPC2)> 0){
      echo '<div class="postCommentOUTERDIV">';
     echo '<button class="hidecommments" id="hidecomments_'.$row['id'].'">Post Comments</button>';
     echo '<div class="postCommentDIV" id="postCommentDiv_ID_'.$row['id'].'" style="display:none;">';
    while($rowPC2 = mysqli_fetch_array($dataPC2)){
 echo '<table class="postCommentTable"><tr><td width="20%">';
 echo 'Comment on Post: </td>';
 echo '<td width="60%">' . $rowPC2['comment'] . '</td>';
  if ($_SESSION['user_id']!=$row['member_id']){  
  echo '<td width="20%"><div style="float:right;"><button  class="deletecommentonpostbutton stylebutton" style="display:block; float:left;" id="commentpostID_'.$rowPC2['postcomment_id'].'" name="commentpostID_'.$rowPC2['postcomment_id'].'">Delete Comment</button></div><td>';
  }
 echo '</tr></table>';
 }
 
 echo '</div></div>';
 } 
 
 
 }
 
 }
 
 $i++;
 
 
 }
 
 

}



  // Generate navigational page links if we have more than one page
  if ($num_pages > 1) {
 echo '<p class="pagelinks" style="text-align:center;">'; 
    echo generate_page_links($cur_page, $num_pages);
	echo '</p>';
  }
 //echo $gallery;


/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


 $query = "SELECT ALL * FROM creativebrainpower WHERE file_id ='" . $file_dir . "' ORDER BY date " . $orderit;
 $result = mysqli_query($dbc, $query);
 
  $data = mysqli_query($dbc, $query);
  
 if ($data!=NULL){
 

$i=0;
while ($row  = mysqli_fetch_array($data)) { 
$show=0;


if ($row['private']=='1'){

$query99 = "SELECT user_name FROM uploadprivacy WHERE upload_id ='"  . $row['id'] . "'";
  $data99 = mysqli_query($dbc, $query99);
    
 while($row99 = mysqli_fetch_array($data99)){
 if($row99['user_name']==$_SESSION['username']){
 $show=1;
 break;
  }
 }


if($show==1){  /// is private and has read access view.

     
	if ($row['filename']!=NULL){
		$file1 = $row['filename'];
		$fileext = findexts ($file1);
		
		if (($fileext == 'png')|| ($fileext == 'jpg') || ($fileext == 'gif') || ($fileext == 'jpeg') || ($fileext == 'jpeg')){
            
                   
                                 $src = $root . $row['file_id']  . '/' . $row['filename'];

                        $testpicname = basename($src);
                        $pic_parts1 = pathinfo( $testpicname);
                        $testpicname = $pic_parts1['filename'] . 'gallery4434' . '.' . $pic_parts1['extension'];
                            
                        
                        if (!file_exists($root . $row['file_id']  . '/' .$testpicname)){
                            
                            resizepics($src , 1000, 1500, 1);  /// Create Thumbnail
                            
                        }
         
                                            
        				
                        if ($gallery == ''){
                             $gallery .=    '"' . $_SERVER['PHP_SELF']. '?path='. $row['file_id'] . '/' . $testpicname . '"';
                       
                        }else{
                            
                          $gallery .=    ', "' . $_SERVER['PHP_SELF']. '?path='. $row['file_id'] . '/' . $testpicname . '"';
                        }
                        
                    
	    	
	} 
 
      
 }
 
}

 }else{
 
//end of  $show = 1;
 
 if($show == 0){  /// Is a public post.
 
   if ($row['filename']!=NULL){
		$file1 = $row['filename'];
		$fileext = findexts ($file1);
		
		if (($fileext == 'png')|| ($fileext == 'jpg') || ($fileext == 'gif') || ($fileext == 'jpeg') || ($fileext == 'jpeg')){
              
                         $src = $root . $row['file_id']  . '/' . $row['filename'];
 
                        $testpicname = basename($src);
                        $pic_parts1 = pathinfo( $testpicname);
                            $testpicname = $pic_parts1['filename'] . 'gallery4434' . '.' . $pic_parts1['extension'];
                            
                      
                      if (!file_exists($root . $row['file_id']  . '/' .$testpicname)){
                            resizepics($src , 1000, 1500, 1);  /// Create Thumbnail
                    }

                         if ($gallery == ''){
                             $gallery .=    '"' . $_SERVER['PHP_SELF']. '?path='. $row['file_id'] . '/' . $testpicname . '"';
                       
                        }else{
                            
                          $gallery .=    ', "' . $_SERVER['PHP_SELF']. '?path='. $row['file_id'] . '/' . $testpicname . '"';
                        }
                        
		}

 }

 
 
 }
 


}

$i++;
}
}


?>

<div id="commentpostdialog" title="Comment on Post" >
<p class="validateTips"></p>
<textarea id="comment_on_post" style="width:500px;">Enter a Comment</textarea>

</div>

<div id="delcommentpostdialog" title="Delete Post Comment" >
<p class="ui-state-highlight">Are you sure you want to delete your comment?</p>
</div>


<script>
 var  post_id;
 var del_post_id;
 var textarea_entered=0;
 var comment_on_post = $( "#comment_on_post" ),
   tips = $( ".validateTips" );
    
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkSize( o, min, max ) {
      if ( parseFloat(o.val()) > parseFloat(max) || parseFloat(o.val()) < parseFloat(min) ||  o.val() == "" ||  o == null ) {
        o.addClass( "ui-state-error" );
        updateTips( "Enter a dollar amount, must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
     if ( ( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }



$("#commentpostdialog").dialog({
      autoOpen: false,
      height: 'auto',
      width: 650,
      modal: true,
      buttons: {
        "Add Comment": function() {
          var bValid = true;
         
          //bValid = bValid && checkSize( pixel_x, "pixel_x", 1, 100 );
          //bValid = bValid && checkSize( pixel_y, "pixel_y", 1, 100 );
         // bValid = bValid && checkSize( R, "Red", 0, 255 );
         // bValid = bValid && checkSize( G, "Green", 0, 255 );
         // bValid = bValid && checkSize( B, "Blue", 0, 255 );
 
        //  bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
         ///  From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
         // bValid = bValid && checkRegexp( contact_email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
        //  bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
         bValid = bValid && checkRegexp( comment_on_post, /^$/, "Enter your comment" );
       //    bValid = bValid && checkRegexp( edit_re_to, /^[^?<>!@#$%^&*()]+$/, "Enter the name the messages in this group are from. (i.e. Bob Robertson)" );
       //   bValid = bValid && checkRegexp( edit_re_email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
        
          
          if ( bValid ) {
                             
     var    vcomment_on_post = comment_on_post.val(); 
               
           //  alert( post_id );
           //   alert(vcomment_on_post);
            // alert(vedit_campaign_description);
            
                $( this ).dialog( "close" ); 
           
             // enter AJAX here
   //     $("#"+vedit_campaign_id).html("<img src='http://www.znoter.com/images/loading.gif' />");
              
         $.post('http://www.cirrusidea.com/commentonpost.php',
             {
             post_id: post_id,
             comment: vcomment_on_post
             },
                    
              function(data,status){
                    
                //var arr = jQuery.parseJSON(data);
             
                 alert(data); // show response from the php script.
            
               $( ".validateTips" ).html("");
               location.reload();
               
                 
           });
        
          }
        },
        Cancel: function() {
         $( ".validateTips" ).html("");
          $( this ).dialog( "close" );
                     
          
        }
      },
      close: function() {
     
           
      }
    });

$("#delcommentpostdialog").dialog({
      autoOpen: false,
      height: 'auto',
      width: 650,
      modal: true,
      buttons: {
        "Delete Comment": function() {
            
                $( this ).dialog( "close" ); 
          // alert(del_post_id);
         $.post('http://www.cirrusidea.com/delcommentonpost.php',
             {
             del_post_id: del_post_id,
             },    
              function(data,status){
                  // alert(data); // show response from the php script.      
             location.reload();
              
           });   
          
        },
        Cancel: function() {
          $( this ).dialog( "close" );

        }
      },
      close: function() {
           
      }
    });


   
 //   $(".commentonpostbutton").hide();
    


$(".commentonpostbutton").click(function(){

var post_id_str = $(this).attr('id');

//alert(post_id_str);

post_id = post_id_str.replace('commentpostB_', '');

//alert(post_id);


$("#commentpostdialog").dialog("open");


});


$(".deletecommentonpostbutton").click(function(){

var del_post_id_str = $(this).attr('id');

//alert(post_id_str);

del_post_id = del_post_id_str.replace('commentpostID_', '');

//alert(post_id);


$("#delcommentpostdialog").dialog("open");


});
$(".hidecommments").button({
      icons: {
        primary: "ui-icon-plusthick"
      }
    });
$(".hidecommments").css('padding','5');
$(".hidecommments").css('font-size','10px');


$(".hidecommments").click(function(){

var hide_post_id_str = $(this).attr('id');
//alert(post_id_str);
hide_post_id = hide_post_id_str.replace('hidecomments_', '');

if($("#postCommentDiv_ID_"+hide_post_id).is(":visible")){
$("#postCommentDiv_ID_"+hide_post_id).hide();
$("#hidecomments_"+hide_post_id).button("option", {
          icons: { primary: "ui-icon-plusthick" }
        });
//$("#hidecomments_"+hide_post_id).html("Post Comments");

}else{
$("#postCommentDiv_ID_"+hide_post_id).show();
$("#hidecomments_"+hide_post_id).button("option", {
          icons: { primary: "ui-icon-minusthick" }
        });
//$("#hidecomments_"+hide_post_id).html("Post Comments");

}


});


$("#comment_on_post").focus(function() {
       var string = $(this).html();
       if (string.match(/Enter a Comment/i)  && textarea_entered == 0) {
           $(this).html('');
            textarea_entered = 1;
        }
  });

 </script>
 

<script>

function loadVideo(id, srcpath, embed)
{

$('#videobutton'+id).html('<img src="http://www.cirrusidea.com/images/loading.gif" />');

$('#src' + id).attr('src', srcpath);

if(embed){

$('#embedvideo' + id).html('<OBJECT class="embed" classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" WIDTH="800"HEIGHT="400"' +
'CODEBASE="http://www.apple.com/qtactivex/qtplugin.cab" showlogo="false">' +
'<PARAM name="SRC" VALUE="'+ srcpath + '">' +
'<PARAM name="AUTOPLAY" VALUE="true">' +
'<PARAM name="CONTROLLER" VALUE="true">' +
'<param name="showlogo" value="false" >' +
'<EMBED SRC="'+ srcpath + '" WIDTH="640" HEIGHT="320" AUTOPLAY="true" CONTROLLER="true" PLUGINSPAGE="http://www.apple.com/quicktime/">' +
'</EMBED>' +
'</OBJECT>');

}else{

$('#video' + id)[0].load();
$('#video' + id)[0].play();
}
$('#videobutton'+id).hide();

}
</script>


<script>
var links = [<?php echo $gallery; ?>];
//alert(links);
$('.openLightbox').on('click', function (event) {
$('.embed').remove();
    event.preventDefault();
    // Your list of Gallery links:
    // (Alternatively, a jQuery collection of your gallery links)
    blueimp.Gallery(links);
});

</script>

<?php


  mysqli_close($dbc);


  // Insert the page footer
  require_once($root.'/footer.php');
 ?>


