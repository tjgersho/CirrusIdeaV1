<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Terms and Conditions';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
 ?> 
 <h3>Terms and Conditions</h3>

<p style="position:relative; left:10px;"><br />
<ol>
  <li>When uploading any form of data you assure that you have the right to do so, and if you do not, the liability of any infringement is yours and yours only.</li>
  <li>When you upload data in a public folder you are releasing that data to the public domain.</li>
  <li>When putting cash down on a project folder or duscussions folder you are providing free and clear capital for the developers of the project/discussion folder.</li>
  <li>Your cash will not be released to the project until 51% of the stakers vote that the project/discussion proposal is acceptable.</li>
  <li>You can get your 85% of your stake back if the proposal is not approved and you want it back.</li>
  <li>Stakers must vote on the "Developers" of the project/discussion.</li>
  <li>Your information will never by sold or shared without your written consent.</li>
  <li>CirrusIdea will always actually delete the data from out database when a user deletes it on the user interface.</li>
</ol>
</p>


<?php 
if ($_SESSION['newuser']){
?>
<span class="hotspot" onmouseover="tooltip.show('Next, click on the <i>My CirrusIdea Home Tab</i>.');" onmouseout="tooltip.hide();"><p>Next Hover-Help</p></span>
<?php
}
 echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
 // Insert the page footer
  require_once('footer.php');
 ?>