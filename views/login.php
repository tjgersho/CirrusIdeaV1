<?php
?>

<div style="max-width: 600px; width:95%; margin-left:auto; margin-right:auto;">

     <div ng-if="loginCtrl.locationpath && loginCtrl.locationpage">Log Into:   {{loginCtrl.locationpage}} </div>
     
      
      <form name="loginForm"  ng-submit="loginCtrl.login()" class="form-horizontal"  role="form" novalidate>
      
        <div class="panel panel-default">
	   <div class="panel-heading">
               <h3>Login:</h3>
            </div>
      <div class="panel-body">
           <div class="login-form">
              <label for="username">Username</label>
              <input type="text"  ng-model="loginCtrl.user.username"  class="form-control"   id="email"  placeholder="Enter Username" required>
          <br />
         
              <label for="password">Password</label>
              <input type="password"  ng-model="loginCtrl.user.password" class="form-control" id="password" placeholder="Enter Password" required>
         <br />
         <div class="alert alert-danger"  ng-bind-html="loginCtrl.errorMessage"   ng-show="loginCtrl.errorMessage !== ''"></div>


         <a href="/resetupw" id="needhelp">Need Help?</a>
         <a href="/signup" id="signup" class="pull-right">Signup</a>
         
          </div> </div>
  <div class="panel-footer">
  
<div id="login_loading"	style="display:none;" class="pull-left">
<img src="images/loading.gif"/></div>

          <input type="submit" class="btn btn-success btn-lg pull-right" id="login" value="Login"  ng-disabled="loginForm.$invalid">
          <div class="clr"></div>
      </div>
</div>
    
          
          
          </div>
          
          
          
          
      </form>


 </div>
 
 <script>
 $(function(){
 
 $("#needhelp").focus(function(){
 $("#login").focus();
 });
 
 });
 
 
 </script>