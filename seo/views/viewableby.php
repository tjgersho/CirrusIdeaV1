<?php
?>

Viewable By:
<div id="viewablebydiv">
<div ng-if="!viewableByCtrl.ideadata.isPrivate">The World</div>

        <div ng-if="viewableByCtrl.ideadata.isPrivate">
		<div ng-repeat="mem in viewableByCtrl.ideadata.members">
		<span class="label label-info" style="float:left; margin:3px;"><a ng-href="#!/viewprofile/username/{{mem}}" style="color:white;">{{mem}}</a></span>
		</div>
        </div>
        <br />
    <div ng-if="viewableByCtrl.ideadata.isCreator && viewableByCtrl.ideadata.isPrivate" class="pull-right"> 
	<a ng-href="#!/manageaccess/ideaid/{{viewableByCtrl.ideadata.idea_id}}">Manage Access</a>
     </div>
   
 </div>  
   
<div class="clr"></div>   
