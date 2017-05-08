<?php


require_once('../startsession.php');


if (!isset($_SESSION['user_id'])) {

  exit();
  
}
  
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

   


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);



  $cdname = $request->cdname;
  $addit= $request->addit;
  $isin = $request->isin;
  
  $getCDlist = $request->getlist;
  
  $delCD = $request->delete;
  
  
if($addit == 1){ 

 $query = "SELECT * FROM codevelopers WHERE member = '".$_SESSION['username']."' AND codeveloper = '".$cdname ."'";
 $data =  mysqli_query($dbc, $query);
   mysqli_num_rows($data);
		 if(mysqli_num_rows($data)<1){ 
		 
		 		  
		           $query = "INSERT INTO codevelopers (member, codeveloper) VALUES ('" . $_SESSION['username'] . "', '" . $cdname . "')";
			
                           mysqli_query($dbc, $query);
			
			}
			
	}elseif($isin == 1){
	
	
 $query = "SELECT * FROM codevelopers WHERE member = '".$_SESSION['username']."' AND codeveloper = '".$cdname ."'";
 $data =  mysqli_query($dbc, $query);
		 if(mysqli_num_rows($data)<1){ 
		         header(' ', true, 400);
	    	        $arr = array('msg' => "Not in codeveloper list", 'error' => '');
                        $jsn = json_encode($arr);
			 print_r($jsn);

		           			
			}else{
			  header(' ', true, 200);
	                  $arr = array('msg' => "Is in codeveloper list", 'error' => '');
                         $jsn = json_encode($arr);
                         print_r($jsn);
			
			}

	
	}elseif($getCDlist == 1){
	 
	 if($_SESSION['user_id'] == $request->user_id && $_SESSION['username'] == $request->username){
           
	
	$query = "SELECT * FROM codevelopers WHERE member = '".$_SESSION['username']."'";
       $data =  mysqli_query($dbc, $query);
	
	$codevlist = array();
	$i = 0;
	while($row = mysqli_fetch_array($data)){
	$codevlist[$i]['id'] = $row['codevelopers_id'];
	$codevlist[$i]['membername'] = $row['codeveloper'];
	
	
       $query1 = "SELECT * FROM users WHERE username = '".$row['codeveloper']."'";
       $data1 =  mysqli_query($dbc, $query1);	
       $row1 = mysqli_fetch_array($data1);

	$codevlist[$i]['cred'] = $row1['cred'];
	$codevlist[$i]['interest'] = $row1['interest'];

	
	
	$query56 = "SELECT cred FROM users ORDER BY cred DESC LIMIT 1";
  	 $data56 = mysqli_query($dbc, $query56);
  	 $row56 = mysqli_fetch_array($data56);
  		         
	$percentcred = round($row1['cred']/$row56['cred']*100,0);
	 		
	$codevlist[$i]['percentcredstyle']['width'] = $percentcred . '%';

	
	
		
	$i++;
	}
	

	
	 $jsn = json_encode($codevlist);
                         print_r($jsn);

	  }
	}elseif($delCD  == 1){
	  
  $delCD_id = $request->codev_id;
	
	$query = "DELETE FROM codevelopers WHERE codevelopers_id = '".$delCD_id . "'";
       mysqli_query($dbc, $query);

	
	}	
			          
		 
	 
 mysqli_close($dbc); 
 
 

 
?>

