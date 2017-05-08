<?php


require_once('htmlemail_functions.php');
require_once('txtemail_function.php');

require_once('smtp.php');


class CirrusEmail {

  private $iter;    //Counter
  private $dbc;       //// Database connection details
  private $user_id;
  private $username;
  private $useremail;
  private $emailType;
  private $subject;
  private $htmlemail;
  private $txtemail;
  private $mailobj;
  private $error;
  private $emailads;
  private $emailid;
  private $emailcode;
  private $initDate;
  private $root;
  
   function __construct($type, $userNAME = '', $userID = ''){
    $this->root = realpath($_SERVER["DOCUMENT_ROOT"]);  
    
        if(file_exists('../../phplib/PHPMailer/PHPMailerAutoload.php')){
        require_once("../../phplib/PHPMailer/PHPMailerAutoload.php");
        
        }elseif(file_exists('../../../phplib/PHPMailer/PHPMailerAutoload.php')){
         require_once("../../../phplib/PHPMailer/PHPMailerAutoload.php");
        
        }elseif(file_exists($this->root."/phplib/PHPMailer/PHPMailerAutoload.php")){
        
        require_once($this->root."/phplib/PHPMailer/PHPMailerAutoload.php");
        }else{
        
         require_once($this->root."/phplib/PHPMailer/PHPMailerAutoload.php");

        }
        
     //Create a new PHPMailer instance
       $this->mailobj = new PHPMailer;

       $this->emailType = $type;
          
       $this->error = '';
      
       $this->emailads = false;
       
       $this->emailcode = md5(uniqid(rand(), true));

         if(file_exists('../startsession.php')){
        require_once('../startsession.php');
        
        }elseif(file_exists('../../startsession.php')){
         require_once('../../startsession.php');
        
        }elseif(file_exists($this->root."/cirrusidea.com/api/startsession.php")){
        
        require_once($this->root."/cirrusidea.com/api/startsession.php");
        }else{
        
         require_once($this->root."/api/startsession.php");

        }
        
       if(file_exists('../connectvars.php')){
        require_once('../connectvars.php');
        
        }elseif(file_exists('../../connectvars.php')){
         require_once('../../connectvars.php');
        
        }elseif(file_exists($this->root."/cirrusidea.com/api/connectvars.php")){
        
        require_once($this->root."/cirrusidea.com/api/connectvars.php");
        }else{
        
         require_once($this->root."/api/connectvars.php");

        }

     
        
        $this->dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

   if(isset( $_SESSION['user_id'])){
        $this->user_id = $_SESSION['user_id'];
        }else{
        $this->user_id = $userID; 
        }
        
   if(isset($_SESSION['username'])){
        $this->username = $_SESSION['username'];
        }else{
        
        $this->username = $userNAME; 
        }
        
      if(empty($this->user_id) && isset($this->username)){
        $query = "SELECT user_id FROM users WHERE username = '". $this->username ."'";
        $data = mysqli_query($this->dbc, $query);
        $row = mysqli_fetch_array($data); 
         $this->user_id = $row['user_id'];
         
        }
      
      
       if(empty($this->username) && isset($this->user_id)){
        $query = "SELECT username FROM users WHERE user_id = '". $this->user_id ."'";
        $data = mysqli_query($this->dbc, $query);
        $row = mysqli_fetch_array($data); 
         $this->username = $row['username'];
        }
       
       if($this->emailType == 'shoutoutEmail'){
       
        $this->initDate =  date("Y-m-d H:i:s");
       $this->htmlemail = "";
       
    
         $query = "INSERT INTO cirrusemails (ref_user_id, email, code, initDate) VALUES ('". $this->user_id ."', '".$this->htmlemail."', '".$this->emailcode."', '".$this->initDate."')";
         mysqli_query($this->dbc, $query);
          $query = "SELECT email_id FROM cirrusemails WHERE ref_user_id  = '". $this->user_id ."' AND code = '". $this->emailcode."' AND initDate = '".$this->initDate."'";
    
        
       $data = mysqli_query($this->dbc, $query);
       $row= mysqli_fetch_array($data); 

       $this->emailid = $row['email_id']; 

       
       
       
       }else{
       
       if((empty($this->username) || empty($this->user_id)) ){
        $this->error = 'Not a user or logged in';
        echo $this->error;
         
       }else{
        $query = "SELECT email FROM users WHERE user_id = '". $this->user_id ."'";
        $data = mysqli_query($this->dbc, $query);
        $row = mysqli_fetch_array($data); 
        $this->useremail = $row['email'];
 
       $this->initDate =  date("Y-m-d H:i:s");
       $this->htmlemail = "";
       
    
       
         $query = "INSERT INTO cirrusemails (ref_user_id, email, code, initDate) VALUES ('". $this->user_id ."', '".$this->htmlemail."', '".$this->emailcode."', '".$this->initDate."')";
         mysqli_query($this->dbc, $query);
          $query = "SELECT email_id FROM cirrusemails WHERE ref_user_id  = '". $this->user_id ."' AND code = '". $this->emailcode."' AND initDate = '".$this->initDate."'";
    
        
       $data = mysqli_query($this->dbc, $query);
       $row= mysqli_fetch_array($data); 

       $this->emailid = $row['email_id']; 
         //echo 'EMAIL ID  ' . $this->emailid;
       }
       }
       
        
    }



public function getEmail($injectorObj){
     
      
  

              switch ($this->emailType){
              
              case 'introEmailValidation':
              
              $this->subject = 'Email Validation';
              $title = 'Email Validation';

              $teaser = "You are so close to using the best and most rewarding way to think!";
               
              break;
              
              case 'resetPassword':
              
              $this->subject = 'Reset Password';
              $title = 'Password Reset';

              $teaser = "Your Password Reset Email.";
               

              
              break;
              
              case 'getUsername':
                
              $this->subject = 'Get Username';
              $title = 'Get Username';

              $teaser = "Your CirrusIdea Get Userame Email.";
               
              break;

             case 'commentEmail':
                
              $this->subject = 'Message';
              
              $title = 'CirrusIdea Message';

              $teaser = "A message was sent to you on CirrusIdea from ".$this->username;
               
              break;
              
             case 'chatbackEmail':
                
              $this->subject = 'Re:Message';
              
              $title = 'CirrusIdea Message Reply';

              $teaser = "A reply to a message was sent to you on CirrusIdea";
               
              break;

          
             
              case 'shoutoutEmail':
                
              $this->subject = 'Shout Out from CirrusIdea.com';
              
              $title = 'CirrusIdea Shout Out';

              $teaser = "Your friend sent you a shout out from CirrusIdea.com";
               
              break;
              
              case 'paymentEmail':
              $this->subject = 'You got paid for your thoughts!';
              
              $title = 'CirrusIdea Thought Payment';

              $teaser = "You Just got Paid $".$injectorObj['amount'] . "!!!";
               
              
              break;
              
              case 'membersinthreadEmail':
              
              $this->subject = 'A Cirrus thought was posted to a CirrusIdea you are apart of: '. $injectorObj['page'];
              
              $title = 'New CirrusIdea Thought in the idea: ' . $injectorObj['page'];

              $teaser = "A new thought was posted to a CirrusIdea you are apart of!!! It is in " . $injectorObj['page'];
              
              break;
                            
              
              default: 
              
              }
              
				
             
             
             $emailHead = getHeader($title);  
             $viewInBrowserSection = viewInBrowserSection($teaser, $this->emailid,   $this->emailcode);
             $bodySection = emailBody($this->emailType, $injectorObj);
             $endSection = emailFooter($title, $this->emailType);
             
             $this->htmlemail =  $emailHead . $viewInBrowserSection . $bodySection . $endSection;    
                           
            $this->txtemail = txtemailBody($this->emailType, $injectorObj); 
            
          return 'Got EMAIL';   
                                       
  }




public function sendEmail($to, $from){

                $this->mailobj->isSMTP();  // Set mailer to use SMTP
		  $this->mailobj->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
		  $this->mailobj->SMTPAuth = true; // Enable SMTP authentication
		  $this->mailobj->Username = 'smtp_username'; // SMTP username from https://mailgun.com/cp/domains
		  $this->mailobj->Password = 'smtp_password'; // SMTP password from https://mailgun.com/cp/domains
		  $this->mailobj->SMTPSecure = 'tls'; 
 



                $this->mailobj->setFrom($from['email'], $from['name']);
                //Set an alternative reply-to address
               $this->mailobj->addReplyTo($from['email'], $from['name']);
                //Set who the message is to be sent to
                $this->mailobj->addAddress($to['email'], $to['name']);
                //Set the subject line
                $this->mailobj->Subject = 'CirrusIdea - ' . $this->subject;
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                
                                  
                                 
                 $this->mailobj->WordWrap = 70;     
    

                $this->mailobj->msgHTML($this->htmlemail);
                //Replace the plain text body with one created manually
                $this->mailobj->AltBody = $this->txtemail;
                //Attach an image file
                
             
          ///////////////// EMBED LOGO ///////////////////////

        if(file_exists('../images/cirrusidealogo.png')){
         $this->mailobj->AddEmbeddedImage('../images/cirrusidealogo.png', "logo", 'logo.png');  
        }elseif(file_exists('../../images/cirrusidealogo.png')){
        $this->mailobj->AddEmbeddedImage('../../images/cirrusidealogo.png', "logo", 'logo.png');
        }elseif(file_exists($this->root."/cirrusidea.com/images/cirrusidealogo.png")){
          $this->mailobj->AddEmbeddedImage($this->root.'/cirrusidea.com/images/cirrusidealogo.png', "logo", 'logo.png');
        }else{
          $this->mailobj->AddEmbeddedImage($this->root.'/images/cirrusidealogo.png', "logo", 'logo.png');
        }

       ///////////////////////////////////////////////////
                                           
                
               // $j=0;
               // if($this->emailads){
               
              //  foreach($emailads as $ad){
                // $this->mailobj->AddEmbeddedImage($this->root. '/' . $ad['src'], "ad" . $j, 'ad'.$j.'.png');
               // $j++;
                //}
               
                //}
           	//$sendback['ads'][$n]['ad_img'] =$row['img'];
                
                //send the message, check for errors
                if (!$this->mailobj->send()) { ///////// Fail! ///////////
                        return 1;         
                } else {
              
                
                   $query = "UPDATE cirrusemails SET email = '". $this->htmlemail ."'  WHERE email_id = '". $this->emailid."'";

                    echo mysqli_query($this->dbc, $query);

                   //////////Good ///////////////

                    return 0;
                }
                        
  }





}



?>