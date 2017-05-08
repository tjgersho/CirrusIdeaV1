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
  
  
  
  
  
if(isset($_POST['ireason_to_reject'])){
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query8438 = "SELECT * FROM proposals WHERE file_id = '" . $_POST['project_id'] . "'";
     $data8438 = mysqli_query($dbc, $query8438);
      $row8438 = mysqli_fetch_array($data8438);
	
	$query8458 = "SELECT * FROM cbp_user WHERE user_id = '" . $row8438['proposer_id'] . "'";
     $data8458 = mysqli_query($dbc, $query8458);
      $row8458 = mysqli_fetch_array($data8458);
	  
	    	$query8218 = "SELECT * FROM cbpfiles WHERE file_id = '" . $_POST['project_id'] . "'";
     $data8218 = mysqli_query($dbc, $query8218);
      $row8218 = mysqli_fetch_array($data8218);
	  
	  $comment = 'The project proposal for ' . $row8218['file_name'] . ' has been rejected' .
     '. The reason given was: <br />'. $_POST['ireasonreject'] . '<br /> The latest version of the proposal can be downloaded '.
	  '<a href="http://www.cirrusidea.com/proposals/' . $row8438['filename'] . '" >here</a>.  Fix or create a new proposal.';
	  
	
	$query8438 = "SELECT * FROM developervote WHERE projectfolder_id = '" . $_POST['project_id'] . "' AND developer_percentage > '0'";
     $data8438 = mysqli_query($dbc, $query8438);
      
	  
while ($row8438 = mysqli_fetch_array($data8438)){
	$query8258 = "SELECT * FROM cbp_user WHERE username = '" . $row8438['developer_name'] . "'";
     $data8258 = mysqli_query($dbc, $query8258);
      $row8258 = mysqli_fetch_array($data8258);
	  
	 
   $query45 = "INSERT INTO comment (comment, post_member_id, to_member_name, comment_private) VALUES ('" . $comment . "', 'NULL', '" . $row8438['developer_name'] . "', '" . 1 . "')";
	mysqli_query($dbc, $query45);
	 
if ($row8258['mailme'] == 1){	
	$to = $row8258['email'];
	$subject = "CirrusIdea.com - Proposal Rejection";
	$message = "
 <html>
 <head>
 <title>Proposal Rejection</title>
 </head>
 <body>
 <p><br /><br />The project proposal for " . $row8218['file_name'] . " has been rejected.
 The reason given was: <br />". $_POST['ireasonreject'] .  "<br />
 <a href='http://www.cirrusidea.com/developerpage.php'>Log In</a>
 and submit a new proposal or approve the latest and greatest proposal for the project.<br /><br />
 </p>
 </body>
 </html>
 ";
 
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
 $headers .= 'From: <webmaster@cirrusidea.com>' . "\r\n";
	
	mail($to,$subject,$message,$headers);
	
	
	}
}
  
	 $query84308 = "DELETE FROM proposal_approvals_developers WHERE project_id = '" . $_POST['project_id'] . "'";
     $data84308 = mysqli_query($dbc, $query84308);
	 
	 	 $query81308 = "DELETE FROM proposal_approvals_investors WHERE project_id = '" . $_POST['project_id'] . "'";
     $data81308 = mysqli_query($dbc, $query81308);
	 
	$query84318 = "DELETE FROM proposals WHERE file_id = '" . $_POST['project_id'] . "'";
     $data84318 = mysqli_query($dbc, $query84318);
	 
	$query517 = "UPDATE cbpfiles SET funds = 1 WHERE file_id = '" . $_POST['project_id'] . "'";
     mysqli_query($dbc, $query517);
	 
echo '<p>Your rejection notice will anonymously be sent to the developers of the project.</p>';

}
  
if (isset($_POST['iplan_approval'])){
 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$approved = $_POST['iplanapproval'];
$project_id = $_POST['project_id'];

if($approved){
$query7786 = "INSERT INTO proposal_approvals_investors (investor_id, approve, project_id)  VALUES ('" . $_SESSION['user_id'] . "', '" . $approved. "', '" . $project_id . "')";
mysqli_query($dbc, $query7786);

echo '<p>Your proposal approval has been processesed. <br />';
echo 'All investors of this project have to approve plan before the funds get released to this project.'; 
echo '<br /><a href="http://www.cirrusidea.com/investorpage.php">&lt;&lt; Back to Stake Management.</a></p>';
			
	$number_of_investors = 0;
	$number_still_to_vote = 0;
	$query3336 = "SELECT DISTINCT investor FROM investments WHERE project_id = '". $project_id . "'";
	$data3336 = mysqli_query($dbc, $query3336);
	while ($row3336 = mysqli_fetch_array($data3336)){
	 $query945 = "SELECT * FROM proposal_approvals_investors WHERE investor_id = '" . $row3336['investor']  . "' AND project_id = '" . $project_id . "'";
     $data945 = mysqli_query($dbc, $query945);
     $row945 = mysqli_fetch_array($data945);
	
 
	$number_of_investors++;
	
	if (!isset($row945['iprop_id'])){
	$number_still_to_vote++;
	 }
	
	
	}
	
	
 
	 if ($number_still_to_vote) {
	 $query517 = "UPDATE cbpfiles SET funds = 3 WHERE file_id = '" . $_POST['project_id'] . "'";
     mysqli_query($dbc, $query517);
	 }else{
	  $query517 = "UPDATE cbpfiles SET funds = 4 WHERE file_id = '" . $_POST['project_id'] . "'";
     mysqli_query($dbc, $query517);
	 }
	 
}else{
echo  '<h3>State the reasons why you are rejecting this plan:</h3><br />';
echo  '<table style="position:relative; margin-left:auto; margin-right:auto; width:50%;"><tr><td><form method="post" action="http://www.cirrusidea.com/investorpage.php">';
?>
<textarea rows="4" cols="70" onKeyUp="forceReturn('70', this.value);"  id="ireasonreject" name="ireasonreject"></textarea></td><td></td><tr>
<?php
echo  '<td></td><td><input type="hidden" name="project_id" value="' . $project_id . '"/>';
echo   '<input type="submit" name="ireason_to_reject" value="Reject" />';
echo   '</form></td></tr></table>';

//you need to get a delete query here for any rejection made by developers, email and comment to other developers letting them know, delete from proposal file and database.
//this will basically re-set the proposal process.....

}
 
 
 // Insert the page footer
  require_once('footer.php');
  exit();
}


  
 

 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


$query7776 = "SELECT * FROM investments WHERE investor = '" . $_SESSION['user_id'] . "'";
	$data7776 = mysqli_query($dbc, $query7776);
     $row7776 = mysqli_fetch_array($data7776);

echo '<h2>Your Cash</h2>';


if(!isset($row7776['investor'])){
echo '<h3>You do not have any cash for projects.</h3>';
echo '<p>You can help projects come to life with cash by <a href="http://www.cirrusidea.com/files/browse.php">browsing CirrusIdeas</a>, find a project you want to help make happen, and put down cash at the top of the project pages.<br />';
echo '<br /><br />By placing cash down on a project you will and becoming a Cirrustaker and you will have a say in how the project develops.</p>';
}

$t=0;
$query7776 = "SELECT * FROM investments WHERE investor = '" . $_SESSION['user_id'] . "'";
$data7776 = mysqli_query($dbc, $query7776);
while ($row7776 = mysqli_fetch_array($data7776)){   ////////For each investment///////

$insert = true;

for ($e=0; $e<$t; $e++){
if ($row7776['project_id'] == $project_id[$e]){
$insert = false;
$amount[$e] = $amount[$e]+$row7776['amount'];  // Total up your investments for this project.
break;
}
}

if ($insert){
   

  $query77337 = "SELECT * FROM cbpfiles WHERE file_id = '" . $row7776['project_id'] . "'";
  $data77337 = mysqli_query($dbc, $query77337);
  $row77337 = mysqli_fetch_array($data77337);
  

  $investor_total[$t]=0;
  $total_invested[$t]=0;
  $query9996 = "SELECT * FROM investments WHERE investor = '" . $_SESSION['user_id'] . "' AND project_id = '". $row7776['project_id'] . "'";
	$data9996 = mysqli_query($dbc, $query9996);
	while ($row9996 = mysqli_fetch_array($data9996)){
	$investor_total[$t] = $investor_total[$t] + $row9996['amount'];
	}
$query3336 = "SELECT * FROM investments WHERE project_id = '". $row7776['project_id'] . "'";
	$data3336 = mysqli_query($dbc, $query3336);
	while ($row3336 = mysqli_fetch_array($data3336)){
	$total_invested[$t] = $total_invested[$t] + $row3336['amount'];
	}
$percent_invested[$t] = number_format(100*($investor_total[$t]/$total_invested[$t]),2);
$project_invested_list[$t] = $row77337['file_name'];
$project_id[$t] = $row7776['project_id'];
$amount[$t] = $row7776['amount'];
$t++;
}

}


for ($r=0; $r<$t; $r++){

echo '<br /><table class="brain_table" width="800px"><tr>';
echo '<td style="text-align:left;" width="60px">Project:</td><td style="text-align:left;" width="150px"><b>' . $project_invested_list[$r] . '</b></td>';
echo '<td style="text-align:left;" width="150px">Your Cash Percentage:</td><td style="text-align:left;"><a href="http://www.cirrusidea.com/otherinvestors.php?project_id='.$project_id[$r].'">' . $percent_invested[$r] . '% of total project cash</a></td>';
echo '<td style="text-align:left;"><b>$';
echo $amount[$r];
echo '</b></td>';

       $query456 = "SELECT * FROM cbpfiles WHERE file_id = '" . $project_id[$r] . "'";
       $data456 = mysqli_query($dbc, $query456);
	   $row456 = mysqli_fetch_array($data456);
	   
	   
	
if ($row456['funds'] == 2){
   $query775 = "SELECT * FROM proposals WHERE file_id = '" . $project_id[$r] . "'";
   $data775 = mysqli_query($dbc, $query775);
    $row775 = mysqli_fetch_array($data775);

	echo '<td width="150px"><a href="http://www.cirrusidea.com/proposals/' . $row775['filename'] . '">Download Proposal for your review</a></td>';
	echo '<td width="300px"><form method="post" action="http://www.cirrusidea.com/investorpage.php">';
	echo '<input type="radio" name="iplanapproval" value="1" checked="checked"/>Approve Plan';
	echo '<input type="radio" name="iplanapproval" value="0" />Reject Plan';
	echo '<input type="hidden" name="project_id" value="' . $project_id[$r] . '"/>';
	echo '<input type="submit" name="iplan_approval" value="Submit"/></form>';

}else if($row456['funds']==3){
    $number_of_investors = 0;
	$number_still_to_vote = 0;
   
	$query3336 = "SELECT DISTINCT investor FROM investments WHERE project_id = '". $project_id[$r] . "'";
	$data3336 = mysqli_query($dbc, $query3336);
	while ($row3336 = mysqli_fetch_array($data3336)){
	 $query945 = "SELECT * FROM proposal_approvals_investors WHERE investor_id = '" . $row3336['investor']  . "' AND project_id = '" . $project_id[$r] . "'";
     $data945 = mysqli_query($dbc, $query945);
     $row945 = mysqli_fetch_array($data945);
	
      $user_did_vote = true;
   
	$number_of_investors++;
	
	if (isset($row945['iprop_id'])){
	$number_still_to_vote++;
	 }
	
	}
     $query945 = "SELECT * FROM proposal_approvals_investors WHERE investor_id = '" . $_SESSION['user_id']  . "' AND project_id = '" . $project_id[$r] . "'";
     $data945 = mysqli_query($dbc, $query945);
     $row945 = mysqli_fetch_array($data945);
    if (isset($row945[''])){
         echo '<td>' . $number_still_to_vote  . ' investors on this project must approve this proposal before funds are released.</td>';
    } else {
     $query775 = "SELECT * FROM proposals WHERE file_id = '" . $project_id[$r] . "'";
    $data775 = mysqli_query($dbc, $query775);
    $row775 = mysqli_fetch_array($data775);

    echo '<td width="150px"><a href="http://www.cirrusidea.com/proposals/' . $row775['filename'] . '">Download Proposal for your review</a></td>';
	echo '<td width="300px"><form method="post" action="http://www.cirrusidea.com/investorpage.php">';
	echo '<input type="radio" name="iplanapproval" value="1" checked="checked"/>Approve Plan';
	echo '<input type="radio" name="iplanapproval" value="0" />Reject Plan';
	echo '<input type="hidden" name="project_id" value="' . $project_id[$r] . '"/>';
	echo '<input type="submit" name="iplan_approval" value="Submit"/></form>';
        
    }
    
	
        
        
}else if($row456['funds']==4){
	
		echo '<td>All stakers for this project have approved the proposal presented by the project developers and the cash has been released to the developers.</td>';


}else{
echo '<td style="text-align:right;"><form method="post" action="projectdevelopervoting.php">';
echo '<input type="hidden" name="project_id" value="' . $project_id[$r] . '"/>';
echo '<input type="hidden" name="project_investment_percentage" value="' . $percent_invested[$r]  . '"/>';
echo '<input type="submit" value="Vote on Developer/s"/>';
echo '</form></td>';

}



echo '</table><br />';

}
echo '<br /><br /><p>As as staker you are agreeing that you are not buying into any equity of the project, but as a friend you may enjoy the benifits of the positive progression of the project.</p>';

 echo '<br /><br /><br /><br /><br />';
 // Insert the page footer
  require_once('footer.php');
 ?>