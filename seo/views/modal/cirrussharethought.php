<?php?>

<!-- Modal -->
	<div id="ShareThought" class="modal fade" role="dialog">
  	    <div class="modal-dialog modal-lg">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal">&times;</button>
      		    <h4 class="modal-title">Share Thought</h4>
      	          </div>
      	          
      	           
                                 <div class="modal-body">
                                 
      	    <label>Share Link (copy&paste):</label>
	    <div class="form-group">     
      	    <textarea class="form-control">http://www.cirrusidea.com/#/cirrus/path/{{thoughtCtrl.urlpath}}/page/{{thoughtCtrl.urlpage}}/tid/{{thoughtCtrl.sharethought_id}}</textarea>
      	    </div>
      	    <br />
      	    
      	    <br />
<form id="shareForm" name="shareForm" novalidate>
<div>
 	
 	<div class="col-sm-4"> 
 	  <label>CoDev Share:</label>
	    <div class="form-group">  
	      <select id="shareCoDevSelect" multiple class="form-control" id="share_with_membername" ng-model="thoughtCtrl.share_to_membername">
	         <option ng-repeat="codev in thoughtCtrl.ShareWithCoDevs">{{codev.membername}}</option>
	      </select>
	    </div>
	     <div class="clr"></div>
	</div>
        <div class="col-sm-8"> 
        <div class="clr"></div>
        <label>Message:</label>
        	<textarea id="shareCommentTxtArea" class="form-control"  rows="6" id="sharecomment" name="sharecomment" ng-model="thoughtCtrl.sharecomment" cirrus-addtextarea ng-keyup="addtextareaCtrl.txtkeyup($event)" ></textarea>
   	   </div>
     
       </div>   		
     
  </form> 
   		<div class="clr"></div>
 <br />


      	    
      	    
      	    
      	    
      	    
      	    
      	                 
	                		                	 
	                	 </div>  <!-- End of Modal Form Body -->
                                          
               		 <div class="modal-footer">
       				 <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
       				  <button type="button" class="btn btn-primary" ng-click="thoughtCtrl.submitshareThought(thoughtCtrl.sharethought_id, thoughtCtrl.share_to_membername)"> 
       				  <span class="glyphicon glyphicon-envelope"></span> Share</button>
                	</div>
                 
                  
           </div>

          </div>
	</div>




