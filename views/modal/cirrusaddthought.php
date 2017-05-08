<?php


  
function isIphone($user_agent=NULL) {
    if(!isset($user_agent)) {
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }
    return (strpos($user_agent, 'iPhone') !== FALSE);
}

$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');

 
 
?>

<!-- Modal -->
	<div id="AddThought" class="modal fade" role="dialog">
  	    <div class="modal-dialog">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal">&times;</button>
      		    <h4 class="modal-title">Add Thought @ {{thoughtCtrl.page}}</h4>
      	          </div>
      	          
      	           
      <div class="modal-body">
      	          
      	          <form name="addthoughtForm" id="addthoughtForm" style="text-align:center;" enctype="multipart/form-data" novalidate>
   
  
                        <textarea  class="form-control" rows="5" id="newthought" name="newthought" ng-model="thoughtCtrl.newThought" ng-keyup="addtextareaCtrl.txtkeyup($event)" cirrus-addtextarea></textarea><br />
 
 <?php
 if(isIphone() || $isiPad) {
 ?>    
 <div class='file_browse_wrapper'>
        <input class="specialfileinput" ng-model="thoughtCtrl.userFile" type="file" name="userFile[]" id="userFile" fileread="thoughtCtrl.userFile"/>
       </div>
 <?php
 }else{
?>    
            <div class='file_browse_wrapper'> 
                  
         <input class="specialfileinput" ng-model="thoughtCtrl.userFile" type="file" name="userFile[]" id="userFile" fileread="thoughtCtrl.userFile" multiple/>              
</div>
<?php    
 }
?> 

							
			<input type="hidden" id="ideaPath" name="ideaPath" value="{{thoughtCtrl.path}}" />
			
			<input type="hidden" id="ideaPage" name="ideaPage" value="{{thoughtCtrl.page}}" />
			
                        
  

                   <div id="loader-icon" style="display:none; text-align:center; padding:2px;"><img src="images/loading.gif" /></div>

<div class="progress progress-success progress-striped active" id="uploadProgressContainer" style="display:none;">
<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" id="fileUploadProgress"></div>  
</div> 

                                    </form>
                                    <div class="clr"></div>
  
 <div ng-repeat="fup in thoughtCtrl.userFile">
<div>{{fup.name}}</div>
</div>
<div class="clr"></div>
	                	 </div>  <!-- End of Modal Form Body -->
                     
           
                     
               		 <div class="modal-footer">
       				 <button type="button" class="btn btn-default" ng-click="thoughtCtrl.close()" data-dismiss="modal">Close</button>
       				  <button type="button" class="btn btn-primary"  ng-click="thoughtCtrl.submit()" ng-disabled="!thoughtCtrl.formokay()" id="thoughtSubmitButton">Add</button>
                	</div>
                 
                  
           </div>

          </div>
	</div>
