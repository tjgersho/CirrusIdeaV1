<?php
?>


<div id="searchingmembers" style="display:none;"><img src="images/loading.gif"/></div>




<div ng-if="cirrusSearchMemberCtrl.searchResults.numpages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="cirrusSearchMemberCtrl.getsearchMemberPageSpecial(cirrusSearchMemberCtrl.pagControl(cirrusSearchMemberCtrl.paginationpage-1))" 
      ng-if="cirrusSearchMemberCtrl.paginationpage>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [cirrusSearchMemberCtrl.searchResults.numpages] | makeRange" ng-class="cirrusSearchMemberCtrl.activePag(n)" >
    
         <a ng-click="cirrusSearchMemberCtrl.getsearchMemberPageSpecial(cirrusSearchMemberCtrl.pagControl(n))" >{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="cirrusSearchMemberCtrl.getsearchMemberPageSpecial(cirrusSearchMemberCtrl.pagControl(cirrusSearchMemberCtrl.paginationpage+1))"
      ng-if="cirrusSearchMemberCtrl.paginationpage<cirrusSearchMemberCtrl.searchResults.numpages ">        
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>

 <div  style="margin:5px; float:right;">
		Order By:
		 
		 <button type="button" class="btn btn-default  btn-xs" ng-click="cirrusSearchMemberCtrl.setMemberOrderby(1)">
		  <span ng-class="cirrusSearchMemberCtrl.getMemberOrderClassDirection(1)" aria-hidden="true"></span> Username  <span ng-class="cirrusSearchMemberCtrl.getMemberOrderClassSelected(1)" aria-hidden="true"></span>
		</button>
		 
		 <button type="button" class="btn btn-default  btn-xs" ng-click="cirrusSearchMemberCtrl.setMemberOrderby(2)">
		     <span ng-class="cirrusSearchMemberCtrl.getMemberOrderClassDirection(2)" aria-hidden="true"></span> Cred  <span ng-class="cirrusSearchMemberCtrl.getMemberOrderClassSelected(2)" aria-hidden="true"></span></button>
		 </button>
		 
  </div>


<div class="clr"></div>

<div class="info" ng-if="cirrusSearchMemberCtrl.searchResults.memberarray.length<1">
Your Search has Zero Results... Try another search term.
</div>

<div ng-repeat="searchmembers in cirrusSearchMemberCtrl.searchResults.memberarray">

                  
        <div class="searchmemberdiv">	
  <span class="label label-info label-lg"><a ng-href="/viewprofile/username/{{searchmembers.membername}}" style="color:white;">{{searchmembers.membername}}</a></span>
    <div ng-if="searchmembers.interest"> 
   <label for="interest">Interest:</lable>
{{searchmembers.interest}}
  </div>
  
   <div ng-if="!searchmembers.interest"> 
   <br />
  </div>

  
      <div class="progress" style="width:150px; float:right; height:40px; background-image: url('images/membercred.png'); background-size: 45px 35px; background-repeat: no-repeat; background-position: right;">
<div style="padding-top:8px; padding-left:3px; color:black; position:absolute;">Member Cred: <b>{{searchmembers.cred}}</b></div>
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="opacity: 0.4; filter: alpha(opacity=40);" ng-style="searchmembers.percentcredstyle">
   </div>
</div>
       </div>



</div>









<br />
<div class="clr"></div>



<div ng-if="cirrusSearchMemberCtrl.searchResults.numpages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="cirrusSearchMemberCtrl.getsearchMemberPageSpecial(cirrusSearchMemberCtrl.pagControl(cirrusSearchMemberCtrl.paginationpage-1))" 
      ng-if="cirrusSearchMemberCtrl.paginationpage>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [cirrusSearchMemberCtrl.searchResults.numpages] | makeRange" ng-class="cirrusSearchMemberCtrl.activePag(n)" >
    
         <a ng-click="cirrusSearchMemberCtrl.getsearchMemberPageSpecial(cirrusSearchMemberCtrl.pagControl(n))" >{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="cirrusSearchMemberCtrl.getsearchMemberPageSpecial(cirrusSearchMemberCtrl.pagControl(cirrusSearchMemberCtrl.paginationpage+1))"
      ng-if="cirrusSearchMemberCtrl.paginationpage<cirrusSearchMemberCtrl.searchResults.numpages ">        
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>