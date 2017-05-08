<?php

echo '<div id="project_toper">';


$filename1 = "projectviewscount.txt"; // This is at root of the file using this script.


$fd = fopen ($filename1, "r"); // opening the file counter.txt in read mode
$contents1 = fread ($fd, filesize($filename1)); // reading the content of the file
fclose ($fd); // Closing the file pointer
$contents1=$contents1+1; // incrementing the counter value by one
$fp = fopen ($filename1, "w"); // Open the file in write mode
fwrite ($fp,$contents1); // Write the new data to the file
fclose ($fp); // Closing the file pointer 


$fd = fopen ($filename1, "r"); // opening the file counter.txt in read mode
$contents2 = fread ($fd, filesize($filename1)); // reading the content of the file
fclose ($fd); // Closing the file pointer
//$contents=$contents+1; // incrementing the counter value by one
echo '<div style="float:right; width:160px;"><b style="float:right;">Views: ' .$contents1 . '</b></div>';
 
   
   
if(isset($_POST['foldersubmit'])){

$filetype = mysqli_real_escape_string($dbc, trim($_POST['filetype']));
if($filetype){
$query7747 = "UPDATE cbpfiles SET type = '$filetype' WHERE file_name = '$foldername1' AND file_path = '$file_dir2'";
mysqli_query($dbc, $query7747);
} 
}
  
  $query877 = "SELECT * FROM cbpfiles WHERE file_name = '$foldername1' AND file_path = '$file_dir2'";
  $data877 = mysqli_query($dbc, $query877);
  $row877 = mysqli_fetch_array($data877);
  
  $upfoldername = basename($file_dir2);
  $upfolderpath = dirname($file_dir2);
  $query77788 = "SELECT * FROM cbpfiles WHERE file_name = '$upfoldername' AND file_path = '$upfolderpath'";
  $data77788 = mysqli_query($dbc, $query77788);
  $row77788 = mysqli_fetch_array($data77788);
  
  
  $upfile_type = $row77788['type'];
  
if ($row877['creator'] == $_SESSION['user_id'] && $row877['type']==NULL && $upfile_type == 3|| $row877['creator'] == $_SESSION['user_id'] && $row877['type']==0 && $upfile_type == 3) {

echo '<form enctype="multipart/form-data" method="post" action="';
echo $_SERVER['PHP_SELF'];
echo '"><table style=""><tr><td colspan="3"><b><legend>You Created this Folder, Select the Folder Type:</legend></b></td></tr>';
echo '<tr><td><input type="radio" name="filetype" value="3"/>General Discipline</td>';
echo '<td><input type="radio" name="filetype" value="5"/>Discussion Page</td>';
echo '<td><input type="radio" name="filetype" value="1"/>Main Project Folder</td>';
echo '<td><input type="radio" name="filetype" value="2"/>Sub Project Folder</td></tr>';
echo '<tr><td></td><td></td><td><input type="submit" name="foldersubmit" id="foldersubmit" value="Submit" /></td></tr>';
echo '</table></form>';
}

if ($row877['creator'] == $_SESSION['user_id'] && $row877['type']==NULL && $upfile_type == 4|| $row877['creator'] == $_SESSION['user_id'] && $row877['type']==0 && $upfile_type == 4) {

echo '<form enctype="multipart/form-data" method="post" action="';
echo $_SERVER['PHP_SELF'];
echo '"><table><tr><td colspan="3"><b><legend>You Created this Folder, Select the Folder Type:</legend></b></td></tr>';
echo '<tr><td><input type="radio" name="filetype" value="2"/>Sub Project Folder</td></tr>';
echo '<tr><td></td><td></td><td><input type="submit" name="foldersubmit" id="foldersubmit" value="Submit" /></td></tr>';
echo '</table></form>';
}

if ($row877['creator'] == $_SESSION['user_id'] && $row877['type']==NULL && $upfile_type == 1|| $row877['creator'] == $_SESSION['user_id'] && $row877['type']==0 && $upfile_type == 1) {

echo '<form enctype="multipart/form-data" method="post" action="';
echo $_SERVER['PHP_SELF'];
echo '"><table><tr><td colspan="3"><b><legend>You Created this Folder, Select the Folder Type:</legend></b></td></tr>';
echo '<tr><td><input type="radio" name="filetype" value="2"/>Sub Project Folder</td></tr>';
echo '<tr><td></td><td></td><td><input type="submit" name="foldersubmit" id="foldersubmit" value="Submit" /></td></tr>';
echo '</table></form>';
}

if ($row877['creator'] == $_SESSION['user_id'] && $row877['type']==NULL && $upfile_type == 5|| $row877['creator'] == $_SESSION['user_id'] && $row877['type']==0 && $upfile_type == 5) {

echo '<form enctype="multipart/form-data" method="post" action="';
echo $_SERVER['PHP_SELF'];
echo '"><table><tr><td colspan="3"><b><legend>You Created this Folder, Select the Folder Type:</legend></b></td></tr>';
echo '<tr><td><input type="radio" name="filetype" value="2"/>Sub Project Folder</td></tr>';
echo '<tr><td></td><td></td><td><input type="submit" name="foldersubmit" id="foldersubmit" value="Submit" /></td></tr>';
echo '</table></form>';
}

if ($row877['creator'] == $_SESSION['user_id'] && $row877['type']==NULL && $upfile_type == 2|| $row877['creator'] == $_SESSION['user_id'] && $row877['type']==0 && $upfile_type == 2) {

echo '<form enctype="multipart/form-data" method="post" action="';
echo $_SERVER['PHP_SELF'];
echo '"><table><tr><td colspan="3"><b><legend>You Created this Folder, Select the Folder Type:</legend></b></td></tr>';
echo '<tr><td><input type="radio" name="filetype" value="2"/>Sub Project Folder</td></tr>';
echo '<tr><td></td><td></td><td><input type="submit" name="foldersubmit" id="foldersubmit" value="Submit" /></td></tr>';
echo '</table></form>';
}



if(isset($_POST['remindfolderowner'])){
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  $comment = 'Your folder '. $foldername1 . ' on Cirrus Idea does not have a classification, <br />';
  $comment .= 'please submit the type of folder on the top of the project page.';
 
  $post_member_id = $_SESSION['user_id'];
  	$query901 = "SELECT * FROM cbp_user WHERE user_id = '" . $row877['creator'] . "' LIMIT 1";
	$data901 = mysqli_query($dbc, $query901);
	$row901 = mysqli_fetch_array($data901);
  $to_member_name = $row901['username'];
  $comment_private = 1;
  	
	$query55 = "INSERT INTO comment (comment, post_member_id, to_member_name, comment_private) VALUES ('" . $comment . "', '" . $post_member_id . "', '" . $to_member_name . "', '" . $comment_private . "')";
	
	mysqli_query($dbc, $query55);
	
	echo '<b style="color:black; font-size:18px;">Thanks for reminding '.  $to_member_name . ' to determine the folder type.</b>';


	
	$query86 = "SELECT * FROM cbp_user WHERE username = '" . $to_member_name . "' LIMIT 1";
	$data86 = mysqli_query($dbc, $query86);
	$row86 = mysqli_fetch_array($data86);
	$useremail = $row86['email'];
	$query90 = "SELECT * FROM cbp_user WHERE user_id = '" . $post_member_id . "' LIMIT 1";
	$data90 = mysqli_query($dbc, $query90);
	$row90 = mysqli_fetch_array($data90);

	
if ($row86['mailme'] == 1){	
	$to = "$useremail";
	$subject = "CirrusIdea.com - Folder Reminder";
	$message = "
 <html>
 <head>
 <title>A reminder your file needs a classification.</title>
 </head>
 <body>
 <p>
 " . $row90['username'] . " wanted to remind you to classify a folder you created. <br />
 " . $comment . " 
 <br /><br />" . $to_member_name . ",  <a href='http://www.cirrusidea.com" . $_SERVER['PHP_SELF'] . "'>Goto Folder</a>
 and update this folder.<br /><br />
 
 
 </p>
 </body>
 </html>
 ";
 
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 
// More headers
 $headers .= "From: " . $row90['email'] . "\r\n";
	
	mail($to,$subject,$message,$headers);
	
	
	}


}


if ($row877['type']==NULL && $row877['creator'] != $_SESSION['user_id'] || $row877['type']==0 && $row877['creator'] != $_SESSION['user_id']){

echo '<p>The owner of this folder has not determined the type of folder yet.</p>';
echo '<form enctype="multipart/form-data" method="post" action="';
echo $_SERVER['PHP_SELF'];
echo '"><table><tr><td>Remind owner to determine the folder type:<input type="submit" name="remindfolderowner" id="remindfolderowner" value="Remind" />';
echo '</table></form>';

}



if (isset($_POST['votesubmit'])){
$voteview = false;
$vote = $_POST['developmentlevel'];

$query57 = "INSERT INTO projectvoting (projectfolder_id, vote, member_id) VALUES ('" . $row877['file_id'] . "', '" . $vote . "', '" . $_SESSION['user_id'] . "')";
    
	mysqli_query($dbc, $query57);

}else{
$voteview = true;
}



//Check to see if the user can vote or not on the project

$query855 = "SELECT * FROM projectvoting WHERE member_id = '" . $_SESSION['user_id'] . "' AND projectfolder_id = '" . $row877['file_id'] . "' ORDER BY date DESC LIMIT 1";
 
 $data855 = mysqli_query($dbc, $query855);
 $row855 = mysqli_fetch_array($data855);

if ($row855['date']!=NULL){

$datetimestamp1 = $row855['date'];

$datetimestamp2 = date("Y-m-d");

$query14 = "SELECT DATEDIFF('$datetimestamp2','$datetimestamp1') AS DiffDate";
    $data14 = mysqli_query($dbc, $query14);
	$row14 = mysqli_fetch_array($data14);
	$datediff = intval($row14['DiffDate']);
   
		if ($datediff>7){
			$voteview = true;
			}else{
			$voteview = false;
			}
            
}else{
$voteview = true;
}







if ($row877['type']==1 && $voteview == true || $row877['type']==5 && $voteview == true) {

if ($row877['type']==5) {
echo '<div style ="width:800px; float:left;"><b style="font-size:18px;">This is a Discussion Page</b></div>';
}else{
echo '<div style ="width:800px; float:left;"><b style="font-size:18px;">This is a main Project Folder</b></div>';
}

echo '<div style ="width:300px; float:left; padding:10px;"><form enctype="multipart/form-data" method="post" action="';
echo $_SERVER['PHP_SELF'];
echo '"><b>Vote on CirrusIdea Development:</b><br /><div style="font-size:10px;">';
echo '<input type="radio" name="developmentlevel" value="1"/>Needs lots of work.<input type="radio" name="developmentlevel" value="4"/>Good idea and development.<br />';
echo '<input type="radio" name="developmentlevel" value="2"/>Keep building.<input type="radio" name="developmentlevel" value="5"/>Awesome Stuff.<br />';
echo '<input type="radio" name="developmentlevel" value="3"/>Looking good.<input type="radio" name="developmentlevel" value="6"/>Should be out in the world already!';
echo '<br /><input type="submit" name="votesubmit" id="votesubmit" value="Vote" /></div>';
echo '</form></div>';


echo '<div style ="width:150px;  float:left;"><b style="color:black; font-size:13px;">Help make it happen:</b><br />';
echo '<form action="http://www.cirrusidea.com/cirrustakecart.php" method="post">';
echo '<input  type="hidden" name="item_name_1" value="'.$foldername1 .'">';
echo '<input type="hidden" name="item_name_2" value="'.$file_dir2.'">';
echo '<b>$</b><input type="text" size="10" name="sharesvalue" ';
if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"';
echo '/>';
echo '<input type="submit" border="0" name="submit" value="Build it" alt="" ';
if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"';
echo '>';
echo '</form>';
echo '</div>';

$query999 = "SELECT * FROM projectvoting WHERE projectfolder_id = '" . $row877['file_id'] . "'";
	$data999 = mysqli_query($dbc, $query999);
	$oo = 0;
	$vote_total = 0;
while ($row999 = mysqli_fetch_array($data999)){
$oo++;

$vote_total = $vote_total + $row999['vote'];
}
if ($vote_total !=0){
	$average_vote = $vote_total/$oo;
	$average_vote = round($average_vote,0);
	}else{
	$average_vote=0;
	}
if ($row877['type']==1 ){	
echo '<div style="width:200px; float:left;"><b>This Project ';
} else {
  echo '<div style="width:200px; float:left;"><b>This Discussion '; 
}
switch ($average_vote){
case 0:
echo ' has no votes yet on progress</b>';
break;
case 1:
echo ' needs <i>lots of work</i>.</b>';
break;
case 2:
echo ' needs to <i>keep building</i>.</b>';
break;
case 3:
echo ' is <i>looking good</i>.</b>';
break;
case 4:
echo ' is a <i>good idea and has good development</i>.</b>';
break;
case 5:
echo ' is <i>awsome</i>.</b>';
break;
case 6:
echo ' <i>should be out in the world already</i>!</b>';
break;
}
echo '</div>';





$query7777 = "SELECT * FROM investments WHERE project_id = '" . $row877['file_id'] . "'";
	$data7777 = mysqli_query($dbc, $query7777);
$capital_invested = 0;	
	while ($row7777 = mysqli_fetch_array($data7777))
	{
$capital_invested = $capital_invested + $row7777['amount'];

}

echo '<div style="width:200px; float:right;"><b style="font-size:16px;">Project Cash:';
echo $capital_invested;
echo '</b>';

if($capital_invested>0){
 $query8989 = "SELECT * FROM developervote WHERE projectfolder_id = '" . $row877['file_id'] . "'";
  $data8989 = mysqli_query($dbc, $query8989);
  if(isset($data8989)){
  echo '<br /><b style="color:#009900;">Cash Voted Developer List: <br />';
  $yr=0;
  while ($row8989 = mysqli_fetch_array($data8989)){
  

   if($row8989['developer_percentage'] != 0){
	$iter = 0;
		$add_to_developer_list=true;
		for($u=0; $u<$yr; $u++){
		  if($developer_name[$u] == $row8989['developer_name']){
		  $add_to_developer_list=false;
		  $iter = $u;
		  break;
		  }
		}
		
		if($add_to_developer_list){
			$developer_name[$yr] = $row8989['developer_name'];
			$developer_percentage[$yr] = ($row8989['developer_percentage']*$row8989['owner_equity_weight']/100);
		}else{
		$developer_percentage[$iter] = $developer_percentage[$iter] + (($row8989['developer_percentage']*$row8989['owner_equity_weight'])/100);
		}
      $yr++;
	}
			
  }
  
  for ($y=0; $y<$yr; $y++){
   echo $developer_name[$y] . ' ' . $developer_percentage[$y] .'%<br />';
		}
	  
		}
	
	}
    echo '</b></div>';
    
}elseif($row877['type']==1 && $voteview == false || $row877['type']==5 && $voteview == false) {

if ($row877['type']==5) {
echo '<div style ="width:800px; float:left;"><b style="color:black; font-size:18px;">This is a Discussion Page</b></div>';
}else{
echo '<div style ="width:800px; float:left;"><b style="color:black; font-size:18px;">This is a main Project Folder</b></div>';
}

    		echo '<div style="width:300px; float:left; padding:10px;"><b style="font-size:12px;">';
			echo 'You have ' . (7 - $datediff) . ' more days until you can vote on the progress of this project again.</b></div>';
			

echo '<div style ="width:150px;  float:left;"><b style="color:black; font-size:13px;">Help make it happen:</b>';
echo '<form action="http://www.cirrusidea.com/cirrustakecart.php" method="post">';
echo '<input  type="hidden" name="item_name_1" value="'.$foldername1 .'">';
echo '<input type="hidden" name="item_name_2" value="'.$file_dir2.'">';
echo '<b style="color:black;">$</b><input type="text" size="10" name="sharesvalue" ';
if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"';
echo '/>';
echo '<input type="submit" style="" border="0" name="submit" value="Build it" alt=""';
if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"';
echo '>';
echo '</form></div>';


$query999 = "SELECT * FROM projectvoting WHERE projectfolder_id = '" . $row877['file_id'] . "'";
	$data999 = mysqli_query($dbc, $query999);
	$oo = 0;
	$vote_total = 0;
while ($row999 = mysqli_fetch_array($data999)){
$oo++;

$vote_total = $vote_total + $row999['vote'];
}
if ($vote_total !=0){
	$average_vote = $vote_total/$oo;
	$average_vote = round($average_vote,0);
	}else{
	$average_vote=0;
	}
	
if ($row877['type']==1 ){    
echo '<div style="width:200px; float:left;"><b>This Project ';
} else {
  echo '<div style="width:200px; float:left;"><b>This Discussion '; 
}
//echo '<div style ="width:200px; float:left;"><b style="color:black; font-size:15px; float:left;">This Project Folder/Discussion ';
switch ($average_vote){
case 0:
echo ' has no votes yet on progress</b>';
break;
case 1:
echo ' needs <i>lots of work</i>.</b>';
break;
case 2:
echo ' needs to <i>keep building</i>.</b>';
break;
case 3:
echo ' is <i>looking good</i>.</b>';
break;
case 4:
echo ' is a <i>good idea and has good development</i>.</b>';
break;
case 5:
echo ' is <i>awsome</i>.</b>';
break;
case 6:
echo ' <i>should be out in the world already</i>!</b>';
break;
}
echo '</div>';



$query7777 = "SELECT * FROM investments WHERE project_id = '" . $row877['file_id'] . "'";
	$data7777 = mysqli_query($dbc, $query7777);
$capital_invested = 0;	
	while ($row7777 = mysqli_fetch_array($data7777))
	{
$capital_invested = $capital_invested + $row7777['amount'];

}

echo '<div style ="width:200px; float:right;"><b style="font-size:16px;">Project Cash:';
echo $capital_invested;
echo '</b>';

if($capital_invested>0){
 $query8989 = "SELECT * FROM developervote WHERE projectfolder_id = '" . $row877['file_id'] . "'";
  $data8989 = mysqli_query($dbc, $query8989);
  if(isset($data8989)){
  echo '</br ><b style="color:#009900; font-size:14px;">Cash Voted Developer List: <br />';
  $yr=0;
  while ($row8989 = mysqli_fetch_array($data8989)){
  

   if($row8989['developer_percentage'] != 0){
	$iter = 0;
		$add_to_developer_list=true;
		for($u=0; $u<$yr; $u++){
		  if($developer_name[$u] == $row8989['developer_name']){
		  $add_to_developer_list=false;
		  $iter = $u;
		  break;
		  }
		}
		
		if($add_to_developer_list){
			$developer_name[$yr] = $row8989['developer_name'];
			$developer_percentage[$yr] = ($row8989['developer_percentage']*$row8989['owner_equity_weight']/100);
		}else{
		$developer_percentage[$iter] = $developer_percentage[$iter] + (($row8989['developer_percentage']*$row8989['owner_equity_weight'])/100);
		}
      $yr++;
	}
			
  }
  
  for ($y=0; $y<$yr; $y++){
   echo $developer_name[$y] . ' ' . $developer_percentage[$y] .'%<br />';
      }
	  
  }
}
echo '</b></div>';

}


if ($row877['type']==3) {
echo '<br /><b style="color:black; font-size:18px; float:top; float:right;">This is a General Topic Folder, create more specific projects by adding a sub-folder.</b>';
}


if ($row877['type']==2) {
$i=1; 
$temp_uplevelfoldername = basename($file_dir2);
$temp_uplevel_file_dir = dirname($file_dir2);
$query845 = "SELECT type FROM cbpfiles WHERE file_name = '$temp_uplevelfoldername' AND file_path = '$temp_uplevel_file_dir'";
  $data845 = mysqli_query($dbc, $query845);
  $row845 = mysqli_fetch_array($data845);
  
while($row845['type']==2){
	 

$temp_uplevelfoldername = basename($temp_uplevel_file_dir);
$temp_uplevel_file_dir = dirname($temp_uplevel_file_dir);
$query845 = "SELECT type FROM cbpfiles WHERE file_name = '$temp_uplevelfoldername' AND file_path = '$temp_uplevel_file_dir'";
  $data845 = mysqli_query($dbc, $query845);
  $row845 = mysqli_fetch_array($data845);


$i++;

}


$uplevelfoldername = $temp_uplevelfoldername;
$uplevel_file_dir=$temp_uplevel_file_dir;

 

if ($i>1){
echo '<br /><b style="color:black; font-size:18px; float:right;">This is a Sub-Folder to ' .$uplevelfoldername . ' project, up ' . $i . ' levels.</b>';
}else{
echo '<br /><b style="color:black; font-size:18px; float:right;">This is a Sub-Folder to ' .$uplevelfoldername . ' project, up ' . $i . ' level.</b>';
}

}

 
   

echo '</div>';

?>
