<?php
?>


<script>
       jQuery(document).ready(function ($) {
       
           var _CaptionTransitions = [];
            _CaptionTransitions["L"] = { $Duration: 200, x: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["R"] = { $Duration: 200, x: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["T"] = { $Duration: 200, y: 0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["B"] = { $Duration: 200, y: -0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["ZMF-10"] = { $Duration: 200, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 };
            _CaptionTransitions["RTT-10"] = { $Duration: 200, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} };
            _CaptionTransitions["RTT-2"] = { $Duration: 200, $Zoom: 3, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 0.5} };
            _CaptionTransitions["RTTL-BR"] = { $Duration: 200, x: -0.6, y: -0.6, $Zoom: 11, $Rotate: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} };
            _CaptionTransitions["CLIP-LR"] = { $Duration: 200, $Clip: 15, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic }, $Opacity: 2 };
            _CaptionTransitions["MCLIP-L"] = { $Duration: 200, $Clip: 1, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };
            _CaptionTransitions["MCLIP-R"] = { $Duration: 200, $Clip: 2, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };
            _CaptionTransitions["CUST1"] = {$Duration:1800,x:0.4,y:0.8,$Zoom:11,$Rotate:-1.5,$Easing:{$Left:$JssorEasing$.$EaseInOutElastic,$Top:$JssorEasing$.$EaseInOutElastic,$Zoom:$JssorEasing$.$EaseInElastic,$Rotate:$JssorEasing$.$EaseInOutElastic},$Opacity:2,$During:{$Zoom:[0,0.8],$Opacity:[0,0.7]},$Round:{$Rotate:0.5}}
            _CaptionTransitions["CUST2"] = {$Duration:900,x:-0.6,$Zoom:11,$Easing:{$Left:$JssorEasing$.$EaseInCubic,$Zoom:$JssorEasing$.$EaseInCubic},$Opacity:2}
       
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 900,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
 $CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
                    $Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
                    $CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
                    $PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
                    $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
                },

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                },

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $AutoCenter: 0,                                 //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 9,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 260,                          //[Optional] The offset position to park thumbnail
                    $Orientation: 1,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                    $DisableDrag: false                            //[Optional] Disable drag or not, default value is false
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 980));
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
    <div style="position: relative; width: 100%; background-color: #CAFFCA;  background-image: url('images/bg.png');  background-size: 100% 100%;  background-repeat: no-repeat; overflow: hidden;">
        <div style="position: relative; left: 50%; width: 5000px; text-align: center; margin-left: -2500px;">
            <!-- Jssor Slider Begin -->
            <div id="slider1_container" style="position: relative; margin: 0 auto;  top: 0px; left: 0px; width: 980px; height: 400px;">
                            <!-- Loading Screen -->
                <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;">
                    </div>
                    <div style="position: absolute; display: block; background: url(images/loading.gif) no-repeat center center;  top: 0px; left: 0px; width: 100%; height: 100%;">
                    </div>
                </div>
                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 980px;  height: 400px; overflow: hidden;">
                    <div>
                        <img src="images/geek1.png" style="position: absolute; top: 0px; left: 0px; width: 100%;" />
                        <img u="thumb" src="images/geek1.jpg" />
                        
                          <div  u="caption" t="CUST1" t2="R"  d="200"  du="1000"  style="position: absolute; width: 800px; height: 300px; top: 10px; left: 30px; text-align: left; line-height: 1.8em; font-size: 12px;">
                           
                            <span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 52px; color: #001E29;">The New Best Place To Think</span>
                          
                          </div>
                          
                          <div  u="caption" t="CUST1" t2="T"  d="200"  du="1000"  style="position: absolute; width: 780px; height: 300px; top: 150px; left: 100px; text-align: left; line-height: 1.8em; font-size: 12px;">

                            <span style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                               Keeping your head in the clouds is a great thing
                             </span>
                             <br />
                          <br />
                            <span style="display: block; line-height: 1.1em; font-size: 1.5em; color: #001E29;">
                               <h1>Ideas, Thoughts and Incentive</h1>
                            </span>
                           

                        </div>
                        <div  u="caption" t="CUST1" t2="T"  d="300"  du="1000"  style="position: absolute; width: 300px; height: 300px; top: 275px; left: 250px; text-align: left; line-height: 1.8em; font-size: 12px;">
        
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em;">
                                <a href="/cirrus" class="btn btn-success btn-lg" style="color:#001E29;">Browse CirrusIdeas</a>
                            </span>

                         </div>
                        
                        
                    </div>
                    <div>
                        <img src="images/geek2.png" style="position: absolute; top: 0px; left: 0px; width: 100%;" />
                        <img u="thumb" src="images/geek2.jpg" />
                        
                        <div  u="caption" t="CUST2" t2="B"  d="100"  du="1500" style="position: absolute; width: 780px; height: 300px; top: 10px; left: 100px;  text-align: left; line-height: 1.8em; font-size: 12px;">
                            <span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 52px; color: #001E29;">Build Credibility</span>
                            
                            </div>
                            
                            <div  u="caption" t="CUST1" t2="B"  d="500"  du="2000" style="position: absolute; width: 780px; height: 300px; top: 100px; left: 100px;  text-align: left; line-height: 1.8em; font-size: 12px;">

                            <span style="display: block; line-height: 1.1em; font-size: 2.2em; color: #001E29;">
                              Ideas = Contributions
                             <br />
                             <br />
                             Thoughts =  Contributions
                             <br />
                             <br />
                             <b>Contributions = Money</b>
                                <br />
                             <br />
                             <b>Mo-Cred = Mo-Money</b> 
                            </span>
                          
                           
                        </div>
                          <div  u="caption" t="T" t2="T"  d="1000"  du="1000"  style="position: absolute; width: 300px; height: 300px; top: 150px; left: 600px; text-align: left; line-height: 1.8em; font-size: 12px;">
        
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                <a href="/signup" class="btn btn-info btn-lg" >Signup Today</a>
                            </span>

                         </div>

                    </div>
                    <div>
                     <img src="images/geek3.png" style="position: absolute; top: 0px; left: 0px; width: 100%;" />
                        <img u="thumb" src="images/geek3.jpg" />
                        <div u="caption" t="*" t2="L"  d="500"  du="2000"   style="position: absolute; width: 700px; height: 300px; top: 10px; left: 10px;  text-align: left; line-height: 1.8em; font-size: 12px;">
                            <span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 52px; color: #001E29;">Explore Limitless Ideas and Thoughts</span>
                          
                        </div>
                          <div u="caption" t="B" t2="L"  d="800"  du="2000"   style="position: absolute; width: 780px; height: 300px; top: 150px; left: 100px;  text-align: left; line-height: 1.8em; font-size: 12px;">

                          
                            <span style="display: block; line-height: 1.5em; font-size: 2.5em; color: #001E29;">
                               Categories from Art to Science to Philosophy <br /> <br /> -- AND START YOUR OWN --
                            </span>
                            <div class="clr"></div>
                           
                        </div>
                        
                           <div  u="caption" t="R" t2="T"  d="1000"  du="1000"  style="position: absolute; width: 300px; height: 300px; top: 300px; left: 200px; text-align: left; line-height: 1.8em; font-size: 12px;">
        
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em;">
                                <a href="/cirrus" class="btn btn-success btn-lg" style="color:#001E29;">Browse CirrusIdeas</a>
                            </span>

                         </div>
                       
                    </div>
                    <div>
                     <img src="images/geek4.png" style="position: absolute; top: 0px; left: 0px; width: 100%;" />
                        <img u="thumb" src="images/geek4.jpg" />
                        <div u="caption" t="MCLIP-L" t2="T"  d="500" du="1000"  style="position: absolute; width: 780px; height: 300px; top: 10px; left: 50px;  text-align: left; line-height: 1.8em; font-size: 12px;"> 
                            <span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 3.0em; color: #001E29;">A platform to organize and develop your <i>Thinking</i></span>
                         </div>
                         
                         <div u="caption" t="MCLIP-R" t2="T"  d="500" du="1000"  style="position: absolute; width: 780px; height: 300px; top: 150px; left: 100px;  text-align: left; line-height: 1.8em; font-size: 12px;"> 
  
                            <span style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                Structure Your Idea How You Want
                            </span>
                             <div class="clr"></div>
                            
                          </div>
                        
                           <div  u="caption" t="CUST1" t2="T"  d="200"  du="1000"  style="position: absolute; width: 300px; height: 300px; top: 250px; left: 300px; text-align: left; line-height: 1.8em; font-size: 12px;">
        
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                <a href="/signup" class="btn btn-info btn-lg" >Signup Today</a>
                            </span>
 <div class="clr"></div>
                         </div>
                       
                    </div>
                    <div>
                        <img src="images/geek6.png" style="position: absolute; top: 0px; left: 0px; width: 100%;" />
                        <img u="thumb" src="images/geek6.jpg" />
                       
                        <div u="caption" t="MCLIP-R" t2="T"  d="500"  du="1000" style="position: absolute; width: 900px; height: 300px; top: 10px; left: 10px;  text-align: left; line-height: 1.8em; font-size: 12px;">
                            <span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 3.5em; color: #001E29;">Go Private and Secure  </span>
                             <br />
                             <span style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                               Share your private Ideas with your selected CoDevelopers
                               </span>

                                                           
                          </div>  
                            <div u="caption" t="MCLIP-L" t2="B"  d="700"  du="1000" style="position: absolute; width: 780px; height: 300px; top: 280px; left: 10px;  text-align: left; line-height: 1.8em; font-size: 12px;">

                                      <span style="display: block; line-height: 1.8em; font-size: 2.5em; color: #001E29;">
                               Or open your Ideas to the World and Make the Difference
                               </span>
               
                                                    
                        </div>
                        
                        <div  u="caption" t="CUST1" t2="T"  d="200"  du="1000"  style="position: absolute; width: 300px; height: 300px; top: 200px; left: 500px; text-align: left; line-height: 1.8em; font-size: 12px;">
        
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                <a href="/signup" class="btn btn-info btn-lg" >Signup Today</a>
                            </span>

                         </div>

                        
                    </div>
                     <div>
                       <img src="images/geek8.png" style="position: absolute; top: 0px; left: 0px; width: 100%;" />
                        <img u="thumb" src="images/geek8.jpg" />
                        <div u="caption" t="ZMF-10" t2="R"  d="500" du="1000"  style="position: absolute; width: 850px; height: 300px; top: 10px; left: 10px;  text-align: left; line-height: 1.8em; font-size: 12px;">
                            <span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 52px; color: #001E29;">Safely Store Files, Ideas and Thoughts. 
                            <br />
                            <br />Securely share with CoDevelopers and Friends</span>
                           
                                                    
                        </div>
                        
   <div  u="caption" t="CUST1" t2="T"  d="200"  du="1000"  style="position: absolute; width: 300px; height: 300px; top: 300px; left: 200px; text-align: left; line-height: 1.8em; font-size: 12px;">
        
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                <a href="/signup" class="btn btn-info btn-lg" >Signup Today</a>
                            </span>

                         </div>
                       
                    </div>
                    <div>
                       <img src="images/geek9.png" style="position: absolute; top: 0px; left: 0px; width: 100%;" />
                        <img u="thumb" src="images/geek9.jpg" />
                        <div u="caption" t="*" t2="B"  d="2000"  du="500"  style="position: absolute; width: 780px; height: 300px; top: 10px; left: 100px;  text-align: left; line-height: 1.8em; font-size: 12px;">
                            <span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 52px; color: #001E29;">Easily Upload Your Thoughts.</span>
                           
                                                    
                            </div>
                              <div u="caption" t="*" t2="R"  d="1000"  du="2000"  style="position: absolute; width: 780px; height: 300px; top: 160px; left: 50px;  text-align: left; line-height: 1.8em; font-size: 12px;">

                            <span style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                Stop Letting Your Thoughts Go Down the Drain
                            </span>
                                                 
                        </div>
                        
                           <div  u="caption" t="CUST1" t2="T"  d="200"  du="1000"  style="position: absolute; width: 300px; height: 300px; top: 250px; left: 300px; text-align: left; line-height: 1.8em; font-size: 12px;">
        
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                <a href="/signup" class="btn btn-info btn-lg" >Signup Today</a>
                            </span>

                         </div>
                        
                    </div>
                    <div>
                     <img src="images/geek11.png" style="position: absolute; top: 0px; left: 0px; width: 100%;" />
                        <img u="thumb" src="images/geek11.jpg" />
                        <div u="caption" t="R" t2="L"  d="2000"  du="2000"  style="position: absolute; width: 800px; height: 300px; top: 20px; left: 30px;  text-align: left; line-height: 1.8em; font-size: 12px;">
                            <span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 52px; color: #001E29;">Simple and free for all users</span>
                           
                            </div>   
                            
                                 <div u="caption" t="*" t2="B"  d="2000"  du="500"  style="position: absolute; width: 580px; height: 300px; top: 150px; left: 100px;  text-align: left; line-height: 1.8em; font-size: 12px;">
                   
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                               Learn Grow and Make the World a Better Place
                            </span>

                        
                       
                    </div>
                    
                       <div  u="caption" t="B" t2="T"  d="200"  du="1000"  style="position: absolute; width: 300px; height: 300px; top: 250px; left: 300px; text-align: left; line-height: 1.8em; font-size: 12px;">
        
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                <a href="/signup" class="btn btn-info btn-lg" >Signup Today</a>
                            </span>

                         </div>
                  </div>
                </div>
                
                <!-- Arrow Navigator Skin Begin -->
                <style>
                    /* jssor slider arrow navigator skin 07 css */
                    /*
                    .jssora07l              (normal)
                    .jssora07r              (normal)
                    .jssora07l:hover        (normal mouseover)
                    .jssora07r:hover        (normal mouseover)
                    .jssora07ldn            (mousedown)
                    .jssora07rdn            (mousedown)
                    */
                    .jssora07l, .jssora07r, .jssora07ldn, .jssora07rdn {
                        position: absolute;
                        cursor: pointer;
                        display: block;
                        background: url(images/a07.png) no-repeat;
                        overflow: hidden;
                    }

                    .jssora07l {
                        background-position: -5px -35px;
                    }

                    .jssora07r {
                        background-position: -65px -35px;
                    }

                    .jssora07l:hover {
                        background-position: -125px -35px;
                    }

                    .jssora07r:hover {
                        background-position: -185px -35px;
                    }

                    .jssora07ldn {
                        background-position: -245px -35px;
                    }

                    .jssora07rdn {
                        background-position: -305px -35px;
                    }
                </style>
                <!-- Arrow Left -->
                <span u="arrowleft" class="jssora07l" style="width: 50px; height: 50px; top: 123px; left: 8px;"></span>
                <!-- Arrow Right -->
                <span u="arrowright" class="jssora07r" style="width: 50px; height: 50px; top: 123px; right: 8px"></span>
                <!-- Arrow Navigator Skin End -->
                <!-- ThumbnailNavigator Skin Begin -->
                <div u="thumbnavigator" class="jssort04" style="position: absolute; width: 600px; height: 60px; right: 0px; bottom: 0px;">
                    <!-- Thumbnail Item Skin Begin -->
                    <style>
                        /* jssor slider thumbnail navigator skin 04 css */
                        /*
                        .jssort04 .p            (normal)
                        .jssort04 .p:hover      (normal mouseover)
                        .jssort04 .pav          (active)
                        .jssort04 .pav:hover    (active mouseover)
                        .jssort04 .pdn          (mousedown)
                        */
                        .jssort04 .w, .jssort04 .pav:hover .w {
                            position: absolute;
                            width: 60px;
                            height: 30px;
                            border: #0099FF 1px solid;
                        }

                        * html .jssort04 .w {
                            width: /**/ 62px;
                            height: /**/ 32px;
                        }

                        .jssort04 .pdn .w, .jssort04 .pav .w {
                            border-style: solid;
                        }

                        .jssort04 .c {
                            width: 62px;
                            height: 32px;
                            filter: alpha(opacity=45);
                            opacity: .45;
                            transition: opacity .6s;
                            -moz-transition: opacity .6s;
                            -webkit-transition: opacity .6s;
                            -o-transition: opacity .6s;
                        }

                        .jssort04 .p:hover .c, .jssort04 .pav .c {
                            filter: alpha(opacity=0);
                            opacity: 0;
                        }

                        .jssort04 .p:hover .c {
                            transition: none;
                            -moz-transition: none;
                            -webkit-transition: none;
                            -o-transition: none;
                        }
                    </style>
                    <div u="slides" style="bottom: 25px; right: 30px;">
                        <div u="prototype" class="p" style="position: absolute; width: 62px; height: 32px; top: 0; left: 0;">
                            <div class="w">
                                <thumbnailtemplate style="width: 100%; height: 100%; border: none; position: absolute; top: 0; left: 0;"></thumbnailtemplate>
                            </div>
                            <div class="c" style="position: absolute; background-color: #000; top: 0; left: 0">
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnail Item Skin End -->
                </div>
                <!-- ThumbnailNavigator Skin End -->
                <a style="display: none" href="http://www.jssor.com">javascript</a>
            </div>
            <!-- Jssor Slider End -->
        </div>
    </div>

 <!-- start about area -->
    <section id="aboutArea" class="text-center">
    	<div class="container">
             
            <div class="row">
            
                <div class="col-md-12">
                
                    <h2>Cirrus<cite>Idea</cite></h2>
                    
                    <div class="hline"></div>
					
                    <h5>Think, Question, Learn, Grow, Collaborate and <cite><b>Create</b></cite></h5>
                                        
                </div>
				
                <div class="col-space"></div>
				
              
                	
            </div>

        </div>
        
       
        	<div class="container">
        		<div class="row">
                	
                    <div class="col-md-12">
                    	
                        <h4>A world of <cite>Wonder,</cite></h4>
						
                        <h3>and <cite>Possibilities.</cite></h3>
                        
                    </div>
                    
                    </div>
                    <div class="clr"></div>
                    </div>
                    <div class="container">
        		<div class="row">
                    
                    <div class="col-sm-4">
                      <div class="services">
                       <div>
                        <div class="circleBox">
                            <div class="circle-border-outside">
                                <div class="circle-border-inside">
                                
                                    <i class="fa fa-lightbulb-o fa-3x"></i>
                                </div>
                                <div class="circle-triangle"></div>
                            </div>
                        </div>
                        </div>
                        
                        <h5>Do You Have an Idea?</h5>
                        
                        <p>Use CirrusIdea to develop your idea and make it a reality.</p>
                                        <br /><br />
 				<span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                <a href="/signup" class="btn btn-info btn-lg" >Signup Today</a>
                            </span>

                      </div>  
                        
                            
                    </div>
                        
                    <div class="col-sm-4">
                     <div class="services">
                      <div>
                        <div class="circleBox">
                            <div class="circle-border-outside">
                                <div class="circle-border-inside">
                                    <i class="fa fa-cog fa-spin"></i>
                                </div>
                                <div class="circle-triangle"></div>
                            </div>
                        </div>
                        </div>
                         <h5>Keep on Thinking and Developing your Ideas</h5>
                        
                        <p>Post your thoughts and supporting files to show idea development.</p>
                            
                            <span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                <a href="/signup" class="btn btn-info btn-lg" >Signup Today</a>
                            </span>

                         </div>
                           
                    </div>
                        
                     <div class="col-sm-4">
                        <div class="services">
                         <div>
                        <div class="circleBox">
                            <div class="circle-border-outside">
                                <div class="circle-border-inside">
                                    <i class="fa fa fa-money"></i>
                                </div>
                                <div class="circle-triangle"></div>
                            </div>
                        </div>
                         
           </div>
<h5>Donations Drive Thought and Progress</h5>
                        
                        <p>Your public ideas can get attentention and recieve incentivizing donations.</p>
 				<span  style="display: block; line-height: 1.1em; font-size: 2.5em; color: #001E29;">
                                <a href="/signup" class="btn btn-info btn-lg" >Signup Today</a>
                            </span>

</div>
                         </div>
                         
                                                           
            	</div>
        
      </div>
        
        <div class="container">
            <div class="row">
                
                <div class="col-md-12">
                    
                    <h3>Cirrus<cite>Ideas</cite> Get Payouts</h3>
                    
                </div>
                
                 </div>
	    	  
	   
          </div>  
                
                
                <div class="container">

               <h4>Here is a Cirrus<cite>Idea</cite> Payout Poll:</h4> 
	       <div id="exPayout" class="progress" style="position: relative; height:40px; background-image: url('images/postcred.png'); background-size: 30px 30px; background-repeat: no-repeat; background-position: right;">
		     <span id="expayoutPointDollarLeft" class="glyphicon glyphicon-usd" style="position:absolute; top:20px;"></span>
		     <i id="expayoutPoint" class="fa fa-arrow-down" style="position:absolute; top:27px;"></i>
		     <span id="expayoutPointDollarRight" class="glyphicon glyphicon-usd" style="position:absolute;top:20px;"></span>
		  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" style="opacity: 0.4; filter: alpha(opacity=40); width:35%;">
	   		 <div style="position:absolute; padding-left:5px; color:black;">Payout- 35% </div>
	  	  </div>
	 	  <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" style="opacity: 0.4; filter: alpha(opacity=40); width: 65%;">
	  		      <div style="position:absolute; padding-left:5px; color:black;">Needs Thought - 65%</div>

	  	  </div>
	    	  
	    	  
               </div>
                   
                              
                    <h4>Get Paid When Member Voting Gets The Idea to 60% Payout.</h4>
       </div>         
        
        
        
        
               <div class="container">

               <h4>Here is a Payout Poll ready for Payout!</h4> 
	       <div id="exPayout1" class="progress" style="position: relative; height:40px; background-image: url('images/postcred.png'); background-size: 30px 30px; background-repeat: no-repeat; background-position: right;">
		     <span id="expayoutPointDollarLeft1" class="glyphicon glyphicon-usd blinkit" style="position:absolute; top:20px;"></span>
		     <i id="expayoutPoint1" class="fa fa-arrow-down blinkit" style="position:absolute; top:27px;"></i>
		     <span id="expayoutPointDollarRight1" class="glyphicon glyphicon-usd blinkit" style="position:absolute;top:20px;"></span>
		  <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="opacity: 0.4; filter: alpha(opacity=40); width:60%;">
	   		 <div class="blinkit" style="position:absolute; padding-left:5px; color:black;">Payout- 60% </div>
	  	  </div>
	 	  <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" style="opacity: 0.4; filter: alpha(opacity=40); width: 40%;">
	  		      <div style="position:absolute; padding-left:5px; color:black;">Needs Thought - 40%</div>

	  	  </div>
	    	  
	    	  
               </div>
               
                <br /><br />
  <div style="text-align:center;">
  <img src="images/payout.png" width="100%" style="max-width:700px;"/>
  </div>

<div class="container">
<br /><br /><br />

<a  href="/signup"><div id="signupButton">Sign Up</div></a>
</div>


	
          <script>
          (function(){
          
          var exPayoutWidthCtrl1 = function(){      
         
             
           $("#expayoutPoint1").css('left', ($("#exPayout1").width()*0.6-7) + 'px');
            $("#expayoutPointDollarLeft1").css('left', ($("#exPayout1").width()*0.55-7) + 'px');
          
            $("#expayoutPointDollarRight1").css('left', ($("#exPayout1").width()*0.65-7) + 'px');
           };
           
           
           
          
          
           var exPayoutWidthCtrl = function(){      
         
             
           $("#expayoutPoint").css('left', ($("#exPayout").width()*0.6-7) + 'px');
            $("#expayoutPointDollarLeft").css('left', ($("#exPayout").width()*0.55-7) + 'px');
          
            $("#expayoutPointDollarRight").css('left', ($("#exPayout").width()*0.65-7) + 'px');
           };
           
           exPayoutWidthCtrl();
           exPayoutWidthCtrl1();
           
          window.onresize = function(event) {
                   exPayoutWidthCtrl1();
                   exPayoutWidthCtrl();
                     };
          

          })();
          
          </script>                    
                              
       </div>         
        
        
    </section>
    <!-- end about area -->

<div class="container">
            
   
                <h2>Some <cite>Thoughts:</cite></h2>
           
        

</div>
  
            
<div class="container">
<div class="row">
 <div class="span12">      

 <script>
        jssor_slider2_starter = function (containerId) {
            //Reference http://www.jssor.com/development/slider-with-slideshow-no-jquery.html
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

            var options1 = {
                $FillMode: 1,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
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

            var jssor_slider2 = new $JssorSlider$(containerId, options1);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider2() {
                var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider2.$ScaleWidth(Math.min(parentWidth, 600));
                else
                    $Jssor$.$Delay(ScaleSlider2, 30);
            }

            ScaleSlider2();
            $Jssor$.$AddEvent(window, "load", ScaleSlider2);

            $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider2));
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider2);
            //responsive code end
        };
    </script>
    <!-- Jssor Slider Begin -->
    <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
    <div id="slider2_container" style="position: relative; margin-left:auto; margin-right:auto; background-color:transparent; width: 800px; height: 500px;  overflow: hidden; ">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; background-color:transparent; width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(images/loading.gif) no-repeat center center;  width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute;background-color:transparent; left: 0px; top: 0px; width: 800px; height: 500px; overflow: hidden;">
            
            <?php 

            
             require_once('../api/connectvars.php');
 
           //Find some good pictures to show...
           // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $query = "SELECT * FROM thoughts WHERE (filename LIKE '%.jpg' OR filename LIKE '%.JPG' OR filename LIKE '%.png' OR filename LIKE '%.PNG' OR filename LIKE '%.gif') ORDER BY RAND()";
     $data = mysqli_query($dbc, $query);

$i = 0;

     while ($row = mysqli_fetch_array($data)) {

           $query1 = "SELECT * FROM ideas WHERE file_path ='".dirname($row['path'])."' AND file_name ='".basename($row['path'])."' LIMIT 1";
     $data1 = mysqli_query($dbc, $query1);

     $isPub = false;
     $row1 = mysqli_fetch_array($data1);
            if($row1['file_private'] != 1){
               $isPub = true;
             }
          
         if($isPub){
          $file_info = pathinfo($row['filename']);
     
             if(file_exists('..'. $row['path']. '/' . $file_info['filename'].'gallery4434.' . $file_info['extension'] )  ){
                 $src[$i] = ltrim($row['path']  .'/' . $file_info['filename'].'gallery4434.' . $file_info['extension'], '/');
              $i++;
             }

           } 
        
          if($i>10){
            break;
            }

       }
  

          
            foreach ($src as $img ){
          
            
            echo '<div>';
            echo '<img  data-u="image"  src="';
            echo $img;
            echo '" style="position: relative;"/>';
            echo '</div>';
           
         
            }
            
            ?>
                  </div>
        
        <!--#region Bullet Navigator Skin Begin -->
        <!-- Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html -->
        <style>
            /* jssor slider bullet navigator skin 13 css */
            /*
            .jssorb13 div           (normal)
            .jssorb13 div:hover     (normal mouseover)
            .jssorb13 .av           (active)
            .jssorb13 .av:hover     (active mouseover)
            .jssorb13 .dn           (mousedown)
            */
            .jssorb13 {
                position: absolute;
            }
            .jssorb13 div, .jssorb13 div:hover, .jssorb13 .av {
                position: absolute;
                /* size of bullet elment */
                width: 21px;
                height: 21px;
                background: url(images/b13.png) no-repeat;
                overflow: hidden;
                cursor: pointer;
            }
            .jssorb13 div { background-position: -5px -5px; }
            .jssorb13 div:hover, .jssorb13 .av:hover { background-position: -35px -5px; }
            .jssorb13 .av { background-position: -65px -5px; }
            .jssorb13 .dn, .jssorb13 .dn:hover { background-position: -95px -5px; }
        </style>
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb13" style="bottom: 16px; right: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype"></div>
        </div>
        <!--#endregion Bullet Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">Bootstrap Slider</a>
        <!-- Trigger -->
        <script>
            jssor_slider2_starter('slider2_container');
        </script>

    </div>
    <!-- Jssor Slider End -->


  <br /><br />
  <div style="text-align:center;">
  <img src="images/chart.png" width="100%" style="max-width:700px;"/>
  </div>
</div>
</div>
</div>




