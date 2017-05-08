<?php
 // Start the session
  require_once('startsession.php');
 
  require_once('appvars.php');
  require_once('connectvars.php');
  
   if (!isset($_SESSION['user_id'])) {

    echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  }
 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



$credusername = $_POST['credusername'];
$credvote = $_POST['credvote'];


if ($credvote  == 'positivecred'){
        
    $query3465 = "SELECT cred FROM cbp_user WHERE username = '" . $credusername . "'";
    $data3465 = mysqli_query($dbc, $query3465); 
    
      $row3465 = mysqli_fetch_array($data3465);
      $credvote =  $row3465['cred'] +1;
       
     $query345 = "UPDATE cbp_user SET cred =  " . $credvote . " WHERE username = '" . $credusername . "'";
    mysqli_query($dbc, $query345); 
    
 }elseif ($credvote  == 'negativecred'){
    
     
      $query3465 = "SELECT cred FROM cbp_user WHERE username = '" . $credusername . "'";
    $data3465 = mysqli_query($dbc, $query3465); 
    
      $row3465 = mysqli_fetch_array($data3465);
      
    $credvote =  $row3465['cred'] -1;
 
     $query345 = "UPDATE cbp_user SET cred =  " . $credvote . " WHERE username = '" . $credusername . "'";
    mysqli_query($dbc, $query345); 
    
 }


//Get max membercred variable///////////
/////////////////////////////////////////
 $query554 = "SELECT MAX(cred) AS max_cred FROM cbp_user";
 $data554 = mysqli_query($dbc, $query554);
   $row554  = mysqli_fetch_array($data554 );
  $max_cred = $row554['max_cred'];
  
//////////////////////////////////////////////////////////////
 ///////Cred Calcs and script for display /////////
     $credpercentage = round(($credvote/ $max_cred)*100,0);
    



echo '{"credusername": "' . $credusername .'",';
echo '"credvote": "'. $credvote . '",';
echo '"credpercentage": "'. $credpercentage. '"}';




?>


