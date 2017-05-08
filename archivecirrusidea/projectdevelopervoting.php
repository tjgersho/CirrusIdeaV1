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
 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


$project_id = $_POST['project_id'];
$percent_invested  = $_POST['project_investment_percentage'];
 $query77347 = "SELECT * FROM cbpfiles WHERE file_id = '" . $project_id . "'";
  $data77347 = mysqli_query($dbc, $query77347);
  $row77347 = mysqli_fetch_array($data77347);
  
 

   $query7667 = "SELECT * FROM creativebrainpower WHERE file_id LIKE '" . $row77347['file_path'] .  "/" . $row77347['file_name'] . "%'";
  $data7667 = mysqli_query($dbc, $query7667);
  
    $query5488 = "SELECT COUNT(*) As Developers FROM creativebrainpower WHERE file_id LIKE '" . $row77347['file_path'] .  "/" . $row77347['file_name'] . "%'";
  $data5488 = mysqli_query($dbc, $query5488);
  $row5488 = mysqli_fetch_array($data5488);
  
  $total_project_posts = $row5488['Developers'];
  
 echo '<h2>Project Developers for ' . $row77347['file_name'] . '</h2>';
$io=0; 
 while($row7667 = mysqli_fetch_array($data7667)){


$addtoarray = true;
for ($u=0; $u<$io; $u++){
if($row7667['member_id']==$developer_id[$u]){
$addtoarray = false;
}

}

if ($addtoarray==true){

 $developer_id[$io] =  $row7667['member_id'];
 
  $query544 = "SELECT COUNT(*) As Developer" . $row7667['member_id'] . " FROM creativebrainpower WHERE member_id = '" . $row7667['member_id'] . "' AND file_id LIKE '" . $row77347['file_path'] .  "/" . $row77347['file_name'] . "%'";
  $data544 = mysqli_query($dbc, $query544);
  $row544 = mysqli_fetch_array($data544);

	
	$developer_input_count[$io] =   $row544['Developer' . $row7667['member_id']];
	
	 
  $io++;
  
  }
  
  
  
 }
echo '<form method="POST"  action="investortodevelopervote.php" enctype="multipart/form-data">';
  for ($u=0; $u<$io; $u++){

  $query57 = "SELECT * FROM cbp_user WHERE user_id = '" . $developer_id[$u] . "'";
  $data57 = mysqli_query($dbc, $query57);
  $row57 = mysqli_fetch_array($data57);


echo '<br /><table class="brain_table" width="700px"><tr>';
echo '<td style="text-align:left;" width="400px"><b>' . $row57['username'] . '</b>';
echo ' has ' . number_format(($developer_input_count[$u]/$total_project_posts)*100,2) . '% of the posts for this project.</td>';
echo '<td style="text-align:right;" width="300px">';
echo 'Input the Percentage of <b>Value Added</b> input you would give this developer:';
echo '<input type="hidden" id="developername'.($u+1).'" name="developername'.($u+1).'" value="' . $row57['username'] . '"/>';
echo '<input type="text" id="developerpercent'.($u+1).'" name="developerpercent'.($u+1).'"/>%</td>';
echo '<td style="text-align:right;">';
echo '</td>';
echo '</table>';


}

echo '<input type="hidden" id="project_id" name="project_id" value="' . $project_id  . '"/>';
echo '<input type="hidden" name="project_investment_percentage" value="' . $percent_invested . '"/>';
echo '<input type="hidden" id="number_of_posters" name="number_of_posters" value="' . $io . '"/><br />';
echo '<input style="position:relative; left:600px;"  type="submit" value="Your input on developer % of contribution"/>';
echo '</form>';
echo '<br /><br /><br />';
 
 // Insert the page footer
  require_once('footer.php');
?>