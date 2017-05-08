<?php
 // Start the session
  require_once('startsession.php');
 
  require_once('appvars.php');
  require_once('connectvars.php');
  
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  $query77 = "SELECT * FROM codevelopers WHERE member = '".$_SESSION['username']."'";
 $data77 = mysqli_query($dbc, $query77);
if ($data77!=NULL){


while ($row77 = mysqli_fetch_array($data77)) { 

echo '<a href="http://www.cirrusidea.com/viewprofile.php?username='.$row77['codeveloper'].'" target="_parent">'.$row77['codeveloper'].'</a></br>';

}

}else{
echo '<p style="color:red">Go to another member\'s profile and select add as co-developer</p>';
}



 
?>
