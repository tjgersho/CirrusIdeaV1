<?php?>

<!-- Modal -->
	<div id="signup-success-modal" class="modal fade" role="dialog">
  	    <div class="modal-dialog">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" ng-click="signupCtrl.goToLogin()">&times;</button>
      		    <h4 class="modal-title">Signup Success!</h4>
      	          </div>
      	          
      	           
      <div class="modal-body">
      	          
      	        <div class="alert alert-info" role="alert">You have successfully signed up with CirrusIdea<br />
      	        <br />
      	        
Before you can login you&#39;ll have to confirm your email by clicking the confirmation link in the email just sent to you.  You will then be able to login.
<br />
<br />
Thanks for joining this great community of thinkers.

      	        </div>                   
	                		                	 
	                	 </div>  <!-- End of Modal Form Body -->
                                          
               		 <div class="modal-footer">
       				
       				  <button type="button" class="btn btn-primary"  ng-click="signupCtrl.goToLogin()">Lets GO!</button>
                	</div>
                 
                  
           </div>

          </div>
	</div>
