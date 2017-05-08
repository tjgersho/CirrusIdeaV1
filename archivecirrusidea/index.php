<?php
// Start the session 
require_once('startsession.php');

 // Make sure the user is logged in before going any further.


$root = realpath($_SERVER["DOCUMENT_ROOT"]); 
 
 function resizepics($pics, $newwidth, $newheight,$i){


//$pics = str_replace(' ', '%20', $pics);

//echo $pics;
  list($width, $height) = getimagesize($pics);
 
//echo 'Width:' . $width . '   ';
//echo 'Height:' .$height . '<br />';

if($width > 0 && $height > 0){

if (($width/$height) > $newwidth/$newheight)
{  
 $newheight = ($height / $width) * $newwidth;   

}else {
           $newwidth = ($width / $height) * $newheight; 
} 


   

    if(preg_match("/.jpg/i", basename($pics))){
    $source = imagecreatefromjpeg($pics);
    }
    if(preg_match("/.jpeg/i", basename($pics))){
    $source = imagecreatefromjpeg($pics);
    }
    if(preg_match("/.jpeg/i", basename($pics))){
    $source = Imagecreatefromjpeg($pics);
    }
    if(preg_match("/.png/i", basename($pics))){
    $source = imagecreatefrompng($pics);
    }
    if(preg_match("/.gif/i", basename($pics))){
    $source = imagecreatefromgif($pics);
    }
    
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return imagejpeg($thumb, 'sliderimgs/img'.$i.'.jpg');
   
   if(preg_match("/.jpg/i", basename($pics))){
    return imagejpeg($thumb, 'sliderimgs/img'.$i.'.jpg');
    }
    if(preg_match("/.jpeg/i", basename($pics))){
    return imagejpeg($thumb, 'sliderimgs/img'.$i.'.jpg');
   }
    if(preg_match("/.jpeg/i", basename($pics))){
    return imagejpeg($thumb, 'sliderimgs/img'.$i.'.jpg');
   }
    if(preg_match("/.png/i",  basename($pics))){
    return imagepng($thumb, 'sliderimgs/img'.$i.'.jpg');
   }
    if(preg_match("/.gif/i", basename($pics))){
    return imagegif($thumb, 'sliderimgs/img'.$i.'.jpg');
    }
    
}else{
return "NOTOK";
}

}


   require_once('appvars.php');
  require_once('connectvars.php');
 
//Find some good pictures to show...
  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $query = "SELECT * FROM creativebrainpower WHERE (filename LIKE '%.jpg' OR filename LIKE '%.JPG' OR filename LIKE '%.png' OR filename LIKE '%.PNG' OR filename LIKE '%.gif') AND private = 0 ORDER BY RAND() LIMIT 16";
      $data = mysqli_query($dbc, $query);
     
     
     $i = 0;
      

while ($row = mysqli_fetch_array($data)) {



$src[$i] = $root . $row['file_id']  . '/' . $row['filename'];

$rc = resizepics($src[$i] ,800,700,$i);

$i++;



}


  
 
 
  if (!isset($_SESSION['user_id'])) {
    $page_title = 'Home';
    require_once('header.php');
    


     echo '</div>';
     echo '<div id="fillcontent">';
	} else {
	$page_title = 'Home';
	require_once('appvars.php');
    require_once('connectvars.php');
    require_once('header.php');
	require_once('navmenu.php');
  }

 
if (!isset($_SESSION['user_id'])) {
$filename = "mainpagecount.txt"; // This is at root of the file using this script.
$fd = fopen ($filename, "r"); // opening the file counter.txt in read mode
$contents = fread ($fd, filesize($filename)); // reading the content of the file
fclose ($fd); // Closing the file pointer
$contents=$contents+1; // incrementing the counter value by one
$fp = fopen ($filename, "w"); // Open the file in write mode
fwrite ($fp,$contents); // Write the new data to the file
fclose ($fp); // Closing the file pointer 
}




 $root = realpath($_SERVER["DOCUMENT_ROOT"]); 




  
?>  


<h2>Creation with Socialization</h2>
<h3>Meet, Collaborate, Create</h3>
<br /><br />
<div style="margin-left:100px; width:800px; height:700px; float:left; display:block; clear:both;">

   <!-- use jssor.slider.mini.js (40KB) or jssor.sliderc.mini.js (32KB, with caption, no slideshow) or jssor.sliders.mini.js (28KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="js/jssor.js"></script>
    <script type="text/javascript" src="js/jssor.slider.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            //Reference http://www.jssor.com/development/slider-with-slideshow-jquery.html
            //Reference http://www.jssor.com/development/tool-slideshow-transition-viewer.html

            var _SlideshowTransitions = [
                //Fade Twins
                { $Duration: 700, $Opacity: 2, $Brother: { $Duration: 1000, $Opacity: 2 } },
                //Rotate Overlap
                { $Duration: 1200, $Zoom: 11, $Rotate: -1, $Easing: { $Zoom: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 0.5 }, $Brother: { $Duration: 1200, $Zoom: 1, $Rotate: 1, $Easing: $JssorEasing$.$EaseSwing, $Opacity: 2, $Round: { $Rotate: 0.5 }, $Shift: 90 } },
                //Switch
                { $Duration: 1400, x: 0.25, $Zoom: 1.5, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Zoom: $JssorEasing$.$EaseInSine }, $Opacity: 2, $ZIndex: -10, $Brother: { $Duration: 1400, x: -0.25, $Zoom: 1.5, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Zoom: $JssorEasing$.$EaseInSine }, $Opacity: 2, $ZIndex: -10 } },
                //Rotate Relay
                { $Duration: 1200, $Zoom: 11, $Rotate: 1, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 1 }, $ZIndex: -10, $Brother: { $Duration: 1200, $Zoom: 11, $Rotate: -1, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 1 }, $ZIndex: -10, $Shift: 600 } },
                //Doors
                { $Duration: 1500, x: 0.5, $Cols: 2, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInOutCubic }, $Opacity: 2, $Brother: { $Duration: 1500, $Opacity: 2 } },
                //Rotate in+ out-
                { $Duration: 1500, x: -0.3, y: 0.5, $Zoom: 1, $Rotate: 0.1, $During: { $Left: [0.6, 0.4], $Top: [0.6, 0.4], $Rotate: [0.6, 0.4], $Zoom: [0.6, 0.4] }, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Brother: { $Duration: 1000, $Zoom: 11, $Rotate: -0.5, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Shift: 200 } },
                //Fly Twins
                { $Duration: 1500, x: 0.3, $During: { $Left: [0.6, 0.4] }, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true, $Brother: { $Duration: 1000, x: -0.3, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Rotate in- out+
                { $Duration: 1500, $Zoom: 11, $Rotate: 0.5, $During: { $Left: [0.4, 0.6], $Top: [0.4, 0.6], $Rotate: [0.4, 0.6], $Zoom: [0.4, 0.6] }, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Brother: { $Duration: 1000, $Zoom: 1, $Rotate: -0.5, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Shift: 200 } },
                //Rotate Axis up overlap
                { $Duration: 1200, x: 0.25, y: 0.5, $Rotate: -0.1, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Brother: { $Duration: 1200, x: -0.1, y: -0.7, $Rotate: 0.1, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2 } },
                //Chess Replace TB
                { $Duration: 1600, x: 1, $Rows: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1600, x: -1, $Rows: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Chess Replace LR
                { $Duration: 1600, y: -1, $Cols: 2, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1600, y: 1, $Cols: 2, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Shift TB
                { $Duration: 1200, y: 1, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1200, y: -1, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Shift LR
                { $Duration: 1200, x: 1, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1200, x: -1, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } },
                //Return TB
                { $Duration: 1200, y: -1, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Brother: { $Duration: 1200, y: -1, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Shift: -100 } },
                //Return LR
                { $Duration: 1200, x: 1, $Delay: 40, $Cols: 6, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Brother: { $Duration: 1200, x: 1, $Delay: 40, $Cols: 6, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Shift: -100 } },
                //Rotate Axis down
                { $Duration: 1500, x: -0.1, y: -0.7, $Rotate: 0.1, $During: { $Left: [0.6, 0.4], $Top: [0.6, 0.4], $Rotate: [0.6, 0.4] }, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Brother: { $Duration: 1000, x: 0.2, y: 0.5, $Rotate: -0.1, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2 } },
                //Extrude Replace
                { $Duration: 1600, x: -0.2, $Delay: 40, $Cols: 12, $During: { $Left: [0.4, 0.6] }, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Opacity: $JssorEasing$.$EaseInOutQuad }, $Opacity: 2, $Outside: true, $Round: { $Top: 0.5 }, $Brother: { $Duration: 1000, x: 0.2, $Delay: 40, $Cols: 12, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Assembly: 1028, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Opacity: $JssorEasing$.$EaseInOutQuad }, $Opacity: 2, $Round: { $Top: 0.5 } } }
            ];


            var options = {
                $FillMode: 4,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 2500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                                  //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10,                                  //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.min(parentWidth, 800));
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
        });
    </script>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
    <div id="slider1_container" style="position: relative; width: 800px; height: 700px; background-color:transparent; overflow: hidden; ">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; background-color:transparent; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;  top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 700px; overflow: hidden;">
        
                <div><img src="sliderimgs/img0.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>"  /></div>
               <div><img src="sliderimgs/img1.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>"  /></div>
                 <div><img src="sliderimgs/img2.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>"  /></div>
                  <div><img src="sliderimgs/img3.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>"  /></div>
                 <div><img src="sliderimgs/img4.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>"  /></div>
                <div><img src="sliderimgs/img5.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>"  /></div>
                  <div><img src="sliderimgs/img6.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
                  <div><img src="sliderimgs/img7.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
                  <div><img src="sliderimgs/img8.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
                  <div><img src="sliderimgs/img9.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
                  <div><img src="sliderimgs/img10.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
                  <div><img src="sliderimgs/img11.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
                  <div><img src="sliderimgs/img12.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
                  <div><img src="sliderimgs/img13.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
                  <div><img src="sliderimgs/img14.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
                  <div><img src="sliderimgs/img15.jpg?v=<?php echo Date("Y.m.d.G.i.s")?>" /></div>
        </div>

        <!-- Bullet Navigator Skin Begin -->
        <style>
            /* jssor slider bullet navigator skin 13 css */
            /*
            .jssorb13 div           (normal)
            .jssorb13 div:hover     (normal mouseover)
            .jssorb13 .av           (active)
            .jssorb13 .av:hover     (active mouseover)
            .jssorb13 .dn           (mousedown)
            */
            .jssorb13 div, .jssorb13 div:hover, .jssorb13 .av {
                background: url(imgs/b13.png) no-repeat;
                overflow: hidden;
                cursor: pointer;
            }

            .jssorb13 div {
                background-position: -5px -5px;
            }

                .jssorb13 div:hover, .jssorb13 .av:hover {
                    background-position: -35px -5px;
                }

            .jssorb13 .av {
                background-position: -65px -5px;
            }

            .jssorb13 .dn, .jssorb13 .dn:hover {
                background-position: -95px -5px;
            }
        </style>
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb13" style="position: absolute; bottom: 16px; right: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 21px; HEIGHT: 21px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">javascript</a>
    </div>
    <!-- Jssor Slider End -->




</div>
<br />
<br />
<br />

  <div style="margin-left: 20px;  float:left; width:350px;">
      <a class="stylebutton" style="text-decoration:none;" href="aboutvideo.php">
About CirrusIdea
</a>

<p>
The best place for idea development and collaboration. CirrusIdea is where ideas are grown from nothing in to a reality.<br />
<br />
Start your next project here, where you can co-develop in the cloud and make your idea public or keep it private as your project develops.

</p>
</div>

<br />


<br /><br />

<?php
if(!isset($_SESSION['username'])){
?>

<div style="width:180px; margin: 20px;  float:left;">
<p style="font-size:15px;">
  <form method="post" action="signup.php">
        <input type="submit"  class="stylebutton" value="Sign Up Now" name="submit1" />
  </form>
  </p>
 </div>
 <br /><br /><br />
 <div style="width:180px; margin: 20px; float:left;">
 <p style="font-size:15px;"><form method="post" action="http://www.cirrusidea.com/login.php">
Log In as Anonymous and Browse CirrusIdea.com:<br />
<input type="hidden" name="username" value="Anonymous"/>
<input type="hidden" name="password" value="123"/>
<input type="submit" class="stylebutton" value="Log In as Anonymous" name="submit"/></form></p></div>
  <br /><br /><br />
 <?php
}
 
 

  // Insert the page footer
  require_once('footer.php');
?>

