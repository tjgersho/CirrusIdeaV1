<?php
?>
<div ng-if="thoughtCtrl.thoughts.numPages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="thoughtCtrl.getThoughtsSpecial(thoughtCtrl.pagControl(thoughtCtrl.showPag-1))" ng-if="thoughtCtrl.showPag>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [thoughtCtrl.thoughts.numPages] | makeRange" ng-class="thoughtCtrl.activePag(n)" >
    
         <a ng-click="thoughtCtrl.getThoughtsSpecial(thoughtCtrl.pagControl(n))">{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="thoughtCtrl.getThoughtsSpecial(thoughtCtrl.pagControl(thoughtCtrl.showPag+1))" ng-if="thoughtCtrl.showPag<thoughtCtrl.thoughts.numPages">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>