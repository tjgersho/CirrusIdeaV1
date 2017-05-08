<?php
 
$root = realpath($_SERVER["DOCUMENT_ROOT"]);  

  // Start the session
  require_once($root.'/startsession.php');

  // Insert the page header
  $page_title = 'Concept Builder';
  require_once($root.'/header.php');

  require_once($root.'/appvars.php');
  require_once($root.'/connectvars.php');
 
  if (!isset($_SESSION['user_id'])) {

    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';

    exit();
  
  }

  // Show the navigation menu
require_once($root.'/navmenu.php');
 

function decode ($messagenote) 
 { 
 $decodedmessage = quoted_printable_decode($messagenote) ; 
 return $decodedmessage; 
 } 
 
 
$backtoproject = $_POST['project_file'];
$post_id = $_POST['upload_id'];



 
 if (isset($_POST['submit'])) {
    // Connect to the database

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

 // Grab the POST
 
    $post_id = mysqli_real_escape_string($dbc, trim($_POST['post_id']));
	$problem = mysqli_real_escape_string($dbc, trim($_POST['problem']));
    
    $problem = "POST COMPLAINT!!!!!!!!!!!!!!!<br />   " . $problem . "<br />   The post id is " . $post_id;
    
     $problem = decode ($problem);
    
    $backtoproject = mysqli_real_escape_string($dbc, trim($_POST['backtoproject']));

    $query515 = "INSERT INTO comment (comment, post_member_id, to_member_name, comment_private, re_to_comment) VALUES ('" . $problem . "', '" . $_SESSION['user_id'] . "', 'tjgersho', 1, NULL)";
	
	mysqli_query($dbc, $query515);
	

	$to = "tgershon@msn.com, travis.g@paradigmmotion.com, travis.g@cirrusidea.com";
	$subject = "CirrusIdea.com - Post Report";
	$message = "
 <html>
 <head>
 <title>A post has a complaint!</title>
 </head>
 <body>
 <p>
 " . $_SESSION['username'] . " wrote: <br />
 " . $problem . " 
 <br /><br />T$,  <a href='http://www.cirrusidea.com" . $backtoproject . "'>Log In</a>
 and checkout this reported post.<br /><br />
  
 </p>
 </body>
 </html>
 ";
 
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
 $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";

mail($to,$subject,$message,$headers);
	

 // Confirm success with the user
            echo '<p>Your concern with this post will be reviewed and it will be determined if it is an appropriate post or not and will be removed if it is inappropriate.<br />';
			echo 'It may be removed if deemed inappropriate.</p>';

	     	echo '<p><a href="http://www.cirrusidea.com'.  $backtoproject   . '">&lt;&lt; Back the project folder</a></p>';
            echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to My CirrusIdea</a></p>';
 


            mysqli_close($dbc);
	require_once($root.'/footer.php');	
	exit;		
		
	}



  
 $root = realpath($_SERVER["DOCUMENT_ROOT"]); 

?>


<script language="javascript">
 function forceReturn(iMaxLength, sValue){
 if (sValue.length > iMaxLength){
 sValue = sValue + "\r";
 }
 }
</script>
 
 
<h3 style="text-align:center;">Report an Inappropirate Post</h3>

<table  style="margin-left:auto; margin-right:auto;"">
<form enctype="multipart/form-data" method="post" action=" <?php echo $_SERVER['PHP_SELF']; ?>">
	
<input type="hidden" name="backtoproject"   value=" <?php echo $backtoproject; ?> "/>
<input type="hidden" name="post_id"        value="<?php echo $post_id; ?> " />

 <tr><td> 
	<tr><td><label for="problem">Enter your concern:</label>
	<textarea rows="3" cols="60" onKeyUp="forceReturn('75', this.value);"  id="problem" name="problem" value="<?php if (!empty($problem)) echo $problem; ?>"></textarea></td></tr>
      
    <tr><td style="text-align:right"><input type="submit" value="Report" name="submit"  <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> /></td></tr>
	</table>
  </form>
  

<br /><br /><br /><br /><br /><br /><br /><br />
<?php

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);




  mysqli_close($dbc);


  // Insert the page footer
  require_once('footer.php');
?>