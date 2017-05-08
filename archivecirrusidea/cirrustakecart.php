<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Project Involvement';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
 
   if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  }
 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$query878 = "SELECT * FROM cbpfiles WHERE file_name = '" .$_POST['item_name_1'] . "' AND file_path = '" . $_POST['item_name_2'] . "'";
  $data878 = mysqli_query($dbc, $query878);
  $row878 = mysqli_fetch_array($data878);

$project_id =  $row878['file_id'];


//security!

//Check to see if the user can vote or not on the project
$query857 = "SELECT * FROM investments WHERE investor = '" . $_SESSION['user_id'] . "' AND project_id = '" . $project_id . "' ORDER BY date ASC LIMIT 1";
	$data857 = mysqli_query($dbc, $query857);
	$row857 = mysqli_fetch_array($data857);

if ($row857['date']!=NULL){

$datetimestamp1 = $row857['date'];

$datetimestamp2 = date("Y-m-d");


$query146 = "SELECT DATEDIFF('$datetimestamp2','$datetimestamp1') AS DiffDate";
	$data146 = mysqli_query($dbc, $query146);
	$row146 = mysqli_fetch_array($data146);
	$datediff = $row146['DiffDate'];

		if ($datediff>7){
			$allowinvest = true;
			}else{
			$allowinvest = false;
				}
}else{
$allowinvest = true;
}
 
 
 if($allowinvest == true){
	 
 
echo '<p>The net value below is the amount of value you want to position for this project to develop.  ';
echo 'The percentage of the stake is proportional to that which you pay in versus the total cash that has been positioned for this project by you and other members.<br /><br />';
echo 'This will be tracked and can be viewed on your CirrusIdea home page under Cash Management.<br />';
echo 'As a staker you can make this cash available to the developers, whom you as a staker must vote on through the Cash Management link on your CirrusIdea home page. ';
echo 'Once the developers submit a proposal, all stakers will have to approve the proposal which allows disbursement of the cash to the project.<br /><br />';
echo 'The net value of your cash is the amount after PayPals percentage and CirrusIdea.com administrative fee. <br />';
echo '<be />The net cash made available to the project is shown below and is 85% of the stake you entered on the project page. <br />';
echo '<br />You agree by submitting the cash that you are not making an equity investment, the SEC has strict laws prohibiting equity crowdsource funding, and you are simply adding value to a project to see it come to fruition.<br />';
echo '<br />By submitting this cash you are expecting nothing in return as it is not an investment for equity, but you may enjoy the returns as a private codeveloper of the project.<br /><br /><br />';
echo 'Please allow the paypal website, once you have submitted the cash, to re-direct you back to CirrusIdea so that the transaction goes through.</p>';


 
echo '<table style="position:relative; margin-left:auto; margin-right:auto;"><tr>';
echo '<td>Project:</td>';
echo '<td>' . $_POST['item_name_1'] . '</td><td></td><td style="text-align:right;">';
echo '<!-- Begin Official PayPal Seal --><a href="https://www.paypal.com/us/verified/pal=travis%2eg%40cirrusidea%2ecom" target="_blank"><img src="https://www.paypal.com/en_US/i/icon/verification_seal.gif" border="0" alt="Official PayPal Seal"></A><!-- End Official PayPal Seal -->';
 
echo '</td></tr>';
echo '<tr><td></td><td>Gross Purchase:  </td>';
echo '<td>$' . number_format($_POST['sharesvalue'],2)  . '</td></tr>';
echo '<tr><td></td><td>Net cash for '.$_POST['item_name_1'] . ':  </td>';
echo '<td>$' . number_format((0.85*$_POST['sharesvalue']),2)  . '</td></tr>';
echo '<tr><td></td><td></td><td></td><td>';
echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">';
echo '<input type="hidden" name="business" value="travis.g@cirrusidea.com">';
echo '<input type="hidden" name="cmd" value="_xclick">';
echo '<input  type="hidden" name="item_name" value="'.$_POST['item_name_2'] . '/' . $_POST['item_name_1'] .'">';
echo '<input type="hidden" name="amount" value="'.$_POST['sharesvalue'].'">';
 echo '<input type="hidden" name="currency_code" value="USD">'; 
echo '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">';
echo '<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">';
echo '</form></td></tr>';


echo '</table>';



}else{

echo '<p style="color:red; font-size:20px;">';
			echo 'You have to wait ' . (7-$datediff) . ' days to add cash into this project.</p>';


}
 
 // Insert the page footer
  require_once('footer.php');
 ?>