<?php

  require_once($root.'/startsession.php');
  require_once($root.'/appvars.php');
 
  require_once($root.'/connectvars.php');
 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 if (isset($_POST['addcred'])){
 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
     
 
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
 
 
 ?>