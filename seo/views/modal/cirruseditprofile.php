<!-- Modal -->
	<div id="editProfile" class="modal fade" role="dialog">
  	    <div class="modal-dialog">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" ng-click="cirrusProfileCtrl.closeEdit()" >&times;</button>
      		    <h4 class="modal-title">Edit Profile</h4>
      	          </div>
      	          
      	                	        
                <form name="editProfileform"  role="form"  novalidate>
      		 
      		  <div class="modal-body">
                 
                      <div class="form-group">
		                <label for="yourFName">Your First Name:</label>
		<input type="text" id="first_name" name="first_name" class="form-control"  placeholder="Your First Name" ng-model="cirrusProfileCtrl.profile.first_name" required>
		               </div>
                
	     	 
	     	  <div ng-show="cirrusProfileCtrl.editerr.firstname_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="cirrusProfileCtrl.editerr.firstname_errmsg"></div>
	     	 </div>	

                 <div class="form-group">
		                <label for="yourLName">Your Last Name:</label>
		<input type="text" id="last_name" name="last_name" class="form-control"  placeholder="Your Last Name" ng-model="cirrusProfileCtrl.profile.last_name">
		               </div>
		                              
                  <div ng-show="cirrusProfileCtrl.editerr.lastname_errmsg !== ''">
	     	    <div class="alert alert-danger" role="alert" ng-bind="cirrusProfileCtrl.editerr.lastname_errmsg"></div>
	     	 </div>	
                
                 
          
                      <label>CirrusIdea Interest:</label>
	    <div class="form-group">  
	      <select id="CirrusIdeaInterestSelect" class="form-control" id="comment_to_membername" ng-model="cirrusProfileCtrl.profile.interest">
	         <option ng-repeat="ideas in cirrusProfileCtrl.possibleIdeas" id="INTREST_{{ideas.ideaname}}" value="{{ideas.ideaname}}">{{ideas.ideaname}}</option>
	      </select>
	    </div>
             
                 
		 	      <div class="form-group">
		                <label for="shoutout_message">About You:</label>
		   <textarea class="form-control" rows="5" name="aboutU"  id="aboutU" cirrus-addtextarea ng-keyup="addtextareaCtrl.txtkeyup($event)" ng-bind-html="cirrusProfileCtrl.profile.about"></textarea>
		               </div>
                      
            



                              <div class="form-group col-sm-6">
		                <label for="mailMe">Cirrus Email Updates:</label>
					 <div class="radio">
					  <label><input type="radio" name="mailmeradio" id="MailMe" value="1" >Mail Me</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="mailmeradio" id="NoMail" value="0" >No Mail</label>
					</div>
				  </div>
				  
				  <div class="form-group col-sm-6">
		                <label for="privateprofile">Cirrus Profile Private:</label>
					 <div class="checkbox">
					  <label><input type="checkbox" id="PrivateProfile" ng-model="cirrusProfileCtrl.profile.privateprofile">Private Profile</label>
					</div>
				  </div>
		               
		               
                    <button type="button" class="btn btn-default pull-left" ng-click="cirrusProfileCtrl.goToResetPW()">Reset Password</button>
                    <div class="clr"></div>
                  </div>  <!-- End of Modal Form Body -->
                       
               		 <div class="modal-footer">
              
       				 <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="cirrusProfileCtrl.close()">Close</button>
       				  <button type="button" class="btn btn-primary" ng-click="cirrusProfileCtrl.updateprofile()" ng-disabled="editProfileform.$invalid">Update</button>
                	</div>
                 </form>
                  
           </div>

          </div>
	</div>

