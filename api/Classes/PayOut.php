<?php




class PayOut {

  private $iter;    //Counter
  private $root;    /// Website Root
  private $dbc;       //// Database connection details
  private $path;     /// Idea Path
  private $page;          /// Idea Page
  private $user_id;
  private $username;
  private $members;
  private $membersCred;
  private $membernames;
  private $ratings;
  
   function __construct($PATH, $PAGE){
       
       $this->path = $PATH;
       $this->page = $PAGE;
   
       

        $this->root = realpath($_SERVER["DOCUMENT_ROOT"]);  
              
         if(file_exists('startsession.php')){
        require_once('startsession.php');
        
        }elseif(file_exists('../api/startsession.php')){
         require_once('../api/startsession.php');
        
        }elseif(file_exists($this->root."/api/startsession.php")){
        
        require_once($this->root."/api/startsession.php");
        }else{
        
         require_once($this->root."/api/startsession.php");

        }
        
       if(file_exists('connectvars.php')){
        require_once('connectvars.php');
        
        }elseif(file_exists('../api/connectvars.php')){
         require_once('../api/connectvars.php');
        
        }elseif(file_exists($this->root."/api/connectvars.php")){
        
        require_once($this->root."/api/connectvars.php");
        }else{
        
         require_once($this->root."/api/connectvars.php");

        }
   
        $this->dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(isset($_SESSION['user_id'])){
        $this->user_id = $_SESSION['user_id'];
        $this->username = $_SESSION['username'];
        }else{ 
	 $this->user_id = '';
        $this->username = '';

       }
        
        
    }



  private function member_in_array($memId){
  $in_member_array = false;
   foreach ($this->members as $MEMID){
	  if($MEMID == $memId){
	  $in_member_array = true;
	  break;
	  }
  	}

  return $in_member_array;
  }








 public function getSubMRData(){
 $SubMRArray = array();
 $sendArray = array();
 
 $query = "SELECT * FROM ideas WHERE file_path = '/".$this->path."' AND file_name = '".$this->page."'";
 $data = mysqli_query($this->dbc, $query);
  $row = mysqli_fetch_array($data);
  $idea_id = $row['file_id'];
  if($row['funds'] == 1){
     
     $query1 = "SELECT * FROM donations WHERE idea_id = '". $idea_id ."' AND paid IS NULL";
     $data1 =  mysqli_query($this->dbc, $query1);
     $money = 0;
     
    while($row1 = mysqli_fetch_array($data1)){
   
        $money = $money + $row1['amount'];
      
    } 

 }
 
 

 $query1 = "SELECT * FROM thoughts WHERE path = '/".$this->path."/".$this->page."' ORDER by rating DESC";
 $data1 = mysqli_query($this->dbc, $query1);
 $i = 0;
  while($row1 = mysqli_fetch_array($data1)){
  
  $post[$i]['rating'] = $row1['rating'];
  $post[$i]['member_id'] = $row1['member_id'];
  
  $i++;
  
  }


////Count Unique Member Thinkers ////
$u = 0;
$this->members = array();

$this->members[$u] = $post[0]['member_id'];

for($j = 1; $j < $i; $j++){

  
  if(!$this->member_in_array($post[$j]['member_id'])){
  $u++;
  $this->members[$u] = $post[$j]['member_id'];
  }
  
}




for ($k = 0; $k<=$u; $k++){
$query = "SELECT * FROM users WHERE user_id = '".$this->members[$k]."'";
 $data = mysqli_query($this->dbc, $query);
  $row = mysqli_fetch_array($data);

$this->membernames[$k] = $row['username'];
$this->membersCred[$k] = $row['cred'];
}


for ($k = 0; $k<=$u; $k++){
$SubMRArray[$k] = array();
$SubMRArray[$k][1] = 0;

  for($j = 0; $j < $i; $j++){  /// loop through all the posts.. if member = member in buildsend array add the rating...

 
    if($post[$j]['member_id'] == $this->members[$k]){

    $SubMRArray[$k][1] =  $SubMRArray[$k][1] + $post[$j]['rating']*$this->membersCred[$k];
    
    }

 
   }

}



///////////////////////////////////////////////
/////////Now consider sub posts///////////////
/////////////////////////////////////////////

$queryc=  "SELECT COUNT(*) AS total FROM thoughts WHERE path LIKE '/".$this->path."/".$this->page."%'";
$datac = mysqli_query($this->dbc, $queryc);
 $datac = mysqli_query($this->dbc, $queryc);
 $rowc = mysqli_fetch_array($datac);
 $totalSub_posts =  $rowc['total']; 


for ($k = 0; $k<=$u; $k++){

$queryc=  "SELECT COUNT(*) AS total FROM thoughts WHERE path LIKE '/".$this->path."/".$this->page."%' AND member_id = '".$this->members[$k]."'";
$datac = mysqli_query($this->dbc, $queryc);
 $rowc = mysqli_fetch_array($datac);
 $totalUserSub_posts =  $rowc['total'];
 if( $totalSub_posts > 0){
$factor[$k] =   $totalUserSub_posts/ $totalSub_posts;
 }else{
 $factor[$k] = 0;
 }
}

 $totalval = 0;
 $sendArray['contribs'] = array();
for ($k = 0; $k<=$u; $k++){

$sendArray['contribs'][$k]['member'] = $this->membernames[$k];
$sendArray['contribs'][$k]['data'] = $SubMRArray[$k][1]*$factor[$k];
 $totalval =  $totalval + $sendArray['contribs'][$k]['data'];
}



for ($k = 0; $k<=$u; $k++){
if($totalval>0){
$sendArray['contribs'][$k]['percent'] = $sendArray['contribs'][$k]['data'] / $totalval*100;
}
if($money>0){
$sendArray['contribs'][$k]['cashval'] = round($sendArray['contribs'][$k]['percent']/100*$money,2);
}
}

 
 $sendArray['total'] = round($money,2);
 
 return $sendArray;
 
 }
 
 
 
 
 
 
 

	
public function getSubMRCharting(){
	
	   
		 
$SubMRArray = array();





 $query1 = "SELECT * FROM thoughts WHERE path = '/".$this->path."/".$this->page."' ORDER by rating DESC";
 $data1 = mysqli_query($this->dbc, $query1);
 $i = 0;
  while($row1 = mysqli_fetch_array($data1)){
  
  $post[$i]['rating'] = $row1['rating'];
  $post[$i]['member_id'] = $row1['member_id'];
  
  $i++;
  
  }


////Count Unique Member Thinkers ////
$u = 0;
$this->members = array();

$this->members[$u] = $post[0]['member_id'];

for($j = 1; $j < $i; $j++){

  
  if(!$this->member_in_array($post[$j]['member_id'])){
  $u++;
  $this->members[$u] = $post[$j]['member_id'];
  }
  
}




for ($k = 0; $k<=$u; $k++){
$query = "SELECT * FROM users WHERE user_id = '".$this->members[$k]."'";
 $data = mysqli_query($this->dbc, $query);
  $row = mysqli_fetch_array($data);

$this->membernames[$k] = $row['username'];
$this->membersCred[$k] = $row['cred'];
}


for ($k = 0; $k<=$u; $k++){
$SubMRArray[$k] = array();
$SubMRArray[$k][1] = 0;

  for($j = 0; $j < $i; $j++){  /// loop through all the posts.. if member = member in buildsend array add the rating...

 
    if($post[$j]['member_id'] == $this->members[$k]){

    $SubMRArray[$k][1] =  $SubMRArray[$k][1] + $post[$j]['rating']*$this->membersCred[$k];
    
    }

 
   }

}



///////////////////////////////////////////////
/////////Now consider sub posts///////////////
/////////////////////////////////////////////

$queryc=  "SELECT COUNT(*) AS total FROM thoughts WHERE path LIKE '/".$this->path."/".$this->page."%'";
$datac = mysqli_query($this->dbc, $queryc);
 $datac = mysqli_query($this->dbc, $queryc);
 $rowc = mysqli_fetch_array($datac);
 $totalSub_posts =  $rowc['total']; 

for ($k = 0; $k<=$u; $k++){
$queryc=  "SELECT COUNT(*) AS total FROM thoughts WHERE path LIKE '/".$this->path."/".$this->page."%' AND member_id = '".$this->members[$k]."'";
$datac = mysqli_query($this->dbc, $queryc);
 $rowc = mysqli_fetch_array($datac);
 $totalUserSub_posts =  $rowc['total']; 

if( $totalSub_posts > 0){
$factor[$k] =   $totalUserSub_posts/ $totalSub_posts;
 }else{
 $factor[$k] = 0;
 }
}


for ($k = 0; $k<=$u; $k++){

$SubMRArray[$k][0] = $this->membernames[$k];
$SubMRArray[$k][1] = $SubMRArray[$k][1] *$factor[$k];

}





	
	   return $SubMRArray;
	
	
}



















}


























































?>












