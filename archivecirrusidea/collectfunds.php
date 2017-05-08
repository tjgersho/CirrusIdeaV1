<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Collect Funds';
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


 $query77537 = "SELECT * FROM cbpfiles WHERE file_id = '" . $project_id . "'";
  $data77537 = mysqli_query($dbc, $query77537);
  $row77537 = mysqli_fetch_array($data77537);
echo '<h2>Congradulations, you get to collect cash for the project: '.  $row77537['file_name'] . '</h2>';
echo  '<h3>By collecting this cash you are completely responsible and have a duity which you have agreed upon in your project proposal to complete.';
echo '  If you do not fullfill the spending which was proposed and then agreed upon by you and or any of the other developer\'s of this project and its';
echo 'proposal, the stakers have the right to take legal action against the breach of contract.</h3>';

echo '<p>By accepting this cash you agree to these terms and conditions by taking the liability of owning the project and spending the cash in the best interest of the project and the stakers.';

echo 'You are going to receive a deposit into your paypal account in the amount of :<br />';
echo '<h3>$';
echo number_format(($amount*($project_developer_percentage/100)),2). '</h3>';


echo '<h3>Best of Luck for your Project!!!</h3>';
echo '<p style="position:relative; margin-left:auto; margin-right:auto; width:70%; color:red"><b style="color:red">Prior to accepting these funds you must ensure your paypal email is entered into your cirrusidea.com account. Please <a href="http://www.cirrusidea.com/editprofile.php">enter now</a> if you do not currently have your paypal email entered into your cirrusidea profile.</b></p>';
 

echo  '<table style="position:relative; margin-left:auto; margin-right:auto; width:10%;"><form method="post" action="http://www.cirrusidea.com/fundsreleased.php" >';
echo '<input type="hidden" name="project_id" value="' . $project_id . '"/>';
echo '<input type="hidden" name="amount" value="' . $amount . '"/>';
echo '<input type="hidden" name="project_developer_percentage" value="' . $project_developer_percentage . '"/>';
echo '<input type="submit" value="Accept Funds"/></form></table>';


 // Insert the page footer
  require_once('footer.php');
 ?>