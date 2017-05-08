<?php
require_once('modal/cirrusdeletecodev.php');

?>

<h5> Your CirrusIdea CoDevelopers</h5>

<div id="codevloading" style="display:none;"><img src="images/loading.gif"/></div>


<br />
<div class="clr"></div>

<div class="info" ng-if="cirrusCoDevsCtrl.codevlist.length<1">
You do not have any CoDevelopers yet. Start browsing <a href="/cirrus">CirrusIdeas</a>.
</div>

<div ng-repeat="CoDev in cirrusCoDevsCtrl.codevlist">

                  
        <div class="searchmemberdiv">	
  <span class="label label-info label-lg"><a ng-href="/viewprofile/username/{{CoDev.membername}}" style="color:white;">{{CoDev.membername}}</a></span>
   
   <div  class="dropdown" style="float:right;" ng-click="cirrusCoDevsCtrl.dropdownclick($event)">
				  
<a id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="float:left; display:block; width:25px; height:35px;">
		  <span class="caret" style="float:right;"></span>
		 </a>
				  
				
		 <ul ng-class="cirrusCoDevsCtrl.ddclassobj"  aria-labelledby="dLabel" >
		 <li><a class="btn" role="button" ng-click="cirrusCoDevsCtrl.deleteCoDevPopup(CoDev.id)">Remove <br />{{CoDev.membername}}<br /> as CoDeveloper</a></li>
		</ul>
				  
	</div>
 <div ng-if="CoDev.interest"> 
   <label for="interest">Interest:</lable>
{{CoDev.interest}}
  </div>
  
   <div ng-if="!CoDev.interest"> 
   <br />
  </div>


  
<div class="progress" style="width:150px; float:right; height:40px; background-image: url('images/membercred.png'); background-size: 45px 35px; background-repeat: no-repeat; background-position: right;">
<div style="padding-top:8px; padding-left:3px; color:black; position:absolute;">Member Cred: <b>{{CoDev.cred}}</b></div>
<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="opacity: 0.4; filter: alpha(opacity=40);" ng-style="CoDev.percentcredstyle">
</div>
</div>
</div>



</div>







<br />
<div class="clr"></div>





