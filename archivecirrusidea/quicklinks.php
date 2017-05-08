<?php
 // Start the session
  require_once('startsession.php');
 
  require_once('appvars.php');
  require_once('connectvars.php');
  
   if (!isset($_SESSION['user_id'])) {

    echo '<p class="login">Please <a href="http://www.cirrusidea.com/login.php">log in</a> to access this page.</p>';

    exit();
  
  }
  ?>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


 <!--Get Style Sheet--> 
 <link rel="stylesheet" type="text/css" href="http://www.cirrusidea.com/style.css" />
 
  </head>
  <body style="background-color:#EDEDED;">
  <?php
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if(isset($_POST['deletequicklink'])){

$quicklink_id = $_POST['quicklink_id'];

$query717 = "SELECT * FROM quicklinks WHERE quicklink_id = '".$quicklink_id."'";
 $data717 = mysqli_query($dbc, $query717);

$row717 = mysqli_fetch_array($data717);

$member_id = $row717['member_id'];

if ($_SESSION['user_id'] == $member_id){

$query7117 = "DELETE FROM quicklinks WHERE quicklink_id = '".$quicklink_id."'";
 $data7117 = mysqli_query($dbc, $query7117);

}

}


  $query77 = "SELECT * FROM quicklinks WHERE member_id = '".$_SESSION['user_id']."'";
 $data77 = mysqli_query($dbc, $query77);
$i=0;
while ($row77 = mysqli_fetch_array($data77)) { 
    

echo '<br /><span><a style="display:inline" href="'.$row77['quicklink'].'" target="_parent">'.substr(dirname($row77['quicklink']),-40).'</a>';
echo  '<form style="display:inline;" action="'.$_SERVER['PHP_SELF'].'" method="post"><input type="hidden" name="quicklink_id" value="'.$row77['quicklink_id'].'"/>';
echo '<input type="submit" class="stylebutton" name="deletequicklink" value="Delete this Quick Link" /></form></span><br />';

$i=1;
}

if($i==0){
    
echo '<b>Browse CirrusIdeas, find a project you want to watch or visit regularly and click the "Add to Your Quick Link List" button.</b><br />';
}
?>
</body>
<?php
?>
