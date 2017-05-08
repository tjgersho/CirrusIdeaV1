<!-- Modal -->
	<div id="AddIdea" class="modal fade" role="dialog">
  	    <div class="modal-dialog">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" ng-click="subfolderlistCtrl.close()" >&times;</button>
      		    <h4 class="modal-title">Add Idea</h4>
      	          </div>
      	          
      	                	        
                <form name="addideaform"  role="form"  novalidate>
      		 
      		  <div class="modal-body">
                 
                 
                   <div>
                 
                     <div style="width:60%; float:left; padding:5px;">                     
                        <div class="form-group">
                          <label>Idea:</label>
                       
                            <input type="text" class="form-control" ng-pattern="/^[^/|^\\]*$/" id="newIdea" name="newIdea" ng-model="subfolderlistCtrl.newIdea" required style="width:100%;"><br />
                        
                       
                              <span style="color:red" ng-show="addideaform.newIdea.$dirty && addideaform.newIdea.$invalid"  >
                              <p class="help-block text-warning" ng-if="addideaform.newIdea.$error.required">Enter Your Idea Name</p>
                       
                              <p class="help-block text-warning"  ng-if="addideaform.newIdea.$error.pattern">Do Not Use &#39;/&#39; or &#39;\&#39; in the Name</p>
                              <div ng-show="subfolderlistCtrl.error1">There is an idea with that name already</div>
                              </span>
 
                          </div>
                       <div style="color:red" ng-if="subfolderlistCtrl.error1">There is already an Idea in {{subfolderlistCtrl.page}} with that name. <br /></div>
                       <div style="color:red" ng-if="subfolderlistCtrl.error2">This Idea has unallowable characters. <br /></div>
                                                                        
                       
                       
                        </div>
                                     
                        <div style="width:38%; float:right; padding:5px;">                                                                  
                             <div class="form-group">
                                        <div style="float:right;">
                              <label for="fileprivate" ng-if="!subfolderlistCtrl.ideaprivate">Make Private:</label> <label for="fileprivate" ng-if="subfolderlistCtrl.ideaprivate">Private:</label>
                              <input type="checkbox" class="checkbox" id="ideaprivate" name="ideaprivate" ng-change="subfolderlistCtrl.modalprivate()" ng-model="subfolderlistCtrl.ideaprivate" ng-disabled="subfolderlistCtrl.privatedisabled"/>
                                        </div>
                                  </div>
                         </div>
                         
                         
                          <div  style="width:100%; float:left; padding:10px;">

                          <div class="form-group">
                               <label for="headline">**Idea Headline:</label>
                                            <input class="form-control input-lg" id="inputlg" type="text" ng-model="subfolderlistCtrl.headline">
                               </div>
                    
                         </div>
                         
                        <div  style="width:100%; float:left; padding:10px;">

                          <div class="form-group">
                               <label for="slogan">**Idea Slogan:</label>
                                            <input class="form-control input-sm" id="inputlg" type="text" ng-model="subfolderlistCtrl.slogan">
                               </div>
                    
                         </div>
                 
                        <div  style="width:100%; float:left; padding:10px;">
                        	    <div class="form-group">
	                            <label for="comment">**Idea Synopsis:</label>
	                           <textarea cirrus-addtextarea class="form-control"  style="width:100%;" ng-keyup="addtextareaCtrl.txtkeyup($event)" ng-model="subfolderlistCtrl.synopsis"></textarea>                 
	                         </div>
	                    </div>
                    
                     </div><!-- end outer div-->
                                    <div class="clr"></div>   
                                    ** Optional                
                   	                	 </div>  <!-- End of Modal Form Body -->
                       
               		 <div class="modal-footer">
       				 <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="subfolderlistCtrl.close()">Close</button>
       				  <button type="button" class="btn btn-primary" ng-click="subfolderlistCtrl.submit()" ng-disabled="addideaform.$invalid">Add</button>
                	</div>
                 </form>
                  
           </div>

          </div>
	</div>

