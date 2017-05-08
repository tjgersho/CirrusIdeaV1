<?php
require_once('modal/cirrusaddidea.php');
require_once('modal/cirrusdeleteidea.php');
require_once('modal/errormodal.php');

?> 
			
			<div class="panel panel-default">
			  <div class="panel-body">
			  
 <div style="padding:5px; width:80%; margin-left:auto; margin-right:auto;" ng-if="!thoughtCtrl.loggedin" ng-mouseenter="show = true" ng-mouseleave="show = false">
					<button type="button" class="btn btn-warning btn-block" ng-disabled="1">
					Add Idea
					</button>
					  <div class="alert alert-info" ng-show="show">
					  <strong><a href="/login">Login</a></strong> or <strong><a href="/signup">Signup</a></strong> to participate. But explore great ideas and thoughts as you wish.
					  </div>
					 </div> 
					 
			  
			  
			    <div style="padding:5px; width:80%; margin-left:auto; margin-right:auto;" ng-if="thoughtCtrl.loggedin">
				<button type="button" class="btn btn-warning btn-block"  ng-click="subfolderlistCtrl.openAddIdea()">
				Add Idea
				</button>
				</div>

			  
			  <div ng-if="!(subfolderlistCtrl.ideas.public.length>0) && !(subfolderlistCtrl.ideas.owner.length>0)" style="padding:5px;">
			     <small>Add A <i>NEW</i> Sub-Idea to {{subfolderlistCtrl.specialpath}}/</small><b>{{subfolderlistCtrl.page}}</b>
			  </div>
			  
			  
			  <div ng-if="subfolderlistCtrl.ideas.owner.length>0">
			  <h5 ng-if="mainCtrl.userService.isLoggedIn">Your CirrusIdeas</h5> 
				   <div ng-repeat="sub in subfolderlistCtrl.ideas.owner | orderBy:'page'">
				  
						  <div  ng-class="sub.type">
						  
						  <a ng-class="sub.type1" ng-href="/cirrus/path{{sub.path}}/page/{{sub.page}}" style="float:left; padding:5px; margin:5px;" >{{sub.page}}</a>
						
						
						
								<div class="dropdown" style="float:left;" ng-click="subfolderlistCtrl.dropdownclick($event)">
								  
								  <a id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="float:left; width:25px; height:35px;">
								  <span class="caret" style="float:right;"></span>
								  </a>
								
								  <ul ng-class="subfolderlistCtrl.ddclassobj" aria-labelledby="dLabel">
								  
				    <li><a ng-href="/manageaccess/ideaid/{{sub.id}}" ng-if="sub.type.privateidea === 1">Manage Access</a></li>
				    <li><a class="btn" role="button" ng-click="subfolderlistCtrl.deleteIdeaPopup(sub.id)">Delete Idea</a></li>
				   				
								
								  </ul>
								</div>
						
						
						</div>
				
				   </div>
			    </div>
			    
			   <div class="clr"></div>
			<div ng-if="subfolderlistCtrl.ideas.public.length>0">
			   
				
				<br />
			
			
			
			<div class="content_underline" ng-if="mainCtrl.userService.isLoggedIn"></div>
						<h5 ng-if="mainCtrl.userService.isLoggedIn">CirrusIdeas</h5>
						<div>
						
						<div ng-repeat="subpub in subfolderlistCtrl.ideas.public | orderBy:'page'" >
						
						
						<div ng-class="subpub.type">
						
						<a ng-class="subpub.type1" ng-href="/cirrus/path{{subpub.path}}/page/{{subpub.page}}" style="float:left; padding:10px; margin:5px;">{{subpub.page}}</a>
						
						
						</div>
						
						
						</div>
						
						
						</div>
				 <div class="clr"></div>		   
			   
			    </div>
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			      </div>
			     </div>
			</div>
			
			





