<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'About Cirrus Idea';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');// Show the navigation menu
  require_once('navmenu.php');
 ?> 
 <h3>About Us</h3>
<p>CirrusIdea.com is a platform development from Paradigm Motion, LLC. CirrusIdea.com is a website 
 with a similar model to Wikipedia where anyone who signs up can modify and add applicable knowledge.  Projects can be publicly created and crowd-source funded similarly to Kickstarter.
 It is also a social environment where likeminded people can converse and create value in their fields of interest. 
 Finally the site can be used to store files and data for the users privately and securely and invite other members to view the private folders and data, similarly to Dropbox.</p><br /><br />

   <div style="float:right; padding-right: 20px;">
      <a class="buttonlink" style="display: inline-block;" href="cirrusvideos.php">
About CirrusIdea
</a>
</div>

<br />
<div>

    <p>&#8226; This is a community of thinkers and innovators who desire to develop and grow solutions with free creation and modification.</p>
    <p>&#8226; Explore, download, upload, and contribute to these developing projects and ideas adding real value to humanity.</p>
    <p>&#8226; As a member you can invest and profit by getting in on the ground floor of a new idea.</p>
	<p>&#8226; Get your idea funded with this investor and developer platform; it is a crowd sourcing tool.</p>
	<p>&#8226; Store project data securely, make data private and invite others to view your project data.</p>
    <p>&#8226; Unlimited secure private free data storage.</p>
    <p>&#8226; Easy utilization of this platform as a secure business product data management system (PDM).</p>
	<p>&#8226; Start a public or private project, a story, an idea and get help from members all over the world who are also interested and want to make contributions.</p>
	<p>&#8226; Upload any data which may help the cause: comments and questions, CAD, schematics, information, sketches, etc.</p>

</div>
<p style="font-size:18px position:relative; margin-left:50px; margin-right:50px;">
If you are a thinker, dreamer, innovator, engineer, scientist and want to make a difference 
then join this community of creative minds to make a reality of your ideas.<br /><br />
<a href="http://www.cirrusidea.com/signup.php">Sign up today</a>, it does not cost a thing, and is great creative fun if you are sincere in wanting to be a part of this community.<br /><br />  
<br />
CirrusIdea.com starts with the different categories where creative people can meet for real creation and development. 
You can browse and search projects, invest in or help develop a project to make it a reality.  
All you need to join is an email, username and password.  No other information is required to be a member. 
Once you join and find a project you are interested in you can freely contribute and offer ideas, solutions, questions; any and every little contribution will make a difference for a project and can help make it a reality.
You can start your own project and file directories to keep your project organized and so others can easily contribute. 
You can even create private folders which only you and anyone you invite to your private folder can have access to view and build upon.
Once a public project is created then it is available for all members who want to make a positive difference, collaborate and develop the project. 
With open collaboration anything is possible; the limit is not just the sky.

</p>

<br /><br />

<?php
if(!isset($_SESSION['username'])){
?>

<div style="position:relative;left:180px;">

  <form method="post" action="signup.php">
        <input type="submit"  class="stylebutton" value="Sign Up Now" name="submit1" />
  </form>
 </div>
 <br /><br /><br />
 <p style="font-size:15px;"><form  style="position:relative; left:300px;" method="post" action="http://www.cirrusidea.com/login.php">
Log In as Anonymous and Browse CirrusIdea.com:<br />
<input type="hidden" name="username" value="Anonymous"/>
<input type="hidden" name="password" value="123"/>
<input type="submit" class="stylebutton" value="Log In as Anonymous" name="submit"/></form></p>
  <br /><br /><br />
 <?php
}

 echo '<br />';
 // Insert the page footer
  require_once('footer.php');
 ?>