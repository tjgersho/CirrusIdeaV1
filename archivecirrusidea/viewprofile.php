<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Member Profile';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.

  if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';

    exit();
  
  }

  // Show the navigation menu
  require_once('navmenu.php');


  if (isset($_GET['username'])) {
    // Grab the score data from the GET
    $otheruser = $_GET['username'];
 }
  else if (isset($_POST['username'])) {
    // Grab the score data from the POST
  $otheruser = $_POST['username'];
  }
  else {
    echo '<p class="error">Sorry, this user is unavailable.</p>';
  }


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Retrieve the score data from MySQL

//Get max membercred variable///////////
/////////////////////////////////////////
 $query554 = "SELECT MAX(cred) AS max_cred FROM cbp_user";
 $data554 = mysqli_query($dbc, $query554);
   $row554  = mysqli_fetch_array($data554 );
  $max_cred = $row554['max_cred'];
  
if ($_POST['submit_comment']){

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  $comment = mysqli_real_escape_string($dbc, trim($_POST['comment']));
  $post_member_id = mysqli_real_escape_string($dbc, trim($_POST['post_member_id']));
  $to_member_name = mysqli_real_escape_string($dbc, trim($_POST['to_member_name'])); 
  $comment_private = mysqli_real_escape_string($dbc, trim($_POST['comment_private']));
  
	if ($comment_private == NULL){
	$comment_private = 1;
	}else{
	$comment_private = 0;
	}
	
	$query55 = "INSERT INTO comment (comment, post_member_id, to_member_name, comment_private) VALUES ('" . $comment . "', '" . $post_member_id . "', '" . $to_member_name . "', '" . $comment_private . "')";
	
	mysqli_query($dbc, $query55);
	
	echo 'Thanks for posting a comment to '. $otheruser;

	
	$query86 = "SELECT * FROM cbp_user WHERE username = '" . $to_member_name . "' LIMIT 1";
	$data86 = mysqli_query($dbc, $query86);
	$row86 = mysqli_fetch_array($data86);
	$useremail = $row86['email'];
	
	$query90 = "SELECT * FROM cbp_user WHERE user_id = '" . $post_member_id . "' LIMIT 1";
	$data90 = mysqli_query($dbc, $query90);
	$row90 = mysqli_fetch_array($data90);
	

	$to = "$useremail";
	$subject = "CirrusIdea.com - Comment";
	$message = "
 <html>
 <head>
 <title>A comment has been posted to your CirrusIdea profile.</title>
 </head>
 <body>
 <p>
 " . $row90['username'] . " wrote: <br />
 " . $comment . " 
 <br /><br />" . $to_member_name . ",  <a href='http://www.cirrusidea.com/mycreativebrainpower.php'>Log In</a>
 and checkout your profile.<br /><br />
 
 
 </p>
 </body>
 </html>
 ";
 
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
 //$headers .= "From: <webmaster@cirrusidea.com>," . $row90['email'] . "\r\n";
	$headers .= "From: " . $row90['email'] . "\r\n";
    
	mail($to,$subject,$message,$headers);
	
	
	


}




 if (isset($_GET['username'])) {
    $query = "SELECT * FROM cbp_user WHERE username = '" . $otheruser . "'";
  }
  
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
 
 echo '<p style="font-size:25px; text-align:center;"><b>CirrusIdea Profile Information for <i>' . $otheruser . '</i></b></p>';
 ?><form method="post" action="mycreativebrainpower.php" style="position:relative; left:830px; top:0px;">
 <input type="hidden" name="codeveloper" value="<?php echo $otheruser; ?>"/>
  <input type="submit" name="addfriend"  class="stylebutton"  value="Add to Your Co-Developer List"  <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> />
  </form>
  <?php
    // The user row was found so display the user data
    $row = mysqli_fetch_array($data);
    echo '<table style="margin-left:auto; margin-right:auto;">';
    if (!empty($row['username'])) {
      echo '<tr><td class="label">Username:</td><td>' . $row['username'] . '</td></tr>';
    }
    if (!empty($row['first_name'])) {
      echo '<tr><td class="label">First name:</td><td>' . $row['first_name'] . '</td></tr>';
    }
    if (!empty($row['last_name'])) {
      echo '<tr><td class="label">Last name:</td><td>' . $row['last_name'] . '</td></tr>';
    }
	
	 if (!empty($row['email'])) {
      echo '<tr><td class="label">Email:</td><td>' . $row['email'] . '</td></tr>';
    }
		
    if (!empty($row['city']) || !empty($row['state']) || !empty($row['country'])) {
      echo '<tr><td class="label">Location:</td><td>' . $row['city'] . ', ' . $row['state'] . ', ' . $row['country'] . '</td></tr>';
    }
	
	if (!empty($row['interest'])) {
      echo '<tr><td class="label">Interest:</td><td>';
     
        echo $row['interest'];
   
      }  
      else {
        echo '';
      }
      echo '</td></tr>';
   
       ///////Cred Calcs and script for display /////////
     $credpercentage = round(($row['cred']/ $max_cred)*100,0);
    

   
      echo '<tr><td class="label">Member-Cred:</td><td width="250px"><div style ="width:200px; border-style:solid; border-width:1px;"><div id="memcred' . $row['user_id'] . '" style=""><div style ="width:100px;"><img src="/images/postcredbrain.png" height="30px" style="z-index:+2"/>' . $row['cred'] . '</div></div></div></td></tr>';

if ($credpercentage >= 0) {
?>
<script>
document.getElementById("memcred<?php echo $row['user_id']; ?>").style.backgroundColor="#5CE62E";
document.getElementById("memcred<?php echo $row['user_id']; ?>").style.width=<?php echo $credpercentage; ?> + "%";
</script>
<?php
} else {
 ?>
<script>
document.getElementById("memcred<?php echo $row['user_id']; ?>").style.backgroundColor="red";
document.getElementById("memcred<?php echo $row['user_id']; ?>").style.width="100%";
</script>
<?php     
}

    
    echo '</table>';

function parsedescription($descip){
    
  $data = explode("\\",$descip);
       $descip = implode("",$data);
       $descip = stripslashes($descip); 

        return $descip;   
}

?>

  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?username=' . $otheruser; ?>"> 
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo CBP_MAXFILESIZE; ?>" />   
    <table style="margin-left:auto;margin-right:auto;"><tr><td> 
	<p class="italic">Write a comment to <?php echo $otheruser; ?></p></td></tr>
	<tr><td><textarea <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> rows="4" cols="80" onKeyUp="forceReturn('75', this.value);"  id="comment" name="comment"></textarea></td></tr>
    <tr><td><label for="private">Make Public:</label><input type="checkbox" id="comment_private" name="comment_private" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> />
	<input type="hidden" id="post_member_id" name="post_member_id" value="<?php echo $_SESSION['user_id']; ?>" />  
	<input type="hidden" id="to_member_name" name="to_member_name" value="<?php echo $otheruser; ?>" />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="submit_comment" type="submit"  class="stylebutton"  id="submit_comment" value="Comment" <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?>  /></td></tr></table>
  </form> 
   

 <br /><br />
 
 
 
 
 
 <?php
 
 
 } // End of check for a single row of user results
  else {
    echo '<p class="error">There was a problem accessing this profile.<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></p>';
  }




  function findexts ($filename) 
 { 
 $filename = strtolower($filename) ; 
 $exts = split("[/\\.]", $filename) ; 
 $n = count($exts)-1; 
 $exts = $exts[$n]; 
 return $exts; 
 } 



 $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $results_per_page = 10;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);

 

// This function builds navigational page links based on the current page and the number of pages
  function generate_page_links($cur_page, $num_pages, $otheruser) {
    $page_links = '';
 
 // If this page is not the first page, generate the "previous" link
    if ($cur_page > 1) {
      $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?username=' . $otheruser . '&page=' . ($cur_page - 1) . '"><-</a> ';
    }
    else {
      $page_links .= '<- ';
    }

    // Loop through the pages generating the page number links
    for ($i = 1; $i <= $num_pages; $i++) {
      if ($cur_page == $i) {
        $page_links .= ' ' . $i;
      }
      else {
        $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?username=' . $otheruser . '&page=' . $i . '"> ' . $i . '</a>';
      }
    }
	
 // If this page is not the last page, generate the "next" link
    if ($cur_page < $num_pages) {
      $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?username=' . $otheruser . '&page=' . ($cur_page + 1) . '">-></a>';
    }
    else {
      $page_links .= ' ->';
    }

    return $page_links;
  }






echo ' <br /><br /><div class="sidebar_container1"><div id="sidebar1">';

//Interest table.
echo '<table style="width:400px;">';

echo '<h4>Cirrus Comments:</h4>';
echo '<td>';


 $cur_page2 = isset($_GET['page2']) ? $_GET['page2'] : 1;
  $results_per_page2 = 10;  // number of results per page
  $skip2 = (($cur_page2 - 1) * $results_per_page2);

 

// This function builds navigational page links based on the current page and the number of pages
  function generate_page_links_again1($cur_page2, $num_pages2) {
    $page_links2 = '';
 
 // If this page is not the first page, generate the "previous" link
    if ($cur_page2 > 1) {
      $page_links2 .= '<a href="' . $_SERVER['PHP_SELF'] . '?page2=' . ($cur_page2 - 1) . '&username=' . $otheruser . '"><-</a> ';
    }
    else {
      $page_links2 .= '<- ';
    }

    // Loop through the pages generating the page number links
    for ($i = 1; $i <= $num_pages2; $i++) {
      if ($cur_page2 == $i) {
        $page_links2 .= ' ' . $i;
      }
      else {
        $page_links2 .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page2=' . $i . '&username=' . $otheruser . '"> ' . $i . '</a>';
      }
    }
	
 // If this page is not the last page, generate the "next" link
    if ($cur_page2 < $num_pages2) {
      $page_links2 .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page2=' . ($cur_page2 + 1) . '&username=' . $otheruser . '">-></a>';
    }
    else {
      $page_links2 .= ' ->';
    }

    return $page_links2;
  }




$query15 = "SELECT * FROM comment WHERE to_member_name = '"  . $otheruser . "' AND comment_private ='0' AND deleted IS NULL";
$result15 = mysqli_query($dbc, $query15);
if ($result15!=NULL){


  $total23 = mysqli_num_rows($result15);
  
 $total13 = $total13 +$total23;
 
 }

 
  $num_pages2 = ceil($total13 / $results_per_page2);
  





  $query14 = "SELECT * FROM comment WHERE to_member_name = '"  . $otheruser . "' AND comment_private ='0'  AND deleted IS NULL ORDER BY comment_date DESC LIMIT $skip2, $results_per_page2";
  $data14 = mysqli_query($dbc, $query14);
if ($data14!=NULL){

    
 //user_id = '"  . $_SESSION['user_id'] . "' AND
 

$i=0;
while ($row14 = mysqli_fetch_array($data14)) { 
    // Display artwork from user_id

  $query26 = "SELECT username FROM cbp_user WHERE user_id ='"  . $row14['post_member_id'] . "'";
  $data26 = mysqli_query($dbc, $query26);
  $row26 = mysqli_fetch_array($data26);
  if($row14['comment_private']==1 && $_SESSION['user_name']==$otheruser){
	echo '<table style="border:1px solid black; width:500px;">';
	echo '<tr><td class="cbptd2">Comment: ' . '<td class="cbptd2" colspan="3">' . parsedescription($row14['comment']) . '</td></tr>';
	echo '<tr><td class="cbptd2">Posted by: ' . '<td class="cbptd2">' . $row26['username'] . '</td>';
    echo '<td class="cbptd2">Date: ' . '<td class="cbptd2">' . $row14['comment_date'] . '</td></tr>';
	echo '<tr><td>';
	
	echo '<b>This is a Private Comment</b>';
	echo '</td></tr></table><br />';
	
	}else if($row14['comment_private']==0){
	echo '<table style="border:1px solid black; width:500px;">';
	echo '<tr><td class="cbptd2">Comment: ' . '<td class="cbptd2" colspan="3">' . parsedescription($row14['comment']) . '</td></tr>';
	echo '<tr><td class="cbptd2">Posted by: ' . '<td class="cbptd2"><a href="http://www.cirrusidea.com/viewprofile.php?username=' . $row26['username'] . '">'.$row26['username'].'</a></td>';
    echo '<td class="cbptd2">Date: ' . '<td class="cbptd2">' . $row14['comment_date'] . '</td></tr>';
	echo '</td></tr></table><br />';
	
	}
	

   $i++;
 
  }
 

 } 
 
  // Generate navigational page links if we have more than one page
  if ($num_pages2 > 1) {
 echo '<p style="text-align:left;">'; 
    echo generate_page_links_again1($cur_page2, $num_pages2);
	echo '</p>';
  }
 echo '<br /><br /><br /><br />'; 
echo '</td>';



echo '</table>';

echo '</div></div>';










 
echo '<div id="content1"> <br /><br />';
echo '<table style="width:400px;">';
echo '<td>';
echo '<h4>'. $otheruser . ' CirrusIdea posts:</h4>';



$file_dir = dirname($_SERVER['PHP_SELF']);

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 $query4 = "SELECT * FROM cbp_user WHERE username ='"  . $otheruser . "'";
  $data4 = mysqli_query($dbc, $query4);
  $row4 = mysqli_fetch_array($data4);

  $query = "SELECT * FROM creativebrainpower WHERE member_id = '"  . $row4['user_id'] . "' AND approved = 1 AND private = 0 ORDER BY date ASC";
 $result = mysqli_query($dbc, $query);
  $total = mysqli_num_rows($result);
  $num_pages = ceil($total / $results_per_page);
 
 
 $query = "SELECT * FROM creativebrainpower WHERE member_id = '"  . $row4['user_id'] . "' AND approved = 1 AND private = 0 ORDER BY date ASC LIMIT $skip, $results_per_page";
  $data = mysqli_query($dbc, $query);

   
 if ($data!=NULL){
 
 
$i=0;
while ($row = mysqli_fetch_array($data)) { 
 $show = 0;
if ($row['private']=='1'){

$query99 = "SELECT user_name FROM uploadprivacy WHERE upload_id ='"  . $row['id'] . "'";
  $data99 = mysqli_query($dbc, $query99);
  while($row99 = mysqli_fetch_array($data99)){
 if($row99['user_name']==$_SESSION['username']){
 $show=1;
 }
 }

if($show==1){

  $query2 = "SELECT username FROM cbp_user WHERE user_id ='"  . $row['member_id'] . "'";
  $data2 = mysqli_query($dbc, $query2);
  $row2 = mysqli_fetch_array($data2);

echo '<table style="border:1px solid black; width:500px;">';
echo '<tr><td class="cbptd2">Project File: </td><td colspan="3"><a href="http://www.cirrusidea.com' . $row['file_id'] . '">' . substr($row['file_id'], 0, 50) . '</a></td></tr>';
echo '<tr><td class="cbptd2">Comments/Description: <td class="cbptd2" colspan="3">' . substr(parsedescription($row['description']), 0, 50) . '</td></tr>';
    echo '<tr><td class="cbptd2">CirrusIdea Member: ' . $row2['username'] . '</td>';
    echo '<td class="cbptd2">Date: </td><td class="cbptd2">' . $row['date'] . '</td></tr>';
	if ($row['filename']!=NULL){
		$file1 = $row['filename'];
		$fileext = findexts ($file1);
		
	    if (($fileext == 'png')|| ($fileext == 'jpg') || ($fileext == 'gif') || ($fileext == 'jpeg') || ($fileext == 'jpeg')){
             
                 $pic_parts = pathinfo( $file1);
                  $extension = $pic_parts['extension'];
                 $thumbpicname = $pic_parts['filename'] . 'thum63820.'. $extension;
             
						echo '<tr><th class="cbptd2" colspan = "4"><a href="http://www.cirrusidea.com' . $row['file_id'] . '/index.php?path=' . $row['file_id'] . '/' . $row['filename'] . '"><img src="http://www.cirrusidea.com' .$row['file_id'] . '/' . $thumbpicname . '" alt="Creative Image" width="200" /></a></th></tr>';
	    } else {
	echo '<tr><th class="cbptd2" colspan = "4"><a href="http://www.cirrusidea.com' . $row['file_id'] . '/index.php?path=' . $row['file_id'] . '/' . $row['filename'] . '">Cirrus Idea File: ' . substr($row['filename'], 0, 25) . '</a></th></tr>';
		}
	 }
    echo '<tr><td class="cbptd2" colspan = "4">';
	if ($_SESSION['user_id']==$row['member_id']){
	echo '<a href="http://www.cirrusidea.com/postremove.php?member_id=' . $row['member_id'] . '&id=' . $row['id']. '">Remove</a>';
	}
	echo '</td><td class="cbptd2" colspan = "4">';
	
	if ($_SESSION['user_id']==$row['member_id']){
	echo '<form enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '?username=' . $otheruser . '">';
	echo '<input type="hidden" name="upload_id" value="' . $row['id']  . '" />';
	echo '<label for="sharename">Share with another member, Enter their Username: </label><input type="text" name="sharename" id="sharename" />';
    echo '<input type="submit" value="Share File" name="sharefile"/></form>';
	}
	echo '</td></tr></table><br />';
 }
 
 }else{
 
 $show = 1;
 
 if($show == 1){
 
 $query2 = "SELECT username FROM cbp_user WHERE user_id ='"  . $row['member_id'] . "'";
  $data2 = mysqli_query($dbc, $query2);
  $row2 = mysqli_fetch_array($data2);


echo '<table style="border:1px solid black; width:500px;">';
echo '<tr><td class="cbptd2">Project File: </td><td colspan="3"><a href="http://www.cirrusidea.com' . $row['file_id'] . '">' . substr($row['file_id'], 0, 50) . '...</a></td></tr>';
echo '<tr><td class="cbptd2">Comments/Description: </td><td class="cbptd2" colspan="3">' . substr($row['description'], 0, 50) . '...</td></tr>';
    echo '<tr><td class="cbptd2">CirrusIdea Member: ' . $row2['username'] . '</td>';
    echo '<td class="cbptd2">Date: </td><td class="cbptd2">' . $row['date'] . '</td></tr>';
	if ($row['filename']!=NULL){
		$file1 = $row['filename'];
		$fileext = findexts ($file1);
		
	if (($fileext == 'png')|| ($fileext == 'jpg') || ($fileext == 'gif') || ($fileext == 'jpeg') || ($fileext == 'jpeg')){
             
                 $pic_parts = pathinfo( $file1);
                  $extension = $pic_parts['extension'];
                 $thumbpicname = $pic_parts['filename'] . 'thum63820.'. $extension;
             
    					echo '<tr><th class="cbptd2" colspan = "4"><a href="http://www.cirrusidea.com' . $row['file_id'] . '/index.php?path=' . $row['file_id'] . '/' . $row['filename'] . '"><img src="http://www.cirrusidea.com' .$row['file_id'] . '/' . $thumbpicname . '" alt="Creative Image" width="200" /></a></th></tr>';
	    } else {
	echo '<tr><th class="cbptd2" colspan = "4"><a href="http://www.cirrusidea.com' . $row['file_id'] . '/index.php?path=' . $row['file_id'] . '/' . $row['filename'] . '">Cirrus Idea File: ' . substr($row['filename'], 0, 25) . '</a></th></tr>';
		}
	 }
    echo '<tr><td class="cbptd2" colspan = "4">';
	if ($_SESSION['user_id']==$row['member_id']){
	echo '<a href="http://www.cirrusidea.com/postremove.php?member_id=' . $row['member_id'] . '&id=' . $row['id']. '">Remove</a>';
	}
	echo '</td></tr></table><br />';
 
 
 
 
 
 }
 
 }
 
 $i++;
 
 
 }
 
 

}



  // Generate navigational page links if we have more than one page
  if ($num_pages > 1) {
 echo '<p style="text-align:center">'; 
    echo generate_page_links($cur_page, $num_pages, $otheruser);
	echo '</p>';
  }
 
echo '</td>';



echo '</table>';

echo '</div>';



  mysqli_close($dbc);

  // Insert the page footer
  require_once('footer.php');
 
 ?>
