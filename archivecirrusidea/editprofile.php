<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Edit Profile';
  require_once('header.php');
  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
   echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
   // Insert the page footer
  require_once('footer.php');
  exit();
  }

  // Show the navigation menu
  require_once('navmenu.php');

if ($_SESSION['username'] == 'Anonymous') {
   echo '<p class="login">You cannot edit this profile, it is a public browsing account.<br />';
   echo 'Please <a href="http://www.cirrusidea.com/signup.php">sign up</a> and create your own profile.</p>';
    echo '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
     // Insert the page footer
  require_once('footer.php');
    exit();
  }
  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
 
    // Grab the profile data from the POST
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $city = mysqli_real_escape_string($dbc, trim($_POST['city']));
    $state = mysqli_real_escape_string($dbc, trim($_POST['state']));
	$country = mysqli_real_escape_string($dbc, trim($_POST['country']));
    $interest = mysqli_real_escape_string($dbc, trim($_POST['interest']));
	$mailme = mysqli_real_escape_string($dbc, trim($_POST['mailme']));
	$paypalemail = mysqli_real_escape_string($dbc, trim($_POST['paypalemail']));
    // Update the profile data in the database

  
    
    if (!empty($first_name) || !empty($last_name) || !empty($email) || !empty($city) || !empty($state) || !empty($country) || !empty($paypalemail)) {
    
     $query = "UPDATE cbp_user SET validated = 1 WHERE user_id = '" . $_SESSION['user_id'] . "'";
    
     mysqli_query($dbc, $query);
   
   $query = "UPDATE cbp_user SET first_name = '$first_name' WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query);
	
	$query = "UPDATE cbp_user SET last_name = '$last_name' WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query); 
	
	$query = "UPDATE cbp_user SET email = '$email' WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query); 
	
	$query = "UPDATE cbp_user SET city = '$city' WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query);  
	 
	$query = "UPDATE cbp_user SET state = '$state' WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query);  
	
	
	$query = "UPDATE cbp_user SET country = '$country' WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query); 
	 
	$query = "UPDATE cbp_user SET interest = '$interest' WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query);  
	
	if ($mailme == 'YES'){
	$query = "UPDATE cbp_user SET mailme = 1 WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query);
	
	} else if ($mailme == 'NO') {
	$query = "UPDATE cbp_user SET mailme = 0 WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query);
	} else {
	$query = "UPDATE cbp_user SET mailme = 1 WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query);
	} 
	$query = "UPDATE cbp_user SET paypalemail = '$paypalemail' WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	 mysqli_query($dbc, $query);  

    
        // Confirm success with the user
        echo '<p>Your profile has been successfully updated. Would you like to <a href="mycreativebrainpower.php">view your profile</a>?</p>';
		echo '<br /><br /><br /><br /><br /><br />';
        mysqli_close($dbc);
         require_once('footer.php');
		exit();
      }
      else {
   
        echo '<p class="error">You must enter all of the required profile data.</p>';
      }
}

  // End of check for form submission
  
    // Grab the profile data from the database
    $query = "SELECT first_name, last_name, email, city, state, country, interest, mailme, paypalemail FROM cbp_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);

    if ($row != NULL) {
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $email = $row['email'];
      $city = $row['city'];
      $state = $row['state'];
	  $country = $row['country'];  
      $interest = $row['interest'];
	  $mailme = $row['mailme'];
	  $paypalemail= $row['paypalemail'];
    }
    else {
        
     
      echo '<p class="error">There was a problem accessing your profile.</p>';
    }

 
 $root = realpath($_SERVER["DOCUMENT_ROOT"]); 
?>

<div style="position:relative; left:300px;">
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 
      

<?php 
if ($_SESSION['newuser']){
?>
<span class="hotspot" onmouseover="tooltip.show('Make sure you fill out your info, esspecially your interest.  If your interest is not in the selection, you\'ll have to add a new Geneal Topic Folder on the main CirrusIdeas page which suits your general interest.  Also, below is where you can manage your private and public folders that you\'ll create. <br /><br /> <strong>Next Tour Stop</strong>:  Click on the <i>CirrusIdeas</i> tab.');" onmouseout="tooltip.hide();"><p tyle="width:300px; float:left;">
<?php
}      
?>

      <legend><p class="italic">
      <?php
if ($_SESSION['newuser']){
  echo  'Hover-Help: ';}
 ?>
      CirrusIdea Profile Info</p></legend>
<?php
if ($_SESSION['newuser']){
  echo  '</span>';}
 ?>
   
      
      
      <label for="firstname">First name:</label>
      <input type="text" id="firstname" name="firstname" value="<?php if (!empty($first_name)) echo $first_name; ?>" /><br />
      
	  <label for="lastname">Last name:</label>
      <input type="text" id="lastname" name="lastname" value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
     
	  <label for="email">Email:</label>
      <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br /> 
	   <label for="country">Enable E-mails:</label>
	   
      <input type="radio" id="mailme" name="mailme" value="YES" />YES&nbsp;&nbsp;
	  <input type="radio" id="mailme" name="mailme" value="NO"/>NO<br />
	  
	 <label for="city">City:</label>
      <input type="text" id="city" name="city" value="<?php if (!empty($city)) echo $city; ?>" /><br />
	
	<label for="state">State:</label>
      <input type="text" id="state" name="state" value="<?php if (!empty($state)) echo $state; ?>" /><br />
	
	<label for="country">Country:</label>
      <input type="text" id="country" name="country" value="<?php if (!empty($country)) echo $country; ?>" /><br />

	
	 <label for="intetest">Interest:</label>
      <select id="interest" name="interest">
	  
	<?php


$query8797 = "SELECT * FROM cbpfiles WHERE file_path = '/files' AND file_private = 0";
  $data8797 = mysqli_query($dbc, $query8797);

  
  while ($row8797 = mysqli_fetch_array($data8797)){
	
	echo '<option value="' .   $row8797['file_name'] . '"';
	  if (!empty($interest) && $interest == $row8797['file_name']){
	  echo 'selected = "selected"';
	  }
	  echo '>';
	   echo   $row8797['file_name'];
	   echo '</option>';
	   }
       
       
       
	   
       
?>		
      </select><br />
	  <label for="paypalemail">PayPal Email:</label>
      <input type="text" id="paypalemail" name="paypalemail" value="<?php if (!empty($paypalemail)) echo $paypalemail; ?>" />(Optional: Used for stakers and devleopers)<br /> 

    <input type="submit" value="Save Profile" name="submit" />
  </form>
 <br />
 <?php
 
  $code = mt_rand(1,99999);

  $query1 = "UPDATE cbp_user SET validated = ".$code." WHERE username = '".$_SESSION['username']."'";
  mysqli_query($dbc, $query1);
 
 ?>
 <a href="http://www.cirrusidea.com/editpwusername.php">Edit Username and Password</a><br />
 <a href="http://www.cirrusidea.com/changepasswordlink.php?username=<?php echo $_SESSION['username'];?>&code=<?php echo $code; ?>">Edit Password Only</a>
 </div> 
  
<?php
 
 echo '<br /><br /><p style="position:relative; left:40px;">Your Private Folders: (Link for Sharing/Deletion/Folder Name Change)</p>'; 
  
 
    
    echo '<table style="position:relative; left:50px;"><tr>';
	$u = 1; 
    
    $query3 = "SELECT * FROM cbpfiles WHERE creator = '" . $_SESSION['user_id'] . "' AND file_private=1";
    $data3 = mysqli_query($dbc, $query3);
    

while($row3 = mysqli_fetch_array($data3)){
	


 if ($row3['file_id'] != NULL){
echo '<td><a class="editfolder" href="http://www.cirrusidea.com/shareprivatefolders.php?folder_id='. $row3['file_id'].'">' . $row3['file_path'] . '/' . $row3['file_name'] . '</a></td>';



if( $u % 2 == 0 ){
echo '</tr><tr>';
}

$u++; 

}


}

 echo '</tr></table>';

echo '<p style="position:relative; left:40px;">Your Public Folders (Link for Deletion/Folder Name Change):</p>';

  	$query6 = "SELECT * FROM cbpfiles WHERE creator = '" . $_SESSION['user_id'] . "' AND file_private=0";
	$data6 = mysqli_query($dbc, $query6);
	
	
    echo '<table style="position:relative; left:50px;"><tr>';
	$u = 1; 
while($row6 = mysqli_fetch_array($data6)){

if ($row6['file_id'] != NULL){
echo '<td><a class="editfolder" href="http://www.cirrusidea.com/editdeletefolder.php?folder_id='. $row6['file_id'].'">' . $row6['file_path'] . '/' . $row6['file_name'] . '</a></td>';

  
if($u % 2 == 0 ){
echo '</tr><tr>';
}

$u++; 

}

}


 echo '</tr></table>';



  // Insert the page footer
  require_once('footer.php');
?>
