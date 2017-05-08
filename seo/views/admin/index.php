<?php
?>
<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">
         Admin
      </h3>
   </div>
   
   <div class="panel-body">
     

       <div class="btn-group">
          <button class="btn btn-lg btn-success" ng-click="cirrusideaAdminCtrl.actionToggle(1)"><span class="fontmorph">MEMBERS</span></button>
          <button class="btn btn-lg btn-info" ng-click="cirrusideaAdminCtrl.actionToggle(2)"><span class="fontmorph">SCRATCH</span></button>
          <button class="btn btn-lg btn-default" ng-click="cirrusideaAdminCtrl.actionToggle(3)"><span class="fontmorph">CONTACT US MSGS</span></button>
          <button class="btn btn-lg btn-warning" ng-click="cirrusideaAdminCtrl.actionToggle(4)"><span class="fontmorph">SEND PAYMENT</span></button>
           <button class="btn btn-lg btn-danger" ng-click="cirrusideaAdminCtrl.actionToggle(5)"><span class="fontmorph">DISTRIBUTIONS</span></button>
        </div>
     <!--   <div class="btn-group">
          <button class="btn btn-lg btn-success">5</button>
          <button class="btn  btn-lg btn-success">6</button>
          <button class="btn  btn-lg btn-success">7</button>
        </div>
        <div class="btn-group">
            <button class="btn btn-lg btn-warning">8</button>
        </div> -->
        
      
<br />
<br />

<div ng-show="cirrusideaAdminCtrl.action === 1">


  <h2>Members</h2>
  <div class="CSSTableGenerator">
     <table>
             <tr>
                <td>UserId</td>
		<td>Username</td>
		<td>First Name</td>
		<td>Last Name</td>
		<td>Email</td>
		<td>Join Date</td>
		<td>Interest</td>
		<td>Cred</td>
		<td>Validated</td>
	        <td>Delete?</td>
               </tr>
       
          <tr ng-repeat="member in cirrusideaAdminCtrl.members">
	
	
		
		<td>{{member.user_id}}</td>
		<td>{{member.username}}</td>
		<td>{{member.first_name}}</td>
		<td>{{member.last_name}}</td>
		<td>{{member.email}}</td>
		<td>{{member.join_date}}</td>
		<td>{{member.interest}}</td>
		<td>{{member.cred}}</td>
		<td>{{member.validated}}</td>
	        <td><button ng-click="cirrusideaAdminCtrl.deleteMember(member.user_id)">Delete</button></td>

  </tr></table>
 </div>

</div>





<div ng-show="cirrusideaAdminCtrl.action === 2">
	<div class="alert alert-warning">
	<p>Edit Button</p>
	<br /> Use this to post a server action
	<br /> Use by editing AdminCtrl.executescratch() Edit Server side script to job required.... Make new buttons to do other scripts...
	
	
	<button class="btn btn-warning" ng-click="cirrusideaAdminCtrl.executescratch()">Scratch</button>
	
	<button class="btn btn-success" ng-click="cirrusideaAdminCtrl.clearscratch()">Clear Scratch</button>
	</div>
    	 <div class="alert alert-info">
    	 
    	 {{cirrusideaAdminCtrl.scratchresp}}
    	</div>
          
</div>


<div ng-show="cirrusideaAdminCtrl.action === 3">


<div id="contactusmsglistloading"><img src="images/loading.gif" /></div>
  <h2>Contact Us Submissions</h2>
  <div class="CSSTableGenerator">
     <table>
     

             <tr>
                <td>Msg_id</td>
		<td>Msg Date</td>
		<td>First Name</td>
		<td>Last Name</td>
		<td>Email</td>
		<td>Message</td>
		<td>Delete?</td>
            </tr>
       
          <tr ng-repeat="list in cirrusideaAdminCtrl.contactusmsglist">
	
	
		<td>{{list.comment_id}}</td>
		<td>{{list.comment_date}}</td>
		<td>{{list.firstname}}</td>
		<td>{{list.lastname}}</td>
		<td>{{list.email}}</td>		
		<td>${{list.comment}}</td>
		
	
		<td><button ng-click="cirrusideaAdminCtrl.deletecomment(list.comment_id)">Delete</button></td>
	</tr>
	       
  </table>
 </div>


</div>

<div ng-show="cirrusideaAdminCtrl.action === 4">


<div id="paylistloading"><img src="images/loading.gif" /></div>
  <h2>Pay List</h2>
  <div class="CSSTableGenerator">
     <table>
     

             <tr>
                <td>Paylist_id</td>
		<td>Request Date</td>
		<td>Pay Date</td>
		<td>User_ID</td>
		<td>Username</td>
		<td>Paypal Email</td>
		<td>Amount</td>
		<td>PAY!!!</td>
	    </tr>
       
          <tr ng-repeat="list in cirrusideaAdminCtrl.paylistrequests">
	
	
		<td>{{list.paylist_id}}</td>
		<td>{{list.requestdate}}</td>
		<td>{{list.paydate}}</td>
		<td>{{list.user_id}}</td>
		<td>{{list.username}}</td>		
		<td>${{list.amount}}</td>
		<td>{{list.paypalemail}}</td>
	
		<td ng-class="{'paylistpaid': (list.paydate !== null), 'paylistunpaid': (list.paydate === null)}"><button ng-if="list.paydate === null" ng-click="cirrusideaAdminCtrl.paymember(list.username, list.user_id, list.amount, list.paylist_id)">Payout</button></td>
	</tr>
	       
  </table>
 </div>


</div>



<div ng-show="cirrusideaAdminCtrl.action === 5">


<div id="payoutstatsloading"><img src="images/loading.gif" /></div>
  <h2>Payout Stats</h2>
  <div class="CSSTableGenerator">
     <table>
             <tr>
                <td>Idea_ID</td>
		<td>Path</td>
		<td>Idea</td>
		<td>Cash In</td>
		<td>Payout %</td>
		<td>Total Votes</td>
		<td>Pay OUT</td>
	    </tr>
       
          <tr ng-repeat="stats in cirrusideaAdminCtrl.payoutStats.idea">
	
	
		
		<td>{{stats.ideaID}}</td>
		<td>{{stats.path}}</td>
		<td><a ng-href="#/cirrus/path{{stats.path}}/page/{{stats.page}}">{{stats.page}}</a></td>
		<td>${{stats.cashin}}</td>
		<td><span ng-if="stats.payoutvotepercent>=60"><b class="blinkit" style="color:red;">{{stats.payoutvotepercent}}%</b></span>
		<span ng-if="stats.payoutvotepercent<60">{{stats.payoutvotepercent}}%</span>		
		</td>
		<td>{{stats.totalvotes}}</td>
		<td><button ng-click="cirrusideaAdminCtrl.payoutidea(stats.ideaID)">Payout</button></td>
	</tr>
	
       <tr>
       <td></td><td></td><td>Total In:</td><td>${{cirrusideaAdminCtrl.payoutStats.totalIn}}</td><td></td><td></td><td></td>
       </tr>
       
  </table>
 </div>


</div>










   </div>
   <div class="panel-footer">Admin</div>

   
 </div>
