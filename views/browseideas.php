<?php

require_once('modal/cirrusaddcategory.php');
require_once('modal/cirrusdeletecategory.php');
require_once('modal/errormodal.php');

?>


<div style="padding:5px; width:80%; margin-left:auto; margin-right:auto;" ng-if="!browseIdeasCtrl.loggedin" ng-mouseenter="show = true" ng-mouseleave="show = false">
<button type="button" class="btn btn-danger btn-block" ng-disabled="1">
  Add Category
  </button>
  <div class="alert alert-info anime1" ng-show="show">
  <strong><a href="/login">Login</a></strong> or <strong><a href="/signup">Signup</a></strong> to participate.  But explore great ideas and thoughts as you wish.
  </div>
 </div> 
 
<div style="padding:5px; width:80%; margin-left:auto; margin-right:auto;"  ng-if="browseIdeasCtrl.loggedin">
<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#AddCategory">Add Category</button>
</div>

	<div ng-if="browseIdeasCtrl.categories.owner.length>0">
	
	<h5  ng-if="mainCtrl.userService.isLoggedIn" >Your CirrusIdeas</h5>
           <div>
	
		<div ng-repeat="ideafolder in browseIdeasCtrl.categories.owner | orderBy:'page'" >
		
		
			<div ng-class="ideafolder.type">
			
			<a ng-class="ideafolder.type1" ng-href="/cirrus/path/files/page/{{ideafolder.page}}" style="float:left; padding:10px; margin:5px;">{{ideafolder.page}}</a>
			
				<div  class="dropdown" style="float:left;" ng-click="browseIdeasCtrl.dropdownclick($event)">
				  
				  <a id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="float:left; display:block; width:25px; height:35px;">
				  <span class="caret" style="float:right;"></span>
				  </a>
				  
				
				  <ul ng-class="browseIdeasCtrl.ddclassobj"  aria-labelledby="dLabel" >
				    <li><a ng-href="/manageaccess/ideaid/{{ideafolder.id}}" ng-if="ideafolder.type.privateidea === 1">Manage Access</a></li>
				    <li><a ng-click="browseIdeasCtrl.deleteCategoryPopup(ideafolder.id)">Delete Category</a></li>
				
				  </ul>
				  
				</div>
				
			
			</div>
		
		
		</div>
	
	
           </div>

       </div>

<div class="clr" ng-if="browseIdeasCtrl.loggedin"></div>
<br />
<div ng-if="browseIdeasCtrl.categories.public.length>0">
	<div class="content_underline" ng-if="browseIdeasCtrl.loggedin"></div>

	<h5 ng-if="browseIdeasCtrl.loggedin">CirrusIdeas</h5>
	<div>
	
		<div ng-repeat="pubfolder in browseIdeasCtrl.categories.public | orderBy:'page'" >
		
			
			<div ng-class="pubfolder.type">
			
				<a ng-class="pubfolder.type1" ng-href="/cirrus/path/files/page/{{pubfolder.page}}" style="float:left; padding:10px; margin:5px;">{{pubfolder.page}}</a>
			
			
			</div>
			
		
		</div>
		
	
	</div>
	
</div>