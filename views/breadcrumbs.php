<?php
?>


<div ng-model="breadcrumbCtrl.path"></div>

<ol class="breadcrumb">
  <li><a href="/cirrus">CirrusIdeas</a></li>
  
  <li ng-repeat="pathparts in breadcrumbCtrl.links">
  
  <a ng-href="/cirrus/path/{{pathparts.path}}/page/{{pathparts.page}}">{{pathparts.page}}</a>
  
  </li>
  
  
  <li class="active">{{breadcrumbCtrl.page}}</li>
</ol>


