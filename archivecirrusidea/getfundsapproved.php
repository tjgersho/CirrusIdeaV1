<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]); 
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
  
  
  

  
  if (isset($_POST['submit'])) {
    // Connect to the database
	
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

 // Grab the score data from the POST
	
 $file = mysqli_real_escape_string($dbc, trim($_FILES['file']['name']));
$project_id = mysqli_real_escape_string($dbc, trim($_POST['project_id']));
$project_developer_percentage  = mysqli_real_escape_string($dbc, trim($_POST['project_developer_percentage']));
$amount = mysqli_real_escape_string($dbc, trim($_POST['amount']));


if(isset($file)){


    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size']; 
     $fileinfo = pathinfo($file);
     $fileext23=$fileinfo['extension'];

if ($file_size <= CBP_MAXFILESIZE) {

		if ($_FILES['file']['error'] == 0 || $file==NULL) {
          // Move the file to the target upload folder
  $newfilename =  $project_id . '.' . $fileext23;
 if ($file!=NULL){ 
 $target =  $root . '/proposals/' .$newfilename;
 }
  
 if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
            // Write the data to the database
 
	  $query = "INSERT INTO proposals (date, filename, proposer_id, file_id) VALUES (NOW(), '" . $newfilename . "', '" . $_SESSION['user_id'] . "', '" .$project_id ."')";
	   mysqli_query($dbc, $query);
		
	
	$query7786 = "INSERT INTO proposal_approvals_developers (developer_id, approve, project_id)  VALUES ('" . $_SESSION['user_id'] . "', '1', '$project_id')";
mysqli_query($dbc, $query7786);
  // Confirm success with the user
 
            echo '<p>Thanks for adding your proposal.  Now make sure all the developers review this proposal for approval.  Then the investors will be able to approve.<br />';
			echo '<p><a href="http://www.cirrusidea.com/developerpage.php">&lt;&lt; Back to Developer Management.</a></p>';
			
     
 // Clear the score data to clear the form
           
            $description = "";
            $file = "";
		$newfilename = "";
	
	
	require_once($root.'/footer.php');	
	exit;		
		
          }

 else {
		
            echo '<p class="error">Sorry, there was a problem uploading your file.</p>';
    
		  }
}
      }
      else {

        echo '<p class="error">The file should be no greater than ' . round((CBP_MAXFILESIZE / 1024),4) . ' KB in size.</p>';
   
	  }
    // Try to delete the temporary file
      @unlink($_FILES['file']['tmp_name']);
    }
    else {

      echo '<p class="error">Please fill out the comment section, or the description of your file.</p>';
    
	}
  }
  
  

 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


$project_id = $_POST['project_id'];
$project_developer_percentage  = $_POST['project_developer_percentage'];
$amount = $_POST['amount'];

 $query77347 = "SELECT * FROM cbpfiles WHERE file_id = '" . $project_id . "'";
  $data77347 = mysqli_query($dbc, $query77347);
  $row77347 = mysqli_fetch_array($data77347);
 
 
 echo '<h2>Invested Funds Approval Page: ' . $row77347['file_name'] . '</h2><p style="margin:30px;">';

if ($project_developer_percentage==100){

echo 'You have the possibility to get $' . number_format(($amount),2) . ' awarded to you.<br />';
}else{
echo 'If you generate a single plan with the other developers in this project there can be a total of $'. number_format($amount,2) . ' awarded to the project.<br />';
}
echo 'Before these funds can be claimed you must submit a proposal which all the developers must approve of.<br />';
echo 'Once the proposal is approved by all developers the proposal will be visible to the investors which they must approve before the funds are released to the project.<br />';
echo 'The investors will then be able to approve or reject the plan; after approval the funds will be released to the developers according to their percentage of developership.';
echo 'It will be the developers responsibility to follow through with the plan which was approved by all parties with the recourse of the law.';
echo '<br /><br />Use the form below to submit a proposal.<br />';
echo '<br />One way to do it: <a href="http://www.cirrusidea.com/proposals/Project Proposal Template.doc">Download Proposal Template</a></p>';
?>

  <form enctype="multipart/form-data" method="post" action="" name="uploadform" id="uploadform"> 
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo CBP_MAXFILESIZE; ?>" />   
    <table style="margin-left:auto;margin-right:auto;"><tr><td> 
	<p class="italic">Submit a Proposal</p></td></tr>
	<tr><td style="text-align:right">File:<input type="file" id="file" name="file" /></td>
    <td>
	
<!----> 

<!--hidden field--> 
    <input type="hidden" name="UPLOAD_PROGRESS" id="progress_key" value="<?php echo $up_id; ?>"/> 
<!----> 


<!--Include the iframe--> 
<iframe id="upload_frame" name="upload_frame" frameborder="0" border="0" src="" scrolling="no" scrollbar="no" > </iframe> 
<?php
echo '<input type="hidden" name="project_id" value="' . $project_id . '"/>';
echo '<input type="hidden" name="project_developer_percentage" value="' . $project_developer_percentage . '"/>';
echo '<input type="hidden" name="amount" value="' . $amount . '"/>';
?>
<!--<input name="submit" type="submit" id="submit" value="Add" onclick="function set() { f=document.getElementById('progress_iframe'); f.style.display='block'; f.src='http://www.cirrusidea.com/upload_frame.php?id='<?php echo $up_id?>';} setTimeout(set);" /></td></tr></table>
 --> 

    <input name="submit" type="submit" id="submit" value="Add" /></td></tr></table>
  </form> 
 
 <br /><br /><br />
<?php

 
 // Insert the page footer
  require_once('footer.php');
?>