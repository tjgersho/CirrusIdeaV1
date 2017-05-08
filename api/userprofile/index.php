<?php


function strip_html_tags( $text )
{
	// PHP's strip_tags() function will remove tags, but it
	// doesn't remove scripts, styles, and other unwanted
	// invisible text between tags.  Also, as a prelude to
	// tokenizing the text, we need to insure that when
	// block-level tags (such as <p> or <div>) are removed,
	// neighboring words aren't joined.
	$text = preg_replace(
		array(
			// Remove invisible content
			'@<head[^>]*?>.*?</head>@siu',
			'@<style[^>]*?>.*?</style>@siu',
			'@<script[^>]*?.*?</script>@siu',
			'@<object[^>]*?.*?</object>@siu',
			'@<embed[^>]*?.*?</embed>@siu',
			'@<applet[^>]*?.*?</applet>@siu',
			'@<noframes[^>]*?.*?</noframes>@siu',
			'@<noscript[^>]*?.*?</noscript>@siu',
			'@<noembed[^>]*?.*?</noembed>@siu',

			// Add line breaks before & after blocks
			'@<((br)|(hr))@iu',
			'@</?((address)|(blockquote)|(center)|(del))@iu',
			'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
			'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
			'@</?((table)|(th)|(td)|(caption))@iu',
			'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
			'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
			'@</?((frameset)|(frame)|(iframe))@iu',
		),
		array(
			' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
			"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
			"\n\$0", "\n\$0",
		),
		$text );

	// Remove all remaining tags and comments and return.
	return strip_tags( $text );
}



 // Start the session
require_once('../startsession.php');
require_once('../connectvars.php');
   
  
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


$user_id = $request->user_id;
$username = $request->username;
$update = $request->updateProf;


if($_SESSION['username'] == $username && $_SESSION['user_id'] == $user_id){

if($update != 1){
/////////First Check if idea is public ////////////

   $query = "SELECT * FROM users WHERE user_id = '". $user_id."' AND username = '". $username."'";
   $data = mysqli_query($dbc, $query);
   $row = mysqli_fetch_array($data);
        if(mysqli_num_rows($data)>0){ //////User Exists//////
                $arr = array();
                 $arr['user_id'] = $row['user_id']; 
                 $arr['username'] = $row['username']; 

                 $arr['first_name'] = $row['first_name'];
	         $arr['last_name'] = $row['last_name'];
                 $arr['email'] = $row['email'];
                 $arr['join_date'] = $row['join_date'];
                 if($row['interest'] == null){
                 $arr['interest'] ='';
                 }else{
                 $arr['interest'] = $row['interest'];
                 }
                 $arr['cred'] = $row['cred'];
                 $arr['mailme'] = $row['mailme'];
                 $arr['paypalemail'] = $row['paypalemail'];
                 $arr['about'] = $row['about'];
                 $arr['balance'] = $row['balance'];
                 $arr['collect'] = $row['collect'];
                 $arr['paidtotal'] = $row['paidtotal'];
                 
                 if($row['privateprofile'] == 1){
                  $arr['privateprofile'] = true;
                 }else{
                 $arr['privateprofile'] = false;
                 
                 }
                
                 
    $query = "SELECT cred FROM users ORDER by cred DESC LIMIT 1";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);
                 $arr['percentcred'] = round($arr['cred']/$row['cred']*100);
                
                
               $arr['percentcredstyle']['width'] = $arr['percentcred'].'%';
              
         
                
               
                
                
                
	       $jsn = json_encode($arr);
		 print_r($jsn);
                 exit();
         }else{
         
            header(' ', true, 400);
	    	$arr = array('msg' => "User Does not Exist", 'error' => '');
                $jsn = json_encode($arr);
		  print_r($jsn);
                  exit();
         
         
         }
         
         
         }else{ ///////////////////////// Update users profile!
         
         
         $first_name = $request->first_name;
         $last_name = $request->last_name;
         $mailMe = $request->mailMe;
         $aboutme = $request->aboutme;
         $interest = $request->interest;
           $privateProf = $request->privateProf;
       
    $aboutme = strip_html_tags($aboutme);  
       
           $query = "UPDATE users SET first_name ='".$first_name."', last_name = '".$last_name."', interest = '". 
           $interest."', about = '".$aboutme."', mailme = '".$mailMe."', privateprofile = '".$privateProf."' WHERE user_id = '".$user_id."'";
           mysqli_query($dbc, $query);
           
           echo 'Update Successful!';
         
         }
         
     }else{
         
            header(' ', true, 400);
	    	$arr = array('msg' => "User Does not Exist" . $_SESSION['username'] .' != '. $username .' && ' . $_SESSION['user_id'] .' != '.  $user_id, 'error' => '');
                $jsn = json_encode($arr);
		  print_r($jsn);
                  exit();
         
         
         }

                          
?>