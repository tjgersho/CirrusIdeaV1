<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Project Shares Purchase';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
   if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  }
 
 
 
 if(isset($_GET['allowinvest'])){
 
 echo '<p style="color:red; font-size:20px;">';
			echo 'Your transaction did not go through either because you refreshed the page <br />';
			echo 'and it already went through, or you have to wait 7 days to reinvest into this project.</p>';
 
 }else{
$amount = $_GET['amount'];
$foldername1 = $_GET['foldername'];
$file_dir2 = $_GET['filedir'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];


echo '<br /><br />';
echo ("<p><h3>Thank you for your project shares purchase</h3></p>");
echo '<p>You now own part of the project: ' .  $foldername1 . '</p>';
echo ("<b>Payment Details</b><br />"); 
echo ("<li>Name: $firstname $lastname</li><br />");

echo '<li>Filename:'.$foldername1 . '</li><br />';
echo '<li>File Directory:'.$file_dir2 . '</li><br />';


echo ("<li>Total Amount: $amount</li><br />");
echo ("");

	
$member_buying_shares = $_SESSION['username'];
echo $member_buying_shares;
echo ' your transaction has been completed, and a receipt for your purchase has been emailed to you.<br><br>';
}
 
 // Insert the page footer
  require_once('footer.php');
 ?>