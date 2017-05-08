<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Contact Us';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
  if(isset($_POST['submit'])){
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
 
 $firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
  $lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
  $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
  $comment = mysqli_real_escape_string($dbc, trim($_POST['comment']));
 
$status = 'OK';
    
    $msg = '';
    
    
      if(empty($_SESSION['6_letters_code'] ) ||   strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)   {     
          //Note: the captcha code is compared case insensitively.      
          //if you want case sensitive match, update the check above to      
          // strcmp()     
          $msg .= "\n The captcha code does not match!";  
         
          $status= 'NOTOK';
          
          }   
    
     

	if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
	{ // checking your email
$msg .='Your email address was not entered correctly<br />';
$status= 'NOTOK';
} 


 

if ($status=='OK'){

 if($email!=NULL && $firstname!=NULL && $comment!=NULL){
 
 
 	$query = "INSERT INTO contactus (firstname, lastname, email, comment, approved) VALUES ('" . $firstname . "', '" . $lastname . "','" . $email . "','" . $comment . "', 0)";
            mysqli_query($dbc, $query);
			 echo '<div id="main_content">';
	        echo '<p><b>Thanks for submitting a comment.<br />';
			echo 'We will follow up with your comment as soon as possible.</b><br /></p>';
			echo '<a href="index.php">Home</a>';
            echo '</div>';
 
 }else{
 echo '<div id="main_content">';
 echo '<p style="color:red"><b>Please enter your Email, Name and a Comment.</b></p>';
 echo '</div>';
 }
 
 
 
 }
 
 }else{
     
      echo '<div id="main_content">';
 echo '<p style="color:red"><b>'.$msg.'</b></p>';
 echo '</div>';
     
     
 }

?> 

<div id="contentfull">
   	
	<img style="padding-right:10px; float:right;"  src="images/geek1.png" width="500px" />
	
    		<h2>We want to hear what you think!</h2> 
		        <table><tr><td> 
       <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="firstname">First Name: </label></td><td><input type="text" id="firstname" name="firstname" /></td></tr>
	   <tr><td><label for="lastname">Last Name </label></td><td>
       <input type="text" id="lastname" name="lastname" /></td></tr>
	    
		<tr><td><label for="email">Email Address: </label></td><td><input type="text" id="email" name="email" /></td></tr>	
	
	   <tr><td><label for="comment">Comment: </label></td><td>
	   <textarea rows="4" cols="30" onKeyUp="forceReturn('75', this.value);"  id="comment" name="comment"></textarea></td></tr>
	
    <tr><td>
 <?php
 echo '<img src="';
 echo 'captcha_code_file.php?rand=';
 echo rand(); 
 echo '" id="captchaimg" >';
 ?>
 </td></tr><tr><td>
 <label for="message">Enter the code above here :</label></td><td>
 <input id="6_letters_code" name="6_letters_code" type="text"> 
 <br>
<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>

 </td><td></td></tr>
 
 <tr><td></td><td>

    
    
		<tr><td style="text-align:right;"><input type="submit" value="Submit" name="submit"/></form></td></tr>   
	</table>	
	
	<br /><br />
       </p>


<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
    var img = document.images['captchaimg'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>

<?php
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
$query = "SELECT * FROM comments WHERE approved = 1 ORDER BY comment_id";
$data = mysqli_query($dbc, $query);

if ($data != NULL) {

while ($row = mysqli_fetch_array($data)) { 

echo '<table width="900px">';
if ($row['email']=='travis.g@paradigmmotion.com'){

	echo '<tr><td><p style="color:#000000">'.$row['comment'] . '</p></td></tr>';
	echo '</td></tr></table>';
	
	} else{

	echo '<tr><td><p style="color:#000099">'.$row['comment'] . '</p></td></tr>';
	echo '</td></tr></table>';
	}
	
   $i++;
 
  }
  
}

 ?>
<br /><br /><br />
 
</div>

<?php
 // Insert the page footer
  require_once('footer.php');
 ?>