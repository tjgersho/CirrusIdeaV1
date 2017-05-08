<?php

function txtemailBody($type, $info){

 $txtBody = '';
			
switch ($type){
 ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////          
           case 'introEmailValidation':
           
           
   $getemail = str_replace ("@", "xxyyyatsym", $info['email']);



 
   
              $txtBody .= 
          $info['username'] . 
	 ',       \r\n Please confirm your email address by clicking the link below: \r\n\r\n' .
	  '<a href="http://cirrusidea.com/#!/emailverification/user/' .  $info['username'] .'/email/' . $getemail .'/code/'.$info['code'].'" target="_blank">
	  Confirm Email</a>' .
	 '\r\n' .
	 '\r\nIf the link is not working copy and paste this link into your browser: \r\n\r\n' .
	 'http://cirrusidea.com/#!/emailverification/user/' . $info['username'] .'/email/' . $getemail .'/code/'.$info['code'].
	 '\r\n\r\n';
              
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////               
       case 'resetPassword':
              
              
               $txtBody .= '
                         \r\n\r\n' .
			$info['username']. 
			 '\r\n\r\nClick this link below to update your password: \r\n\r\n' .
			  '<a href="https://cirrusidea.com/#!/editpassword/user/' .  $info['username'] .'/code/'.$info['code'].'" target="_blank">
			 Confirm Email</a>' .
			 '\r\n' .
			 '\r\nIf the link is not working copy and paste this link into your browser:\r\n\r\n' .
			 'https://cirrusidea.com/#!/editpassword/user/' .  $info['username'] .'/code/'.$info['code'].'\r\n\r\n' . 
			 '\r\n\r\n';
              
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////           
   
      case 'getUsername':
              
 
              
               $txtBody .= '
                        \r\n\r\n' .
			
			 '\r\n\r\nYou Requested your Username @ CirrusIdea.  Your Username is:\r\n\r\n' .
			 $info['username'].  
			   '\r\n\r\n<a href="https://cirrusidea.com/#!/login" target="_blank">Go Login!</a>\r\n\r\n'.
			 '\r\n';

              
              
              
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////    
      case 'commentEmail':
              
               $txtBody .=  $info['byusername'] . ' wrote: \r\n\r\n' . $info['comment']  .
 '\r\n\r\n'  . $info["tousername"] . ',  <a href="http://cirrusidea.com/#!/login">Log In</a>
 and checkout your profile. \r\n\r\n';
 
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////     
   
    case 'chatbackEmail':
              
              $txtBody .=  $info['byusername'] . ' replied to your message and wrote:  \r\n\r\n'  . $info['comment']  .
 '\r\n\r\n'  . $info["tousername"] . ',  <a href="http://cirrusidea.com/#!/login">Log In</a>
 and checkout your profile. \r\n\r\n '; 
 
        break;
      ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////     
   
   
          case 'shoutoutEmail':
              
               $txtBody .=  '\r\n\r\n';

$txtBody .=  $info['yourname'];
 
 $txtBody .=  ' wanted to tell you about CirrusIdea.com.  \r\n\r\n';
$txtBody .= $info['msg'];
$txtBody .=   ' \r\n\r\nCheck out CirrusIdea.com today!  \r\n\r\n';
 
 
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////    
             case 'paymentEmail':
              
               $txtBody .=  '\r\n\r\n';

      $txtBody .= '\r\n\r\n ';

 $txtBody .= $info['username'];
 
$txtBody .=  ',\r\n\r\n\r\n  You just got paid from CirrusIdea for your thought contributions.  \r\nYou should see  a payment in your paypal account for this amount: \r\n\r\n';
$txtBody .= '$'.$info['amount'];
$txtBody .=  '\r\n\r\nCome on back and contribute some more on CirrusIdea.com. \r\n\r\n';
 
 
 
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////     
   
          case 'membersinthreadEmail':
              

              
   
                 
 $txtBody .= '\r\n\r\n';

 $txtBody .=  $info['tousername'];
 
 $txtBody.=  '\r\n\r\n <a href="http://cirrusidea.com/#!/cirrus/path/'. $info['path'] . '/page/'. $info['page'].'/tid/'.$info['thought_id'].'">Log In</a> and check out what thought '. $info['postername'].' has been posted to the idea: \r\n\r\n';
 $txtBody.=  '<a href="http://cirrusidea.com/#!/cirrus/path/'. $info['path'] . '/page/'. $info['page'].'/tid/'.$info['thought_id'].'">Thought Link @: ' .$info['page']. '</a>\r\n\r\n';
  if(!empty($info['newthought'])){
 $txtBody .= '\r\n\r\nThought\r\n\r\n';
 $txtBody.= $info['newthought'];
 }



 $txtBody .=  '\r\n\r\nCome on back and see whats new on <a href="http://www.cirrusidea.com">CirrusIdea.com</a>.\r\n\r\n';
 
 break;
       default: 
              
     }




return $txtBody;

}




?>