<?php
?>
<!-- Modal -->
<div id="TellAFriend" class="modal fade" role="dialog">
  	    <div class="modal-dialog modal-lg">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal">&times;</button>
      		    <h4 class="modal-title">Tell a Friend about CirrusIdea</h4>
      	          </div>
      	          
      	          <div class="modal-body">
      	          
                 <form name="shoutoutForm" role="form" novalidate>
                 

   			<div class="form-group" ng-if="!mainCtrl.userService.isLoggedIn">
		                <label for="yourName">Your Name:</label>
		<input type="text" id="your_name" name="your_name" class="form-control"  placeholder="Enter Your Name" ng-model="cirrusFooterCtrl.shoutout.your_name" required>
		               </div>
                
	     	 
	     	  <div ng-show="cirrusFooterCtrl.shoutouterr.yourname_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="cirrusFooterCtrl.shoutouterr.yourname_errmsg"></div>
	     	 </div>	

                 <div class="form-group" ng-if="!mainCtrl.userService.isLoggedIn">
		                <label for="yourEmail">Your Email:</label>
		 <input type="email" id="your_email" name="your_email" class="form-control"  placeholder="Enter Your Email" ng-model="cirrusFooterCtrl.shoutout.your_email" required>
		               </div>
		                              
                  <div ng-show="cirrusFooterCtrl.shoutouterr.youremail_errmsg !== ''">
	     	    <div class="alert alert-danger" role="alert" ng-bind="cirrusFooterCtrl.shoutouterr.youremail_errmsg"></div>
	     	 </div>	

                 
                              <div class="form-group">
		                <label for="friendEmail">Your Friends Email:</label>
 <input type="email" id="shoutout_friends_email" name="shoutout_friends_email" class="form-control"  placeholder="Enter Email" ng-model="cirrusFooterCtrl.shoutout.friends_email" required>
		               </div>
		               
                 <div ng-show="cirrusFooterCtrl.shoutouterr.email_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="cirrusFooterCtrl.shoutouterr.email_errmsg"></div>
	     	 </div>	

                 
		 	      <div class="form-group">
		                <label for="shoutout_message">Message:</label>
		                   <textarea class="form-control" rows="5" name="shoutout_message"  id="shoutout_message" cirrus-addtextarea ng-keyup="addtextareaCtrl.txtkeyup($event)" ></textarea>
		               </div>
		                  
		                   
      <br />
	 <?php
	 echo '<img src="';
	 echo 'captcha_code_file.php?rand=';
	 echo rand(); 
	 echo '" id="shoutout_captchaimg" >';
	 ?>
	 <br />
	 <label for="message">Enter the code above here :</label>
	 <input id="6_letters_code" name="6_letters_code" type="text" class="form-control" ng-model="cirrusFooterCtrl.shoutout.captcha" required> 
	 <br />
	<p>Cannot read the image? click <a ng-click="cirrusFooterCtrl.refreshCaptcha()" class="btn btn-info btn-sm">here</a> to refresh</p>
	<br />
	
<div ng-show="cirrusFooterCtrl.shoutouterr.captcha_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="cirrusFooterCtrl.shoutouterr.captcha_errmsg"></div>
	     	 </div>	
    
		                   
                     </form>

               
		 </div>  <!-- End of Modal Form Body -->
		
               		 <div class="modal-footer">
       				 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       				  <button type="button" class="btn btn-primary" ng-click="cirrusFooterCtrl.shoutout()" ng-disabled="shoutoutForm.$invalid">Add</button>
                	</div>
  
      </div>

     </div>
</div>



<script>


var img = document.images['shoutout_captchaimg'];
img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;


</script>