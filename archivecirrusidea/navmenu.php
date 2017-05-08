<?php
  // Generate the navigation menu
 echo '</div>'; //End Headcontainer div 
  if (isset($_SESSION['username'])) {
  echo '<div id="header">';
 echo '<div id="menubar">'; 
  echo '<ul id="menu">';
  
	echo '<li ';
	$current = $_SERVER['PHP_SELF']; 
	if(basename($current) == 'mycreativebrainpower.php'){echo 'class="current"';}
	echo '><a href="http://www.cirrusidea.com/mycreativebrainpower.php"><b>My CirrusIdea Home</b></a></li>'; 
	
	echo '<li ';
	$current = $_SERVER['PHP_SELF'];
	if(basename($current) == 'editprofile.php'){echo 'class="current"';} 
	echo '><a href="http://www.cirrusidea.com/editprofile.php"><b>Edit Profile/Your Folders</b></a></li>';
	
	echo '<li ';
	$current = $_SERVER['PHP_SELF'];
	if(basename($current) == 'browse.php'){echo 'class="current"';}
	echo '><a  href="http://www.cirrusidea.com/files/browse.php" style="font-size:80%; "><b>CirrusIdeas</b></a></li>';
	
	echo '<li ';
	$current = $_SERVER['PHP_SELF']; 
	if(basename($current) == 'searchprojects.php'){echo 'class="current"';} 
	echo '><a href="http://www.cirrusidea.com/searchprojects.php"><b>Search CirrusIdea</b></a></li>';
	
//	echo '<li ';
	//$current = $_SERVER['PHP_SELF']; 
//	if(basename($current) == 'conceptbuilder.php'){echo 'class="current"';} 
//	echo '><a  href="http://www.cirrusidea.com/conceptbuilder.php"><b>CONCEPT BUILDER&#153;</b></a></li>';
	
	echo '<li ';
	$current = $_SERVER['PHP_SELF']; 
	if(basename($current) == 'logout.php'){echo 'class="current"';}
	echo '><a  href="http://www.cirrusidea.com/logout.php"><b>Log Out (' . $_SESSION['username'] . ')</b></a></li>';
	

	if ($_SESSION['username']=='tjgersho'){

	echo '<li ';
	$current = $_SERVER['PHP_SELF']; 
	if(basename($current) == 'admin.php'){echo 'class="current"';}
	echo '><a href="http://www.cirrusidea.com/admin.php"><b>Admin</b></a></li>';

   
  }
  
  if ($_SESSION['username']=='tjgersho'){

    echo '<li ';
	$current = $_SERVER['PHP_SELF']; 
	if(basename($current) == 'updateindex.php'){echo 'class="current"';}
	echo '><a href="http://www.cirrusidea.com/updateindex.php"><b>UPDate</b></a></li>';

   
  }

  }
  else {
  echo '<div id="header">';
 echo '<div id="menubar">'; 
  echo '<ul id="menu">';
  
    echo '<li><a href="http://www.cirrusidea.com/signup.php">Sign Up</a></b></li>';
	 echo '<li><a href="http://www.cirrusidea.com">Home</a></b></li>';
  }
 echo '</ul></div>';
 ?> 
<div style="width:300px; position:relative; left:1000px; top:-40px;">
  <form  enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="tourbutton" id="tourbutton" value="CirrusIdea Help?" />
</form>
</div>
<?php
 
  echo '</div>';
 echo '<div id="fillcontent">';
 
 
 

?>



<script>

var helpon = "<?php echo $_SESSION['newuser']; ?>";
var f = document.getElementById('tourbutton');

if (helpon =="1"){
f.value = "Exit Help?";
}else{
f.value = "CirrusIdea Help?";
}

</script>
<?php

