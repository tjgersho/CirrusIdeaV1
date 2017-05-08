<?php
 // Start the session
  require_once('startsession.php');
 
  require_once('appvars.php');
  require_once('connectvars.php');
  

  function decode ($messagenote) 
 { 
 $decodedmessage = quoted_printable_decode($messagenote) ; 
 return $decodedmessage; 
 } 
 
if(isset($_GET['id'])){
    
$upload_id = $_GET['id'];
}else{
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$upload_id = mysqli_real_escape_string($dbc, trim($_POST['upload_id']));    
}


if (isset($_POST['sharefile'])){
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $upload_id = mysqli_real_escape_string($dbc, trim($_POST['upload_id']));
  $post_member_id = mysqli_real_escape_string($dbc, trim($_POST['post_member_id'])); 
  $to_member_name = mysqli_real_escape_string($dbc, trim($_POST['to_member_name']));
  $note = mysqli_real_escape_string($dbc, trim($_POST['note']));
 

 
$query = "SELECT * FROM creativebrainpower WHERE id = '". $upload_id . "'";
$data =	mysqli_query($dbc, $query);
$row = mysqli_fetch_array($data);

	$query90 = "SELECT * FROM cbp_user WHERE user_id = '" . $post_member_id . "' LIMIT 1";
	$data90 = mysqli_query($dbc, $query90);
	$row90 = mysqli_fetch_array($data90);


if ($row['private']==1){
	$query88 = "INSERT INTO uploadprivacy (upload_id, user_name) VALUES ('" . $upload_id . "', '" . $to_member_name . "')";
	mysqli_query($dbc, $query88);
	
	} 
	
$note = decode ($note);
 $messagenote = $row90['username'] . " is sharing a file with you.<br />
 Note: " . $note . "
 <br />Post Path: <a href=\'http://www.cirrusidea.com" . $row['file_id'] . "\'>". $row['file_id'] ."</a><br />
 Post File: <a href=\'http://www.cirrusidea.com" . $row['file_id'] . "/index.php?path=" . $row['file_id'] . "/" . $row['filename'] . "\'>". $row['filename'] ."</a><br />";

 $messagenote = decode ($messagenote);

	$comment_private = 1;
	
	//echo $messagenote;
	
	$query55 = "INSERT INTO comment (comment, post_member_id, to_member_name, comment_private) VALUES ('" . $messagenote . "', '" . $post_member_id . "', '" . $to_member_name . "', '" . $comment_private . "')";
	
	mysqli_query($dbc, $query55);
	
	echo 'Thanks for sharing this file with '. $to_member_name . ' Make sure the user you shared this post with has folder access if it is a private folder.';
  

	
	$query86 = "SELECT * FROM cbp_user WHERE username = '" . $to_member_name . "' LIMIT 1";
	$data86 = mysqli_query($dbc, $query86);
	$row86 = mysqli_fetch_array($data86);
	$useremail = $row86['email'];
	

	
	$to = "$useremail";
	$subject = "CirrusIdea.com - File Share";
	$message = "
 <html>
 <head>
 </head>
 <body>
 <p>
  A file has been shared with you on CirrusIdea.com by " . $row90['username'] . ".<br /><br />
 File Note: <br />
 " . $note . " 
 <br /><br />" . $to_member_name . ", Click <a href='http://www.cirrusidea.com" . $row['file_id'] . "'>here </a> to go to the project folder where the shared file is.
  Also, checkout your profile with a new comment with a link.<br /><br />
 </p>
 </body>
 </html>
 ";
 
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
    $headers .= "From: " . $row90['email'] . "\r\n";
	
	mail($to,$subject,$message,$headers);
	
	

	
		  
	}
	
?>

 <form enctype="multipart/form-data" method="post" action="sharefile.php"> 
	<input type="hidden" id="post_member_id" name="post_member_id" value="<?php echo $_SESSION['user_id']; ?>" />  
	<input type="hidden" id="upload_id" name="upload_id" value="<?php echo $upload_id; ?>" />
    <table><tr><td> 
	<p class="italic">File Note: </p></td>
	<td><textarea rows="3" cols="60" onKeyUp="forceReturn('20', this.value);"  id="note" name="note"></textarea></td><td width="100px">
<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query5 = "SELECT * FROM codevelopers WHERE member = '" .$_SESSION['username']. "' ORDER BY codeveloper ASC";
$data5 = mysqli_query($dbc, $query5);

 echo '<select id="to_member_name" name="to_member_name">';
 echo '<option value="NULL">YOUR CO-DEVELOPERS</option>';
while($row5 = mysqli_fetch_array($data5)) { 
echo '<option value="' . $row5['codeveloper'] . '">'.$row5['codeveloper'].'</option>';
} 
 echo '</select></td></tr><tr><td></td><td></td><td><input type="submit" value="Share" name="sharefile"/></td></tr></table></form>';

?>
   
