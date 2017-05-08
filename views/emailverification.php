<?php

?>

<div class="container" ng-bind-html="emailverificationCtrl.msg"></div>
<div class="container" ng-if="emailverificationCtrl.msg !== '' && !emailverificationCtrl.verifyerror">Check out <a href="/terms">Terms and Conditions</a> and or <a href="/privacypolicy">Privacy Policy.</a> <br /><br />
You agree to both by continuing from here. 
</div>
<div class="container" ng-if="emailverificationCtrl.verifyerror">
<button class="btn btn-danger" ng-click="emailverificationCtrl.re_send_verification_email()">Re-Send Verification Email</button>
</div>