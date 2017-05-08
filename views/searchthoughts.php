<?php
?>


<div id="searchingthoughts" style="display:none;"><img src="images/loading.gif"/></div>




<div ng-if="cirrusSearchThoughtCtrl.thoughts.numPages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="cirrusSearchThoughtCtrl.getsearchthoughtPageSpecial(cirrusSearchThoughtCtrl.pagControl(cirrusSearchThoughtCtrl.paginationpage-1))" 
      ng-if="cirrusSearchThoughtCtrl.paginationpage>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [cirrusSearchThoughtCtrl.thoughts.numPages] | makeRange" ng-class="cirrusSearchThoughtCtrl.activePag(n)" >
    
         <a ng-click="cirrusSearchThoughtCtrl.getsearchthoughtPageSpecial(cirrusSearchThoughtCtrl.pagControl(n))" >{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="cirrusSearchThoughtCtrl.getsearchthoughtPageSpecial(cirrusSearchThoughtCtrl.pagControl(cirrusSearchThoughtCtrl.paginationpage+1))"
      ng-if="cirrusSearchThoughtCtrl.paginationpage<cirrusSearchThoughtCtrl.thoughts.numPages ">        
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>

 <div  style="margin:5px; float:right;">
		Order By:
		 
		 <button type="button" class="btn btn-default  btn-xs" ng-click="cirrusSearchThoughtCtrl.setThoughtOrderby(1)">
		  <span ng-class="cirrusSearchThoughtCtrl.getThoughtOrderClassDirection(1)" aria-hidden="true"></span> Date  <span ng-class="cirrusSearchThoughtCtrl.getThoughtOrderClassSelected(1)" aria-hidden="true"></span>
		</button>
		 
		 <button type="button" class="btn btn-default  btn-xs" ng-click="cirrusSearchThoughtCtrl.setThoughtOrderby(2)">
		     <span ng-class="cirrusSearchThoughtCtrl.getThoughtOrderClassDirection(2)" aria-hidden="true"></span> Cred  <span ng-class="cirrusSearchThoughtCtrl.getThoughtOrderClassSelected(2)" aria-hidden="true"></span></button>
		 </button>
		 
  </div>
		 
 <div class="clr"></div>
  <!-- -------------------------------------------------------------------------------  -->
   <!-- -------------------------------------------------------------------------------  -->
    <!-- -------------------------------------------------------------------------------  -->
 <div ng-repeat="thought in cirrusSearchThoughtCtrl.thoughts.thoughtarray">

     <div class="cirrus_own_thought">


   <div>Post Date: {{thought.date | date:'MM/dd/yyyy @ h:mma'}} </div>
   
   <span class="label label-info pull-right"><a ng-href="/viewprofile/username/{{thought.membername}}" style="color:white;">{{thought.membername}}</a></span>

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
  
   <div><b>CirrusIdea:</b>

     <a ng-href="/cirrus/path/files/page/{{thought.idea}}/tid/{{thought.id}}"  ng-if="thought.isCategory">{{thought.idea}}</a>
     <a ng-href="/cirrus/path/{{thought.ideapath}}/page/{{thought.idea}}/tid/{{thought.id}}" ng-if="!thought.isCategory">{{thought.idea}}</a>    
     
     </div>
   
   
<br /><br />
   <div  class="headline" ng-if="thought.headline">
           {{thought.headline}}
   </div>
   <br />
  
 
  
  <div ng-switch on="thought.file_type">
  
  
    <div ng-switch-when="image">
       
     <img ng-src="{{thought.thumbnail}}" width="100%"/>
     
    </div>  <!--Switch When File Type is image END -->
  
  
    <div ng-switch-when="audio">
   <div class="clr"></div>
   <br />
    <div style="width:80%; margin-left:auto; margin-right:auto;">
      <audio controls style="width:100%;">
	   <source ng-src="{{thought.path}}"  type="audio/mp3">
	 </audio> 
    </div>	 
    
     </div> <!--Switch When File Type is Audio END -->
       
  
    <div ng-switch-when="video">
    
  
				    <div style="width:100%; margin-left:auto; margin-right:auto; margin-top:25px; ">
				
				<!-- "Video For Everybody" v0.3.3 by Kroc Camen of Camen Design <http://camendesign.com/code/video_for_everybody>
				     =================================================================================================================== -->
				<!-- first try HTML5 playback. if serving as XML, expand `controls` to `controls="controls"` and autoplay likewise       -->
				<!-- warning: playback does not work on iPad/iPhone if you include the poster attribute! wee are awaiting a fix from apple -->
				<video width="100%" height="360" controls>
				    <!-- MP4 must be first for iPad! you must use `</source>` to avoid a closure bug in Firefox 3.0 / Camino 2.0! -->
				    <source ng-src="{{thought.path}}"  type="video/mp4"><!-- Safari / iPhone video    --></source>
				    <source ng-src="{{thought.path}}"  type="video/ogg"><!-- Firefox native OGG video --></source>
				    <!-- IE only QuickTime embed: IE6 is ignored as it does not support `<object>` in `<object>` so we skip QuickTime
				         and go straight to Flash further down. the line break after the `classid` is required due to a bug in IE -->
				    <!--[if gt IE 6]>
					<object width="100%" height="375" classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B"><!
					[endif]-->
					<!-- non-IE QuickTime embed (hidden from IE): the self-closing comment tag allows non-IE browsers to
					     see the HTML whilst being compatible with serving as XML -->
					<!--[if !IE]><!-->
					<object width="100%" height="375" type="video/quicktime"  data="{{thought.path}}"  >
					<!--<![endif]-->
					<param name="src" value="{{thought.path}}"  />
					<param name="showlogo" value="true" />
					<!-- fallback to Flash -->
					<object width="100%" height="384" type="application/x-shockwave-flash"	data="player.swf?&amp;image=poster.jpg&amp;file={{thought.path}}">
						<!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
						<param name="movie" value="player.swf?image=poster.jpg&amp;file={{thought.path}}" />
						<!-- fallback image -->
						<img src="images/poster.jpg" width="100%" height="360" alt="znoter intro"  title="No video playback capabilities, please download the video below" />
					</object><!--[if gt IE 6]><!-->
					</object><!--<![endif]-->
				</video>
				<p>   <b>{{thought.file_name}}</b>
				
				</p>
				
				</div>
				
   
    </div>  <!--Switch When File Type is VIDEO END -->
  

    
     <div ng-switch-default>
      
        <b>{{thought.file_name}}</b> <small ng-if="thought.file_name">Size:  {{thought.file_size/1024 | number:0}} Kb</small>
      
      </div>  <!--Switch When File Type is OTHER END -->
  
  
   
  </div>
  
 			 
<div class="progress pull-right" style="width:150px; margin:5px; height:30px; background-image: url('images/postcred.png'); background-size: 20px 20px; background-repeat: no-repeat; background-position: right;">
<div style="padding-top:8px; padding-left:3px; color:black; position:absolute;">PostCred: {{thought.rating}}</div>
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="opacity: 0.4; filter: alpha(opacity=40);" ng-style="thought.percentratingstyle">
   </div>
</div>
            


<div class="clr"></div>
  
  
 </div> <!-- End of Thought -->
		 
 </div> <!-- End of repeat -->


<br />
<div class="clr"></div>

<div class="info" ng-if="cirrusSearchThoughtCtrl.thoughts.thoughtarray.length<1">
Your Search has Zero Results... Try another search term.
</div>


<div ng-if="cirrusSearchThoughtCtrl.thoughts.numPages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="cirrusSearchThoughtCtrl.getsearchthoughtPageSpecial(cirrusSearchThoughtCtrl.pagControl(cirrusSearchThoughtCtrl.paginationpage-1))" 
      ng-if="cirrusSearchThoughtCtrl.paginationpage>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [cirrusSearchThoughtCtrl.thoughts.numPages] | makeRange" ng-class="cirrusSearchThoughtCtrl.activePag(n)" >
    
         <a ng-click="cirrusSearchThoughtCtrl.getsearchthoughtPageSpecial(cirrusSearchThoughtCtrl.pagControl(n))" >{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="cirrusSearchThoughtCtrl.getsearchthoughtPageSpecial(cirrusSearchThoughtCtrl.pagControl(cirrusSearchThoughtCtrl.paginationpage+1))"
      ng-if="cirrusSearchThoughtCtrl.paginationpage<cirrusSearchThoughtCtrl.thoughts.numPages">        
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>