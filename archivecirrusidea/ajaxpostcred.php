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



$postid = $_POST['postid'];
$postcredvote = $_POST['postcredvote'];

 

 if ($postcredvote  == 'positivepostcred'){
        
        $query3465 = "SELECT rating FROM creativebrainpower WHERE id = '" . $postid . "'";
    $data3465 = mysqli_query($dbc, $query3465); 
    
      $row3465 = mysqli_fetch_array($data3465);
      $cred =  $row3465['rating'] +1;
       
     $query345 = "UPDATE creativebrainpower SET rating =  " . $cred . " WHERE id = '" . $postid . "'";
      mysqli_query($dbc, $query345); 
    
 }elseif ($postcredvote  == 'negativepostcred'){
    
     
      $query3465 = "SELECT rating FROM creativebrainpower WHERE id = '" . $postid . "'";
    $data3465 = mysqli_query($dbc, $query3465); 
    
      $row3465 = mysqli_fetch_array($data3465);
      
    $cred =  $row3465['rating'] -1;
 
    $query345 = "UPDATE creativebrainpower SET rating =  " . $cred . " WHERE id = '" . $postid . "'";
    mysqli_query($dbc, $query345); 
    
 }
 
  
 //Get maxpostcred variable///////////
/////////////////////////////////////////
 $query554 = "SELECT MAX(rating) AS max_postcred FROM creativebrainpower";
  $data554 = mysqli_query($dbc, $query554);
  $row554  = mysqli_fetch_array($data554 );
  $max_postcred = $row554['max_postcred'];
  
  
///////Cred Calcs and script for display /////////
$postcredpercentage = round(($cred/$max_postcred)*100,0);


echo '{"postcredpercentage": "' . $postcredpercentage  .'",';
echo '"postcredvote": "'. $cred. '"}';



?>



