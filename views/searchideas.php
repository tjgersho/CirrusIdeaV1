<?php
?>


<div id="searching" style="display:none;"><img src="images/loading.gif"/></div>




<div ng-if="cirrusSearchIdeaCtrl.searchResults.numpages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="cirrusSearchIdeaCtrl.getsearchIdeaPage(cirrusSearchIdeaCtrl.pagControl(cirrusSearchIdeaCtrl.paginationpage-1))" 
      ng-if="cirrusSearchIdeaCtrl.paginationpage>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [cirrusSearchIdeaCtrl.searchResults.numpages] | makeRange" ng-class="cirrusSearchIdeaCtrl.activePag(n)" >
    
         <a ng-click="cirrusSearchIdeaCtrl.getsearchIdeaPage(cirrusSearchIdeaCtrl.pagControl(n))" >{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="cirrusSearchIdeaCtrl.getsearchIdeaPage(cirrusSearchIdeaCtrl.pagControl(cirrusSearchIdeaCtrl.paginationpage+1))"
      ng-if="cirrusSearchIdeaCtrl.paginationpage<cirrusSearchIdeaCtrl.searchResults.numpages ">        
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>



<br />
<div class="clr"></div>

<div class="info" ng-if="cirrusSearchIdeaCtrl.searchResults.ideaarray.length<1">
Your Search has Zero Results... Try another search term.
</div>

<div ng-repeat="searchideas in cirrusSearchIdeaCtrl.searchResults.ideaarray">

                    <div ng-class="searchideas.type">
			       
	<a ng-class="searchideas.type1" ng-href="/cirrus/path/files/page/{{searchideas.file_name}}" style="float:left; padding:10px; margin:5px;" ng-if="searchideas.isCat">{{searchideas.file_name}}</a>
			
	 <a ng-class="searchideas.type1" ng-href="/cirrus/path{{searchideas.file_path}}/page/{{searchideas.file_name}}" style="float:left; padding:10px; margin:5px;" ng-if="!searchideas.isCat">{{searchideas.file_name}}</a>
						

                    <div ng-if="searchideas.p_descript">
			<br />
			
			   <div style="float:left; max-width:450px;"><b>Synopsis:</b><br />{{searchideas.p_descript}}</div>
			   </div>
	             </div>



</div>









<br />
<div class="clr"></div>



<div ng-if="cirrusSearchIdeaCtrl.searchResults.numpages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="cirrusSearchIdeaCtrl.getsearchIdeaPage(cirrusSearchIdeaCtrl.pagControl(cirrusSearchIdeaCtrl.paginationpage-1))" 
      ng-if="cirrusSearchIdeaCtrl.paginationpage>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [cirrusSearchIdeaCtrl.searchResults.numpages] | makeRange" ng-class="cirrusSearchIdeaCtrl.activePag(n)" >
    
         <a ng-click="cirrusSearchIdeaCtrl.getsearchIdeaPage(cirrusSearchIdeaCtrl.pagControl(n))" >{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="cirrusSearchIdeaCtrl.getsearchIdeaPage(cirrusSearchIdeaCtrl.pagControl(cirrusSearchIdeaCtrl.paginationpage+1))"
      ng-if="cirrusSearchIdeaCtrl.paginationpage<cirrusSearchIdeaCtrl.searchResults.numpages ">        
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>