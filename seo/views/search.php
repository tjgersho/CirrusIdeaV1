<?php
?>
<div class="panel panel-success">
  

<div class="panel-heading">
    <h3 class="panel-title">CirrusIdea - Search: <b>{{cirrusSearchPageCtrl.searchterm}}</b></h3>
  </div>


  <div class="panel-body">
  


 
<ul class="nav nav-tabs">
  <li role="presentation" ng-class="{'active': cirrusSearchPageCtrl.getsearchTabFromService()    === 1}"><a ng-click="cirrusSearchPageCtrl.tabcontrol(1)">CirrusIdeas</a></li>
  <li role="presentation" ng-class="{'active': cirrusSearchPageCtrl.getsearchTabFromService()    === 2}"><a ng-click="cirrusSearchPageCtrl.tabcontrol(2)">Thoughts</a></li>
  <li role="presentation" ng-class="{'active': cirrusSearchPageCtrl.getsearchTabFromService()    === 3}"><a ng-click="cirrusSearchPageCtrl.tabcontrol(3)">Members</a></li>
 </ul>


<div ng-if="cirrusSearchPageCtrl.getsearchTabFromService()  === 1">
<cirrus-searchideas></cirrus-searchideas>
</div>

<div ng-if="cirrusSearchPageCtrl.getsearchTabFromService() === 2">
<cirrus-searchthoughts></cirrus-searchthoughts>
</div>

<div ng-if="cirrusSearchPageCtrl.getsearchTabFromService()  === 3">
<cirrus-searchmembers></cirrus-searchmembers>
</div>










</div>

  
  
  <div class="panel-footer">
    <cirrus-search></cirrus-search><div class="clr"></div>
  </div>

  
</div>
