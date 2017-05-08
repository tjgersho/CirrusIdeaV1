<?php  
  // Start the session
require_once('startsession.php');
$root = realpath($_SERVER["DOCUMENT_ROOT"]);  


  // Insert the page header
 $page_title = 'My Cirrus Idea';
  require_once('header.php');
 
  require_once('appvars.php'); 
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.

if (!isset($_SESSION['user_id'])) {
     $page_title = $foldername1;
  require_once($root.'/header.php');
   require_once($root.'/navmenu.php');
   echo '<p> You are not logged in.  Enter your username and password above. </p>';
   
   // Insert the page footer
  require_once($root.'/footer.php');
    exit();
  
  }
  
  
  ///Delete comment action//////////
  ///////////////////////////////////
  
  if (isset($_POST['deletecomment'])){
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   $commentid = $_POST['commentid'];
    $query = "UPDATE comment SET deleted = '1' WHERE comment_id = '". $commentid . "'";
        mysqli_query($dbc, $query);
  
  }
  ///////////////////////////////////////////
  

  // Show the navigation menu
require_once($root.'/navmenu.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//Get max membercred variable///////////
/////////////////////////////////////////
 $query554 = "SELECT MAX(cred) AS max_cred FROM cbp_user";
 $data554 = mysqli_query($dbc, $query554);
   $row554  = mysqli_fetch_array($data554 );
  $max_cred = $row554['max_cred'];
  
//////////////////////////////////////////////////////////////



/////////////////Developer and Investor SnapShot/////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
echo '<div style="position:relative; float: right; top:-200px; right:20px;">';
echo '<table border="1"><tr><td width="200">';
$query7775 = "SELECT * FROM investments WHERE investor = '" . $_SESSION['user_id'] . "'";
	$data7775 = mysqli_query($dbc, $query7775);
$capital_invested = 0;	
	while ($row7775 = mysqli_fetch_array($data7775))
	{
$capital_invested = $capital_invested + $row7775['amount'];

}

echo '<b style="font-size:12px;">Your cash in CirrusIdea Projects: $';
echo $capital_invested;
echo '</b></td><td>';

echo '<b style="font-size:12px;"><a href="http://www.cirrusidea.com/cashmanagementpage.php" style="font-size:12px;">Cash Management</a></b>';

echo '</td></tr><tr><td>';


$query7755 = "SELECT DISTINCT projectfolder_id FROM developervote WHERE developer_name = '" . $_SESSION['username'] . "' AND developer_percentage > 0";
	$data7755 = mysqli_query($dbc, $query7755);
$developer_count=0;
	while ($row7755 = mysqli_fetch_array($data7755))
	{
		$developer_count++;
	}
if ($developer_count>0){
echo '<b style="font-size:12px;">You have been voted as a developer for ';
echo $developer_count;
echo ' projects.</b></td><td>';
echo '<b style="font-size:12px;"><a href="http://www.cirrusidea.com/developerpage.php" style="font-size:12px;">Developer Management</a></b></td></tr></table>';
} else {
echo '<b style="color:#8B0000; font-size:12px;">You have been voted as a developer for ';
echo $developer_count;
echo ' projects.</b></td><td>';
echo '<b style="color:#8B0000; font-size:12px;">Start developing ideas.</b></td></tr></table>';
}

echo '</div>';

///////////////////////////////////////////////////////////////////////////

////////////////Add to co-developer action/////////////////////////////////
///////////////////////////////////////////////////////////////////////

if (isset($_POST['addfriend'])){
 $query335 = "SELECT * FROM codevelopers WHERE member = '" . $_SESSION['username'] . "' AND codeveloper = '" . $_POST['codeveloper']. "'";
 $data335 = mysqli_query($dbc, $query335);
$i=0;

while($row335 = mysqli_fetch_array($data335)){
$i=1;
break;
};


 if($i){
	echo '<b>' . $_POST['codeveloper']. '</b> is alread in your co-developer list.<br /><br /><br /><br />';
	
	}else{
	$query67 = "INSERT INTO codevelopers (member, codeveloper) VALUES ('" . $_SESSION['username'] . "', '" . $_POST['codeveloper'] . "')";
	mysqli_query($dbc, $query67);
	
	}
	
}


///////////////////////////////////////////////////////////////////////////////////


////////////////Add to quicklink action/////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['addquicklink'])){
 $query3135 = "SELECT * FROM quicklinks WHERE member_id = '" . $_SESSION['user_id'] . "' AND quicklink = '" . $_POST['quicklink']. "'";
 $data3135 = mysqli_query($dbc, $query3135);
$i=0;

while($row3135 = mysqli_fetch_array($data3135)){
$i=1;
break;
}

 if($i){
    echo '<b>' . substr(dirname($_POST['quicklink']), -40) . ' </b> is alread in your QuickLink list.<br /><br /><br /><br />';
	
	}else{
	$query617 = "INSERT INTO quicklinks (member_id, quicklink) VALUES ('" . $_SESSION['user_id'] . "', '" . $_POST['quicklink'] . "')";
	mysqli_query($dbc, $query617);
	
	}
	
}
///////////////////////////////////////////////////////////////////////////////////



 if (!isset($_GET['user_id'])) {
    $query = "SELECT * FROM cbp_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
  else {
    $query = "SELECT * FROM cbp_user WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  $data = mysqli_query($dbc, $query);
 
if ($_SESSION['newuser']){
?>
<div><div style="float:left;"><p><span class="hotspot" onmouseover="tooltip.show('Your new home page! Here you can see your information, recent posts of yours and other member posts who may have your common interests. Also on the right, you can have running comments and conversations with other members. Also on the right there are three buttons which are very useful, QuickLinks, Co-Developers, and Invite a Friend.', 300);" onmouseout="tooltip.hide();">Hover-Help</span></p></div>
<?php
}

if ($_SESSION['newuser']){
?>
<div style="float:left;"><p><span class="hotspot" onmouseover="tooltip.show('Notice at the top right of the page there is a Cash Management link and a developer link.  These allow you to manage your cash stake and your projects you have in development that has recieved cash and you were voted as the developer. You can invest in projects by browsing CirrusIdeas and at the top right of a Project Page you can invest an equity dollar amount to the project.  To get investment dollars for your project create your project today. <br /><br /> <strong>Next Tour Stop</strong>:  Click on the <i>Edit Profile/Your Folders</i> tab.', 600);" onmouseout="tooltip.hide();">More Hover-Help</span></p></div>
</div><br />
<?php
}
 
 
  if (mysqli_num_rows($data) == 1) {

 echo '<p style="font-size:25px; text-align:center; position:relative;"><b>Your CirrusIdea Home Page</b></p>';


 
    // The user row was found so display the user data
    $row = mysqli_fetch_array($data);
    echo '<table style="position:relative; left:0px;">';
    if (!empty($row['username'])) {
      echo '<tr><td class="label">Username:</td><td>' . $row['username'] . '</td></tr>';
    }else{
         echo '<tr><td class="label"></td></tr>';
    }
    if (!empty($row['first_name'])) {
      echo '<tr><td class="label">First name:</td><td>' . $row['first_name'] . '</td></tr>';
    }else{
         echo '<tr><td class="label"></td></tr>';
    }
    if (!empty($row['last_name'])) {
      echo '<tr><td class="label">Last name:</td><td>' . $row['last_name'] . '</td></tr>';
    }else{
         echo '<tr><td class="label"></td></tr>';
    }
	
	 if (!empty($row['email'])) {
      echo '<tr><td class="label">Email:</td><td>' . $row['email'] . '</td></tr>';
    }else{
         echo '<tr><td class="label"></td></tr>';
    }
		
    if (!empty($row['city']) || !empty($row['state']) || !empty($row['country'])) {
      echo '<tr><td class="label">Location:</td><td>' . $row['city'] . ', ' . $row['state'] . ', ' . $row['country'] . '</td></tr>';
    }else{
         echo '<tr><td class="label"></td></tr>';
    }
	
	if (!empty($row['interest'])) {
      echo '<tr><td class="label">Interest:</td><td>';
     
        echo $row['interest'];
   
      }  
      else {
        echo '<tr><td><a href="editprofile.php">Enter your CirrusIdea info</a>';
      }
      echo '</td></tr>';
	  
      echo '<tr><td class="label">Enable E-mails?</td><td>';
	   if($row['mailme'] == 1){
	   echo 'YES';
	   }else{
	   echo 'NO';
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

   
  } // End of check for a single row of user results
 
  else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
  }

	
if ($_SESSION['username'] != 'tjgersho'){
$filename = "counter.txt"; // This is at root of the file using this script.
$fd = fopen ($filename, "r"); // opening the file counter.txt in read mode
$contents = fread ($fd, filesize($filename)); // reading the content of the file
fclose ($fd); // Closing the file pointer
$contents=$contents+1; // incrementing the counter value by one

/* 
The above code will do the reading and displaying the counter to the screen, now we have to store the above value in the same counter.txt file by overwriting the old data with the new counter data. We will open the counter.txt file in write mode and then write to it.
*/

$fp = fopen ($filename, "w"); // Open the file in write mode
fwrite ($fp,$contents); // Write the new data to the file
fclose ($fp); // Closing the file pointer 
}



 echo '<div id="content">';
 
?>

<script language="javascript">
 function forceReturn(iMaxLength, sValue){
 if (sValue.length > iMaxLength){
 sValue = sValue + "\r";
		}
	}
 </script>

<?php

function parsedescription($descip){
    
  $data = explode("\\",$descip);
       $descip = implode("",$data);
       $descip = stripslashes($descip); 

        return $descip;   
}


function findexts ($filename) 
 { 
 $filename = strtolower($filename) ; 
 $exts = split("[/\\.]", $filename) ; 
 $n = count($exts)-1; 
 $exts = $exts[$n]; 
 return $exts; 
 } 
 

//Interest table.

echo '<h4>Other member posts you might be interested in:</h4>';



 $cur_page1 = isset($_GET['page1']) ? $_GET['page1'] : 1;
  $results_per_page1 = 5;  // number of results per page
  $skip1 = (($cur_page1 - 1) * $results_per_page1);

 

// This function builds navigational page links based on the current page and the number of pages
  function generate_page_links_again($cur_page1, $num_pages1) {
    $page_links1 = '';
 
 // If this page is not the first page, generate the "previous" link
    if ($cur_page1 > 1) {
      $page_links1 .= '<a href="' . $_SERVER['PHP_SELF'] . '?page1=' . ($cur_page1 - 1) . '"><-</a> ';
    }
    else {
      $page_links1 .= '<- ';
    }

    // Loop through the pages generating the page number links
    for ($i = 1; $i <= $num_pages1; $i++) {
      if ($cur_page1 == $i) {
        $page_links1 .= ' ' . $i;
      }
      else {
        $page_links1 .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page1=' . $i . '"> ' . $i . '</a>';
      }
    }
    
 // If this page is not the last page, generate the "next" link
    if ($cur_page1 < $num_pages1) {
      $page_links1 .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page1=' . ($cur_page1 + 1) . '">-></a>';
    }
    else {
      $page_links1 .= ' ->';
    }

    return $page_links1;
  }

$query58 = "SELECT * FROM cbp_user WHERE user_id = '"  . $_SESSION['user_id'] . "' LIMIT 1";
$data58 = mysqli_query($dbc, $query58);
$row58 = mysqli_fetch_array($data58);
if(isset($row58['interest'])){
$userinterest = $row58['interest'];


$query45 = "SELECT user_id FROM cbp_user WHERE interest = '"  . $userinterest . "'";
$data45 = mysqli_query($dbc, $query45);

$i = 0;
while ($row45 = mysqli_fetch_array($data45)){

$memberarray[$i] = $row45['user_id'];

$i++;

}
$total1 = 0;
foreach($memberarray as $m3mber){
if ($m3mber != $_SESSION['user_id']){
$query1 = "SELECT * FROM creativebrainpower WHERE member_id = '"  . $m3mber . "' AND approved = 1 AND private = 0 ORDER BY date DESC LIMIT 5";
$result1 = mysqli_query($dbc, $query1);
if ($result1!=NULL){


  $total2 = mysqli_num_rows($result1);
  
 $total1 = $total1 +$total2;
 
 }
 }
 }
 
  $num_pages1 = ceil($total1 / $results_per_page1);

foreach($memberarray as $m3mber){


if ($m3mber == $m3mbertemp){
$h++;
}else {
$h=0;
}

$m3mbertemp = $m3mber;

if ($h<6){

if ($m3mber != $_SESSION['user_id']){
  $query1 = "SELECT * FROM creativebrainpower WHERE member_id = '"  . $m3mber . "' AND approved = 1 AND private = 0 ORDER BY date DESC LIMIT $skip1, $results_per_page1";
  $data1 = mysqli_query($dbc, $query1);
if ($data1!=NULL){




  // Loop through the array of score data, formatting it as HTML 
 //user_id = '"  . $_SESSION['user_id'] . "' AND
 

$i=0;
while ($row = mysqli_fetch_array($data1)) { 
    // Display artwork from user_id

  $query2 = "SELECT username FROM cbp_user WHERE user_id ='"  . $row['member_id'] . "'";
  $data2 = mysqli_query($dbc, $query2);
  $row2 = mysqli_fetch_array($data2);

  
	echo '<table style="background-color:#FFFFFF;">';
	echo '<tr><td class="cbptd2">Project File: <td class="cbptd2" colspan="3"><a href="http://www.cirrusidea.com' . $row['file_id'] . '">' . substr($row['file_id'], 0, 50) . '</a></td></tr>';
	echo '<tr><td class="cbptd2">Description: <td class="cbptd2" colspan="3">' . substr(parsedescription($row['description']), 0, 40) . '</td></tr>';
    echo '<tr><td class="cbptd2">Contibutor: <td class="cbptd2">' . $row2['username'] . '</td>';
    echo '<td class="cbptd2">Date: <td class="cbptd2">' . $row['date'] . '</td></tr>';
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

	
	
    	echo '<tr><td>&nbsp;</td></tr></table><br />';

   $i++;
 
  }
 
 }
 
 }
 }
 }
 
  // Generate navigational page links if we have more than one page
  if ($num_pages1 > 1) {
 echo '<p style="text-align:left;">'; 
    echo generate_page_links_again($cur_page1, $num_pages1);
	echo '</p>';
  }
 echo '<br /><br /><br /><br />'; 


}else{
echo '<p style="color:red;">Enter your <a href="http://www.cirrusidea.com/editprofile.php">interest</a> to see other postings<br />of people with the same interest</p>';
echo '</table>';
}
 
 $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $results_per_page = 5;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);

 

// This function builds navigational page links based on the current page and the number of pages
  function generate_page_links($cur_page, $num_pages) {
    $page_links = '';
 
 // If this page is not the first page, generate the "previous" link
    if ($cur_page > 1) {
      $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page - 1) . '"><-</a> ';
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
        $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '"> ' . $i . '</a>';
      }
    }
	
 // If this page is not the last page, generate the "next" link
    if ($cur_page < $num_pages) {
      $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page + 1) . '">-></a>';
    }
    else {
      $page_links .= ' ->';
    }

    return $page_links;
  }

$query = "SELECT * FROM creativebrainpower WHERE member_id = '"  . $_SESSION['user_id'] . "' AND approved = 1 ORDER BY date DESC";
$result = mysqli_query($dbc, $query);
  $total = mysqli_num_rows($result);
  $num_pages = ceil($total / $results_per_page);
  
  $query = "SELECT * FROM creativebrainpower WHERE member_id = '"  . $_SESSION['user_id'] . "' AND approved = 1 ORDER BY date DESC LIMIT $skip, $results_per_page";
  $data = mysqli_query($dbc, $query);



  // Loop through the array of score data, formatting it as HTML 
 //user_id = '"  . $_SESSION['user_id'] . "' AND

 echo '<h4>Your posts:</h4>';
$i=0;
while ($row = mysqli_fetch_array($data)) { 
    // Display artwork from user_id
 
  $query2 = "SELECT username FROM cbp_user WHERE user_id ='"  . $row['member_id'] . "'";
  $data2 = mysqli_query($dbc, $query2);
  $row2 = mysqli_fetch_array($data2);

  
	echo '<table style="background-color:#FFFFFF;">';
	echo '<tr><td class="cbptd2">Project File: <td class="cbptd2" colspan="3"><a href="http://www.cirrusidea.com' . $row['file_id'] . '">' . substr($row['file_id'], 0, 50) . '</a></td></tr>';
	echo '<tr><td class="cbptd2">Description: <td class="cbptd2" colspan="3">' .   substr(parsedescription($row['description']), 0, 40) . '</td></tr>';
    echo '<tr><td class="cbptd2">Contibutor: <td class="cbptd2">' . $row2['username'] . '</td>';
    echo '<td class="cbptd2">Date: ' . '<td class="cbptd2">' . $row['date'] . '</td></tr>';
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

	
	
    	echo '<tr><td>&nbsp;</td></tr></table><br />';

   $i++;
 
  }
 
 

  // Generate navigational page links if we have more than one page
  if ($num_pages > 1) {
 echo '<p style="text-align:left; position:relative; left:20px;">'; 
    echo generate_page_links($cur_page, $num_pages);
	echo '</p>';
  }
 

echo '</div>';



 echo '<div id="sidebar_container"><div id="sidebar">';


?>
<span>
<?php 
if ($_SESSION['newuser']){
?>
<span class="hotspot" onmouseover="tooltip.show('The Quick Links button displays links to your favorite places in the CirrusIdea cloud.  You can add a Quick Link by browsing CirrusIdeas and once you get to a place of interest, and want to add it to your Quick Links, just press the <i>Add to Quick Links</i> button.', 300);" onmouseout="tooltip.hide();">
<?php
}
?>
<form style="text-align:left; position:relative; display:inline;">
<input type="button" name="quicklinkbutton" id="quicklinkbutton" value="Quick Links" onclick="quicklinkfunc()" />
<iframe id="quicklinkframe" src="" width="600" height="200" style="display:none; z-index:+2; background-color:transparent;" allowtransparency="true" scrolling="yes" frameborder="0"></iframe>
</form>
<?php 
if ($_SESSION['newuser']){
echo '</span>'; }


if ($_SESSION['newuser']){
?>
<span class="hotspot" onmouseover="tooltip.show('The Co-Developers button displays your Co-Developers, these are other members of CirrusIdea who may have common interests and you found them in a project folder you are fond of, or they are a friend you invited to join CirrusIdea.  You can add a new Co-Developer by browsing CirrusIdeas and if you find a person who may be a good Co-Developer click on their username link and then once on their home page click the  <i>Add as a Co-Developer</i> button.', 300);" onmouseout="tooltip.hide();">
<?php
}
?>

<form style="text-align:left; position:relative; display:inline;">
<input type="button" name="codevelopersbutton" id="codevelopersbutton" value="Your Co-Developers" onclick="codeveloperbuttonfunc()" />
<iframe id="codevelopers" src="" width="600" height="250" style="display:none; z-index:+2; background-color:transparent; overflow:auto;" allowtransparency="true" scrolling="yes" frameborder="0"></iframe>
</form>
<?php 
if ($_SESSION['newuser']){
echo '</span>'; }

if ($_SESSION['newuser']){
?>
<span class="hotspot" onmouseover="tooltip.show('Invite a friend to join.  Once you invite them, they\'ll also be a new Co-Developer of yours.', 300);" onmouseout="tooltip.hide();">
<?php
}
?>
<form style="text-align:left; position:relative; display:inline;">
<input type="button" name="invitefriendbutton" id="invitefriendbutton" value="Invite Friend to Join CirrusIdea.com" onclick="invitefriendfunc()" />
<iframe id="invitefriend" src="" width="300" height="200" style="display:none; z-index:+2; background-color:transparent;" allowtransparency="true" scrolling="no" frameborder="0"></iframe>
</form>
<?php 
if ($_SESSION['newuser']){
echo '</span>'; }
?>
</span>


<script>
function codeveloperbuttonfunc(){
codebutton = document.getElementById('codevelopersbutton');

if (codebutton.value =="Your Co-Developers"){
codebutton.value = "Close Co-Developers List";
}else{
codebutton.value = "Your Co-Developers";
}

f = document.getElementById('codevelopers'); 
if(f.style.display=='block')
{ f.style.display='none';
}else{ 
f.style.display='block'; 
}  

f.src='http://www.cirrusidea.com/codevelopers.php';
} 


function invitefriendfunc(){
invfrbutton = document.getElementById('invitefriendbutton');

if (invfrbutton.value =="Invite Friend to Join CirrusIdea.com"){
invfrbutton.value = "Close Invite";
}else{
invfrbutton.value = "Invite Friend to Join CirrusIdea.com";
}

f = document.getElementById('invitefriend'); 
if(f.style.display=='block')
{ f.style.display='none';
}else{ 
f.style.display='block'; 
}  

f.src='http://www.cirrusidea.com/invitefriend.php';
} 


function quicklinkfunc(){
invfrbutton = document.getElementById('quicklinkbutton');

if (invfrbutton.value =="Quick Links"){
invfrbutton.value = "Close Quick Links";
}else{
invfrbutton.value = "Quick Links";
}

f = document.getElementById('quicklinkframe'); 
if(f.style.display=='block')
{ f.style.display='none';
}else{ 
f.style.display='block'; 
}  

f.src='http://www.cirrusidea.com/quicklinks.php';
} 



</script>
  



 <?php
 

//echo '<table width:400px;">';

echo '<h4 style="position:relative;">Cirrus Comments:</h4>';
//echo '<td>';


 $cur_page2 = isset($_GET['page2']) ? $_GET['page2'] : 1;
  $results_per_page2 = 10;  // number of results per page
  $skip2 = (($cur_page2 - 1) * $results_per_page2);

 

// This function builds navigational page links based on the current page and the number of pages
  function generate_page_links_again1($cur_page2, $num_pages2) {
    $page_links2 = '';
 
 // If this page is not the first page, generate the "previous" link
    if ($cur_page2 > 1) {
      $page_links2 .= '<a href="' . $_SERVER['PHP_SELF'] . '?page2=' . ($cur_page2 - 1) . '"><-</a> ';
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
        $page_links2 .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page2=' . $i . '"> ' . $i . '</a>';
      }
    }
    
 // If this page is not the last page, generate the "next" link
    if ($cur_page2 < $num_pages2) {
      $page_links2 .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page2=' . ($cur_page2 + 1) . '">-></a>';
    }
    else {
      $page_links2 .= ' ->';
    }

    return $page_links2;
  }




$query15 = "SELECT * FROM comment WHERE to_member_name = '"  . $_SESSION['username'] . "' AND deleted IS NULL";
$result15 = mysqli_query($dbc, $query15);
if ($result15!=NULL){


  $total23 = mysqli_num_rows($result15);
  
 $total13 = $total13 +$total23;
 
 }

 
  $num_pages2 = ceil($total13 / $results_per_page2);
  





  $query14 = "SELECT * FROM comment WHERE to_member_name = '" . $_SESSION['username'] . "' AND deleted IS NULL ORDER BY comment_date DESC LIMIT $skip2, $results_per_page2";
  $data14 = mysqli_query($dbc, $query14);
if ($data14!=NULL){

   
 //user_id = '"  . $_SESSION['user_id'] . "' AND
 

$i=0;
while ($row14 = mysqli_fetch_array($data14)) { 
    // Display artwork from user_id

  $query26 = "SELECT username FROM cbp_user WHERE user_id ='"  . $row14['post_member_id'] . "'";
  $data26 = mysqli_query($dbc, $query26);
  $row26 = mysqli_fetch_array($data26);
  
	echo '<table style="background-color:#FFFFFF;">';
	echo '<tr><td class="cbptd3">Comment: <td class="cbptd3" colspan="3">' . parsedescription($row14['comment']) . '</td></tr>';
	echo '<tr><td class="cbptd3">Posted by: <td class="cbptd3"><a href="http://www.cirrusidea.com/viewprofile.php?username=' . $row26['username'] .'" >' . $row26['username'] . '</a></td>';
    echo '<td class="cbptd3">Date: <td class="cbptd3">' . $row14['comment_date'] . '</td></tr>';
	echo '<tr><td>';
	if($row14['comment_private']==1){
	echo '<b>This is a Private Comment</b>';
	}else{
	echo '&nbsp'; 
	}
	echo '</td></tr><tr><td  colspan="4">';
	 
	
	echo '<form enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';

	echo '<iframe id="replycomment' .  $row14['comment_id'] . '" src="" width="450px" height="180px" style="display:none; background-color:transparent; position:relative;" allowtransparency="true" scrolling="no" frameborder="0"></iframe>';


echo '<input type="button" name="replycommentbutton" value="Reply"  class="stylebutton"  id="replycommentbutton' .  $row14['comment_id'] . '" onclick="recomment'.$row14['comment_id'].'()"/>';

?>
<script>
function recomment<?php echo $row14['comment_id']; ?>(){
recombutton = document.getElementById('replycommentbutton<?php echo $row14['comment_id']; ?>');

if (recombutton.value =="Reply"){
recombutton.value = "Close Re:";
}else{
recombutton.value = "Reply";
}

recomiframe = document.getElementById('replycomment<?php echo  $row14['comment_id']; ?>'); 
if(recomiframe.style.display=='block')
{ recomiframe.style.display='none';
}else{ 
recomiframe.style.display='block'; 
}  

recomiframe.src='http://www.cirrusidea.com/commentreply.php?to_member_name=<?php echo  $row26['username']; ?>&retocomment=<?php echo  $row14['comment_id']; ?>';
} 
</script>
  
	
<?php

	
	echo '</form>';
	
	echo '</td><td><form enctype="multipart/form-data" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
	echo '<input type="hidden" name="commentid" id="commentid" value="' . $row14['comment_id'] . '" />';
	echo '<input type="submit"  class="stylebutton"  name="deletecomment" id="deletecomment" value="Delete Comment"';
    if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; 
    echo '/></form>';
	
	echo '</td></tr></table><br />';

   $i++;
 
  }
 

 }
 
  // Generate navigational page links if we have more than one page
  if ($num_pages2 > 1) {
 echo '<p style="text-align:left; position:relative;">'; 
    echo generate_page_links_again1($cur_page2, $num_pages2);
	echo '</p>';
  }
 echo '<br /><br /><br /><br />'; 
echo '</td>';



//echo '</table>';

echo '</div></div>';





  mysqli_close($dbc);


  // Insert the page footer
  require_once('footer.php');
 
?>
