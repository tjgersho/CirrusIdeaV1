<?php
require_once('modal/deletprojfile.php');


?>
 <button class="btn btn-xs pull-right" ng-click="cirrusideaPageCtrl.toggleisuptodate()" ng-if="cirrusideaPageCtrl.projectdata.isOwner && cirrusideaPageCtrl.projectdata.isuptodate">
<span class="glyphicon glyphicon-wrench" aria-hidden="true">
</span>Edit</button>

 <button class="btn btn-xs pull-right" ng-click="cirrusideaPageCtrl.toggleisuptodate()" ng-if="cirrusideaPageCtrl.projectdata.isOwner && !cirrusideaPageCtrl.projectdata.isuptodate">
<span class="glyphicon glyphicon-pushpin" aria-hidden="true">
</span>View</button>

<br />
<div class="clr"></div>
<div class="content_underline"></div>

<div ng-if="cirrusideaPageCtrl.projectdata.isOwner && !cirrusideaPageCtrl.projectdata.isuptodate">

   <div  style="width:100%; padding:10px;">

                              <div class="form-group">
                                  <label for="headline">Idea Headline:</label>
                                            <input class="form-control input-lg" id="inputlg" type="text" ng-model="cirrusideaPageCtrl.projectdata.headline">
                               </div>
                    
                         
                          <div class="form-group">
                               <label for="slogan">Idea Slogan:</label>
                                            <input class="form-control input-sm" id="inputlg" type="text" ng-model="cirrusideaPageCtrl.projectdata.slogan">
                               </div>
                    
                         </div>
                 
                              <div class="form-group">
	                            <label for="comment">Idea Synopsis:</label>
	 <textarea cirrus-addtextarea class="form-control" rows="4"
	  style="width:100%;" ng-keyup="addtextareaCtrl.txtkeyup($event)" ng-model="cirrusideaPageCtrl.projectdata.synopsis"></textarea>                 
	                         </div>
	                    




<button class="btn btn-success btn-xs" ng-click="cirrusideaPageCtrl.updateprojectdata()">Update Breakdown</button>
<div class="clr"></div>
 <br />
 <br />
 <form name="addprojectfileform" id="addprojectfileform" enctype="multipart/form-data" novalidate>
   
 <div class='file_browse_wrapper' ng-if="cirrusideaPageCtrl.projectdata.empty_p_files">
        <input class="specialfileinput" ng-model="cirrusideaPageCtrl.p_file" type="file" name="p_File" id="p_File" fileread="cirrusideaPageCtrl.p_file" />
 </div>
 <button class="btn btn-success btn-xs pull-left" ng-click="cirrusideaPageCtrl.uploadProjectDataFile()" ng-if="cirrusideaPageCtrl.projectdata.empty_p_files">Upload</button>
 {{cirrusideaPageCtrl.p_file[0].name}}
<input type="hidden" id="ideaPath" name="ideaPath" value="{{cirrusideaPageCtrl.path}}" />
			
<input type="hidden" id="ideaPage" name="ideaPage" value="{{cirrusideaPageCtrl.page}}" />


</form>
                   <div id="Projloader-icon" style="display:none; text-align:center; padding:2px;"><img src="images/loading.gif" /></div>

<div class="progress progress-success progress-striped active" id="ProjuploadProgressContainer" style="display:none;">
<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" id="ProjfileUploadProgress"></div>  
</div> 


<div class="clr"></div>
<div ng-repeat="pf in cirrusideaPageCtrl.projectdata.p_files">

       <div ng-if="pf.fname"  class="cirrus_rundown_file">{{pf.fname}}         
       
        
 
		 <div  style="float:right; margin:10px;">
		  
		  <button class="btn btn-danger btn-xs" ng-click="cirrusideaPageCtrl.deletePfilebtn(pf.iter)">
		  <span class="glyphicon glyphicon-trash"></span>
		  </button>
		
		 </div>
		   
		   

			  <div ng-switch on="pf.ftype">
				 <div ng-switch-when="image">   
				  <a ng-click="thoughtCtrl.downloadThoughtFile(pf.fpath)"><img ng-src="{{pf.fthumb}}" width="100%"/></a>
			           </div>
				 <div ng-switch-when="audio">
				 
				 <div class="clr"></div>
			            <br />
			          <div style="width:80%; margin-left:auto; margin-right:auto;">
			          <audio controls style="width:100%;">
				       <source ng-src="{{pf.fpath}}"  type="audio/mp3">
				   </audio> 
			         </div>	 
			        <br />
			          <a ng-if="thought.file_name" ng-click="thoughtCtrl.downloadThoughtFile(pf.fpath)"> 
			          {{cirrusideaPageCtrl.projectdata.p_file1.fname}} 
			           </a> <small ng-if="thought.file_name">Size:  {{pf.fsize/1024 | number:0}} Kb</small>
			        
			
			
			           </div>
			            <!------------- END AUDIO --------------->   
				 <div ng-switch-when="video">{{pf.p_file1}}
				 
				 	    <div style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; ">
							
							<!-- first try HTML5 playback. if serving as XML, expand `controls` to `controls="controls"` and autoplay likewise       -->
							<!-- warning: playback does not work on iPad/iPhone if you include the poster attribute! wee are awaiting a fix from apple -->
							<video width="100%" height="360" controls>
							    <!-- MP4 must be first for iPad! you must use `</source>` to avoid a closure bug in Firefox 3.0 / Camino 2.0! -->
							    <source ng-src="{{pf.fpath}}"  type="video/mp4"><!-- Safari / iPhone video    --></source>
							    <source ng-src="{{pf.fpath}}"  type="video/ogg"><!-- Firefox native OGG video --></source>
							    <!-- IE only QuickTime embed: IE6 is ignored as it does not support `<object>` in `<object>` so we skip QuickTime
							         and go straight to Flash further down. the line break after the `classid` is required due to a bug in IE -->
							    <!--[if gt IE 6]>
								<object width="100%" height="375" classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B"><!
								[endif]-->
								<!-- non-IE QuickTime embed (hidden from IE): the self-closing comment tag allows non-IE browsers to
								     see the HTML whilst being compatible with serving as XML -->
								<!--[if !IE]><!-->
								<object width="100%" height="375" type="video/quicktime"  data="{{pf.fpath}}"  >
								<!--<![endif]-->
								<param name="src" value="{{pf.fpath}}"  />
								<param name="showlogo" value="true" />
								<!-- fallback to Flash -->
								<object width="100%" height="384" type="application/x-shockwave-flash"	data="player.swf?&amp;image=poster.jpg&amp;file={{pf.fpath}}">
									<!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
									<param name="movie" value="player.swf?image=poster.jpg&amp;file={{pf.fpath}}" />
									<!-- fallback image -->
									<img src="images/poster.jpg" width="100%" height="360" alt="znoter intro"  title="No video playback capabilities, please download the video below" />
								</object><!--[if gt IE 6]><!-->
								</object><!--<![endif]-->
							</video>
							<p>    <strong>Download Video:</strong>
							 <a ng-click="thoughtCtrl.downloadThoughtFile(pf.fpath)">{{pf.fname}}</a><small>Size:  {{pf.fsize/1024 | number:0}} Kb</small>
							
							</p>
							
							</div>
							
				 
				 
				 
				 </div><!------------- END Video --------------->  
				 
				 
				 
				 <div ng-switch-default> 
				
				
				   <a ng-click="thoughtCtrl.downloadThoughtFile(pf.fpath)">{{pf.fname}}</a> <small>Size:  {{pf.fsize/1024 | number:0}} Kb</small>
			  
			 
				 
				 </div>
				 
				 <!------------- END OTHER--------------->  
			  </div>  <!------------- END NG Switch---------------> 
			  

		   
		<div class="clr"></div>
       
       </div>
       
  </div>


 </div>


</div>


<div ng-if="!cirrusideaPageCtrl.projectdata.isOwner || cirrusideaPageCtrl.projectdata.isuptodate">
<h2 class="pull-left">{{cirrusideaPageCtrl.projectdata.headline}}</h2>

<h4 class="pull-right"><b>{{cirrusideaPageCtrl.projectdata.slogan}}</b></h4>
<div class="clr"></div>
<p>
{{cirrusideaPageCtrl.projectdata.synopsis}}
</p>

<!-- Associated Files -->



<div ng-repeat="pf in cirrusideaPageCtrl.projectdata.p_files">


<div class="cirrus_rundown_file" ng-if="pf.fname">
  <div ng-switch on="pf.ftype">
	 <div ng-switch-when="image">    
	 <a ng-click="thoughtCtrl.downloadThoughtFile(pf.fpath)"><img ng-src="{{pf.fthumb}}" width="100%"/></a>
          </div>
	 <div ng-switch-when="audio">
	 
	 <div class="clr"></div>
            <br />
          <div style="width:80%; margin-left:auto; margin-right:auto;">
          <audio controls style="width:100%;">
	       <source ng-src="{{pf.fpath}}"  type="audio/mp3">
	   </audio> 
         </div>	 
        <br />
          <a ng-if="thought.file_name" ng-click="thoughtCtrl.downloadThoughtFile(pf.fpath)"> 
          {{cirrusideaPageCtrl.projectdata.p_file1.fname}} 
           </a> <small ng-if="thought.file_name">Size:  {{pf.fsize/1024 | number:0}} Kb</small>
        


           </div>
            <!------------- END AUDIO --------------->   
	 <div ng-switch-when="video">{{pf.p_file1}}
	 
	 	    <div style="width:100%; margin-left:auto; margin-right:auto; margin-top:25px; ">
				
				<!-- first try HTML5 playback. if serving as XML, expand `controls` to `controls="controls"` and autoplay likewise       -->
				<!-- warning: playback does not work on iPad/iPhone if you include the poster attribute! wee are awaiting a fix from apple -->
				<video width="100%" height="360" controls>
				    <!-- MP4 must be first for iPad! you must use `</source>` to avoid a closure bug in Firefox 3.0 / Camino 2.0! -->
				    <source ng-src="{{pf.fpath}}"  type="video/mp4"><!-- Safari / iPhone video    --></source>
				    <source ng-src="{{pf.fpath}}"  type="video/ogg"><!-- Firefox native OGG video --></source>
				    <!-- IE only QuickTime embed: IE6 is ignored as it does not support `<object>` in `<object>` so we skip QuickTime
				         and go straight to Flash further down. the line break after the `classid` is required due to a bug in IE -->
				    <!--[if gt IE 6]>
					<object width="100%" height="375" classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B"><!
					[endif]-->
					<!-- non-IE QuickTime embed (hidden from IE): the self-closing comment tag allows non-IE browsers to
					     see the HTML whilst being compatible with serving as XML -->
					<!--[if !IE]><!-->
					<object width="100%" height="375" type="video/quicktime"  data="{{pf.fpath}}"  >
					<!--<![endif]-->
					<param name="src" value="{{pf.fpath}}"  />
					<param name="showlogo" value="true" />
					<!-- fallback to Flash -->
					<object width="100%" height="384" type="application/x-shockwave-flash"	data="player.swf?&amp;image=poster.jpg&amp;file={{pf.fpath}}">
						<!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
						<param name="movie" value="player.swf?image=poster.jpg&amp;file={{pf.fpath}}" />
						<!-- fallback image -->
						<img src="images/poster.jpg" width="100%" height="360" alt="znoter intro"  title="No video playback capabilities, please download the video below" />
					</object><!--[if gt IE 6]><!-->
					</object><!--<![endif]-->
				</video>
				<p>    <strong>Download Video:</strong>
				 <a ng-click="thoughtCtrl.downloadThoughtFile(pf.fpath)">{{pf.fname}}</a><small>Size:  {{pf.fsize/1024 | number:0}} Kb</small>
				
				</p>
				
				</div>
				
	 
	 
	 
	 </div> <!------------- END Video --------------->  
	 
	 
	
	 <div ng-switch-default> 
	
	
	   <a ng-click="thoughtCtrl.downloadThoughtFile(pf.fpath)">{{pf.fname}}</a> <small>Size:  {{pf.fsize/1024 | number:0}} Kb</small>
  
 
	 
	 </div>
	 
	 <!------------- END OTHER--------------->  
  </div>  <!------------- END NG Switch---------------> 
  
  
</div> <!------------- END Own Thought Div --------------->




  </div>  <!------------- END Repeat --------------->


 
</div>



</div> <!------------- END Show Idea Rundown --------------->


<div class="clr"></div>

