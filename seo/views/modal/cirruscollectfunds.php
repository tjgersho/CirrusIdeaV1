<!-- Modal -->
	<div id="CollectFunds" class="modal fade" role="dialog">
  	    <div class="modal-dialog">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" ng-click="cirrusProfileCtrl.closeEdit()" >&times;</button>
      		    <h4 class="modal-title">Collect Funds</h4>
      	          </div>
      	          
      	                	        
                <form name="collectFundsform" role="form"  novalidate>
      		 
      		  <div class="modal-body">
                 
                      <div class="form-group">
		                <label for="yourFName">Your First Name:</label>
		<input type="text" id="first_name" name="first_name" class="form-control"  placeholder="Your First Name" ng-model="cirrusProfileCtrl.profile.first_name" required>
		               </div>
                
	     	 
	     	  <div ng-show="cirrusProfileCtrl.collecterr.firstname_errmsg !== ''">
	     	 <div class="alert alert-danger" role="alert" ng-bind="cirrusProfileCtrl.collecterr.firstname_errmsg"></div>
	     	 </div>	

                 <div class="form-group">
		                <label for="yourLName">Your Last Name:</label>
		<input type="text" id="last_name" name="last_name" class="form-control"  placeholder="Your Last Name" ng-model="cirrusProfileCtrl.profile.last_name" required>
		               </div>
		                              
                  <div ng-show="cirrusProfileCtrl.collecterr.lastname_errmsg !== ''">
	     	    <div class="alert alert-danger" role="alert" ng-bind="cirrusProfileCtrl.collecterr.lastname_errmsg"></div>
	     	 </div>	
                
                 
           <div class="form-group">
		                <label for="yourLName">Your PayPal Email:</label>
		<input type="email" id="last_name" name="last_name" class="form-control"  placeholder="PayPal Email" ng-model="cirrusProfileCtrl.profile.paypalemail" required>
		               </div>
		                              
                  <div ng-show="cirrusProfileCtrl.collecterr.paypalemail_errmsg !== ''">
	     	    <div class="alert alert-danger" role="alert" ng-bind="cirrusProfileCtrl.collecterr.paypalemail_errmsg"></div>
	     	 </div>	
                 
		 	     


                    
                  </div>  <!-- End of Modal Form Body -->
                       
               		 <div class="modal-footer">
              
       				 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       			<button type="button" class="btn btn-primary" ng-click="cirrusProfileCtrl.collectfunds()" ng-disabled="collectFundsform.$invalid">Collect</button>
                	</div>
                 </form>
                  
           </div>

          </div>
	</div>

