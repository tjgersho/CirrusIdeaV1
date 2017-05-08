<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'About Cirrus Idea';
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

  echo '<title>CirrusIdea - ' . $page_title . '</title>';
  
?>
<meta name="description" content="This site is a platform designed to create positive progress. 
This site is for people who want to make a difference.  It is for Dreamers, Innovators, Engineers, Scientists, 
 and Thinkers to unite for a collaborative and noble cause.  A platform where a project can be conceived, collaborated on developed and funded." />
<meta name="author" content="Advancement by the members" />
<meta name="google" content="notranslate" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

 <!--Get Style Sheet--> 
 
  <!--[if lte IE 7]><!-->
 <link rel="stylesheet" type="text/css" href="http://www.cirrusidea.com/styleIE6.css" />
<!--<![endif]-->

 <!--[if gt IE 8]><!-->
 <link rel="stylesheet" type="text/css" href="http://www.cirrusidea.com/style.css" />
<!--<![endif]-->
  
   <!--[if IE 8]><!-->
 <link rel="stylesheet" type="text/css" href="http://www.cirrusidea.com/styleIE8.css" />
<!--<![endif]-->
  
  
<!--[if !IE]><!-->
 <link rel="stylesheet" type="text/css" href="http://www.cirrusidea.com/style.css" />
<!--<![endif]-->
 
 <!--Get jQuery--> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>

<!-- A Nice JavaScript library.. movable form fields -->
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
 
<script type="text/javascript" src="js/jquery.min.js"></script>


<script language="JavaScript">

function preloader() 
{

 <!--
 
    // VERIFY THAT THE BROWSER IS ONE THAT SUPPORTS THE IMG OBJECT
    // BY VERIFYING THAT ONE OF THE FOLLOWING IS TRUE:
    //	CASE 1  the client is Netscape version 3 or higher,  		 
	//	CASE 2  the client is Netscape version 2.02 on an OS/2 platform, or	 
	//	CASE 3  the client is Microsoft Internet Explorer version 4 or higher.
 
	var bAnimate = false;
 
	// CASE 1:
	bAnimate=(((navigator.appName == "Netscape") && 
	(parseInt(navigator.appVersion) >= 3 )) || 
 
	// CASE 2:
	(navigator.userAgent == "Mozilla/2.02E (OS/2; I)") || 
 
	// CASE 3:
	((navigator.appName == "Microsoft Internet Explorer") && 
	(parseInt(navigator.appVersion) >= 4 )));
 
	//-->

    var numpics = 181;
    
    if (!bAnimate){
    	document.write(	"<FONT COLOR='white' SIZE='5'><BR>Your browser does not support JavaScript Animation!</FONT>");
		}
	else
		{

				    Img = new Array(numpics)
                    
			       for (var i=1; i<numpics+1; i++)
                        {
                        Img[i] = new Image();
    		            Img[i].src="images/animation/img"+i+".png?v=<?php echo Date('Y.m.d.G.i.s'); ?>";
                         
                           }                    
            	}


}
</script>


<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);  
$bgpics = $root . '/bgpics.txt';

$delim = "\n";
$i=0;

	$fp = fopen($bgpics, "r");
    $contents = fread($fp, filesize($bgpics)); 
    $quote_arr = explode($delim,$contents); 
    fclose($fp); 
    srand((double)microtime()*1000000); 
    $quote_index = (rand(1, sizeof($quote_arr)) - 1); 
    $bgpic = $quote_arr[$quote_index];

?> 

<script type="text/javascript">
 function forceReturn(iMaxLength, sValue){
 if (sValue.length > iMaxLength){
 sValue = sValue + "\r";
 }
 }
 </script>

<script src="http://jquery-elastic.googlecode.com/svn/trunk/jquery.elastic.source.js" type="text/javascript"></script> 



</head>
<body  onLoad="javascript:preloader()">
<div id="allcontent">
 
<?php

echo '<div id="headcontainer"><div id="logo">'; 

echo '<a href="http://www.cirrusidea.com/"><img id="logo" border="0" src="http://www.cirrusidea.com/images/cirrusidealogo.png" alt="CirrusIdea Logo" height="155" /></a></div>';



if (!isset($_SESSION['user_id'])) {

$loginloc =  $_SERVER['PHP_SELF'];

echo '<div style="float:right; width:500px;">';

echo '<form method="post" action="http://www.cirrusidea.com/login.php?page=' . $loginloc . '">';
echo '<table>';
echo '<tr>';
echo '<td >Log In:</td>';
echo '<td><label>Username:</label>';
echo '<input type="text" name="username" size="15"/></td>';
echo '<td ><label>Password:</label>';
echo '<input type="password" name="password" size="15"/></td>';
echo '</tr>';
echo '<tr>';
echo '<td ></td>';
echo '<td></td>';
echo '<td ><input type="submit" class="stylebutton" value="Log In" name="submit"/></td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="2" ><a href="signup.php">Create an Account</a></td>';
echo '<td  colspan="2"><a href="changepassword.php">Forget your password or username?</a></td>';
echo '</tr>';
echo '</table>'; 
echo '</form></div>';

?>

<div style="float:right; width:300px;">
<table><tr><td>
Log In as Anonymous and Browse CirrusIdea.com:</td></tr>
<tr><td>
<form  method="post" action="http://www.cirrusidea.com/login.php">
<input type="hidden" name="username" value="Anonymous"/>
<input type="hidden" name="password" value="123"/>
<input type="submit" class="stylebutton" value="Log In as Anonymous" name="submit"/></form>
</td></tr></table>
</div>

<?php
}

require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
?>

<br />

<div style ="margin-left:auto; margin-right:auto; text-align:center; width:800px;" >

<div style="background-color:white; width:800px; z-index:-1;">

 		<img name=t src="images/animation/img1.png" width="800" />
 </div>     

<script>
           
	        var ii=0; 
        	var timerID=null;
          var numpics = 181;

    var bAnimate = false;
 
	// CASE 1:
	bAnimate=(((navigator.appName == "Netscape") && 
	(parseInt(navigator.appVersion) >= 3 )) || 
 
	// CASE 2:
	(navigator.userAgent == "Mozilla/2.02E (OS/2; I)") || 
 
	// CASE 3:
	((navigator.appName == "Microsoft Internet Explorer") && 
	(parseInt(navigator.appVersion) >= 4 )));
 
	//-->


    
    if (!bAnimate){
    	document.write(	"<FONT COLOR='white' SIZE='5'><BR>Your browser does not support JavaScript Animation!</FONT>");
		}
	else
		{

				    Img = new Array(numpics)
                    
			       for (var i=1; i<numpics+1; i++)
                        {
                        Img[i] = new Image();
    		            Img[i].src="images/animation/img"+i+".png?v=<?php echo Date('Y.m.d.G.i.s'); ?>";
                         
                           }                    
            	}
          
		  function startanimation(){
 	                            
                                        ii++;    
                                         
                                        
                                        
                            if (ii<=numpics)
                            {
                            
	                               
                                    
                                    switch (ii)
                                        {
                                       
                                        case 2:
                           
                                
                                  
                                 document.t.src=Img[ii].src;
                  
                                         timerID = setTimeout("startanimation()", 1000);
                                         break;
                                         
                                         case 5:
                                         case 6:
                                         case 7:
                                         case 8:
                                         case 9:
                                         case 10:
                                         case 11:
                              
                                
                                  
                                 document.t.src=Img[ii].src;
              
                                                timerID = setTimeout("startanimation()", 50);
                                                 
                                         break;
                                         
                                            case 18:
                                   
                                  
                                 document.t.src=Img[ii].src;
                          
                                                timerID = setTimeout("startanimation()", 1000);
                                                 
                                         break;
                                        

                                            case 33:
                                            case 34:
                                            case 35:
                                            case 36:
                                            case 37:
                                            case 38:
                                            case 39:

                                            case 72:
                                            case 73:
                                            case 87:
                                            case 90:
                                            case 98:
                                            case 105:
                                            case 111:
                                            case 113:
                                            case 118:
                                            case 130:
                                            
										
                                          
                                  
                                 document.t.src=Img[ii].src;
                           
                                                timerID = setTimeout("startanimation()", 1000);
                                                 
                                         break;
                                        
                                        
                                        
                                         case numpics: /// last frame delay
                                  
                                
                                  
                                 document.t.src=Img[ii].src;
                        
                                                timerID = setTimeout("startanimation()", 1000);
                                             
                                         break;
                                              
                                         default:
                                         document.t.src=Img[ii].src;
                                           timerID = setTimeout("startanimation()", 300);
                                                       

                                        }
                                   
                                    
                                    
                            
                           }
                           else
                           {
                                 
                                 clearTimeout(timerID);
                              
                                    ii=1;
                                 document.t.src=Img[ii].src;
                             
                           }
                           
                            
                           
		        }   
                
    
		</script>


<br />

<button  type="button" onClick="timeID=setTimeout('startanimation()', 200);">Play</button>
		        
<button  type="button" onClick="clearTimeout(timerID)";>Pause</button>
	

 </div>




 <?php
 echo '<br /><br /><br />';
 // Insert the page footer
  require_once('footer.php');
 ?>
