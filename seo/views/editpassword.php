<?php
require_once('modal/cirruseditpasswordsuccess.php');

?>


<div style="max-width: 600px; width:95%; margin-left:auto; margin-right:auto;">


 <form name="resetpasswordForm" ng-submit="editpwCtrl.editPW()" class="form-horizontal"  role="form" novalidate>
      
        <div class="panel panel-default">
	   <div class="panel-heading">
               <h3>Password Reset:</h3>
            </div>
      <div class="panel-body">
      
                 <label for="username">Your Username:</label>
	     	 <input type="text" id="epwusername"  ng-model="editpwCtrl.userpw.username"
	     	  class="form-control" name="epwusername" value="{{editpwCtrl.userpw.username}}"  disabled="disabled">
	     	 <br />     
	     	 
	     	
            <label for="password1">Password:</label>
	      	 <input type="password"  ng-model="editpwCtrl.userpw.password1"
	      	  class="form-control" id="password1" placeholder="Enter Password" required>
	      <br />
	     	 <label for="password2">Password (retype):</label>
	      	 <input type="password"  ng-model="editpwCtrl.userpw.password2" 
	      	 class="form-control" id="password2" placeholder="Enter Password" required>
		
	
	  <br /> 
<div ng-show="editpwCtrl.userpwerror.password_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="editpwCtrl.userpwerror.password_errmsg"></div>
	     	 </div>	  

	  <br />

         
          </div> 
  <div class="panel-footer">
  
<div id="editpw_loading" style="display:none;" class="pull-left">
<img src="images/loading.gif"/></div>

          <input type="submit" class="btn btn-success btn-lg pull-right" ng-disabled="resetpasswordForm.$invalid" value="GO">
          <div class="clr"></div>
      </div>
</div>
    
          
          
         
          
          
          
      </form>

</div>
