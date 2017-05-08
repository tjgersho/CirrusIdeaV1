<?php
// Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Admin Members';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.

if (isset($_POST['deletemember'])){
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
     $userID = mysqli_real_escape_string($dbc, trim($_POST['userID']));
   
   $query126 = "SELECT * FROM cbp_user WHERE user_id = '". $userID."'";
    $data126 = mysqli_query($dbc, $query126);
     $row126 = mysqli_fetch_array($data126);
     
      $username = $row126['username'];
      
     $query = "DELETE FROM cbp_user WHERE user_id = '" . $userID . "'";
     mysqli_query($dbc, $query);
    
     $query = "DELETE FROM codevelopers WHERE codeveloper = '" . $username . "'";
     mysqli_query($dbc, $query);
     
     $query = "DELETE FROM codevelopers WHERE member = '" . $username . "'";
     mysqli_query($dbc, $query);
     
      $query = "DELETE FROM folderprivacy WHERE user_name = '" . $username . "'";
     mysqli_query($dbc, $query);
	 
	 
	 $query = "DELETE FROM comment WHERE to_member_name = '" . $username . "'";
     mysqli_query($dbc, $query);
	 
	  $query = "DELETE FROM comment WHERE post_member_id = '" . $userID . "'";
     mysqli_query($dbc, $query);
	 
	   $query = "DELETE FROM uploadprivacy WHERE user_name = '" . $username . "'";
     mysqli_query($dbc, $query);
	 
	 
     mysqli_close($dbc);
}



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
 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Retrieve the score data from MySQL



    $query = "SELECT * FROM cbp_user ORDER BY user_id DESC";
    $data = mysqli_query($dbc, $query);
	
	$i=0;
echo '<table style="position:relative; left:100px;"><tr><td>';	
while ($row = mysqli_fetch_array($data)) { 
echo '<table class="brain_table">';
	echo '<tr><td class="cbptd">User Names: </td>';
 
	echo '<tr><td class="cbptd"><a href="http://www.cirrusidea.com/viewprofile.php?username=' . $row['username'] . '">' . $row['username'] . '</a></td>';
    
    echo '<td class="cbptd">Email: ' . $row['email'] . '</td>';
    echo '<td class="cbptd">Date: ' . $row['join_date'] . '</td>';
    echo '<td>&nbsp;</td><td>';
    echo '<form method="post" action="' .  $SERVER['PHP_SELF'] . '">';
    echo '<input type="hidden" id="userID" name="userID" value="';
    
    echo $row['user_id'];
    
    echo '" />';
    echo $row['user_id'];
    echo '<input type="submit" name="deletemember" value="Delete"/>';
    
    echo '</form>';

    echo '</td></tr></table><br />';

   $i++;
 
}

echo '</td></tr></table>';
 
   mysqli_close($dbc);
 
 require_once('footer.php');
?>
