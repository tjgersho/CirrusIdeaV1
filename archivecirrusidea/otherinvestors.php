<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Project Stake';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
 
   if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  } 
 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  $query77337 = "SELECT * FROM cbpfiles WHERE file_id = '" . $_GET['project_id'] . "'";
  $data77337 = mysqli_query($dbc, $query77337);
  $row77337 = mysqli_fetch_array($data77337);

$query7776 = "SELECT * FROM investments WHERE project_id = '" . $_GET['project_id'] . "'";
	$data7776 = mysqli_query($dbc, $query7776);
echo '<h2>Project Stakers: ' . $row77337['file_name'] . '</h2>';

$t=0;
while ($row7776 = mysqli_fetch_array($data7776)){

$insert = true;

for ($e=0; $e<$t; $e++){
	if ($row7776['investor'] == $project_investor_id[$e]){
	$insert = false;
	break;
	}
	}

	if ($insert){
	$project_investor_id[$t] = $row7776['investor'];
	$t++;
	}

}

for ($r=0; $r<$t; $r++){

$query901 = "SELECT * FROM cbp_user WHERE user_id = '" . $project_investor_id[$r] . "' LIMIT 1";
	$data901 = mysqli_query($dbc, $query901);
	$row901 = mysqli_fetch_array($data901);

echo '<br /><table class="brain_table" width="300px"><tr>';
echo '<td style="text-align:left;" width="60px">Staker:</td><td style="text-align:left;" width="150px"><b>' . $row901['username'] . '</b></td>';
echo '</tr></table>';

}
 echo '<br /><br /><br />';
 // Insert the page footer
  require_once('footer.php');
 ?>