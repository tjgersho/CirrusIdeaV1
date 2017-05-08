<!DOCTYPE html>

<!-- PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> -->

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

<link rel="stylesheet" href="http://www.cirrusidea.com/css/blueimp-gallery.min.css">
 
 <link href="http://www.cirrusidea.com/jqueryui/jquery-ui.css" rel="stylesheet">
<style>
.loader {
    position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('images/loading.gif') 50% 50% no-repeat rgb(249,249,249);
	background-size:60px 60px;
}
</style>
 
 
 <!--Get jQuery --> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="http://www.cirrusidea.com/jqueryui/external/jquery/jquery.js"></script>
<script src="http://www.cirrusidea.com/jqueryui/jquery-ui.js"></script>

<!-- A Nice JavaScript library.. movable form fields -->
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>

<!-- eLSTIC tEXT AREA -->
<!--<script src="http://www.cirrusidea.com/js/jquery.elastic.source.js" type="text/javascript" charset="utf-8"></script> 
-->


<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-533f0c6527e4cec0"></script>
<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'left',
      'numPreferredServices' : 5
    }   
  });
</script>
<!-- AddThis Smart Layers END -->

<script type="text/javascript" src="js/jquery.min.js"></script>


  <script type="text/javascript" src="/js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
     $(document).ready(function() {
        $('#slider').nivoSlider();
    });
  </script>
  
<script>
 $(document).ready(function() {
    $('.yourprivatefoldercontainer').hover(function() {
       $(this).css("background-image", "url(http://www.cirrusidea.com/images/privateyourfolderlinkhover.png)");
        $(this).children().children().children('.yourfolderbutton').show(250);        

    }, function() {
	 $(this).css("background-image", "url(http://www.cirrusidea.com/images/privateyourfolderlink.png)");
        $(this).children().children().children('.yourfolderbutton').delay(1500).hide(800);
        
        
    });  
	
	$('.yourfoldercontainer').hover(function() {
       $(this).css("background-image", "url(http://www.cirrusidea.com/images/yourfolderlinkhover.png)");
        $(this).children().children().children('.yourfolderbutton').show(250);        
		
    }, function() {
	 $(this).css("background-image", "url(http://www.cirrusidea.com/images/yourfolderlink.png)");
        
		
            $(this).children().children().children('.yourfolderbutton').delay(1500).hide(800);
      
        
    });  
	
	$('.foldercontainer').hover(function() {
       $(this).css("background-image", "url(http://www.cirrusidea.com/images/folderlinkhover.png)");

    }, function() {
	 $(this).css("background-image", "url(http://www.cirrusidea.com/images/folderlink.png)");
        
        
    });  
	
		$('.privatefoldercontainer').hover(function() {
       $(this).css("background-image", "url(http://www.cirrusidea.com/images/privatefolderlinkhover.png)");

    }, function() {
	 $(this).css("background-image", "url(http://www.cirrusidea.com/images/privatefolderlink.png)");
        
        
    });  
	
});
 
  
</script>

<?php
if ($_SESSION['newuser']){
?>
<script>
var tooltip=function(){
 var id = 'tt';
 var top = 5;
 var left = 5;
 var maxw = 800;
 var speed = 10;
 var timer = 20;
 var endalpha = 100;
 var alpha = 0;
 var tt,c,h;
 var ie = document.all ? true : false;
 return{
  show:function(v,w){
   if(tt == null){
    tt = document.createElement('div');
    tt.setAttribute('id',id);
    c = document.createElement('div');
    c.setAttribute('id',id + 'cont');
    tt.appendChild(c);
    document.body.appendChild(tt);
    tt.style.opacity = 30;
    tt.style.filter = 'alpha(opacity=30)';
    document.onmousemove = this.pos;
   }
   tt.style.display = 'block';
   c.innerHTML = v;
   tt.style.width = w ? w + 'px' : 'auto';
   if(!w && ie){

    tt.style.width = tt.offsetWidth;

   }
  if(tt.offsetWidth > maxw){tt.style.width = maxw + 'px'}
  h = parseInt(tt.offsetHeight) + top;
  clearInterval(tt.timer);
  tt.timer = setInterval(function(){tooltip.fade(1)},timer);
  },
  pos:function(e){
   var u = ie ? event.clientY + document.documentElement.scrollTop : e.pageY;
   var l = ie ? event.clientX + document.documentElement.scrollLeft : e.pageX;
   tt.style.top = (u - h) + 'px';
   tt.style.left = (l + left) + 'px';
  },
  fade:function(d){
   var a = alpha;
   if((a != endalpha && d == 1) || (a != 0 && d == -1)){
    var i = speed;
   if(endalpha - a < speed && d == 1){
    i = endalpha - a;
   }else if(alpha < speed && d == -1){
     i = a;
   }
   alpha = a + (i * d);
   tt.style.opacity = alpha * .01;
   tt.style.filter = 'alpha(opacity=' + alpha + ')';
  }else{
    clearInterval(tt.timer);
     if(d == -1){tt.style.display = 'none'}
  }
 },
 hide:function(){
  clearInterval(tt.timer);
   tt.timer = setInterval(function(){tooltip.fade(-1)},timer);
  }
 };
}();
</script>

<?php
}
?>

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


<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
})
</script>


</head>
<body>
<div class="loader"></div>
<div id="allcontent">
 
<?php

echo '<div id="headcontainer"><div id="logo">'; 

echo '<a href="http://www.cirrusidea.com/"><img id="logo" border="0" src="http://www.cirrusidea.com/images/cirrusidealogo.png" alt="CirrusIdea Logo" height="155" /></a></div>';



//  $isiPad = strchr($_SERVER['HTTP_USER_AGENT'],'iPad');
//if ($isiPad!=NULL){
//echo 'iPad App comming soon!   Use IE or Firefox for best results.';
//exit();
//}

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
<form  method="post" action="http://www.cirrusidea.com/login.php?page=<?php echo $loginloc; ?>&Anonymous=1">
<input type="hidden" name="username" value="Anonymous"/>
<input type="hidden" name="password" value="123"/>
<input type="submit" class="stylebutton" value="Log In as Anonymous" name="submit"/></form>
</td></tr></table>
</div>

<?php
}




?>
