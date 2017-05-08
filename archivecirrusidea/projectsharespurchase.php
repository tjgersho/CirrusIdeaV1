<?php
  // Start the session
  require_once('startsession.php');
  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
 
    if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  }
 

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];

$auth_token = "seF385-Ige8uiE2xgQ42eQTfKjk397YrDVTYRdHCveXyXibVv7VC9tujkzm";

$req .= "&tx=$tx_token&at=$auth_token";


// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
// If possible, securely post back to paypal using HTTPS
// Your PHP server will need to be SSL enabled
// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
// read the body data
$res = '';
$headerdone = false;
while (!feof($fp)) {
$line = fgets ($fp, 1024);
if (strcmp($line, "\r\n") == 0) {
// read the header
$headerdone = true;
}
else if ($headerdone)
{ 
// header has been read. now read the contents
$res .= $line;
}
}

// parse the data
$lines = explode("\n", $res);
$keyarray = array();
if (strcmp ($lines[0], "SUCCESS") == 0) {
for ($i=1; $i<count($lines);$i++){
list($key,$val) = explode("=", $lines[$i]);
$keyarray[urldecode($key)] = urldecode($val);
}

// check the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your Primary PayPal email
// check that payment_amount/payment_currency are correct
// process payment

$firstname = $keyarray['first_name'];
$lastname = $keyarray['last_name'];

$fullfilepath = $keyarray['item_name'];
$foldername1 = basename($fullfilepath);
$file_dir2 = dirname($fullfilepath);



$amount = $keyarray['mc_gross'];

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$email = $keyarray['payer_email'];

}
else if (strcmp ($lines[0], "FAIL") == 0) {
// log for manual investigation
 $purchased_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'projectsharespurchased.php?allowinvest=1';
          header('Location: ' . $purchased_url);

}

}


$query878 = "SELECT * FROM cbpfiles WHERE file_name = '$foldername1' AND file_path = '$file_dir2'";
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
	

fclose ($fp);
$query = "INSERT INTO investments (investor, amount, project_id, first_name, last_name, email) VALUES ('" . 
	$_SESSION['user_id']. "' , '" . $amount*0.85 . "', '" . $project_id . "', '" . $firstname  . "', '" . $lastname  . "', '" . $email . "')";
	mysqli_query($dbc, $query);


$purchased_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'projectsharespurchased.php?amout=' .  
		$amount . '&foldername=' .  $foldername1 . '&filedir=' .  $file_dir2 . '&firstname=' .  $firstname . '&lastname=' .  $lastname;
          header('Location: ' . $purchased_url);
  }else{
 
 $purchased_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'projectsharespurchased.php?allowinvest=1';
          header('Location: ' . $purchased_url);
 
 }
 
 
 


 ?>