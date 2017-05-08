<?php



require_once 'API.class.php';
require_once 'Auth.class.php';
require_once 'User.class.php';


class CirrusIdeaAPI extends API
{
    protected $User;
    protected $dbc;
    

    public function __construct($request, $origin) {
        parent::__construct($request);

        
        $this->dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        // Abstracted out for example
        $APIKey = new Auth();
        
        $User = new User();
              
            
        
       // if (!$User->loggedin()) {
       //    throw new Exception('User Not Logged In');
       // } //else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
          //  throw new Exception('Invalid API Key');
       // } else if (array_key_exists('token', $this->request) &&
           //  !$User->get('token', $this->request['token'])) {

          //  throw new Exception('Invalid User Token');
       // }

        $this->User = $User;
    }

    /**
     * Example of an Endpoint
     */
     protected function login() {
        if ($this->method == 'POST') {
        $yourname = array();
        $yourname['first'] = $this->User->name;
         $yourname['last'] = 'Gershon';


 // Clear the error message
  $error_msg = "";
  
  
 //$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Grab the user-entered log-in data
//if($_SERVER['REQUEST_METHOD']=='POST'){
//$postdata = file_get_contents("php://input");
//$request = json_decode($postdata);//
//}


      $user_username = $request->username;
      $user_password = $request->password;
      
   

    if (isset($user_username ) && isset($user_password)) {
      // Connect to the database
     
        // Look up the username and password in the database
       // $query = "SELECT * FROM zusers WHERE username = '" . $user_username . "' AND password = SHA('" . $user_password . "') AND validated != 0";
       // $data = mysqli_query($dbc, $query);

        
        if (($user_username == 'travis' && $user_password == '123') || ($user_username == 'bill' && $user_password == '123')) {

         
                // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
         // $row = mysqli_fetch_array($data);
            if($user_username == 'bill'){
                  $_SESSION['user_id'] = '2'; //$row['user_id'];
                  $_SESSION['username'] = 'bill'; //$row['username'];
                      //setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 5));    // expires in 30 days
                     //setcookie('username', $row['username'], time() + (60 * 60 * 24 * 5));  // expires in 30 days
                     setcookie('user_id', '1', time() + (60 * 60 * 24 * 5));    // expires in 30 days
                     setcookie('username', 'tmoney', time() + (60 * 60 * 24 * 5));  // expires in 30 days
               
                  return "login Successful";
	    	 
	    	 //echo http_response_code(200);
                 }else{
                  $_SESSION['user_id'] = '1'; //$row['user_id'];
                  $_SESSION['username'] = 'tmoney'; //$row['username'];
                      //setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 5));    // expires in 30 days
                     //setcookie('username', $row['username'], time() + (60 * 60 * 24 * 5));  // expires in 30 days
                     setcookie('user_id', '2', time() + (60 * 60 * 24 * 5));    // expires in 30 days
                     setcookie('username', 'bill', time() + (60 * 60 * 24 * 5));  // expires in 30 days
               
            
	       return "login Successful";
           

                 
                 }
			       
          
	    	} else {
	    	throw new Exception('You did not enter the correct username and/or password');
            
	    	}
        
        
	      } else {
	        
	       throw new Exception(' You must enter both username and password');
	       		                 	     	
	
	  }
	  

            return $yourname;
        } else {
            return "Only accepts POST requests";
        }
     }
     
     
     protected function fun() {
        if ($this->method == 'POST') {
            return "Your name is " . $this->User->name;
        } else {
            return "Only accepts POST requests";
        }
     }

      protected function vault() {
        if ($this->method == 'GET') {
            return $this->request;    
        } else {
            return "Only accepts POST requests";
        }
     }
     
     protected function categories(){
      if ($this->method == 'GET') {
    
               $query = "SELECT * FROM ideas WHERE file_path = '/files'";
         $data = mysqli_query($this->dbc, $query);
         
       
         $categories = array();
         $i = 0;
         while ($row = mysqli_fetch_array($data)){
          
          if($row['file_private'] == 1){
              $query1 = "SELECT * FROM folderprivacy WHERE folderID = '".$row['file_id']."' AND user_name = '".$this->User->username."'";
              $data1 = mysqli_query($this->dbc, $query1);
              
             	 if(mysqli_num_rows($data1)>0){
          
	          $categories[$i]['page'] = $row['file_name'];
	          if($row['creator'] == $this->User->ID){
	          $categories[$i]['isOwner'] = 1;
	          }else{
	          $categories[$i]['isOwner'] = 0;
	          }
	          $categories[$i]['type']['publicidea'] = 0;
	          $categories[$i]['type']['privateidea'] = 1;
	          $categories[$i]['type1']['btn btn-success'] = 0;
	          $categories[$i]['type1']['btn btn-info'] = 1;
	          
	           $i++;
	           }
           
           }else{
           
           
          $categories[$i]['page'] = $row['file_name'];
          if($row['creator'] == $this->User->ID){
          $categories[$i]['isOwner'] = 1;
          }else{
          $categories[$i]['isOwner'] = 0;
          }
          $categories[$i]['type']['publicidea'] = 1;
          $categories[$i]['type']['privateidea'] = 0;
          $categories[$i]['type1']['btn btn-success'] = 1;
          $categories[$i]['type1']['btn btn-info'] = 0;
          
           $i++;
           }
         }
            
            return $categories; 
            
        } else {
            return "Only accepts GET requests";
        }

     }

     
     
 }
 
 
 ?>