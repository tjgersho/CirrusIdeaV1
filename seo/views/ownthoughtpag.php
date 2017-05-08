<?php
?>
<div ng-if="cirrusMyIdeasCtrl.thoughts.numPages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="cirrusMyIdeasCtrl.getownThoughts(cirrusMyIdeasCtrl.pagControl(cirrusMyIdeasCtrl.showPag-1))" 
      ng-if="cirrusMyIdeasCtrl.showPag>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [cirrusMyIdeasCtrl.thoughts.numPages] | makeRange" ng-class="cirrusMyIdeasCtrl.activePag(n)" >
    
         <a ng-click="cirrusMyIdeasCtrl.getownThoughts(cirrusMyIdeasCtrl.pagControl(n))">{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="cirrusMyIdeasCtrl.getownThoughts(cirrusMyIdeasCtrl.pagControl(cirrusMyIdeasCtrl.showPag+1))"
       ng-if="cirrusMyIdeasCtrl.showPag<cirrusMyIdeasCtrl.thoughts.numPages">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>