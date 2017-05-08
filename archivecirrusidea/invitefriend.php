<?php
  // Start the session
  require_once('startsession.php');
  require_once('appvars.php');
  require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
if(isset($_POST['sendtofriend'])){
 
echo '<table style="position:relative;"><tr><td>';
$status = "OK";
$msg="";


$f_email=$_POST['f_email'];
$f_name=$_POST['f_name'];


if(substr_count($f_email,"@") > 1){
$msg .="Use only one email address<BR>"; 
$status= "NOTOK";
}


if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $f_email)) { // checking friends email
$msg .="Your Friends address is not correct<BR>";
$status= "NOTOK";}

if (strlen($f_name) <2 ) { // checking freinds name
$msg .="Please enter your friend's name<BR>";
$status= "NOTOK";} 
   
$query = "SELECT * FROM cbp_user WHERE email = '" . $f_email  . "'"; 
$data = mysqli_query($dbc, $query);

if (mysqli_num_rows($data) < 1) { 


if($status=="OK"){ // all validation passed
//add member and insert password2 and username2.

    $query90 = "SELECT * FROM cbp_user WHERE user_id = '" . $_SESSION['user_id'] . "' LIMIT 1";
	$data90 = mysqli_query($dbc, $query90);
	$row90 = mysqli_fetch_array($data90);

$username = $f_name .  rand(0, 5000);
$password = rand(0, 5000) . $f_name;

$query2 = "INSERT INTO cbp_user (username, password, join_date, email, mailme, cred, validated) VALUES ('$username', SHA('$password'), NOW(), '$f_email', 1, 0, 0)"; 
mysqli_query($dbc, $query2);

$query11 = "INSERT INTO codevelopers (member, codeveloper) VALUES ('" . $_SESSION['username'] . "', '" . $username . "')"; 
mysqli_query($dbc, $query11);

$query12 = "INSERT INTO codevelopers (member, codeveloper) VALUES ('" . $username . "', '" . $_SESSION['username'] . "')"; 
mysqli_query($dbc, $query12);

/////////// Sending the message starts here //////////////

/////Message at the top of the page showing the url////
$header_message = "Hi " . $f_name .",\n Your friend " .  $_SESSION['username'] . " has given you an invitation to join CirrusIdea\n";
/// Body message prepared with the message entered by the user ////
$body_message =$header_message."\n You have been invited to join the exclusive web site CirrusIdea\n";
//// Mail posting part starts here /////////
$body_message = $body_message . "where you can find your interest and others with similar interests.\n\n";
$body_message = $body_message . "You can develop ideas in your field of interest, cash in on ideas, and grow ideas into valuable assets, privately or in a public forum.\n\n";
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
echo "<center><font face='Verdana' size='2' color=green>Thank You, invitation has posted to $f_name</font></center>";
//////////// Sending the message ends here /////////////



    $to = "tgershon@msn.com , travis.g@paradigmmotion.com";
	$subject = "CirrusIdea.com New Member Notice";
	$message = "
 <html>
 <head>
 <title>New Member</title>
 </head>
 <body>
 <p><br /><br />Travis, there is a new member of CirrusIdea.com: <br /> &nbsp; Username:" .
  $username . 
 "&nbsp;.<br /> Email: " .
  $f_email . 
  "</p>
 </body>
 </html>
 ";
 
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
 $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";
	
	mail($to,$subject,$message,$headers);
	


}else{
echo "<center><font face='Verdana' size='2' color=red>There is some problem in mail command, contact travis.g@cirrusidea.com</font></center>";
}

}else{// display the error message
echo "<center><font face='Verdana' size='2' color=red>$msg</font></center>";
}
}else{
    
    echo "<center><font face='Verdana' size='2' color=red>There is a member with that email address already.</font></center>";

}

echo '</tr></td></table>';
}

?>

<form enctype="multipart/form-data" method="post" action="invitefriend.php">
<table  style="border:1px solid black; ">
<tr><td colspan=2 align=center><b>Invite a Friend to Join CirrusIdea.com</b></font></td></tr>
<tr><td>Your Friend's Name</font></td><td><input type="text" name="f_name"></td></tr>
<tr><td>Friend's Email</font></td><td><input type="text" name="f_email"></td></tr>
<tr><td></td><td colspan=2 align="center">
<input type="submit" value="Invite" name="sendtofriend" <?php if($_SESSION['username'] == 'Anonymous'){ echo 'disabled';} ?>/></font></td></tr>
</table>
</form> 

