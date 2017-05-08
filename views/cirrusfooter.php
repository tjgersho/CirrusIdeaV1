<?php
require_once('modal/tellafriend.php');
?>

<hr/>
<footer>

<div ng-controller="contactusController as contactusCtrl">
<div ng-include="'views/modal/contactusmodal.php'"></div>
<div ng-include="'views/modal/thanks.html'"></div>
</div>

<div style="background-color:#5CE62E;">
<!-- <div style="background-color:#5CE62E;"> -->
  <div class="container text-center">             
            <div class="row">
                <div class="col-md-12">
                	
                    <div class="logo-bottom" style="margin-top:5px;"><a href="/"><img src="images/cirrusidealogo.png" width="125"/></a></div>
                    
                    <p class="lead social big">
                        <a href="http://www.facebook.com/CirrusIdea/" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="https://twitter.com/CirrusIdea" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/company/cirrusidea?trk=biz-companies-cym" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="https://business.google.com/b/102730247488341512280/dashboard" target="_blank"><i class="fa fa-google-plus"></i></a>
                        <a href="https://www.pinterest.com/cirrusidea/" target="_blank"><i class="fa fa-pinterest"></i></a>
                       <!-- <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-vimeo-square"></i></a>  -->
                        <a  onclick="event.preventDefault()" ng-click="cirrusFooterCtrl.shoutoutdialogopen()"><i class="fa fa-envelope-o"></i></a>
                    </p>
                    
                  </div>
            </div>		
        </div>
</div>

   <div>
   
     <div class="footier">
      <div style="padding:5px; text-align:center;">
        <button id="contactusbutton" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#contactUs" >
         <span class="glyphicon glyphicon-bullhorn"></span><br>
         Contact Us
         </button>
     </div>
    </div>


     <div class="footier">
     
      <p>Copyright &copy;  Paradigm Motion, LLC. All Rights Reserved. <br />
              Design by <a href="http://www.paradigmmotion.com/" target="_blank">Paradigm Motion, LLC</a></p>
        <p><a href="/terms">Terms of Use</a> | <a href="/privacypolicy">Privacy Policy</a></p>
       
       
  
     </div>
     
     
 
  <div class="footier">
<?php 
if (!isset($_SESSION['user_id'])) {
$filename = "../counter.txt"; // This is at root of the file using this script.
$fd = fopen ($filename, "r"); // opening the file counter.txt in read mode
$contents = fread ($fd, filesize($filename)); // reading the content of the file
fclose ($fd); // Closing the file pointer
$contents=$contents+1; // incrementing the counter value by one
$fp = fopen ($filename, "w"); // Open the file in write mode
fwrite ($fp,$contents); // Write the new data to the file
fclose ($fp); // Closing the file pointer 
}
echo '<div class="pagehitcount"  style="text-align:right;">' . $contents . '</div>';
?>


   </div>

  </div>
  


</footer>
 
  <div class="clr"></div>
  <br /><br /><br /><br />

   <br /><br />   <br /><br />	
  

