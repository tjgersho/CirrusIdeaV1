<?php
require_once('modal/cirrusdeletequicklink.php');
?>

<h5> Your Quick CirrusIdea Links </h5>

<div id="quicklinkloading" style="display:none;"><img src="images/loading.gif"/></div>


<br />
<div class="clr"></div>

<div class="info" ng-if="cirrusQuicklinkCtrl.qlinklist.length<1">
You do not have any quicklinks yet. Start browsing <a href="/cirrus">CirrusIdeas</a>.
</div>

<div ng-repeat="link in cirrusQuicklinkCtrl.qlinklist">

      <div class="quicklink">		       
	<a ng-href="/cirrus/path/files/page/{{link.page}}" role="button" class="btn btn-warning" style="float:left; padding:10px; margin:5px;" ng-if="link.isCat">{{link.page}}</a>
			
	 <a ng-href="/cirrus/path/{{link.path}}/page/{{link.page}}" role="button" class="btn btn-warning"  style="float:left; padding:10px; margin:5px;" ng-if="!link.isCat">{{link.page}}</a>
					
					
					
			      <div  class="dropdown" style="float:left;" ng-click="cirrusQuicklinkCtrl.dropdownclick($event)">
				  
				  <a id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="float:left; display:block; width:25px; height:35px;">
				  <span class="caret" style="float:right;"></span>
				  </a>
				  
				
				  <ul ng-class="cirrusQuicklinkCtrl.ddclassobj"  aria-labelledby="dLabel" >
				    <li><a class="btn" role="button" ng-click="cirrusQuicklinkCtrl.deleteQuicklinkPopup(link.id)">Delete <br />{{link.page}}<br /> Quicklink</a></li>
				
				  </ul>
				  
				</div>


                    <div ng-if="link.p_descript">
			<br />
			
			   <div style="float:left; max-width:450px;"><b>Synopsis:</b><br />{{link.p_descript}}</div>
			   </div>
	           
            </div>


</div>









<br />
<div class="clr"></div>
