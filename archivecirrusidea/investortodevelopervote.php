<?php
  // Start the session
  require_once('startsession.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu

if (!isset($_SESSION['user_id'])) {

    exit();
	
} 
  
$project_id = $_POST['project_id'];
$number_of_posters = $_POST['number_of_posters'];
$percent_invested  = $_POST['project_investment_percentage'];
 
 
 for ($u=0; $u<$number_of_posters; $u++){
 
 $developer_percentage[$u] = $_POST['developerpercent'.($u+1)];
 $developer_name[$u] = $_POST['developername'.($u+1)];
 // echo  $developer_name[$u];
 // echo $developer_percentage[$u];
  
 }

 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



for ($uq=0; $uq<$number_of_posters; $uq++){

 $query57 = "SELECT * FROM developervote WHERE voter_id = '" . $_SESSION['user_id'] . "' AND projectfolder_id ='" . $project_id . "' AND developer_name = '" . $developer_name[$uq] . "'";
  $data57 = mysqli_query($dbc, $query57);
  $row57 = mysqli_fetch_array($data57);
if($row57['dvote_id']!=NULL){

$query12 = "UPDATE developervote SET projectfolder_id = '".$project_id."', developer_name = '" .
 $developer_name[$uq]. "', developer_percentage = '" . $developer_percentage[$uq] . "', owner_equity_weight = '" .
 $percent_invested . "', voter_id = '" . $_SESSION['user_id'] . "' WHERE voter_id = '" . $_SESSION['user_id'] . 
 "' AND projectfolder_id ='" .$project_id . "' AND developer_name ='" .$developer_name[$uq] . "'";
        mysqli_query($dbc, $query12);
		
	}else{

 $query15 = "INSERT INTO developervote (projectfolder_id, developer_name, developer_percentage, owner_equity_weight, voter_id) VALUES (" .$project_id. ", '".$developer_name[$uq]. "', " .$developer_percentage[$uq] . ", " .$percent_invested . ", " .$_SESSION['user_id'] . ")";
        mysqli_query($dbc, $query15);
		
		}
		
}



$investor_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'cashmanagementpage.php';
         header('Location: ' . $investor_url);

 ?>