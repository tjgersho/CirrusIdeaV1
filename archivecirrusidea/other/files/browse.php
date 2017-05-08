<?php


// Custom function to draw a bar graph given a data set, maximum value, and image filename
  function draw_bar_graph($width, $height, $data, $max_value, $filename) {
    // Create the empty graph image
    $img = imagecreatetruecolor($width, $height);

    // Set a white background with black text and gray graphics
    $bg_color = imagecolorallocate($img, 255, 255, 255);       // white
    $text_color = imagecolorallocate($img, 0, 0, 0);     // black
    $bar_color = imagecolorallocate($img, 100, 100, 100);            // light gray
    $border_color = imagecolorallocate($img, 192, 192, 192);   // light gray

    // Fill the background
    imagefilledrectangle($img, 0, 0, $width, $height, $bg_color);

    // Draw the bars
    $bar_width = $width / ((count($data) * 2) + 1);
    for ($i = 0; $i < count($data); $i++) {
      imagefilledrectangle($img, ($i * $bar_width * 2) + $bar_width, $height, ($i * $bar_width * 2) + ($bar_width * 2), $height - (($height / $max_value) * $data[$i][1]), $bar_color);
      imagestringup($img, 5, ($i * $bar_width * 2) + ($bar_width), $height - 5, $data[$i][0], $text_color);
    }

    // Draw a rectangle around the whole thing
    imagerectangle($img, 0, 0, $width - 1, $height - 1, $border_color);

    // Draw the range up the left side of the graph
    for ($i = 1; $i <= $max_value; $i=$i + 5) {
      imagestring($img, $max_value, 0, $height - ($i * ($height / $max_value)), $i, $bar_color);
    }

    // Write the graph image to a file
    imagepng($img, $filename, 5);
    imagedestroy($img);
  } // End of draw_bar_graph() function



$root = realpath($_SERVER["DOCUMENT_ROOT"]);  
  // Start the session
  require_once($root.'/startsession.php');

  // Start the session
  require_once($root.'/startsession.php');

  // Insert the page header
  $page_title = 'Browse Categories';

  require_once($root.'/header.php');

  require_once($root.'/appvars.php');
  require_once($root.'/connectvars.php');


if (!isset($_SESSION['user_id'])) {
     $page_title = $foldername1;
  require_once($root.'/header.php');
   require_once($root.'/navmenu.php');
   echo '<p> You are not logged in.  Enter your username and password above. </p>';
   
   // Insert the page footer
  require_once($root.'/footer.php');
    exit();
  
  }
  
    ?>
  
<div style="float: right; padding-right:15px;">
 <h4 style="text-align:center;">CirrusIdea Search</h3>
  <form method="post" action="../search.php" style="text-align:center;">
    <label for="usersearch">Find a project: </label>
    <input type="text" id="usersearch" name="usersearch" /><br />
    <input type="submit" class="stylebutton" name="submit" value="Submit" />
  </form>
  </div>
<?php
  
  // Show the navigation menu
  require_once($root.'/navmenu.php');

if (isset($_POST['submit'])) {
    // Connect to the database

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

 // Grab the score data from the POST
    $newfile = mysqli_real_escape_string($dbc, trim($_POST['newfile']));
    $file_private = mysqli_real_escape_string($dbc, trim($_POST['fileprivate']));
	if ($file_private) {
	$file_private=1;
	}
if (!empty($newfile)) {

      
  $charactersok = true;

  $pos = strpos($newfile, "!");
  $pos1 = strpos($newfile, "@");
  $pos2 = strpos($newfile, "$");
  $pos3 = strpos($newfile, "%");
  $pos4 = strpos($newfile, "^");
  $pos5 = strpos($newfile, "&");
  $pos6 = strpos($newfile, "?");
  $pos7 = strpos($newfile, "index.php");
  $pos8 = strpos($newfile, "*");
  $pos9 = strpos($newfile, "(");
  $pos10 = strpos($newfile, ")");
  $pos11 = strpos($newfile, "=");
  $pos12 = strpos($newfile, "+");
  $pos13 = strpos($newfile, "/");
  $pos14 = strpos($newfile, "\\");
   $pos15 = strpos($newfile, "'");
   
 if ($pos !== false || $pos1 !== false  || $pos2 !== false  || $pos3 !== false  || $pos4 !== false  || $pos5 !== false  || $pos6 !== false  || $pos7 !== false){
     $charactersok =false;

 }
  if ($pos8 !== false || $pos9 !== false  || $pos10 !== false  || $pos11 !== false  || $pos12 !== false  || $pos13 !== false  || $pos14 !== false || $pos15 !== false){
  
     $charactersok =false;
 
 }
 
 
if ($charactersok){
$file_dir = dirname($_SERVER['PHP_SELF']);
 
 $query = "SELECT * FROM cbpfiles WHERE file_name = '$newfile' AND file_path = '$file_dir'";
      $data = mysqli_query($dbc, $query);
      
      
      
      if (mysqli_num_rows($data) == 0) {
      
 
	
	$query = "INSERT INTO cbpfiles (file_name, file_path, file_approval, creator, file_private, type) VALUES ('" . $newfile . "', '" . $file_dir . "', 1, '" . $_SESSION['user_id'] . "', '" . $file_private . "', 3)";
            mysqli_query($dbc, $query);
	        echo '<p>Thanks for adding a Project Category! <br />';
			echo 'This Category may be removed if deemed inappropriate.</p>';
           if ($file_private){
    echo '<p style="color:green"><b><i>' . $newfile  .'</i> is a private folder.  To allow another co-developer to view this folder you must edit and allow a co-developer to view this folder.</b></p>';
   }

if($file_private){
      $query123 = "SELECT * FROM cbpfiles WHERE file_name = '$newfile' AND file_path = '$file_dir'";
      $data123 = mysqli_query($dbc, $query123);
      $row123 = mysqli_fetch_array($data123);
	
	$query654 = "SELECT * FROM cbp_user WHERE user_id = '". $row123['creator']. "'";
      $data654 = mysqli_query($dbc, $query654);
      $row654 = mysqli_fetch_array($data654);

$query321 = "INSERT INTO folderprivacy (user_name, folderID) VALUES ('" . $row654['username'] . "', '" . $row123['file_id'] . "')";
		mysqli_query($dbc, $query321);
}

mkdir($newfile);

$templatefile =  $root .  '/templates/index.php';
$copytofile = $root . '/files/' . $newfile . '/index.php';

copy($templatefile, $copytofile);

$templatefile1 =  $root .  '/templates/projectviewscount.txt';
$copytofile1 = $root . '/' . $file_dir . '/' . $newfile . '/projectviewscount.txt';

copy($templatefile1, $copytofile1);

$templatefile1 =  $root .  '/templates/uploader.php';
$copytofile1 = $root . '/' . $file_dir . '/' . $newfile . '/uploader.php';

copy($templatefile1, $copytofile1);


		}
	else {
	echo '<p class="error">A file already exists with that name in this folder.  Try a different name.</p>';
	}
	}else{
	echo '<p class="error">You used special character that is not allowed.  Try a different name.</p>';

	
	}
	
	
  }

}


 $file_dir = dirname($_SERVER['PHP_SELF']);
 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>

<h2>
<?php
if ($_SESSION['newuser']){
?>
<span class="hotspot" onmouseover="tooltip.show('Here is where the fun begins. CirrusIdea is generally speaking a large folder structure.  You start here with the general diciplines/categories, and as you dig into the folder structure the folders become more specific  So if you had a project for a new book you want to write, you can go into Literature/Novels/YOUR BOOK NAME, and you create folders along the way the make sense.  Start here and find your interest, or add a new general topic folder with the form below. <br /><br /> <strong>Next Tour Stop</strong>:  Click on any folder below.', 800);" onmouseout="tooltip.hide();">
Hover-Help:
<?php
}      
?>

Top Level Folders - General Categories - Delve In</h2>

<?php
if ($_SESSION['newuser']){
echo '</span>';
}
if($_GET['login']==1){
echo '<h2><a href="http://www.cirrusidea.com/mycreativebrainpower.php">Go To My Cirrus Idea Profile</a></h2>';

}
echo '<p style="position:relative; left:40px">This page is where the project folders begin.  The links below are to folders for projects, and are usually of general subject matter;';
echo '  the sub-folders to these links is where the projects get more specific. You can start a new category here by filling in the name';
echo ' of the folder and begin a conversation/project with the world.</p>';
?>


 <form style="text-align:center;" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

	 <legend><b><p class="italic" style="position:relative; left:300px;">Add new Major Category for Creative Projects</p></b></legend>
    <label for="newfile">Category:</label>
    <input type="text" id="newfile" name="newfile"  <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> /><br />
   <label for="fileprivate">Make Private:</label><input type="checkbox" id="fileprivate" name="fileprivate"  <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?>/>
    <input type="submit" class="stylebutton" value="Add" name="submit"  <?php if($_SESSION['username'] == 'Anonymous') echo 'disabled="disabled"'; ?> />
  </form>



<?php

  $query = "SELECT * FROM cbpfiles WHERE file_approval = 1 AND file_path = '" . $file_dir . "'  ORDER BY file_name";
  $data = mysqli_query($dbc, $query);
  
  $atleastoneprivate_folder = false;
$atleastoneyour_folder = false; 
$atleastonepublic_folder = false;

echo '<div>';
echo '<ul style="text-align:center;">';

while ($row = mysqli_fetch_array($data)) { 
    
	  $query432 = "SELECT * FROM folderprivacy WHERE folderID = '" . $row['file_id'] . "'";
      $data432= mysqli_query($dbc, $query432);
     
	if($row['file_private'] == 0 || $row['file_private'] == NULL){
         if ($row['creator']==$_SESSION['user_id']){;
          echo '<li class="yourfoldercontainer">';
    	              echo '<div style="display:inline;"><a style="display:inline;" href="/files/'  .  $row['file_name'] . '/">' . $row['file_name'] . '</a>';
          
                        echo      '<form  style="display:inline;" action="http://www.cirrusidea.com/editdeletefolder.php" method="post">';
                        echo       '<input type="hidden" id="id" name="id" value="'.$row['file_id'].'"/>';
                        echo       '<input type="submit" class="yourfolderbutton" style="display:inline; display:none;" value="Edit">';
                         echo      '</form></div>';
                        
                        echo '</li>';
                                $i++; 
              $atleastoneyour_folder = true;  
        }else{
            
			 echo '<li class="foldercontainer">';
    	              echo '<a style="display:inline;" href="/files/'  .  $row['file_name'] . '/">' . $row['file_name'] . '</a>';
                                  
                        echo '</li>';
                                $i++; 
								$atleastonepublic_folder = true;

        }
          $query12 = "SELECT * FROM creativebrainpower WHERE file_id LIKE '" . $file_dir.'/'.$row['file_name'] . "%' AND private = '0'";
         $data12 = mysqli_query($dbc, $query12);
      
         $nameofpubfolder[$numberofpubfolders] = $row['file_name'];
         $numpostsinfolder = mysqli_num_rows($data12);
         $numberofpostsinfolders[$numberofpubfolders] =  $numpostsinfolder ;
         $numberofpubfolders =  $numberofpubfolders +1;
	
		}else{
			while($row432 = mysqli_fetch_array($data432)) { 
			if($_SESSION['username'] == $row432['user_name']){
		
             if ($row['creator']==$_SESSION['user_id']){;
    	
          
                  echo '<li class="yourprivatefoldercontainer">';
    	          echo '<div style="display:inline;"><a style="display:inline;" href="/files/' .  $row['file_name'] . '/">' . $row['file_name'] . '</a>';
          
                        echo      '<form  style="display:inline;" action="http://www.cirrusidea.com/shareprivatefolders.php" method="post">';
                        echo       '<input type="hidden" id="id" name="id" value="'.$row['file_id'].'"/>';
                        echo       '<input type="submit" class="yourfolderbutton" style="display:inline; display:none;" value="Edit">';
                         echo      '</form></div>';
                        
                        echo '</li>';
                                $i++; 
              $atleastoneyour_folder = true;
               
                  }else{
            
                     echo '<li class="privatefoldercontainer">';
    	              echo '<a style="display:inline;" href="/files/' .   $row['file_name'] . '/">' . $row['file_name'] . '</a>';
                                  
                        echo '</li>';
                                $i++; 
                  }
            
	           $atleastoneprivate_folder = true;		
			
			}
			}
		
		}
        
         if ($i%8==0){
        echo '</ul><ul style="text-align:center;">';
         }
        
		
  }

 echo '</div>';
 
if ($atleastoneprivate_folder){
echo '<p><div style="width:100px; heigth:50px;  background-image:url(\'http://www.cirrusidea.com/images/privatefolderlink.png\'); background-width:100%; float:right; margin:5px;" >';
echo '<font size="2">Private Folder</font>';
echo '</div></p>';
}

if ($atleastoneyour_folder){
echo '<p><div style="width:100px; heigth:50px; background-image:url(\'http://www.cirrusidea.com/images/yourfolder.png\'); background-width:100%; float:right; margin:5px; " >';
echo '<font size="2">Your Folder</font>';
echo '</div></p>';
}

if ($atleastonepublic_folder){
echo '<p><div style="width:100px; heigth:50px; background-image:url(\'http://www.cirrusidea.com/images/folderlink.png\'); background-width:100%; float:right; margin:5px; " >';
echo '<font size="2">Public Folder</font>';
echo '</div></p>';
}



 
 
 echo '<br />';

$data = array();
$maxvalue = 0;
for ($q = 0; $q<$numberofpubfolders; $q++){

    $data[$q][0] = $nameofpubfolder[$q];
    $data[$q][1] =  $numberofpostsinfolders[$q];

if ($maxvalue < $numberofpostsinfolders[$q] ){
$maxvalue = $numberofpostsinfolders[$q];
}
    
}
$maxvalue = $maxvalue+3;


        // Generate and display the cirrus idea category uploads bar graph image
        echo '<h3>Public Posts:</h3>';
       draw_bar_graph(480/15*$numberofpubfolders, 240,  $data, $maxvalue, '../images/graph.png');
        echo '<div style="text-align:center;"><img src="../images/graph.png" alt="CirrusIdea Category Graph" /></div><br />';

echo '<br /><br />';
  mysqli_close($dbc);

  // Insert the page footer
  require_once($root.'/footer.php');
?>
