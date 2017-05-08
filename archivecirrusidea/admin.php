<?php
// Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Admin';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.

  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  
  }
 
if ($_SESSION['username']!=tjgersho){
    echo '<p class="login">Administrator login needed to access this page.</p>';
    exit();
  
  }

  // Show the navigation menu
  require_once('navmenu.php');
 
 echo '<p style="text-align:center; font-size:25px;"><a href="http://www.cirrusidea.com/updateindex.php">Update Index.php</a></p>';
 
 
 // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
  $query1 = "SELECT * FROM cbpfiles ORDER BY file_id";
  $data1 = mysqli_query($dbc, $query1);


     $query = "SELECT * FROM cbp_user";
	 $data = mysqli_query($dbc, $query);
	 $i=0;
	while($row = mysqli_fetch_array($data)){
	$i++; 
	}
	
	echo '<li ';
	$current = $_SERVER['PHP_SELF'];
	if(basename($current) == 'members.php'){echo 'class="current"';}
	echo '><a href="http://www.cirrusidea.com/members.php"><b>Cirrus Idea Members:  ' . $i . '</b></a></li>';



$root = realpath($_SERVER["DOCUMENT_ROOT"]);  
$filename = $root . "/counter.txt"; // This is at root of the file using this script.
$fd = fopen ($filename, "r"); // opening the file counter.txt in read mode
$contents = fread ($fd, filesize($filename)); // reading the content of the file
fclose ($fd); // Closing the file pointer
$contents=$contents+1; // incrementing the counter value by one
echo '<li><b>MyCirrusIdea Page Views:  ' . $contents . '</b></li>'; // printing the incremented counter value

$filename = $root . "/mainpagecount.txt"; // This is at root of the file using this script.
$fd = fopen ($filename, "r"); // opening the file counter.txt in read mode
$contents = fread ($fd, filesize($filename)); // reading the content of the file
fclose ($fd); // Closing the file pointer
$contents=$contents+1; // incrementing the counter value by one
echo '<br /><b>Home Page Views:  ' . $contents . '</b>'; // printing the incremented counter value



echo '<h3>Cirrus Idea Folders</h3><br />';
$i=0;
echo '<table class="brain_table"><tr>';
while ($row1 = mysqli_fetch_array($data1)) { 
    // Display artwork from user_id
	echo '<td style="text-align:center"><a href="http://www.cirrusidea.com/removefolder.php?folder_id=' . $row1['file_id'] . '">' . $row1['file_name'] . '</a></td>';
    $i++;
	if ($i%10==0){
	echo '</tr><tr><td>&nbsp;</td></tr><tr>';
	}
		
  }

echo '</tr></table><br /><br /><br /><br />';


 
 
  // Retrieve the score data from MySQL
 $query = "SELECT * FROM creativebrainpower ORDER BY date DESC";

$data = mysqli_query($dbc, $query);
  
 if ($data!=NULL){
 
 
$i=0;
while ($row = mysqli_fetch_array($data)) { 
 

 $query2 = "SELECT username FROM cbp_user WHERE user_id ='"  . $row['member_id'] . "'";
  $data2 = mysqli_query($dbc, $query2);
  $row2 = mysqli_fetch_array($data2);

echo '<table class="brain_table">';
echo '<tr><td class="cbptd">Comments/Description: ' . '<td class="cbptd" colspan="2">' . $row['description'] . '</td></tr>';
    echo '<tr><td class="earttd">CBP Member: ' . '<td class="cbptd"><a href="http://www.cirrusidea.com/viewprofile.php?username=' . $row2['username'] . '">'. $row2['username'] . '</a></td>';
    echo '<td class="cbptd">Date: ' . '<td class="cbptd">' . $row['date'] . '</td></tr>';
	if ($row['filename']!=NULL){
	echo '<tr><th class="cbptd" colspan = "4"><a href="http://www.cirrusidea.com' . $row['file_id'] . '/' . $row['filename'] . '">Download Creative Brain File: ' . $row['filename'] . '</a></th></tr>';}
      echo '<td><a href="http://www.cirrusidea.com/removeupload.php?id=' . $row['id'] . '">Remove</a></td>';
    if ($row['approved'] == '0') {
      echo '<td><a href="http://www.cirrusidea.com/approveupload.php?id=' . $row['id'] . '">Approve</a></td></tr>';
    }
 echo '<tr><td>&nbsp;</td></tr>';
 echo '</table><br />';
 $i++;
 }

}
  

  mysqli_close($dbc);
 
 require_once('footer.php');
?>

 
 
 
 
 
 
 
 
 
 