<?php


 
?>

<div class="container">

<div ng-if="donationCtrl.success == '1'">

<div class="panel panel-success">
Thanks for your Donation!<br />

<span ng-if="donationCtrl.user.username">
  -- {{donationCtrl.user.username}}
</span>

<div class="panel-body">
  <br />

Amount: {{donationCtrl.amount}}

<br />

Idea ID: {{donationCtrl.ideaID}}

<br />
Back to 
<a ng-href="/cirrus/path{{donationCtrl.path}}/page/{{donationCtrl.page}}">{{donationCtrl.page}}</a>


<br />


  </div>
  <div class="panel-footer"><a ng-href="#/mycirrus">MyCirrus</a>
</div>


</div>



</div>
<div ng-if="donationCtrl.success == '0'">
<br /><br />
<div class="panel panel-warning">
<p style="color:blue; font-size:20px;">
			Your transaction did not go through either because you refreshed the page <br /><br />
			and it already went through, or you have to wait 2 days to donate more to {{donationCtrl.page}}.
			
			<br /><br />
		Back to  <a ng-href="/cirrus/path{{donationCtrl.path}}/page/{{donationCtrl.page}}">{{donationCtrl.page}}</a>

		
			</p>
</div>			
</div>	
			
			

</div>