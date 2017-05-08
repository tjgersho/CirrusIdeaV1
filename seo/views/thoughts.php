<!-- ---------------------------------------------------------------  -->
<div class="panel panel-success">
  

<div class="panel-heading">


 <!--  --------------------------------------------------------------------
 --------------------------------------------------------------------------------
 ----------------------------Donation Facts -->

  <div class="container">
   <div class="row">
  
  
    <div class="col-sm-5">
    
    <p style="padding:5px" ng-if="cirrusideaPageCtrl.fundsdata.funds > 0"><b>{{thoughtCtrl.page}}</b> has <span class="badge">${{cirrusideaPageCtrl.fundsdata.funds | number: 2 }} </span> in donations!</p>
        <button class="btn btn-default btn-sm"  style="margin-bottom:5px;" type="button" ng-click="cirrusideaPageCtrl.openDonationDialog()"><span class="glyphicon glyphicon-usd"></span>Donate for Thoughts</button>
   
	       
                

   </div>
   
   <div class="col-sm-7">
         <div ng-if="cirrusideaPageCtrl.fundsdata.payoutvotes>10 && cirrusideaPageCtrl.fundsdata.funds > 0" style="margin:5px"> Payout Poll: 
	     <div id="PayoutPoll" class="progress" style="position: relative; height:40px; background-image: url('images/postcred.png'); background-size: 30px 30px; background-repeat: no-repeat; background-position: right;">
	     <span id="payoutPointDollarLeft" class="glyphicon glyphicon-usd" ng-class="cirrusideaPageCtrl.addblinkclass()" style="position:absolute; top:20px;"></span>
	     <i id="payoutPoint" class="fa fa-arrow-down" ng-class="cirrusideaPageCtrl.addblinkclass()" style="position:absolute; top:27px;"></i>
	     <span id="payoutPointDollarRight" class="glyphicon glyphicon-usd" ng-class="cirrusideaPageCtrl.addblinkclass()" style="position:absolute; top:20px;"></span>
	 	 <div ng-class="cirrusideaPageCtrl.payoutbarclass()" style="opacity: 0.4; filter: alpha(opacity=40);"  ng-style="cirrusideaPageCtrl.fundsdata.payoutpercentstyle">
	   		 <div style="position:absolute; padding-left:5px; color:black;">Payout- {{cirrusideaPageCtrl.fundsdata.payoutpercent}}% </div>
	  	</div>
	 	 <div ng-class="cirrusideaPageCtrl.needthoughtbarclass()" style="opacity: 0.4; filter: alpha(opacity=40);"  ng-style="cirrusideaPageCtrl.fundsdata.moredevneededpercentstyle">
	  		   <div style="position:absolute; padding-left:5px; top:40px; color:black;" ng-if="cirrusideaPageCtrl.fundsdata.moredevneededpercent>60">Needs Thought - {{cirrusideaPageCtrl.fundsdata.moredevneededpercent}}%</div>
	  		    <div style="position:absolute; padding-left:5px; color:black;" ng-if="cirrusideaPageCtrl.fundsdata.moredevneededpercent<60">Needs Thought - {{cirrusideaPageCtrl.fundsdata.moredevneededpercent}}%</div>

	  	  </div>
	    	  
	    </div>
	    
    
          </div> <!-- NEEDS MORE VOTES && is logged in-->
    <script>
    
                   
           $("#payoutPoint").css('left', ($("#PayoutPoll").width()*0.6+7) + 'px');
            $("#payoutPointDollarLeft").css('left', ($("#PayoutPoll").width()*0.55+7) + 'px');
          
            $("#payoutPointDollarRight").css('left', ($("#PayoutPoll").width()*0.65+7) + 'px');
           
    
    
    </script>      
            
            <div  ng-if="cirrusideaPageCtrl.fundsdata.payoutvotes<11  && cirrusideaPageCtrl.fundsdata.funds > 0 && cirrusideaPageCtrl.fundsdata.usercanVote">
            
             <h4 style="margin:5px">
             More Votes Needed! <br />Vote to Payout Donations to the top <i>Credible Thinkers</i> <b>or</b> to get more Thoughts on the idea.
                          </h4>
            </div> 
            <div  ng-if="cirrusideaPageCtrl.fundsdata.funds > 0 && !cirrusideaPageCtrl.fundsdata.usercanVote && cirrusideaPageCtrl.loggedin">
            
             <h4 style="margin:5px" ng-if="cirrusideaPageCtrl.fundsdata.timetoVote!==1">
            Your recent vote has been entered. Wait {{cirrusideaPageCtrl.fundsdata.timetoVote}} hours to vote again.
                           </h4>
            
              <h4 style="margin:5px" ng-if="cirrusideaPageCtrl.fundsdata.timetoVote===1">
            Your recent vote has been entered. Wait {{cirrusideaPageCtrl.fundsdata.timetoVote}} hour to vote again.
              </h4>
            </div>

                 
             <h4 style="margin:5px" ng-if="!cirrusideaPageCtrl.loggedin && cirrusideaPageCtrl.fundsdata.funds > 0">
             <a href="#!/login">Login</a> or <a href="#!/signup">Signup</a> to cast your Payout Votes.
             </h4>
	<div style="margin:5px" ng-if="cirrusideaPageCtrl.fundsdata.funds >0">
            <span class="badge" >Payout Votes: {{cirrusideaPageCtrl.fundsdata.payoutvotes}} </span>
        </div>
          
   </div> <!-- end Col sm -->
   
  </div> <!-- end Row -->
  
</div>  <!-- end container -->


 <!--  --------------------------------------------------------------------
 --------------------------------------------------------------------------------
 ----------------------------  -->

      
      <div class="container">
   <div class="row">
  
  
    <div class="col-sm-12">
         <div style="margin:5px; float:left;">
          <small>{{thoughtCtrl.specialpath}} /</small> <b>{{thoughtCtrl.page}}</b>
         </div>
         
        <div style="margin:5px; float:left;" ng-if="!cirrusideaPageCtrl.alreadyinQuicklinks">
          <button type="button" class="btn btn-warning  btn-xs" ng-click="cirrusideaPageCtrl.addtoQuicklinks()">QuickLink</button>
         </div>

          <div class="btn-group-vertical" style="margin:5px; float:right;" ng-if="cirrusideaPageCtrl.fundsdata.funds > 0 && cirrusideaPageCtrl.fundsdata.usercanVote">
          	 <button type="button" class="btn btn-info  btn-xs" ng-click="cirrusideaPageCtrl.payoutVote(0, cirrusideaPageCtrl.fundsdata.payoutvotes)">Needs Thought</button>
	         <button type="button" class="btn btn-success  btn-xs" ng-click="cirrusideaPageCtrl.payoutVote(1, cirrusideaPageCtrl.fundsdata.payoutvotes)">Payout</button>	       
	   </div>
	   <div class="clr"></div>

    </div>
 
         
 
  </div> <!-- End Row -->
  </div> <!-- Container -->
 
	 
		<button class="btn btn-info btn-xs pull-right" ng-click="cirrusideaPageCtrl.showPayoutstat()" ng-if="cirrusideaPageCtrl.fundsdata.payoutvotes>10 && cirrusideaPageCtrl.fundsdata.funds > 0" >
<span ng-class="{'glyphicon glyphicon-plus': !cirrusideaPageCtrl.payoutstatsopen, 'glyphicon glyphicon-chevron-up': cirrusideaPageCtrl.payoutstatsopen}" aria-hidden="true">
</span> Payout Stats</button>
 <div class="clr"></div>

<div ng-show="cirrusideaPageCtrl.payoutstatsopen">
<cirrusidea-payoutstats></cirrusidea-payoutstats>
</div>
 <div class="clr"></div>


<button class="btn btn-info btn-xs pull-left" ng-click="cirrusideaPageCtrl.showProjectData()" ng-if="cirrusideaPageCtrl.showprojectdata || cirrusideaPageCtrl.projectdata.isOwner">
<span ng-class="{'glyphicon glyphicon-plus': !cirrusideaPageCtrl.projectdataopen, 'glyphicon glyphicon-chevron-up': cirrusideaPageCtrl.projectdataopen}" aria-hidden="true">
</span> Idea Rundown</button>
 <div class="clr"></div>

<div ng-show="cirrusideaPageCtrl.projectdataopen" >
<cirrusidea-projectdata></cirrusidea-projectdata>
</div>
 <div class="clr"></div>

  </div> <!-- End panel header-->


  <div class="panel-body">
<!-- ---------------------------------------------------------------  ---->





<div style="padding:5px; width:80%; margin-left:auto; margin-right:auto;" ng-if="!thoughtCtrl.loggedin" ng-mouseenter="show = true" ng-mouseleave="show = false">
<button type="button" class="btn btn-primary btn-block" ng-disabled="1">
 Thought? </button>
  <div class="alert alert-info" ng-show="show">
  <strong><a href="#!/login">Login</a></strong> or <strong><a href="#!/signup">Signup</a></strong> to participate. But explore great ideas and thoughts as you wish.
  </div>
 </div> 
 

<div style="padding:5px; width:80%; margin-left:auto; margin-right:auto;" ng-if="thoughtCtrl.loggedin">
<button type="button" class="btn btn-primary btn-block" ng-click="thoughtCtrl.openAddThought()">Add Thought</button>
</div>




<thought-pagination></thought-pagination>




	<div ng-if="thoughtCtrl.thoughts.showcase"> 
	   
	  <button class="btn btn-info-lg pull-left" data-gallery="gallery" ng-click="thoughtCtrl.runLightBox($event)" >
		  <span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span> Gallery  <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
		</button>
          </div>

 <div  style="margin:5px; float:right;" ng-if="thoughtCtrl.thoughts.thoughtarray.length > 1">
		 <div class="LoadOrdering" style="display: none; float:right; margin-right: 5px;"><img src="images/loading.gif" /></div> Order By:
		 
		 <button type="button" class="btn btn-default  btn-xs" ng-click="thoughtCtrl.setThoughtOrderby(1)">
		  <span ng-class="thoughtCtrl.getThoughtOrderClassDirection(1)" aria-hidden="true"></span> Date  <span ng-class="thoughtCtrl.getThoughtOrderClassSelected(1)" aria-hidden="true"></span>
		</button>
		 
		 <button type="button" class="btn btn-default  btn-xs" ng-click="thoughtCtrl.setThoughtOrderby(2)">
		     <span ng-class="thoughtCtrl.getThoughtOrderClassDirection(2)" aria-hidden="true"></span> Cred  
		     <span ng-class="thoughtCtrl.getThoughtOrderClassSelected(2)" aria-hidden="true"></span></button>
		 </button>
		 
		 </div>



<div class="clr"></div>


 <div ng-repeat="thought in thoughtCtrl.thoughts.thoughtarray">
  
     <div id="thought_id_{{thought.id}}" ng-class="{'cirrus_thought_public': !thought.private, 'cirrus_thought_private': thought.private}">

<!-- -------------------------------------------------------------------------------------------------  -->
<!-- Thought Actions -->




<div  class="dropdown" style="float:right; margin:10px;">
				  
	 <a id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="float:right; display:block; width:25px; height:35px;">
				  <span class="glyphicon glyphicon-th" style="float:right;"></span>
	  </a>
				  
				
				  <ul class="dropdown-menu dropdown-menu-right"  aria-labelledby="dLabel" >
				     
				    <li style="text-align:center; padding:5px;" ng-if="cirrusideaPageCtrl.loggedin">
				       <button class="btn btn-default btn-xs" ng-click="thoughtCtrl.shareThoughtDialogbtn(thought.id)">
					 <span class="glyphicon glyphicon-share-alt"></span> Share Thought
					</button>
						

				    </li>
				    
				     <li style="text-align:center; padding:5px;">
				       <button class="btn btn-default btn-xs" ng-click="thoughtCtrl.reportThoughtDialogbtn(thought.id)">
					 <span class="glyphicon glyphicon-zoom-in"></span> Report Malice
					</button>
						

				    </li>
				    
				    
				    <li role="separator" class="divider" ng-if="thought.owner"></li>
				    
				    <li style="text-align:center; padding:5px;" ng-if="thought.owner">
				      <button class="btn btn-danger btn-xs" ng-click="thoughtCtrl.deleteThoughtDialogbtn(thought.id)" ng-if="thought.owner">
					  <span class="glyphicon glyphicon-trash"></span> Delete Thought
					  </button>
				    </li>
				  </ul>
				  
</div>




<!-- -------------------------------------------------------------------------------------------------- -->



   <div ng-init="edit[$index]=true">Post Date: {{thought.date | date:'MM/dd/yyyy @ h:mma'}} </div>
   
   <span class="label label-info pull-right"><a ng-href="#!/viewprofile/username/{{thought.membername}}" style="color:white;">{{thought.membername}}</a></span>

  <!--<div> {{thought.id}} </div> 
      <div> {{thought.headline}}</div>
    <div>{{thought.file_name}}</div>
   <div>{{thought.file_type}}</div>
 <div>{{thought.file_size}}</div>
 <div>{{thought.path}}</div>
  <div>{{thought.member_id}}</div>
  <div>{{thought.membername}}</div>
    <div>{{thought.private}}</div>
    <div>{{thought.rating}}</div> 
 <div>{{thought.percentratingstyle}} -->
  
 <div style="padding:5px;">
  <div ng-if="thought.owner && edit[$index]">
	  <div class="form-group">
	  <label for="comment">Thought:</label>
	  <textarea cirrus-textarea  class="form-control" rows="5" ng-keyup="textareaCtrl.txtkeyup($event)" data-id="{{thought.id}}"  ng-blur="thoughtCtrl.outofFocus($event,$index)" ng-bind="thought.headline"></textarea>
	</div>
	
    </div>
   
   <div ng-if="!thought.owner  || !edit[$index]" class="headline">
          <label for="comment">Thought:</label><div style="overflow:auto;" ng-bind-html="thought.headline"></div>
   </div>
   <button class="btn btn-xs btn-defualt pull-right" ng-if="thought.owner" ng-click="edit[$index] ? edit[$index] = false : edit[$index] = true; ">
   <span ng-class="{'glyphicon glyphicon-pencil': !edit[$index], 'glyphicon glyphicon-pushpin': edit[$index]}"></span>
   </button>
   
   </div>
  

  
  <div ng-switch on="thought.file_type">
  
  
    <div ng-switch-when="image" style="background-image: url('images/loading.gif'); background-repeat:no-repeat; background-position: center center;">
       
      <a ng-click="thoughtCtrl.downloadThoughtFile(thought.path)"><img ng-src="{{thought.thumbnail}}" width="100%"/></a>
    </div>
    
    
    <div ng-switch-when="audio">
   <div class="clr"></div>
   <br />
    <div style="width:80%; margin-left:auto; margin-right:auto;">
      <audio controls style="width:100%;">
	   <source ng-src="{{thought.path}}"  type="audio/mp3">
	 </audio> 
    </div>	 
    <br />
        <a ng-if="thought.file_name" ng-click="thoughtCtrl.downloadThoughtFile(thought.path)">{{thought.file_name}}</a> <small ng-if="thought.file_name">Size:  {{thought.file_size/1024 | number:0}} Kb</small>
        
    </div>
     
 
    <div ng-switch-when="video">
     
 
                                  <button class="btn btn-lg btn-default" ng-if="thoughtCtrl.videoplayer !== $index" ng-click = "thoughtCtrl.setvideoplayer($index);">
                                  <span class="glyphicon glyphicon-play"></span> Video
                                  </span>
                                  </button>
  
				    <div style="width:100%; margin-left:auto; margin-right:auto; margin-top:25px;" ng-if="thoughtCtrl.videoplayer === $index">
				
				<video width="100%" height="360" controls>
	
						<source ng-src="{{thought.path}}" type="video/mp4" /><!-- Safari / iOS video    -->
						
					
						
				</video>
					
					<p>    <strong>Download Video:</strong>
									 <a ng-click="thoughtCtrl.downloadThoughtFile(thought.path)">{{thought.file_name}}</a>
									 <small ng-if="thought.file_name">Size:  {{thought.file_size/1024 | number:0}} Kb</small>
					
					</p>				
				</div>
				
   
    </div>  <!--Switch When File Type is VIDEO END -->
  

    
     <div ng-switch-default>
      
        <a ng-if="thought.file_name" ng-click="thoughtCtrl.downloadThoughtFile(thought.path)">{{thought.file_name}}</a> <small ng-if="thought.file_name">Size:  {{thought.file_size/1024 | number:0}} Kb</small>
     
      </div>  <!--Switch When File Type is OTHER END -->
  
  
  
  </div>
  
 			 
 <div class="btn-group-vertical pull-right" style="margin:5px;" ng-if="thought.credvote && thoughtCtrl.loggedin && !thought.owner">
          	       <button type="button" class="btn btn-info btn-xs" ng-click="thoughtCtrl.addCred(thought.id, $index)">Cred Up <span class="glyphicon glyphicon-menu-up"></span></button>
	               <button type="button" class="btn btn-danger  btn-xs" ng-click="thoughtCtrl.subtractCred(thought.id, $index)" ng-if="thought.rating>0">Cred Down <span class="glyphicon glyphicon-menu-down"></span></button>	       
	       </div>

<div class="progress pull-right" style="width:150px; margin:5px; height:30px; background-image: url('images/postcred.png'); background-size: 20px 20px; background-repeat: no-repeat; background-position: right;">
<div style="padding-top:8px; padding-left:3px; color:black; position:absolute;">Cred: {{thought.rating}}</div>
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="opacity: 0.4; filter: alpha(opacity=40);" ng-style="thought.percentratingstyle">
   </div>
</div>
            

 <div style="padding:5px;">
 <button type="button" class="btn btn-primary btn-xs" ng-click="thoughtCtrl.thoughtcomment_toggleIT($index)" ng-if="cirrusideaPageCtrl.loggedin || thought.thoughtcomments.length > 0">
	 <span ng-class="thought.thoughtcomment_togglestyle"></span> Comments <span class="glyphicon glyphicon-comment"></span> <span class="badge">{{thought.thoughtcomments.length}}</span></button>
	 
	 </div>
  
  
	
	    
	    
	    <div ng-if="thought.thoughtcomment_toggle">
	 <hr></hr>   
	    
	     <form role="form" class="commentForm" ng-if="thoughtCtrl.loggedin">
 	      <div class="form-group">
                <label for="comment">Thought Comment:</label>
                   <textarea cirrus-addtextarea class="form-control postcommenttextarea" id="thoughtCommentTextarea_{{$index}}" rows="2" ng-keyup="addtextareaCtrl.txtkeyup($event)"></textarea>                 
                     </div>
              <input type="submit" class="btn btn-default pull-right" ng-disabled="!thoughtCtrl.commentthoughtformokay($index)"   ng-click="thoughtCtrl.addthoughtComment($event, thought.id, $index)" value="Post"/>
           </form>
             <div class="clr"></div>
	     

	    <div ng-repeat="thoughtcomment in thought.thoughtcomments">
	         <div style="padding:5px;">
	        <div class="cirrus_thoughtcomment">
	       <div>Date: {{thoughtcomment.com_date | date:'MM/dd/yyyy @ h:mma'}} </div>
	        <span class="label label-info pull-right"><a ng-href="#!/viewprofile/username/{{thoughtcomment.commenter_name}}" style="color:white;">{{thoughtcomment.commenter_name}}</a></span>

	              <blockquote>
	              <small>
                       {{thoughtcomment.comment}}
                       </small>
                       </blockquote>
	         
	       </div>
	       </div>
	    </div>
	  </div>
	 
  
  <div class="clr"></div>
  
  
 </div> <!-- End of Thought -->
		 
 </div> <!-- End of repeat -->

<div class="clr"></div>
<thought-pagination></thought-pagination>


	
	<div ng-if="thoughtCtrl.thoughts.showcase"> 
	   
	  <button class="btn btn-info-lg" data-gallery="gallery" ng-click="thoughtCtrl.runLightBox($event)" >
		  <span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span> Gallery  <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
		</button>
  
	<?php
	require_once('modal/cirrusgallery.php');
	?>	  

        </div>





	



<!-- ------------------------------------------------------  -->
 </div>  <!-- ---------------------------------------------------------------  END PANEL BODY ---->

<!-- ------------------------------------------------------  -->


<div class="panel-footer"><cirrus-breadcrumbs></cirrus-breadcrumbs>

<cirrus-search></cirrus-search>
<div class="clr"></div>
<hr></hr>
<viewable-by></viewable-by>
</div>  <!------ END PANEL FOOTER  ----- -->

  
</div>  <!------ END PANEL  ----- -->







