<?php?>

<!-- Modal -->
	<div id="DeleteCategory" class="modal fade" role="dialog">
  	    <div class="modal-dialog">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal">&times;</button>
      		    <h4 class="modal-title">Delete Category</h4>
      	          </div>
      	          
      	           
      <div class="modal-body">
      	          
      	        <div class="alert alert-danger" role="alert">You are about to Delete this Category! Are you sure?</div>                   
	                		                	 
	                	 </div>  <!-- End of Modal Form Body -->
                                          
               		 <div class="modal-footer">
       				 <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
       				  <button type="button" class="btn btn-primary"  ng-click="browseIdeasCtrl.deleteCategory(browseIdeasCtrl.currentDelID)">Delete</button>
                	</div>
                 
                  
           </div>

          </div>
	</div>
