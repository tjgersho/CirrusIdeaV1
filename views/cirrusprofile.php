<?php
require_once('modal/cirruseditprofile.php');
require_once('modal/cirruscollectfunds.php');
?>

<h5>Your CirrusIdea Profile <span ng-if="cirrusProfileCtrl.profile.privateprofile == '1'"><b> -- PRIVATE -- </b></span></h5> 

<div id="profileLoading" style="display:none;"><img src="images/loading.gif" /></div>
 <div class="container">
   <div class="row">
  
  
    <div class="col-sm-6">
   
   
     <div> 
<p>{{cirrusProfileCtrl.profile.first_name}} {{cirrusProfileCtrl.profile.last_name}}</p>
  </div>

<p>{{cirrusProfileCtrl.profile.email}}</p>

   <p> 
   <b>Member Since:</b>
           {{cirrusProfileCtrl.profile.join_date | date: 'M/d/yy' }}</p>
  

  <p><b>Interest:</b>
{{cirrusProfileCtrl.profile.interest}}</p>
  
 
     <div ng-if="cirrusProfileCtrl.profile.balance > 0"> 
		   <p><b>Your Cash:</b> ${{cirrusProfileCtrl.profile.balance}}
		    <button  ng-if="cirrusProfileCtrl.profile.collect !== '1'" type="button" class="btn btn-success btn-xs" ng-click="cirrusProfileCtrl.collectDialogOpen()">$$$ Collect $$$</button> 
		    <span ng-if="cirrusProfileCtrl.profile.collect === '1'" class="blinkit" style="color:#5CE62E;"> PAYMENT PENDING </span>
		</p></div>

    <button type="button" id="editprofilebutton" class="btn btn-info btn-sm" ng-click="cirrusProfileCtrl.editProfDialogOpen()">Edit Profile</button> 
<br />
<br /><br />  
    
      </div>
      	       <div class="col-sm-6">
      	       
		     <div ng-if="cirrusProfileCtrl.profile.about !== '' && cirrusProfileCtrl.profile.about !== null">
		     <label for="about">About You:</lable>
                            <p ng-bind-html="cirrusProfileCtrl.profile.about"></p>
                     </div>
 
  
			  <div class="clr"></div>
			  <br /><br />
			<div class="progress" style="width:150px; height:40px; background-image: url('images/membercred.png'); background-size: 45px 35px; background-repeat: no-repeat; background-position: right;">
			<div style="padding-top:8px; padding-left:3px; color:black; position:absolute;">Member Cred: {{cirrusProfileCtrl.profile.cred}}</div>
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="opacity: 0.4; filter: alpha(opacity=40);" ng-style="cirrusProfileCtrl.profile.percentcredstyle">
			   </div>
			</div>
			
		   
     
	    	      
	    	      
	    	      <br /><br />
	    	      
	    	        <div ng-if="cirrusProfileCtrl.profile.paidtotal > 0"> 
		   <p><b>Paid to Date:</b>${{cirrusProfileCtrl.profile.paidtotal}}</p></div>
     
	    	   
              </div>



	     
	  </div>     <!--END of Row -->
</div> <!--END of container -->
     