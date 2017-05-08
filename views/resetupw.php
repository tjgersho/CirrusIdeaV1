<?php
require_once('modal/cirrusresetpasswordsuccess.php');
require_once('modal/cirrusgetusernamesuccess.php');
?>


<div style="max-width: 600px; width:95%; margin-left:auto; margin-right:auto;">


<ul class="nav nav-tabs">
  <li role="presentation" ng-class="{'active': resetCtrl.getmyTab() === 1}"><a ng-click="resetCtrl.tabcontrol(1)"><span class="fontmorph">Forget Password?</span></a></li>
  <li role="presentation" ng-class="{'active': resetCtrl.getmyTab()  === 2}"><a ng-click="resetCtrl.tabcontrol(2)"><span class="fontmorph">Forget Username?</span></a></li>
</ul>


<div ng-if="resetCtrl.getmyTab()  === 1">











 <form name="resetpasswordForm"  ng-submit="resetCtrl.resetPassword()" class="form-horizontal"  role="form" novalidate>
      
        <div class="panel panel-default">
	   <div class="panel-heading">
               <h3>Reset Your Password:</h3>
            </div>
      <div class="panel-body">
           
                      
             <label for="resetpasswordusername">Username:</label>
              <input type="text"  ng-model="resetCtrl.userreset.username" class="form-control"   id="resetpasswordusername"  placeholder="Enter Your Username" required>
             <br />
             
             
               <div ng-show="resetCtrl.reset_err.username_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="resetCtrl.reset_err.username_errmsg"></div>
	     	</div>	

      
          </div> 
  <div class="panel-footer">
  
<div id="reset_pw_loading" style="display:none;" class="pull-left">
<img src="images/loading.gif"/></div>

                    <button class="btn btn-success btn-lg pull-right" ng-disabled="resetpasswordForm.$invalid">GO</button>
          <div class="clr"></div>
      </div>
</div>
    
          
          
       
          
          
          
          
      </form>


</div>


 <div ng-if="resetCtrl.getmyTab()  === 2">


 <form name="resetusernameForm" ng-submit="resetCtrl.getUsername()" class="form-horizontal"  role="form" novalidate>
      
        <div class="panel panel-default">
	   <div class="panel-heading">
               <h3>Get Your Username:</h3>
            </div>
      <div class="panel-body">
         
              <label for="username">Enter Your Email:</label>
              <input type="email"  ng-model="resetCtrl.userreset.useremail"  class="form-control"   id="resetusernameemail"  placeholder="Enter Your Account Email" required>
          <br />
         
               <div ng-show="resetCtrl.reset_err.email_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="resetCtrl.reset_err.email_errmsg"></div>
	     	</div>	
         
          </div> 
  <div class="panel-footer">
  
<div id="reset_u_loading" style="display:none;" class="pull-left">
<img src="images/loading.gif"/></div>

          <input type="submit" class="btn btn-success btn-lg pull-right" ng-disabled="resetusernameForm.$invalid" value="GO">
          <div class="clr"></div>
      </div>
</div>
    
          
          
         
          
          
          
      </form>

</div>

  
   
   
   
     


 </div>