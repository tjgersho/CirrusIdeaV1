<?php
//ini_set('display_errors', 1);

//ini_set('display_startup_errors', 1);

//error_reporting(E_ALL);
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





require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(!isset($_SESSION['user_id'])){
exit();
}  

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
 


  $user_id = $request->user_id;
  $username = $request->username;
  $sort = $request->sort;
  $page = $request->pag;

  $comment = $request->comment; 
  $post_member_id = $request->post_member_id;
  $to_member_name = $request->to_member_name; 
  $retocomment = $request->retocomment; 
  $code_ok = $request->codeok; 

 

if($code_ok != 1){

$code_ok = 0;
$comment = strip_html_tags(  $comment );

}




$msgdate = date("Y-m-d H:i:s");
 
 if (isset($comment) && isset($to_member_name) && $post_member_id == $_SESSION['user_id']){
 require_once("../Classes/CirrusEmail.php");
 $i=0;
       foreach ( $to_member_name  as $peep ){
	
         
	if(isset($retocomment)){
	$query55 = "INSERT INTO comments (comment_date, comment, post_member_id, to_member_name, re_to_comment, codeok) VALUES".
	" ('". $msgdate. "', '" . $comment . "', '" . $post_member_id . "', '" . $peep . "', '" . $retocomment . "', '".$code_ok."')";
	}else{
	$query55 = "INSERT INTO comments (comment_date, comment, post_member_id, to_member_name, codeok) VALUES".
	" ('". $msgdate. "', '" . $comment . "', '" . $post_member_id . "', '" . $peep . "', '".$code_ok."')";
	}
	
	mysqli_query($dbc, $query55);
	
	
	
	$query86 = "SELECT * FROM users WHERE username = '" . $peep . "' LIMIT 1";
	$data86 = mysqli_query($dbc, $query86);
	$row86 = mysqli_fetch_array($data86);
	$useremail = $row86['email'];
	
	$query90 = "SELECT * FROM users WHERE user_id = '" . $post_member_id . "' LIMIT 1";
	$data90 = mysqli_query($dbc, $query90);
	$row90 = mysqli_fetch_array($data90);
	

$injectArray = array();	
	
if(!isset($retocomment)){
        
     //Create a new PHPMailer instance
       $chatemail[$i] = new CirrusEmail('commentEmail',  $row90['username'], $row90['user_id']);


$injectArray['tousername'] = $peep;
$injectArray['byusername'] = $row90['username'];
$injectArray['comment'] = $comment;
$chatemail[$i]->getEmail($injectArray);
                        $toA = array();
			$toA['email'] = $useremail;
                        $toA['name'] = $peep;
                   
                        
                        $fromA = array();
			$fromA['email'] = $row90['email'];
                        $fromA['name'] = $row90['username'];
 $chatemail[$i]->sendEmail($toA, $fromA); 
	
      
  }else{
     //Create a new PHPMailer instance
       $chatemail[$i] = new CirrusEmail('chatbackEmail',  $row90['username'], $row90['user_id']);



$injectArray['tousername'] = $peep;
$injectArray['byusername'] = $row90['username'];
$injectArray['comment'] = $comment;
$chatemail[$i]->getEmail($injectArray);
                        $toA = array();
			$toA['email'] = $useremail;
                        $toA['name'] = $peep;
                   
                        
                        $fromA = array();
			$fromA['email'] = $row90['email'];
                        $fromA['name'] = $row90['username'];
 $chatemail[$i]->sendEmail($toA, $fromA); 	
			 
		  
}

	$i++;
	}
	
exit();
}else{


//////////  Get comments  ///////


  $commentarray = array();

    // Calculate pagination information
  $cur_page = $page;
  $results_per_page = 20;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);
 

//{{chat.date}} <br />
//{{chat.membername}} <br />
//{{chat.comment}} <br />
//{{chat.commenter_name}} <br />
//{{chat.re_to_com_id}}<br />

//Sub - Comment Toggle -- Reference... {{chat.chatcomment_toggle}} <br />
//<br />
///{{chat.chatcomments}} <br />/
//{{chat.chatcomments.com_date}}<br />
//{{chat.chatcomments.commenter_name}}<br />
//{{chat.chatcomments.comment}}<br />


  // Query to get the total results 
  $query11 =  "SELECT * FROM comments WHERE (to_member_name = '".$_SESSION['username']."' OR post_member_id= '".$_SESSION['user_id']."') AND re_to_comment IS NULL ORDER by " . $sort;    

  $data11 = mysqli_query($dbc, $query11);
   $viewabletotal =  0;
  $i = 0;
   while ($row11 = mysqli_fetch_array($data11)) {
   
     $commentarray[$i]['date'] = $row11['comment_date'];
     
   if($row11['to_member_name'] == $_SESSION['username']){
   
   $commentarray[$i]['send_or_recieve_class']['recieved_chat'] = 1;    
       $parentMsg_recievedbyOther = true;
      $commentarray[$i]['sent_by_me'] = false; 
       
    } else {
  $commentarray[$i]['send_or_recieve_class']['sent_chat'] = 1;   
        
             $parentMsg_recievedbyOther = false;
             
          $commentarray[$i]['sent_by_me'] = true;    
    }
    

         $query2 =  "SELECT * FROM users WHERE user_id = '".$row11['post_member_id']."'";    
         $data2 = mysqli_query($dbc, $query2);
         $row2 = mysqli_fetch_array($data2);

     $commentarray[$i]['post_member_name'] = $row2['username'];
     
  
     if($parentMsg_recievedbyOther){
     $commentarray[$i]['re_to'] = $commentarray[$i]['post_member_name'];
     }else{
     $commentarray[$i]['re_to'] = $row11['to_member_name'];
     }
 
      
       $commentarray[$i]['parentMsg_id'] =  $row11['comment_id'];
              
        $commentarray[$i]['comment'] = $row11['comment'];
        
        if($row11['codeok'] == 1){
         $commentarray[$i]['codeok'] = true;
         }else{
         $commentarray[$i]['codeok'] = false;
         }
        
         $commentarray[$i]['chatcomment_toggle'] = 0;
        $commentarray[$i]['currentMessage'] = '';
   
   $query =  "SELECT * FROM comments WHERE (to_member_name = '".$_SESSION['username']."' OR post_member_id= '".$_SESSION['user_id']."') AND re_to_comment = '".$row11['comment_id']."' ORDER by comment_date DESC";    
   $data = mysqli_query($dbc, $query);
 
   $commentarray[$i]['chatcomments'] = array();
   if(mysqli_num_rows($data)>0){
       $j = 0;
      
     while ($row = mysqli_fetch_array($data)) {
  
     $commentarray[$i]['chatcomments'][$j]['com_date'] = $row['comment_date'];
     
      if($row['to_member_name'] == $_SESSION['username']){
      
  		  $commentarray[$i]['chatcomments'][$j]['send_or_recieve_class']['recieved_chat_sub'] = 1;   
  		   $commentarray[$i]['chatcomments'][$j]['send_or_recieve_class']['sent_chat_sub'] = 0;    
   	  $commentarray[$i]['chatcomments'][$j]['sent_by_me'] = false;    
   	  
   	 } else{
   	 
   	            $commentarray[$i]['chatcomments'][$j]['send_or_recieve_class']['recieved_chat_sub'] = 0;
  		 $commentarray[$i]['chatcomments'][$j]['send_or_recieve_class']['sent_chat_sub'] = 1;   
                 $commentarray[$i]['chatcomments'][$j]['sent_by_me'] = true; 

   	 }

   
    $query2 =  "SELECT * FROM users WHERE user_id = '".$row['post_member_id']."'";    
         $data2 = mysqli_query($dbc, $query2);
         $row2 = mysqli_fetch_array($data2);

    $commentarray[$i]['chatcomments'][$j]['post_member_name'] = $row2['username'];
   
  
   
    $commentarray[$i]['chatcomments'][$j]['comment'] = $row['comment'];
   

    $j++;   
    }
    
   }
     $viewabletotal = $viewabletotal +1;
   $i++;
   }
 
 

  
  $num_pages = ceil($viewabletotal  / $results_per_page);



$j = 0;
 $respchatarray = array();
  
if($viewabletotal > 0){
    for ($i=$skip; $i<$skip+$results_per_page; $i++){     
              if(isset($commentarray[$i])){
 		$respchatarray[$j] = $commentarray[$i];
 		$j++; 	
 		}
 			
   } 
  }
 
 
 
                            
$chats= array();


   $chats['numPages'] = $num_pages;
   $chats['chatarray'] =  $respchatarray;
 
  
            
echo json_encode($chats); 
  
   
  
 }
  
 ?>