<?php
?>
 <!-- <form name="cirrusSearchForm" class="navbar-form navbar-left" style="margin-left:0px; margin-right:0px;" role="search" novalidate> -->
        <div class="form-group" style="margin:10px;">
          <input type="text" class="form-control popup" placeholder="Search" name="search"
           ng-model="cirrusSearchCtrl.searchterm"  ng-blur="cirrusSearchCtrl.search()" ng-keypress="cirrusSearchCtrl.searchkeypress($event)">
        </div>
     <!--   <button type="submit" class="btn btn-default" ng-click="cirrusSearchCtrl.search()" id="submitCirrusSearch" ng-disable="!cirrusSearchForm.$valid">Submit</button>
    
 </form> -->
