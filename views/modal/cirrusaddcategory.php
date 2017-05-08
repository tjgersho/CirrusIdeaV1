<!-- Modal -->
	<div id="AddCategory" class="modal fade" role="dialog">
  	    <div class="modal-dialog">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" ng-click="browseIdeasCtrl.close()" >&times;</button>
      		    <h4 class="modal-title">Add Category</h4>
      	          </div>
      	          
      	                	        
                <form name="addideaform"  class="form-inline" role="form"  novalidate>
      		 
      		  <div class="modal-body">
                 
                 
                   
                  <div class="row">
                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     
                      <div class="form-group">
                         <label>Category:</label>
                       
                            <input type="text" ng-pattern="/^[^/|^\\]*$/" id="newIdea" name="newIdea" ng-model="browseIdeasCtrl.newIdea" required><br />
                        
                       
                          <span style="color:red" ng-show="addideaform.newIdea.$dirty && addideaform.newIdea.$invalid"  >
                         <p class="help-block text-warning" ng-if="addideaform.newIdea.$error.required">Enter Your Idea Name</p>
                       
                         <p class="help-block text-warning"  ng-if="addideaform.newIdea.$error.pattern">Do Not Use  &#39;/&#39; or &#39;\&#39; in the Name</p>
                         </span>
                         
                       </div>
                       <div style="color:red" ng-if="browseIdeasCtrl.error1">There is already a Category with that name. <br /></div>
                       <div style="color:red" ng-if="browseIdeasCtrl.error2">This Category has unallowable characters. <br /></div>
                      
                      
                    </div>
                                     
                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     
                      <div class="form-group">
                                        <div style="float:right;">
                              <label for="fileprivate">Make Private:</label><br /><input type="checkbox" id="ideaprivate" name="ideaprivate" ng-change="browseIdeasCtrl.modalprivate()" ng-model="browseIdeasCtrl.ideaprivate" />
                                        </div>
                                  </div>
                    </div>
                    
                   </div>
                   
                              <!--<div> Form is Valid: {{addideaform.$valid}} </div>  --> 
                            <div ng-show="browseIdeasCtrl.error1">There is a category with that name already</div>
                           
                   	                	 </div>  <!-- End of Modal Form Body -->
                       
               		 <div class="modal-footer">
       				 <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="browseIdeasCtrl.close()">Close</button>
       				  <button type="button" class="btn btn-primary" ng-click="browseIdeasCtrl.submit()" ng-disabled="addideaform.$invalid">Add</button>
                	</div>
                 </form>
                  
           </div>

          </div>
	</div>

