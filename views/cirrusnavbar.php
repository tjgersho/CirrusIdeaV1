<?php
?>
<nav class="navbar navbar-custom navbar-fixed-top" style="border-bottom-width: 0px;">
  <div class="container" style="margin-bottom:0px;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/"><img class="pull-left" src="images/cirrusidealogo.png" height="50" /></a>
     </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="collapse-1">
     <ul class="nav navbar-nav navbar-right">
      <li ng-if="mainCtrl.userService.isLoggedIn"><a href="/mycirrus" style="padding-top:16px; padding-bottom:15px;">Mydea</a></li>
      <li class="navbar-alt-color"><a href="/cirrus" style="padding-top:16px; padding-bottom:15px;">CirrusIdeas</a></li>
      
      <li><cirrus-search></cirrus-search></li>
        

        <li ng-if="!mainCtrl.userService.isLoggedIn"><a href="/signup" style="padding-top:16px; padding-bottom:15px;">Signup</a></li>
        <li ng-if="!mainCtrl.userService.isLoggedIn" class="navbar-alt-color"><a href="/login" style="padding-top:16px; padding-bottom:15px;">Login</a></li>
        <li ng-if="mainCtrl.userService.isLoggedIn"><a ng-click="mainCtrl.logout()" style="padding-top:16px; padding-bottom:15px;">Logout</a></li> 
          
            <li role="separator" class="divider" ng-if="mainCtrl.userService.isAdmin"></li>
            <li ng-if="mainCtrl.userService.isAdmin"><a href="/admin" style="padding-top:16px; padding-bottom:15px;">Admin</a></li>
       
      </ul>
      <!-- {{mainCtrl.userService.isLoggedIn}}
       {{mainCtrl.userService.username}} -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="clr"></div>
<div style="float:left; width:100%; height:70px; display:block;"></div>
<div class="clr"></div>
<script>
$(document).ready(function () {
 $(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a')) {
        $(this).collapse('hide');
    }
});


});



</script>