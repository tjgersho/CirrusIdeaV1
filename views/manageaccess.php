<?php

?>

 <div class="container">
  <h4>Manage Access to  {{manageaccessCtrl.ideastuff.page}}</h4>
  </div>
   <div class="clr"></div>
 <div class="container">
 <div id="manageaccessloading" style="display:none;"><img src="images/loading.gif"/></div>
 

  <div class="col-md-5">
 
  <div id="MACoDevs">
      
	<label>Your CoDevs:</label>
	    <div class="form-group">  
	      <select id="accessCoDevSelect" multiple class="form-control" ng-model="manageaccessCtrl.listofCoDevNames" style="height:auto;">
	         <option ng-repeat="codev in manageaccessCtrl.usercodves">{{codev.membername}}</option>
	      
	      </select>
	    </div>
      
      
        </div>  
   
<div class="clr"></div>  
</div>


<div class="col-md-2">


<button class="btn btn-default btn-lg btn-block" ng-click="manageaccessCtrl.addCoDev2Idea()"><span ng-class='manageaccessCtrl.arrowclassObj'></span></button>
<br /><br />
<div class="clr"></div>  

</div>

 
<div class="col-md-5">
 
 {{manageaccessCtrl.ideastuff.page}} is viewable By:
<div id="viewablebyManageAccessdiv">
<div ng-if="!manageaccessCtrl.ideadata.isPrivate">The World</div>

        <div ng-if="manageaccessCtrl.ideadata.isPrivate">
		<div ng-repeat="mem in manageaccessCtrl.ideadata.members">
		<span class="label label-info label-md" style="float:left; margin:3px; padding:5px;"><a ng-href="/viewprofile/username/{{mem}}" style="color:white;">{{mem}}</a>
		<button class="btn btn-default btn-xs" ng-if="mem !== manageaccessCtrl.myprofile.username " ng-click="manageaccessCtrl.removeCoDevfromIdea(mem)">
		<span class="glyphicon glyphicon-remove"></span></button></span>
		</div>
         </div>
      
 </div>  
   
<div class="clr"></div>  
</div>
 
</div>