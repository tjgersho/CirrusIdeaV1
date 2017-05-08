<?php

 $root = realpath($_SERVER["DOCUMENT_ROOT"]);  

  //session_start();
         
 require_once('../api/startsession.php');

 require_once('../api/connectvars.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

 $viewokay = false;
 
  $query777 = "SELECT * FROM ideas WHERE file_private != 1";
  $data777 = mysqli_query($dbc, $query777);
  
  
               
 

header("Content-type: text/plain");

print "https://cirrusidea.com/cirrus  \n";


while($row777 = mysqli_fetch_array($data777)){

   // do your Db stuff here to get the content into $content
print "https://cirrusidea.com/cirrus/path" . $row777['file_path'] . '/page/'.  $row777['file_name'] . "\n";


}

exit();
 


/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////


