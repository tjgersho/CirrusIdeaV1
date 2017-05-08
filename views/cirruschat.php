<?php?>

 <h5>Chat with Your CoDevs</h5> 

<br />
<form name="chatForm" novalidate>
<div class="container">
 	<div class="row">
 	<div class="col-sm-3"> 
 	  <label>Message Who:</label>
	    <div class="form-group">  
	      <select id="chatCoDevSelect" multiple class="form-control" id="comment_to_membername" ng-model="cirrusChatCtrl.newcomment_to_membername">
	         <option ng-repeat="codev in cirrusChatCtrl.usercodves">{{codev.membername}}</option>
	      </select>
	    </div>
	</div>
        <div class="col-sm-9"> 
        <label>Message:</label>
        	<textarea class="form-control"  rows="6" id="comment" name="comment" ng-model="cirrusChatCtrl.newcomment" cirrus-addtextarea ng-keyup="addtextareaCtrl.txtkeyup($event)" ></textarea>
   		</div>
     </div>
  </div>   		
   		<div class="clr"></div><br />
    <button class="btn btn-info pull-right" name="submit_comment" type="submit" id="submit_comment" ng-disabled="!cirrusChatCtrl.chatformokay()"  ng-click="cirrusChatCtrl.submitComment()">
    <span class="glyphicon glyphicon-envelope"></span> Send</button>
  
  </form> 
   		<div class="clr"></div>
 <br />
 <hr></hr>

 
<div id="chatsloading" style="display:none;"><img src="images/loading.gif"/></div>

  
 

<div id="gettingchats" style="display:none;"><img src="images/loading.gif"/></div>

<div ng-if="cirrusChatCtrl.chats.numPages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="cirrusChatCtrl.getChatStreamSpecial(cirrusChatCtrl.pagControl(cirrusChatCtrl.paginationpage-1))" 
      ng-if="cirrusChatCtrl.paginationpage>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [cirrusChatCtrl.chats.numPages] | makeRange" ng-class="cirrusChatCtrl.activePag(n)" >
    
         <a ng-click="cirrusChatCtrl.getChatStreamSpecial(cirrusChatCtrl.pagControl(n))" >{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="cirrusChatCtrl.getChatStreamSpecial(cirrusChatCtrl.pagControl(cirrusChatCtrl.paginationpage+1))"
      ng-if="cirrusChatCtrl.paginationpage<cirrusChatCtrl.chats.numPages ">        
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>

 <div  style="margin:5px; float:right;">
		Order By:
		 
		 <button type="button" class="btn btn-default  btn-xs" ng-click="cirrusChatCtrl.setChatOrderby()">
		   <span ng-class="cirrusChatCtrl.getChatOrderClassDirection()" ></span> Date 	
                </button>
		 		 
  </div>
		 
 <div class="clr"></div>
  <!-- -------------------------------------------------------------------------------  -->
   <!-- -------------------------------------------------------------------------------  -->
    <!-- -------------------------------------------------------------------------------  -->


 <div ng-repeat="chat in cirrusChatCtrl.chats.chatarray">

      <div class="cirrus_chats">

   <div ng-class="chat.send_or_recieve_class">

<!-- {{chat.date}} <br />

{{chat.comment}} <br />
{{chat.commenter_name}} <br />
{{chat.re_to_com_id}}<br />

Sub - Comment Toggle -- Reference... {{chat.chatcomment_toggle}} ...<br />
<br />
{{chat.chatcomments}} <br />
{{chat.chatcomments.com_date}}<br />
{{chat.chatcomments.commenter_name}}<br />
{{chat.chatcomments.comment}}<br />

-->

   <div>On: {{chat.date | date:'MM/dd/yyyy @ h:mma'}} </div>
   <div ng-if="!chat.sent_by_me" class="pull-right">
   <span class="label label-info" style="float:right;">
<a ng-href="/viewprofile/username/{{chat.post_member_name}}" style="color:white;">{{chat.post_member_name}}</a>
    </span>

    <span class="label label-success " style="float:right;">
From: </span>    </div>
    <div ng-if="chat.sent_by_me"  class="pull-right">
     <span class="label label-info" style="float:right;"><a ng-href="#/viewprofile/username/{{chat.re_to}}" style="color:white;">{{chat.re_to}}</a>
         </span>

     
     <span style="float:right;">
To: </span> 
<span class="label label-success" style="float:right;">
	 
	     By: YOU</span>
 	   </div>
<br /><br />
   <div  class="headline">
           <div ng-bind-html="chat.comment" ng-if="chat.codeok"></div>
            <div ng-bind="chat.comment" ng-if="!chat.codeok"></div>
   </div>
   <br />
  
 
  

  
 			 

 <div style="padding:5px;">
 <button type="button" class="btn btn-primary btn-xs" ng-click="cirrusChatCtrl.chatcomment_toggleIT($index)">
	 <span ng-class="chat.chatcomment_togglestyle"></span> 
	 ChatBack 
	 <span class="glyphicon glyphicon-comment"></span> 
	 <span class="badge"  ng-if="chat.chatcomments.length>0">{{chat.chatcomments.length}}</span>
	 </button>
	 
	 </div>
  
  
	
	    
	    
	    <div ng-if="chat.chatcomment_toggle">
	 <hr></hr>   
	 
	 <form role="form" class="chatbackForm">
 	      <div class="form-group">
                <label for="comment">ChatBack:</label>
                   <textarea cirrus-addtextarea class="form-control postcommenttextarea" id="chatbackTextarea_{{$index}}" rows="2" 
                   ng-keyup="addtextareaCtrl.txtkeyup($event)" ng-model="chat.currentMessage"></textarea>                 
                     </div>
                     
                     
              <button class="btn btn-default pull-right"  id="chatbackButton_{{$index}}"
              ng-click="cirrusChatCtrl.addchatComment($event, chat.parentMsg_id, chat.re_to, $index)" ng-disabled="!cirrusChatCtrl.chatBackformokay($index)" >
                            
                <span class="glyphicon glyphicon-envelope"></span> <span>Re: {{chat.re_to}}  </span>  
              </button>
              
             
           </form>
             <div class="clr"></div>
  <hr></hr> 
  
	    
	      <div class="sent_chat_sub" style="padding:5px;" ng-if="chat.currentMessage">
	     	       
	           <div>
  	              <span class="label label-info pull-right"><a ng-href="#/viewprofile/username/{{chat.re_to}}" style="color:white;">To: {{chat.re_to}}</a></span>
   		 </div>
 		  
	     
	              <blockquote>
	              <small>
                       {{chat.currentMessage}}
                       </small>
                       </blockquote>
	         
	       </div>
	   
	 
	     

	    <div ng-repeat="chatcomment in chat.chatcomments">
	        
	        <div ng-class="chatcomment.send_or_recieve_class" style="padding:5px;">
	         <div>On: {{chatcomment.com_date | date:'MM/dd/yyyy @ h:mma'}} </div>
	       
	       <div ng-if="!chatcomment.sent_by_me" class="pull-right">
	        <span class="label label-info" style="float:right;"><a ng-href="/viewprofile/username/{{chatcomment.post_member_name}}" style="color:white;">{{chatcomment.post_member_name}}</a>
	    </span>

	    <span class="label label-success" style="float:right;">
	    From: </span>	   </div>
	    
	    <div ng-if="chatcomment.sent_by_me" class="pull-right">
	    <span class="label label-info" style="float:right;"><a ng-href="/viewprofile/username/{{chat.re_to}}" style="color:white;">{{chat.re_to}}</a>
	    </span>

	     <span style="float:right;">To: </span> <span class="label label-success" style="float:right;">
	     
	     By: YOU</span>
	       </div>
		     
	              <blockquote>
	              <small>
                       {{chatcomment.comment}}
                       </small>
                       </blockquote>
	         
	       </div>
	   
	    </div>
	    
	     <div class="clr"></div>
	     
	    	    
	  </div>
	 
  
 

<div class="clr"></div>
  
    </div>  <!--   End of send or recieve container -->
    
 </div>  <!--   End of comment/chat container -->
		<div class="clr"></div> 
 </div> <!-- End of repeat -->


<br />
<div class="clr"></div>

<div class="info" ng-if="cirrusChatCtrl.chats.chatarray.length<1">
You don&#39;t have any chats yet.
</div>


<div ng-if="cirrusChatCtrl.chats.numPages > 1">
<nav>
  <ul class="pagination">
    <li>
      <a  aria-label="Previous" ng-click="cirrusChatCtrl.getChatStreamSpecial(cirrusChatCtrl.pagControl(cirrusChatCtrl.paginationpage-1))" 
      ng-if="cirrusChatCtrl.paginationpage>1">
        <span aria-hidden="true" >&laquo;</span>
      </a>
    </li>
   
   
    <li ng-repeat="n in [cirrusChatCtrl.chats.numPages] | makeRange" ng-class="cirrusChatCtrl.activePag(n)" >
    
         <a ng-click="cirrusChatCtrl.getChatStreamSpecial(cirrusChatCtrl.pagControl(n))" >{{n}}</a>
         
    </li>

    
    <li>
      <a aria-label="Next" ng-click="cirrusChatCtrl.getChatStreamSpecial(cirrusChatCtrl.pagControl(cirrusChatCtrl.paginationpage+1))"
      ng-if="cirrusChatCtrl.paginationpage<cirrusChatCtrl.chats.numPages">        
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>






