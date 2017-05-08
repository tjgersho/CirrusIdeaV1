<?php?>

<!-- Modal -->
	<div id="ReportThought" class="modal fade" role="dialog">
  	    <div class="modal-dialog modal-lg">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal">&times;</button>
      		    <h4 class="modal-title">Report Malice Thought</h4>
      	          </div>
      	          
      	           
                                 <div class="modal-body">
      	          
      	    
      	    
      	    <br />
<form id="reportForm" name="reportForm" novalidate>
<div>
 	
 	
 	          <div class="col-sm-12"> 
        <label>State Concern:</label>
        	<textarea id="reportCommentTxtArea" class="form-control"  rows="6" id="reportcomment" name="reportcomment" ng-model="thoughtCtrl.reportcomment" cirrus-addtextarea ng-keyup="addtextareaCtrl.txtkeyup($event)" ></textarea>
   	   </div>
     
       </div>   		
     
  </form> 
   		<div class="clr"></div>
 <br />


      	    
      	    
      	    
      	    
      	    
      	    
      	                 
	                		                	 
	                	 </div>  <!-- End of Modal Form Body -->
                                          
               		 <div class="modal-footer">
       				 <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
       				  <button type="button" class="btn btn-primary" ng-click="thoughtCtrl.submitreportThought(thoughtCtrl.reportthought_id, 'tjgersho')"> 
       				  <span class="glyphicon glyphicon-wrench"></span> Submit </button>
                	</div>
                 
                  
           </div>

          </div>
	</div>




