<?php
?>

<div class="panel panel-success">
  

 <div class="panel-heading">
  <h3 class="panel-title" style="float: left;">MyCirrus </h3>  <span>  -- <b> {{mainCtrl.userService.username}}</b></span>
  </div>


  <div class="panel-body">
  
<ul class="nav nav-tabs">
  <li role="presentation" ng-class="{'active': mycirrusIdeaCtrl.getmyTab() === 1}"><a ng-click="mycirrusIdeaCtrl.tabcontrol(1)">Profile</a></li>
  <li role="presentation" ng-class="{'active': mycirrusIdeaCtrl.getmyTab()  === 2}"><a ng-click="mycirrusIdeaCtrl.tabcontrol(2)">Mydeas</a></li>
  <li role="presentation" ng-class="{'active': mycirrusIdeaCtrl.getmyTab()  === 3}"><a ng-click="mycirrusIdeaCtrl.tabcontrol(3)">Ideation</a></li>
  <li role="presentation" ng-class="{'active': mycirrusIdeaCtrl.getmyTab()  === 5}"><a ng-click="mycirrusIdeaCtrl.tabcontrol(5)">Q-Links</a></li>
  <li role="presentation" ng-class="{'active': mycirrusIdeaCtrl.getmyTab()  === 6}"><a ng-click="mycirrusIdeaCtrl.tabcontrol(6)">CoDevs</a></li>
  <li role="presentation" ng-class="{'active': mycirrusIdeaCtrl.getmyTab()  === 4}"><a ng-click="mycirrusIdeaCtrl.tabcontrol(4)">Chat</a></li>
</ul>


<div ng-if="mycirrusIdeaCtrl.getmyTab()  === 1">
<cirrus-profile></cirrus-profile>
</div>




<div ng-if="mycirrusIdeaCtrl.getmyTab()  === 2">
<cirrus-myideas></cirrus-myideas>
</div>

<div ng-if="mycirrusIdeaCtrl.getmyTab()  === 3">
<cirrus-youmaylike></cirrus-youmaylike>
</div>

<div ng-if="mycirrusIdeaCtrl.getmyTab()  === 4">
<cirrus-chat></cirrus-chat>
</div>


<div ng-if="mycirrusIdeaCtrl.getmyTab()  === 5">
<cirrus-quicklinks></cirrus-quicklinks>
</div>


<div ng-if="mycirrusIdeaCtrl.getmyTab()  === 6">
<cirrus-codevs></cirrus-codevs>
</div>



</div>
  
  
  <div class="panel-footer">
  <h3 class="panel-title" style="float: left;">MyCirrus </h3>  <span>  -- <b> {{mainCtrl.userService.username}}</b></span>
<br />
  <cirrus-search></cirrus-search>
  <div class="clr"></div>
</div>
