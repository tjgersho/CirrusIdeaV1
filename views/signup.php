<?php
require_once('modal/cirrussignupsuccess.php');
?>

<div style="max-width: 600px;  width:95%; margin-left:auto; margin-right:auto;">

      <form name="signupForm" ng-submit="signupCtrl.signup()" class="form-horizontal" role="form" novalidate>
	   <div class="panel panel-default">
	   <div class="panel-heading">
	      <h3>Signup:</h3>
         </div>

  <div class="panel-body">
   	    	      <div class="signup-form">
	    	 <label for="username">Username:</label>
	     	 <input type="text" id="username"  ng-model="signupCtrl.newuser.username"
	     	  class="form-control" name="username" placeholder="Enter Username" value="{{signupCtrl.newuser.username}}"  required>
	     	 <br />     
	     	 <div ng-show="signupCtrl.signuperror.username_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="signupCtrl.signuperror.username_errmsg"></div>
	     	 </div>
      		 <label for="email">Email:</label>
	         <input type="email" id="email" name="email" class="form-control"
	           ng-model="signupCtrl.newuser.email" placeholder="Enter Email" value="{{signupCtrl.newuser.email}}" required>
	         

	      <br />
	      
<div ng-show="signupCtrl.signuperror.email_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="signupCtrl.signuperror.email_errmsg"></div>
	     	 </div>
	     	 
	      	  <label for="password1">Password:</label>
	      	 <input type="password"  ng-model="signupCtrl.newuser.password1"
	      	  class="form-control" id="password1" placeholder="Enter Password" required>
	      <br />
	     	 <label for="password2">Password (retype):</label>
	      	 <input type="password"  ng-model="signupCtrl.newuser.password2" 
	      	 class="form-control" id="password2" placeholder="Enter Password" required>
		
	
	  <br /> 
<div ng-show="signupCtrl.signuperror.password_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="signupCtrl.signuperror.password_errmsg"></div>
	     	 </div>	  

	  <br />
	 <?php
	 echo '<img src="';
	 echo 'captcha_code_file.php?rand=';
	 echo rand(); 
	 echo '" id="signup_captchaimg" >';
	 ?>
	 <br />
	 <label for="message">Enter the code above here :</label>
	 <input id="6_letters_code" name="6_letters_code" type="text" class="form-control" ng-model="signupCtrl.newuser.captcha" required> 
	 <br />
	<p>Cannot read the image? click <a ng-click="signupCtrl.refreshCaptcha()" class="btn btn-info btn-sm">here</a> to refresh</p>
	<br />
	
<div ng-show="signupCtrl.signuperror.captcha_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="signupCtrl.signuperror.captcha_errmsg"></div>
	     	 </div>	
	 
 </div></div>
  <div class="panel-footer">
  
<div id="signup_loading" style="display:none;" class="pull-left"  >
<img src="images/loading.gif"/></div>

 <input type="submit" class="btn btn-success btn-lg pull-right" value="Signup"  ng-disabled="signupForm.$invalid">
	    
<div class="clr"></div>
	  </div>

	</div>
	
	
	
	</form>
   
    


 </div>
 
<script>


var img = document.images['signup_captchaimg'];
img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;


</script>