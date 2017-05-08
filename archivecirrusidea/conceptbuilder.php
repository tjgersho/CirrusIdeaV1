<?php
 
$root = realpath($_SERVER["DOCUMENT_ROOT"]);  

  // Start the session
  require_once($root.'/startsession.php');

  // Insert the page header
  $page_title = 'Concept Builder';
  require_once($root.'/header.php');

  require_once($root.'/appvars.php');
  require_once($root.'/connectvars.php');
 
  if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';

    exit();
  
  }

  // Show the navigation menu
  require_once($root.'/navmenu.php');
 

 function conceptbuilder($problem, $category){
 
$root = realpath($_SERVER["DOCUMENT_ROOT"]); 

$files = array($root . '/newconcepts1.txt', $root . '/newconcepts2.txt', $root . '/newconcepts3.txt', $root . '/newconcepts4.txt', $root . '/newconcepts5.txt');

$delim = "\n";
$i=0;
foreach($files as $conceptfile){
	$i++;

	$fp = fopen($conceptfile, "r");
    $contents = fread($fp, filesize($conceptfile)); 
    $quote_arr = explode($delim,$contents); 
    fclose($fp); 
    srand((double)microtime()*1000000); 
    $quote_index = (rand(1, sizeof($quote_arr)) - 1); 
    $herequote = $quote_arr[$quote_index]; 
    
		if($i == 2){
		$sol[$i] = basename($category) . " " . $herequote;
	}else if ($i == 3){
	$sol[$i] = $herequote;
	}else if ($i == 4){
	$sol[$i] = $herequote;
	
	}else if ($i == 5){
	$sol[$i] = $herequote;
	}else {
	$sol[$i] = $herequote;
	}
	
}


 $folder = basename($category) . rand(1000,20000);
 
 for ($j=0; $j<=$i; $j++){
 $solution = $solution . " " . $sol[$j];
 }

 return array ($folder, $solution);
 }
 
 
 if (isset($_POST['submit'])) {
    // Connect to the database

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

 // Grab the score data from the POST
	$problem = mysqli_real_escape_string($dbc, trim($_POST['problem']));
	$category = mysqli_real_escape_string($dbc, trim($_POST['category']));

if (!empty($problem)) {

list ($folder, $solution) = conceptbuilder($problem, $category);

	
	$query = "SELECT * FROM cbpfiles WHERE file_name = '$folder' AND file_path = '$category'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
	
	$query = "INSERT INTO cbpfiles (file_name, file_path, file_approval, creator, file_private, type) VALUES ('" . $folder . "', '" . $category . "', 1, '" . $_SESSION['user_id'] . "', '" . 0 . "', '4')";
            mysqli_query($dbc, $query);
	 
$newconcept = 'CONCEPT BUILDER&#153;\r\n' . 
			'THE PROBLEM: ' . $problem . '\r\n\r\n' .
			'CONCEPT BUILDER SOLUTION: ' . $solution;



mkdir($root . $category . '/' . $folder);

$templatefile =  $root .  '/templates/index.php';
$copytofile = $root . '/' . $category . '/' . $folder . '/index.php';

copy($templatefile, $copytofile);
$templatefile1 =  $root .  '/templates/projectviewscount.txt';
$copytofile1 = $root . '/' . $category . '/' . $folder . '/projectviewscount.txt';

copy($templatefile1, $copytofile1);


 $query = "INSERT INTO creativebrainpower (date, description, member_id, approved, file_id, startedproject, private) VALUES (NOW(), '" .
	  $newconcept . "', '" . $_SESSION['user_id'] . "', 1, '" . $category . '/' . $folder . "', 0, 0)";
	
	mysqli_query($dbc, $query);




 // Confirm success with the user
            echo '<p>Thanks for creating a new concept!<br />';
			echo 'It may be removed if deemed inappropriate.</p>';

			echo '<p><strong>New Concept Folder:</strong><a href="http://www.cirrusidea.com/' . $category . '/' . $folder . '">' . $folder . '</a></p><br />';
            echo '<p><strong>Problem:</strong><p style="text-align:left"> ' . $problem . '</p><br />';
	
	        echo '<p><strong>Solution:</strong><p style="text-align:left"> ' . $solution . '</p><br />';
	
            echo '<p><a href="http://www.cirrusidea.com/mycreativebrainpower.php">&lt;&lt; Back to My Creative Brain Power</a></p>';
 
 
 // Clear the score data to clear the form
           
            $problem = "";
            $category = "";

            mysqli_close($dbc);
	require_once($root.'/footer.php');	
	exit;		
		

}else {
	echo '<p class="error"><a href="http://www.cirrusidea.com/conceptbuilder.php">Try Again</a></p>';
	
	}


  } else {
 
 echo '<p class="error"><a href="http://www.cirrusidea.com/conceptbuilder.php">Try Again</a></p>';
	
 }
		
 }

  
 $root = realpath($_SERVER["DOCUMENT_ROOT"]); 

?>


<script language="javascript">
 function forceReturn(iMaxLength, sValue){
 if (sValue.length > iMaxLength){
 sValue = sValue + "\r";
 }
 }
</script>
 
 
<h3 style="text-align:center;">CONCEPT BUILDER&#153;</h3>
<h4 style="text-align:center;">This form is designed to help generate new ideas and concepts.</h4>

<table  style="margin-left:auto; margin-right:auto;"">
<form enctype="multipart/form-data" method="post" action=" <?php echo $_SERVER['PHP_SELF']; ?>">
	
	
	<tr><td><label for="category">Category:</label></td></tr>
      
	 <tr><td><select id="category" name="category">
	
	
<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT * FROM cbpfiles WHERE file_private = '0' ORDER BY file_path ASC";
  $data = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($data)) { 
echo '<option value="' . $row['file_path'] . '/' . $row['file_name'] . '" >' . $row['file_name'] .  '</option>';


}


?>
      </select></td></tr>

<br /><br />


   
 <tr><td> 
	<tr><td><label for="problem">Describe the Problem:</label>
	<textarea rows="3" cols="60" onKeyUp="forceReturn('75', this.value);"  id="problem" name="problem" value="<?php if (!empty($problem)) echo $problem; ?>"></textarea></td></tr>
  
 <tr><td><iframe id="progress_iframe" src="" style="display:none;" scrolling="no" frameborder="0"></td></iframe></tr>
 
    
    <tr><td style="text-align:right"><input type="submit" value="Calculate" name="submit"  <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> onclick="function set() { f=document.getElementById('progress_iframe'); f.style.display='block'; f.src='http://www.cirrusidea.com/uploadprogress.php';} setTimeout(set);"/></td></tr>
	</table>
  </form>
  

<br /><br /><br /><br /><br /><br /><br /><br />
<?php

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);




  mysqli_close($dbc);


  // Insert the page footer
  require_once('footer.php');
?>