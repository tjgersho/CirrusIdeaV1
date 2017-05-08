<?php?>


<div class="panel panel-success">
  

 <div class="panel-heading">
 <h3 class="panel-title" style="float: left;">Cirrus Profile </h3>  <span>  -- <b> {{viewProfileCtrl.profile.username}}</b></span>
  </div>


  <div class="panel-body">

 <div class="container">
   <div class="row">

    <div class="col-sm-6" ng-if="viewProfileCtrl.profile.privateprofile !== '1'">
   
   
     <div> 
    <p><b>First Name:</b>
{{viewProfileCtrl.profile.first_name}}</p>
  </div>
 
   <div> 
     <p><b>Last Name:</b>
{{viewProfileCtrl.profile.last_name}}</p>
  </div>
 
   <div> 
   <p><b>Member Since:</b>
           {{viewProfileCtrl.profile.join_date | date: 'M/d/yy' }}</p>
  </div>

   <div> 
   <p><b>Interest:</b>
{{viewProfileCtrl.profile.interest}}</p>
  </div>
  <br />
   <div ng-if="viewProfileCtrl.profile.about !== '' && viewProfileCtrl.profile.about !== null">
		     <label for="about">About {{viewProfileCtrl.profile.username}}:</label>
                            <p ng-bind-html="viewProfileCtrl.profile.about"></p>
        </div>
                     
                 <br /><br />    

  
  
      </div>
 
	       <div class="col-sm-6">
	       <button type="button" class="btn btn-info" ng-click="viewProfileCtrl.addAsCoDev()" ng-show="!viewProfileCtrl.isUserinCoDevList">CoDev</button>      
	      	      
	      <br /><br />
	      
	      
	      <div class="progress" style="width:150px; height:40px; background-image: url('images/membercred.png'); background-size: 45px 35px; background-repeat: no-repeat; background-position: right;">
<div style="padding-top:8px; padding-left:3px; color:black; position:absolute;">Member Cred: {{viewProfileCtrl.profile.cred}}</div>
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="opacity: 0.4; filter: alpha(opacity=40);" ng-style="viewProfileCtrl.profile.percentcredstyle">
   </div>
</div>
  
  <br /><br />
	      <div ng-show="viewProfileCtrl.CommentSend">
         <form role="form">
 	      <div class="form-group">
                <label for="comment">Comment:</label>
                   <textarea class="form-control" rows="5" id="viewProfile_comment" ng-model="viewProfileCtrl.newComment" cirrus-addtextarea ng-keyup="addtextareaCtrl.txtkeyup($event)" ></textarea>
                   </div>
              <button type="submit" class="btn btn-default pull-right" ng-disabled="!viewProfileCtrl.chatformokay()"   ng-click="viewProfileCtrl.sendComment()"> <span class="glyphicon glyphicon-envelope"></span> Submit</button>
          </form>
        </div>
	      
    </div>



	     
	</div>     
</div> 
     

</div>
  
  <div class="panel-footer"> 
  
 <h3 class="panel-title" style="float: left;">Cirrus Profile </h3>  <span>  -- <b> {{viewProfileCtrl.profile.username}}</b></span>

 <div class="clr"></div>
  <cirrus-search></cirrus-search>
  <div class="clr"></div>

  
  </div> 
  

  
</div>