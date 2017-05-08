<?php

function getHeader($title){

$emailHeader = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html>
 <head>
 <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
 <meta content="'.$title.'" property="og:title" />
 <title>'.$title.'</title>
 <style type="text/css">
 #outlook a {padding:0;}
 body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0; background-color:#8FFF66;}
 .ExternalClass {width:100%;}
 .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
 #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
 #templateContainer{ border: 1px solid #DDDDDD; }
 img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
 a img {border:none;}
 .image_fix {display:block;}
 p {margin: 0.5em 0;}
 h1, h2, h3, h4, h5, h6 {color: black !important;}
 h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}
 h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active { color: red !important; }
 h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }
 table td {border-collapse: collapse;}
 table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
 a {color: orange;}
 .bodyContent div{ color:#505050; font-family:Arial; font-size:14px; line-height:150%; text-align:left; }
 .bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{ color:#336699; font-weight:normal; text-decoration:underline; }
 .bodyContent img{ display:inline; height:auto; }
 .leftColumnContent{ background-color:#FFFFFF; }
 .leftColumnContent div{ color:#505050; font-family:Arial; font-size:14px; line-height:150%; text-align:left; }
 .leftColumnContent div a:link, .leftColumnContent div a:visited, .leftColumnContent div a .yshortcuts{ color:#336699; font-weight:normal; text-decoration:underline; }
 .leftColumnContent img{ display:inline; height:auto; }
 .rightColumnContent{ background-color:#FFFFFF; }
 .rightColumnContent div{ color:#505050; font-family:Arial; font-size:14px; line-height:150%; text-align:left; }
 .rightColumnContent div a:link, .rightColumnContent div a:visited, /* Yahoo! Mail Override */ .rightColumnContent div a .yshortcuts { color:#336699; font-weight:normal; text-decoration:underline; }
 .rightColumnContent img{ display:inline; height:auto; }
 @media only screen and (max-device-width: 480px) { a[href^="tel"], a[href^="sms"] { text-decoration: none; color: blue; pointer-events: none; cursor: default; }
 .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] { text-decoration: default; color: orange !important; pointer-events: auto; cursor: default; }
 }
 @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { a[href^="tel"], a[href^="sms"] { text-decoration: none; color: blue; pointer-events: none; cursor: default; }
 .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] { text-decoration: default; color: orange !important; pointer-events: auto; cursor: default; }
 }
 @media only screen and (-webkit-min-device-pixel-ratio: 2) { }
 @media only screen and (-webkit-device-pixel-ratio:.75){ }
 @media only screen and (-webkit-device-pixel-ratio:1){ }
 @media only screen and (-webkit-device-pixel-ratio:1.5){ }
 </style>
 </head> 
';



return $emailHeader;

}


function viewInBrowserSection($teaser, $viewinbrowserid, $code){

$viewinBrowser = '
<body leftmargin="0" marginheight="0" marginwidth="0" offset="0" topmargin="0">
 <center>
 	<table border="0" cellpadding="0" cellspacing="0" height="100%" id="backgroundTable" width="100%">
 	<tbody>
 	<tr>
 	<td align="center" valign="top">
 		<table border="0" cellpadding="10" cellspacing="0" id="templatePreheader" width="600">
 			<tbody>
 			<tr>
 			<td class="preheaderContent" valign="top">
 				<table border="0" cellpadding="10" cellspacing="0" width="100%">
 					<tbody>
 					<tr>
 					<td valign="top">
						 <div>'.
						$teaser .'<br />
						
			<a style="text-align:left;"  data-ajax="false" href="http://cirrusidea.com" target="_blank"><img src="cid:logo" width="100" alt="CirrusIdea Logo" /></a>
						</div>
				        </td>
     					<td valign="top" width="190">
						 <div>
						 Is this email not displaying correctly?<br />
						 <a href="http://cirrusidea.com/viewinbrowser.php?viewinbrowserid=' .  $viewinbrowserid . '&validation='. $code . '"  target="_blank">
						 View In Browser</a>
						 </div>
			               </td>
 					</tr>
 					</tbody>
				 </table>
			 </td>
 			</tr>
 			</tbody>
 		</table>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr>
		<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #cccccc; border-collapse: collapse ; margin-top: 20px; margin-bottom:30px;" width="600">
		<tbody>
		<tr><td style="padding:15px; background-color:#CCFFCC;">
  ';
 
 return $viewinBrowser;

}







function emailBody($type, $info){

 $htmlBody = '';

//                                       <!------------------------------------------------------------------------------->
//					<!-- Main Content----- ---------------------------------------------------------->
//					<!------------------------------------------------------------------------------->
//					<!------------------------------------------------------------------------------->

switch ($type){
 ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////          
      case 'introEmailValidation':
           
           
   $getemail = str_replace ("@", "xxyyyatsym", $info['email']);



 
   
              $htmlBody .= '
              
             <p>'. $info['username'] . 
	 ',&nbsp;<br /><br />Please confirm your email address by clicking the link below: <br /><br />' .
	  '<a href="http://cirrusidea.com/#!/emailverification/user/' .  $info['username'] .'/email/' . $getemail .'/code/'.$info['code'].'" target="_blank">
	  <div style="display:block; width:200px; height:50px; background-color:#C0FFC0; text-align:center;">Confirm Email</div></a>' .
	 '</p>' .
	 '<p>If the link is not working copy and paste this link into your browser: </p><br />' .
	 'http://cirrusidea.com/#!/emailverification/user/' . $info['username'] .'/email/' . $getemail .'/code/'.$info['code'].
	 '<br /><br />';
              
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////               
       case 'resetPassword':
              
              
               $htmlBody .= '
                         <p><br /><br />' .
			$info['username']. 
			 ',&nbsp;<br /><br />Click this link below to update your password: <br /><br />' .
			  '<a href="http://cirrusidea.com/#!/editpassword/user/' .  $info['username'] .'/code/'.$info['code'].'" target="_blank">
			  <div style="display:block; width:200px; height:50px; background-color:#C0FFC0; text-align:center;">Confirm Email</div></a>' .
			 '</p>' .
			 '<p>If the link is not working copy and paste this link into your browser: </p><br />' .
			 'http://cirrusidea.com/#!/editpassword/user/' .  $info['username'] .'/code/'.$info['code'].'<br /><br />' . 
			 '<br /><br />';
              
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////           
   
      case 'getUsername':
              
 
              
               $htmlBody .= '
                        <p><br /><br />' .
			
			 '&nbsp;<br />You Requested your Username @ CirrusIdea.  Your Username is: <br /><br />' .
			 $info['username'].  
			   '<br /><br /><a href="http://cirrusidea.com/#!/login" target="_blank">Go Login!</a><br />'.
			 '<br />';

              
              
              
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////    
      case 'commentEmail':
              
              $htmlBody .=  $info['byusername'] . ' wrote: <br /><br />' . $info['comment']  .
 '<br /><br />' . $info["tousername"] . ',  <a href="http://cirrusidea.com/#!/login">Log In</a>
 and checkout your profile.<br /><br />';
 
        break;
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////     
    
      case 'chatbackEmail':
              
              $htmlBody .=  $info['byusername'] . ' replied to your message and wrote: <br /><br /><br />' . $info['comment']  .
 '<br /><br />' . $info["tousername"] . ',  <a href="http://cirrusidea.com/#!/login">Log In</a>
 and checkout your profile.<br /><br />';
 
        break;
         ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////     
    
      case 'shoutoutEmail':
              
              $htmlBody .= '<p><br /><br />';

 $htmlBody .=  $info['yourname'];
 
 $htmlBody .=  ' wanted to tell you about CirrusIdea.com. <br /><br /><br />';
$htmlBody .= $info['msg'];
 $htmlBody .=  '</p><br /><br /><p>Check out CirrusIdea.com today! </p><br />';
 
 
        break;
        
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////     
   
     case 'paymentEmail':
              
              $htmlBody .= '<p><br /><br />';

 $htmlBody .=  $info['username'];
 
 $htmlBody .=  ',<br /><br /><br /> You just got paid from CirrusIdea for your thought contributions. <br />You should see a payment in your paypal account for this amount: <br /><br />';
$htmlBody .= '$'.$info['amount'];
 $htmlBody .=  '</p><br /><br /><p>Come on back and contribute some more on <a href="http://cirrusidea.com">CirrusIdea.com</a>. </p><br />';
 
 
        break;
         ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////     
   
         case 'membersinthreadEmail':
              

              
              
 $htmlBody .= '<p><br /><br />';

 $htmlBody .=  $info['tousername'];
 
 $htmlBody .=  ',<br /><br /><br /> <a href="http://cirrusidea.com/#!/cirrus/path/'. $info['path'] . '/page/'. $info['page'].'/tid/'.$info['thought_id'].'">Log In</a> and check out what thought '. $info['postername'].' has been posted to the idea: <br /><br /><b>';
 $htmlBody .=  '<a href="http://cirrusidea.com/#!/cirrus/path/'. $info['path'] . '/page/'. $info['page'].'/tid/'.$info['thought_id'].'">Thought Link @: ' .$info['page']. '</a></b>';
 if(!empty($info['newthought'])){
 $htmlBody .= '<br /><br /><br /><b>Thought:</b><br /><br />';
 $htmlBody .= $info['newthought'];
 }


 $htmlBody .=  '</p><br /><br /><p>Come on back and see whats new on <a href="http://cirrusidea.com">CirrusIdea.com</a>. </p><br />';
 
 
        break;

 
  ///////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////    
  ///////////////////////////////////////////////////////////////////////////////// 
   /////////////////////////////////////////////////////////////////////////////////        
       default: 
              
     }




return $htmlBody;

}







function emailFooter ($subject, $type){

$footer = '
		           </td></tr>
			 </tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
		
		
		
<br /><br />


<table border="0" cellpadding="0" cellspacing="0" height="100%" id="backgroundTable" width="100%">
 	<tbody>
 	<tr>
 	<td align="center" valign="top">
 		<table border="0" cellpadding="10" cellspacing="0" id="templatePreheader" width="600">
 			<tbody>
 			<tr>
 			<td class="preheaderContent" valign="top">
 				<table border="0" cellpadding="10" cellspacing="0" width="100%">
 					<tbody>
 					<tr>
 					<td valign="top">


			<a style="text-align:right;"  data-ajax="false" href="http://cirrusidea.com" target="_blank"><img src="cid:logo" width="100" alt="CirrusIdea Logo" /></a>

	 </td>
	 
	 <td valign="top" width="350">
		 <p>
		 <i>
		 Copyright &copy; 2014 CirrusIdea, LLC, <br />All rights reserved.</i>
		 <br />
		<a href="http://cirrusidea.com">CirrusIdea.com</a><br>
		 <b>
		 <br />
		 <a href="mailto:travis.g@cirrusidea.com">
		 Email Us</a></b>
		 </p>
	 </td>

     	 <td valign="top" width="190">
        ';
       if($type == 'membersinthreadEmail'){
       
$footer .= '	<a style="text-align:right;"  data-ajax="false" href="http://cirrusidea.com/#!/login" target="_blank"><b style="font-size:10px;">Email Settings</b></a>';

  }

 $footer .= '     </td>
           
           
 					</tr>
 					</tbody>
				 </table>
			 </td>
 			</tr>
 			</tbody>
 		</table>





	<br /><br /><br /><br /><br /><br />
	
	</td>
 	</tr>
 	</tbody>
 	</table>

</center>
</body>
</html>
';


return $footer;

}


?>