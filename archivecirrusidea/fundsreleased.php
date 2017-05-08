<?php
   // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'fundsrelease Management';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
 
   if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  }

 
$project_id = $_POST['project_id'];

$amount = $_POST['amount'];

$project_developer_percentage = $_POST['project_developer_percentage'];
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

   $query = "INSERT INTO funds_release (pay_developer_id, project_id, project_amount, developer_percentage, pay_amount, paid) VALUES ('". $_SESSION['user_id']. "', '$project_id', '$amount', '$project_developer_percentage', '" . number_format(($amount*($project_developer_percentage/100)),2) . "', 0)";
        mysqli_query($dbc, $query);

echo '<h3>Your funds are on their way to your paypal account.</h3>';
echo '<p style="position:relative; margin-left:auto; margin-right:auto; width:70%;"><b style="color:green">It may take up to 48 hours before you see the transfer of funds to your paypal account.</b></p>';
echo 'Back to your <a href="http://www.cirrusidea.com/developerpage.php">Developer Management</a> page.';


 // Insert the page footer
  require_once('footer.php');

 ?>