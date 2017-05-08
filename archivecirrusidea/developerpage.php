<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Developer Management';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
 
   if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  }

  
  
if(isset($_POST['reason_to_reject'])){
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
	  
	  $comment = 'The project proposal for ' . $row8218['file_name'] . ' has been rejected by '. $_SESSION['username'] . 
     '. The reason given was: <br />'. $_POST['reasonreject'] . '<br /> The latest version of the proposal can be downloaded '.
	  '<a href="http://www.cirrusidea.com/proposals/' . $row8438['filename'] . '" >here</a>.';
	  
	$to_member_name = $row8458['username'];
	$query45 = "INSERT INTO comment (comment, post_member_id, to_member_name, comment_private) VALUES ('" . $comment . "', '" . $_SESSION['user_id']. "', '" . $to_member_name . "', '" . 1 . "')";
	mysqli_query($dbc, $query45);
	
	$query8438 = "SELECT * FROM developervote WHERE projectfolder_id = '" . $_POST['project_id'] . "'";
     $data8438 = mysqli_query($dbc, $query8438);
      
	  
while ($row8438 = mysqli_fetch_array($data8438)){
	$query8258 = "SELECT * FROM cbp_user WHERE username = '" . $row8438['developer_name'] . "'";
     $data8258 = mysqli_query($dbc, $query8258);
      $row8258 = mysqli_fetch_array($data8258);
	  
	
   
	 
if ($row8258['mailme'] == 1){	
	$to = $row8258['email'];
	$subject = "CirrusIdea.com - Proposal Rejection";
	$message = "
 <html>
 <head>
 <title>Proposal Rejection</title>
 </head>
 <body>
 <p><br /><br />The project proposal for " . $row8218['file_name'] . " has been rejected by ". $_SESSION['username'] . ".
    The reason given was: <br />". $_POST['reasonreject'] . " <br />
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
	 
	$query84318 = "DELETE FROM proposals WHERE file_id = '" . $_POST['project_id'] . "'";
     $data84318 = mysqli_query($dbc, $query84318);
	 
echo '<p>Your rejection notice will be sent to the other developers of the project.</p>';

}
  
if (isset($_POST['plan_approval'])){
 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$approved = $_POST['planapproval'];
$project_id = $_POST['project_id'];
 

if($approved){
$query7786 = "INSERT INTO proposal_approvals_developers (developer_id, approve, project_id)  VALUES ('" . $_SESSION['user_id'] . "', '$approved', '$project_id')";
mysqli_query($dbc, $query7786);

echo '<p>Your proposal approval has been processesed. <br />';
echo 'All developers of this project have to approve plan before the investors can approve and you get funds released to this project.'; 
echo '<br /><a href="http://www.cirrusidea.com/developerpage.php">&lt;&lt; Back to Developer Management.</a></p>';
			

}else{
echo  '<h3>State the reasons why you are rejecting this plan:</h3><br />';
echo  '<table style="position:relative; margin-left:auto; margin-right:auto; width:50%;"><tr><td><form method="post" action="http://www.cirrusidea.com/developerpage.php">';
?>
<textarea rows="4" cols="70" onKeyUp="forceReturn('70', this.value);"  id="reasonreject" name="reasonreject"></textarea></td><td></td><tr>
<?php
echo  '<td></td><td><input type="hidden" name="project_id" value="' . $project_id . '"/>';
echo   '<input type="submit" name="reason_to_reject" value="Reject" />';
echo   '</form></td></tr></table>';

//you need to get a delete query here for any rejection made by developers, email and comment to other developers letting them know, delete from proposal file and database.
//this will basically re-set the proposal process.....

}
 
 
 // Insert the page footer
  require_once('footer.php');
  exit();
}


  
  echo '<h2>Your Developing Projects</h2>';
 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//////////////////////////////////////////////////////////
///See if the user has been voted as a developer../////
//////////////////////////////////////////////////////////
$query7776 = "SELECT * FROM developervote WHERE developer_name = '" . $_SESSION['username'] . "'";
$data7776 = mysqli_query($dbc, $query7776);  

//////////////////////////////////////////////////////////////////////////////////////////////////
///For each project for which the user has been voted as a developer add a developer instance ////
//////////////////////////////////////////////////////////////////////////////////////////////////

while ($row7776 = mysqli_fetch_array($data7776)){
    
    ///Pull the project info/////

 $query77337 = "SELECT * FROM cbpfiles WHERE file_id = '" . $row7776['projectfolder_id'] . "'";
  $data77337 = mysqli_query($dbc, $query77337);
  $row77337 = mysqli_fetch_array($data77337);
  
  //////////////////////////////////////////////
  ///Pull the project invested money////////////
  //////////////////////////////////////////////

    $query3336 = "SELECT * FROM investments WHERE project_id = '". $row7776['projectfolder_id'] . "'";
	$data3336 = mysqli_query($dbc, $query3336);
	while ($row3336 = mysqli_fetch_array($data3336)){
	$amount = $amount + $row3336['amount'];
	}
	
    
  /////Set cbpfiles funds column status/////
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query7176 = "SELECT DISTINCT developer_name FROM developervote WHERE projectfolder_id = '" . $row7776['projectfolder_id'] . "' AND developer_percentage > '0'";
$data7176 = mysqli_query($dbc, $query7176);	

$number_of_developers = 0;
$number_still_to_vote = 0;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////Loop through the developer votes for this specific project and determine who all is involved with this project/////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	while ($row7176 = mysqli_fetch_array($data7176)){
	  $query845 = "SELECT * FROM cbp_user WHERE username = '" . $row7176['developer_name'] . "'";
      $data845 = mysqli_query($dbc, $query845);
      $row845 = mysqli_fetch_array($data845);
  
	 $query945 = "SELECT * FROM proposal_approvals_developers WHERE developer_id = '" . $row845['user_id']  . "' AND project_id = '" . $row7776['projectfolder_id'] . "'";
     $data945 = mysqli_query($dbc, $query945);
     $row945 = mysqli_fetch_array($data945);
	
	$number_of_developers++;
	
		
		
    	if (!isset($row945['dprop_id'])){  ////////Has this developer voted on the proposal yet?////////////////
    	 $number_still_to_vote++;
    	 $query5537 = "UPDATE cbpfiles SET funds = 1 WHERE file_id = '" . $row7776['projectfolder_id'] . "'"; 
         mysqli_query($dbc, $query5537);
          /////funds at 1 means there are still developers who need to vote on the proposal////////////////
         
	     }
	
	  } //// elihw
      
      
	
             $query994 = "SELECT * FROM cbpfiles WHERE file_id = '" . $row7776['projectfolder_id'] . "'";
             $data994 = mysqli_query($dbc, $query994);
    	      $row994 = mysqli_fetch_array($data994);
	  
	 
          if(($number_still_to_vote==0) && ($row994['funds'] != 4 && $row994['funds'] != 3)){
           $query5537 = "UPDATE cbpfiles SET funds = 2 WHERE file_id = '" . $row7776['projectfolder_id'] . "'";
           mysqli_query($dbc, $query5537);
           /////funds at 2 means all the developers approvedthe the proposal and the investors need to approve//////////////
           /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            }

            if ($row7776['developer_percentage']!=0){   ///// If a developer is given a percentage by the investors of the project then show it///////

            echo '<br /><table class="brain_table" width="900px"><tr>';
            echo '<td style="text-align:left;" width="60px">Project:</td><td style="text-align:left;" width="150px"><b>' . $row77337['file_name'] . '</b></td>';
            echo '<td style="text-align:left;" width="100px">Developer Percentage:</td><td style="text-align:left;">' . $row7776['developer_percentage'] . '% of project developement and cash eligability.</a></td>';
            echo '<td style="text-align:left;"><b>PROJECT ELIGABLE CASH $';
            echo $amount;
            echo '</b></td>';
            echo '<td style="text-align:right;">';

            //$amount = 0;

             $query775 = "SELECT * FROM proposals WHERE file_id = '" . $row7776['projectfolder_id'] . "'";
             $data775 = mysqli_query($dbc, $query775);
             $row775 = mysqli_fetch_array($data775);
            if(isset($row775)){
            $hasproposal = true;
            }else{
            $hasproposal = false;
            }
  
            if (!$hasproposal){  //////No Proposal Yet///////

            echo  '<form method="post" action="http://www.cirrusidea.com/getfundsapproved.php">';
            echo '<input type="hidden" id="project_id" name="project_id" value="' . $row7776['projectfolder_id'] . '"/>';
            echo '<input type="hidden" id="amount" name="amount" value="' . $amount . '"/>';
            echo '<input type="hidden" name="project_developer_percentage" value="' . $row7776['developer_percentage'] . '"/>';
            echo '<input type="submit" value="Get Cash Approved for Use"/>';
            echo '</form>';
  
            }else{

            $query745 = "SELECT * FROM proposal_approvals_developers WHERE developer_id = '" . $_SESSION['user_id'] . "' AND project_id = '" . $row7776['projectfolder_id'] . "'";
            $data745 = mysqli_query($dbc, $query745);
            $row745 = mysqli_fetch_array($data745);
  
             if(isset($row745['approve'])){
                 
                  if($row745['approve']){

	                 $query999 = "SELECT * FROM cbpfiles WHERE file_id = '" . $row7776['projectfolder_id'] . "'";
                     $data999 = mysqli_query($dbc, $query999);
	                  $row999 = mysqli_fetch_array($data999);
	
	            	if ($row999['funds']==1){
		                	echo 'You approved this proposal.<br />';
	                    	echo $number_still_to_vote  . ' developers on this project must approve this proposal before proposal approval goes to the stakers.';
	                	}
		            
                    if ($row999['funds']==2 || $row999['funds']==3){
		            	echo 'You approved this proposal.<br />';
	                   	echo 'The stakers on this project must approve this proposal before the cash is released.';
		                }
	
	                if ($row999['funds']==4){
		
		                $query1999 = "SELECT * FROM funds_release WHERE project_id = '" . $row7776['projectfolder_id'] . "' AND pay_developer_id = '". $_SESSION['user_id']. "'";
                        $data1999 = mysqli_query($dbc, $query1999);
	                    $row1999 = mysqli_fetch_array($data1999);
		
		             if(isset($row1999['payment_id'])){
		                  if($row1999['paid']){
		                  echo '<b style="color:green">Your cash should now be in your paypal account!!</b>';
			             }else{
			                 echo '<b style="color:orange">Your cas is on their way, it could take up to 48 hours to receive!!</b>';
			               }
		
		
		                 }else{
	            
                             echo '<b style="color:green">All investors have approved this project proposal.';
	                         echo  '<form method="post" action="http://www.cirrusidea.com/collectfunds.php">';
	        	             echo '<input type="hidden" name="project_id" value="' . $row7776['projectfolder_id'] . '"/>';
	        	             echo '<input type="hidden" name="amount" value="' . $amount . '"/>';
	                         echo '<input type="hidden" name="project_developer_percentage" value="' . $row7776['developer_percentage'] . '"/>';
		                     echo '<input type="submit" value="Collect Cash"/>';
	        	             echo '</form>';
	    	                }
                      }
		
                  
        
            	}else{  // Approval variable set to false...////
            	echo 'You rejected this proposal';
	        }
            
         }else{  // Approval variable has not ever been set show proposal for download. /// 
        	echo '<a href="http://www.cirrusidea.com/proposals/' . $row775['filename'] . '">Download Proposal for your review</a></td>';
	        echo '<td width="200px"><form method="post" action="http://www.cirrusidea.com/developerpage.php">';
	        echo '<input type="radio" name="planapproval" value="1" checked="checked"/>Approve Plan';
	        echo '<input type="radio" name="planapproval" value="0" />Reject Plan';
	        echo '<input type="hidden" name="project_id" value="' . $row7776['projectfolder_id'] . '"/>';
	        echo '<input type="submit" name="plan_approval" value="Submit"/></form>';
     	}

       }  //end of is there a proposal test.. which just above is code for the fact that a proposal has been submitted.//////

    echo '</td>';
    echo '</table>';
 }  //End of does the developer have any percentage for this project test.
 
$amount = 0;  // Reset for next project 
}


  echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
 // Insert the page footer
  require_once('footer.php');
 ?>