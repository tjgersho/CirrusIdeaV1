<?php
 // Start the session
  require_once('startsession.php');
 
  require_once('appvars.php');
  require_once('connectvars.php');
  
   if (!isset($_SESSION['user_id'])) {

    echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  }
  ?>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


 <!--Get Style Sheet--> 
 <link rel="stylesheet" type="text/css" href="http://www.cirrusidea.com/style.css" />
 
  </head>
    <body style="background-color:#EDEDED;">
  <?php
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(isset($_POST['remail'])){
 
 $query90 = "SELECT * FROM cbp_user WHERE user_id = '" . $_SESSION['user_id'] . "' LIMIT 1";
    $data90 = mysqli_query($dbc, $query90);
	$row90 = mysqli_fetch_array($data90);
    
$f_user_id = $_POST['user_id'];



$query717 = "SELECT * FROM cbp_user WHERE user_id = '".$f_user_id."'";
 $data717 = mysqli_query($dbc, $query717);

$row717 = mysqli_fetch_array($data717);

$f_email = $row717['email'];

$username =  $row717['username'];

$password = rand(0, 5000) . $username;

$query9717 = "UPDATE cbp_user SET password = SHA('$password') WHERE user_id = '".$f_user_id."'";
mysqli_query($dbc, $query9717);


  /////////// Sending the message starts here //////////////

/////Message at the top of the page showing the url////
$header_message = "Hey, you were invited to CirrusIdea and haven't logged in yet. \n Your friend " .  $_SESSION['username'] . " has given you an invitation to join CirrusIdea\n";
/// Body message prepared with the message entered by the user ////
$body_message =$header_message."\n You have been invited to join the exclusive web site CirrusIdea\n";
//// Mail posting part starts here /////////
$body_message = $body_message . "where you can develop ideas, invest in ideas, and grow ideas into valuable assets.\n\n";
$body_message = $body_message . "Click this link to login and join the development: \n";
$body_message = $body_message . "http://www.cirrusidea.com/login.php?newlogin=1&23j3j2livfha=";
$body_message = $body_message . $username;
$body_message = $body_message . "&asu2jasjvh23=";
$body_message = $body_message . $password;
$body_message = $body_message . "\n\n Have fun exploring the endless possiblities at CirrusIdea\n\n";

$headers="";
//$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;
// Un comment the above line to send mail in html format
$headers4=$row90['email']; // Change this to change from address
$headers.="Reply-to: $headers4\n";
$headers .= "From: $headers4\n";
$headers .= "Errors-to: $headers4\n";
$subject="Invitation to join CirrusIdea.com";
if(mail($f_email,$subject,$body_message,$headers)){
////// Mail posting ends here ///////////
echo "<center><font face='Verdana' size='2' color=green>Your remider email has been sent.</font></center>";
//////////// Sending the message ends here /////////////

}  
    
    
}


  $query77 = "SELECT * FROM codevelopers WHERE member = '".$_SESSION['username']."'";
 $data77 = mysqli_query($dbc, $query77);
$i=0;
while ($row77 = mysqli_fetch_array($data77)) { 
    
    $query8717 = "SELECT * FROM cbp_user WHERE username = '".$row77['codeveloper']."'";
 $data8717 = mysqli_query($dbc, $query8717);

$row8717 = mysqli_fetch_array($data8717);

if (!$row8717['validated']){

echo '<br /><span><a style="display:inline;" href="http://www.cirrusidea.com/viewprofile.php?username='.$row77['codeveloper'].'" target="_parent">'.$row77['codeveloper'].'</a>';
echo  '<form style="display:inline;" action="'.$_SERVER['PHP_SELF'].'" method="post"><input type="hidden" name="user_id" value="'.$row8717['user_id'].'"/>';
echo '<input type="submit" class="stylebutton" name="remail" value="Send remider Email to join CirrusIdea" /></form></span><br />';


} else {
echo '<br /><a href="http://www.cirrusidea.com/viewprofile.php?username='.$row77['codeveloper'].'" target="_parent">'.$row77['codeveloper'].'</a><br />';    
    
}


$i=1;
}

if($i==0){
echo '<b>Go to another member\'s profile by clicking another username link and click "Add as Co-Developer" button.</b><br />';
}
?>
</body>
<?php
?>
