<?php
 
   require_once("api/connectvars.php");
        

if(isset($_GET['viewinbrowserid']) && isset($_GET['validation'])){

$email_id = $_GET['viewinbrowserid'];
$code = $_GET['validation'];

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


  $query= "SELECT * FROM cirrusemails  WHERE email_id = '".$email_id ."' AND code = '".$code."'";
                          $data = mysqli_query($dbc, $query);
			          if(mysqli_num_rows($data)== 1){//////////////////////Grab Email with Ads....////////////////////
				          ////////////////////////////////////////
				         
			         $row = mysqli_fetch_array($data);
			         $email = $row['email'];
			         $email = str_replace('src="cid:logo"', 'src="images/cirrusidealogo.png"' , $email);
			         
			         ///////////////////////////////////////////////////////////////////////////
			         ////////////FIND And Replace Other Special Pics For other EMAILS>>>>///////
			         ///////////////////////////////////////////////////////////////////////////
			         
			         
			         
			         //////////////////////////////////////////////////////////////////////////
			         //////////////////////////////////////////////////////////////////////////
			         
			          echo $email;
			          
			           
			           
			          }else{
			          
			          echo 'There was an error accessing this email';
			          exit();
	   
			          }
		          
		          }else{
		          
		          
		          echo 'There was an error accessing this email';
		          exit();
   
		          
		          
		          
	}
		          
