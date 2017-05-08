<?php?>

<!-- Modal -->
	<div id="DeleteQuicklink" class="modal fade" role="dialog">
  	    <div class="modal-dialog">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal">&times;</button>
      		    <h4 class="modal-title">Delete Quicklink</h4>
      	          </div>
      	          
      	           
      <div class="modal-body">
      	          
      	        <div class="alert alert-danger" role="alert">You are about to Delete this Quicklink! Are you sure?</div>                   
	                		                	 
	                	 </div>  <!-- End of Modal Form Body -->
                                          
               		 <div class="modal-footer">
       				 <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
       				  <button type="button" class="btn btn-primary"  ng-click="cirrusQuicklinkCtrl.deleteQuicklink(cirrusQuicklinkCtrl.currentQLDelID)">Delete</button>
                	</div>
                 
                  
           </div>

          </div>
	</div>
