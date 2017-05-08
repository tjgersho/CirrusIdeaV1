<?php
 // Start the session
  require_once('startsession.php');
 
  require_once('appvars.php');
  require_once('connectvars.php');
  
 if(isset($_GET['to_member_name'])){
 $otheruser = $_GET['to_member_name'];
}
 
 if(isset($_GET['retocomment'])){
 $re_to_comment = $_GET['retocomment'];
}

 
 if ($_POST['submit_recomment']){

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  $comment = mysqli_real_escape_string($dbc, trim($_POST['comment']));
  $post_member_id = mysqli_real_escape_string($dbc, trim($_POST['post_member_id']));
  $to_member_name = mysqli_real_escape_string($dbc, trim($_POST['to_member_name'])); 
  $comment_private = mysqli_real_escape_string($dbc, trim($_POST['comment_private']));
  $retocomment = mysqli_real_escape_string($dbc, trim($_POST['retocomment'])); 
  
	if ($comment_private == NULL){
	$comment_private = 1;
	}else{
	$comment_private = 0;
	}
	
	$query55 = "INSERT INTO comment (comment, post_member_id, to_member_name, comment_private, re_to_comment) VALUES ('" . $comment . "', '" . $post_member_id . "', '" . $to_member_name . "', '" . $comment_private . "', '" . $retocomment . "')";
	
	mysqli_query($dbc, $query55);
	
	echo 'Thanks posting a comment to '. $to_member_name;


	
	$query86 = "SELECT * FROM cbp_user WHERE username = '" . $to_member_name . "' LIMIT 1";
	$data86 = mysqli_query($dbc, $query86);
	$row86 = mysqli_fetch_array($data86);
	$useremail = $row86['email'];
	
	$query90 = "SELECT * FROM cbp_user WHERE user_id = '" . $post_member_id . "' LIMIT 1";
	$data90 = mysqli_query($dbc, $query90);
	$row90 = mysqli_fetch_array($data90);
	

	$to = "$useremail";
	$subject = "CirrusIdea.com - Comment";
	$message = "
 <html>
 <head>
 <title>A comment has been posted to you on CirrusIdea.com.</title>
 </head>
 <body>
 <p>
 " . $row90['username'] . " wrote: <br />
 " . $comment . " 
 <br /><br />" . $to_member_name . ",  <a href='http://www.cirrusidea.com/login.php'>Log In</a>
 and checkout your profile.<br /><br />
 
 
 </p>
 </body>
 </html>
 ";
 
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
     $headers .= "From: " . $row90['email'] . "\r\n";
	
	mail($to,$subject,$message,$headers);
	
	
	
exit;
}

 
?>

 <form enctype="multipart/form-data" method="post" action="commentreply.php" style="background:transparent"> 
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo CBP_MAXFILESIZE; ?>" />   
    <table style="margin-left:auto;margin-right:auto;"><tr><td> 
	<p class="italic">Write a comment to <?php echo $otheruser; ?></p></td></tr>
	<tr><td><textarea rows="4" cols="40" onKeyUp="forceReturn('45', this.value);"  id="comment" name="comment"></textarea></td></tr>
    <tr><td><label for="private">Make Public:</label><input type="checkbox" id="comment_private" name="comment_private"/>
	<input type="hidden" id="post_member_id" name="post_member_id" value="<?php echo $_SESSION['user_id']; ?>" />  
	<input type="hidden" id="to_member_name" name="to_member_name" value="<?php echo $otheruser; ?>" />
	<input type="hidden" id="retocomment" name="retocomment" value="<?php echo $re_to_comment; ?>" />
	
    <tr><td style="text-align:right">
	
    <input name="submit_recomment" type="submit" id="submit_recomment" value="Comment" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> /></td></tr></table>
  </form> 
 
 
 
 