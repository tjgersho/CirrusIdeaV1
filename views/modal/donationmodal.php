<?php?>

<!-- Modal -->
	<div id="DonationModal" class="modal fade" role="dialog">
  	    <div class="modal-dialog">

   	  <!-- Modal content-->
   	    <div class="modal-content">
    		   <div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal">&times;</button>
      		    <h4 class="modal-title">Donate to <b>{{cirrusideaPageCtrl.page}}</b> to Inspire Thought!</h4>
      	          </div>
      	          
      	           
      <div class="modal-body">
      	          
      	                        
	                		                	 
	
<div>
 <p>Please allow the paypal website to re-direct you back to CirrusIdea to ensure transaction goes through.</p>


<!-- Begin Official PayPal Seal -->
<a href="https://www.paypal.com/us/verified/pal=travis%2eg%40cirrusidea%2ecom" target="_blank"><img src="https://www.paypal.com/en_US/i/icon/verification_seal.gif" border="0" alt="Official PayPal Seal"></A>
<!-- End Official PayPal Seal -->


<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="float:right;">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="image_url " value="http://www.cirrusidea.com/images/cirrusidealogopaypal.png">
<input type="hidden" name="hosted_button_id" value="TQTSHGFG5872U">
<input  type="hidden" name="item_name" ng-model="cirrusideaPageCtrl.donationItem" ng-value="cirrusideaPageCtrl.donationItem">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


</div>
	<div class="clr"></div>
	
	 </div>  <!-- End of Modal Form Body -->
                                          
               		 <div class="modal-footer">
       			     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                	</div>
                 
                  
           </div>

          </div>
	</div>
