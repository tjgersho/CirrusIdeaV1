<?php
  // Start the session
  require_once('startsession.php');
 //////////////////////////////////////////////////////////////////////////////////////////////
$root = realpath($_SERVER["DOCUMENT_ROOT"]); 
/////This section of code has to do with downloading a file from the current index folder////

if(isset($_GET['path'])){
 

//$safeFilename = '/^\w+\.\w+$/';
  

// Now get the filename from the user
$pathforfile = $root . $_GET['path'];

  // MAKE SURE THE FILENAME IS SAFE!
 if (!file_exists("$pathforfile")) {
    exit(0);
  }

 // header("Content-disposition: attachment; filename=$pathforfile/$filename12");
 
  header("Content-type: application/octet-stream");
  
   header('Content-Disposition: attachment; filename='.basename($pathforfile));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    ob_clean();
    flush();
  
   
  
  readfile("$pathforfile",1);
  // Exit successfully. We could just let the script exit
  // normally at the bottom of the page, but then blank lines 
  // after the close of the script code would potentially cause 
  // problems after the file download.
  exit(0);
 }
 
/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////

  // Insert the page header
  $page_title = 'About Cirrus Idea';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
 ?> 
 <h3>About CirrusIdea:</h3>

<div style="text-align:center;">

<!--<video width="1000" height="860" controls>
    <source src="/images/CirrusIdea.mp4"  type="video/mp4"  />
	
		<img src="images/CirrusIdeaLogo1.png" width="640" height="360" alt="Batch 9 Video Submittal"
		     title="No video playback capabilities, please download the video below" />
	</object>
</video>-->

<OBJECT CLASSID="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" WIDTH="640"HEIGHT="320"
CODEBASE="http://www.apple.com/qtactivex/qtplugin.cab">
<PARAM name="SRC" VALUE="http://www.cirrusidea.com/images/trim.709DAECB-.mov">
<PARAM name="AUTOPLAY" VALUE="true">
<PARAM name="CONTROLLER" VALUE="false">
<EMBED SRC="http://www.cirrusidea.com/images/trim.709DAECB-.MOV" WIDTH="640" HEIGHT="320" AUTOPLAY="true" CONTROLLER="false" PLUGINSPAGE="http://www.apple.com/quicktime/download/">
</EMBED>
</OBJECT>

<br /><br /><a href="/images/mov.MOV" >MOV</a>

<br /><br /><a href="http://www.cirrusidea.com/batch9.php?path=/images/CirrusIdea.mp4" >Batch 9 Video Submittal</a>
</div>
<br /><br />


 <?php
 echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
 // Insert the page footer
  require_once('footer.php');
 ?>
