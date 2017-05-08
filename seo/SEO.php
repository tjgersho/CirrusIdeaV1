<?php
class SEO {

 private $dbc; 
 private $root;
 private $linkview;
 private $linkfunc;
 private $metatags;
 private $file_path;
 private $file_name;
    
   public function __construct($page) 
   { 
     
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
   
        
  // echo ' _escaped_fragment_ ' . $page;
$patternpath = '/path(.*?)\/page/';
$patternpage = '/cirrus\/path.*\/page\/(.*)/';

if(preg_match($patternpath, $page, $matches) && preg_match($patternpage, $page, $matches1) ){

	$this->file_path = $matches[1];

	$this->file_name = $matches1[1];

	$patterntid =  '/(.*?)\/tid\/.*/';
	if(preg_match($patterntid, $this->file_name, $matches)){
		$this->file_name =$matches[1];
	}

	//Trim any / 

	$patterntslash =  '/(.*?)\//';
	if(preg_match($patterntslash, $this->file_name, $matches)){
		$this->file_name = $matches[1];

	}


 	$page = 'IDEAPAGE123321123321123321EGAPAEDI';

}



        
 $this->dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

switch ($page){
         case '/':

$this->linkfunc[0] = 'home1';
$this->linkfunc[1] = 'homePics';
$this->linkfunc[2] = 'home2';

$this->metatags = '<TITLE>CirrusIdea - A world of thought.</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - A world of thought.">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea is a webapp that helps organize and incentivize the worlds thoughts.">';


break;

case  '/login':

$this->linkview[0] = 'seo/views/login.php';

$this->metatags = '<TITLE>CirrusIdea - Log into CirrusIdea.</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - Log into CirrusIdea.">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea log into CirrusIdea.com.">';

break;
 
case '/cirrus':

$this->linkfunc[0] = 'browse';

$this->metatags = '<TITLE>CirrusIdea - Browse all the great ideas in these categories.</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - A world of thought.">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea is a webapp that helps organize and incentivize the worlds thoughts.">';


break;


case '/signup':

$this->linkview[0] = 'seo/views/signup.php';

$this->metatags = '<TITLE>CirrusIdea - A world of thought. Signup</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - A world of thought. Signup">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea is a webapp that helps organize and incentivize the worlds thoughts.">';


break;

case '/login':

$this->linkview[0] = 'seo/views/login.php';

$this->metatags = '<TITLE>CirrusIdea - A world of thought. Login</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - A world of thought. Login">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea is a webapp that helps organize and incentivize the worlds thoughts.">';


break;

case '/search':

$this->linkview[0] = 'seo/views/search.php';

$this->metatags = '<TITLE>CirrusIdea - A world of thought. Login</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - A world of thought. Login">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea is a webapp that helps organize and incentivize the worlds thoughts.">';


break;

case '/terms':

$this->linkview[0] = 'seo/views/termsandconditions.php';

$this->metatags = '<TITLE>CirrusIdea - Terms and Conditions.</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - Terms and Conditions.">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea is a webapp that helps organize and incentivize the worlds thoughts.">';


break;

case '/privacypolicy':

$this->linkview[0] = 'seo/views/privacypolicy.php';

$this->metatags = '<TITLE>CirrusIdea - Privacy Policy.</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - Privacy Policy.">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea is a webapp that helps organize and incentivize the worlds thoughts.">';


break;

case 'IDEAPAGE123321123321123321EGAPAEDI':


$this->linkfunc[0] = 'breadcrumbs';
$this->linkfunc[1] = 'ideaslist';
$this->linkfunc[2] = 'thoughts';




$this->metatags = '<TITLE>CirrusIdea - Idea: '.$this->file_name. '."</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - Idea: '.$this->file_name. '.">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea is a webapp that helps organize and incentivize the worlds thoughts.">';


break;


default:


$this->linkfunc[0] = 'home1';
$this->linkfunc[1] = 'homePics';
$this->linkfunc[2] = 'home2';


$this->metatags = '<TITLE>CirrusIdea - A world of thought.</TITLE>';
$this->metatags .= '<META NAME="Title" CONTENT="CirrusIdea - A world of thought.">';
$this->metatags .= '<META NAME="Description" CONTENT="CirrusIdea is a webapp that helps organize and incentivize the worlds thoughts.">';

         
         }




 } 
    

   
   
   private function get_top(){ 
   
               return file_get_contents('seo/searchtop.php') . $this->metatags;
               
      
   }  
   
     private function get_head(){ 
   
               return file_get_contents('seo/searchhead.php');
      
   } 
    
   private function get_body() { 
	
   $getpage = '';
  
   if(sizeof($this->linkview)>0){
   foreach ($this->linkview as $link){ 
  
   $getpage .= file_get_contents($link);    
  
   }
  }
  
  if(sizeof($this->linkfunc)>0){
  foreach ($this->linkfunc as $func){
   $getpage .=  $this->{$func}();
  }
  }

 
    return $getpage;
      
   }   
   private function get_footer() { 
              return file_get_contents('seo/searchfooter.php');
      
   }  
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////  
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
private function browse(){



$funcstring = '';

$queryidealist = "SELECT * FROM ideas WHERE file_private != 1 AND file_path = '/files'";
$dataidealist = mysqli_query($this->dbc, $queryidealist);
$j = 0;
while($rowidealist = mysqli_fetch_array($dataidealist)){
$subpage[$j] = $rowidealist['file_name'];
$j++;
}
 
		
$funcstring .= '<div class="panel panel-default">';
$funcstring .= '<div class="panel-body">';
$funcstring .= '<h5>Browse CirrusIdeas</h5>';
	$funcstring .= '<div>';
						
					
			for($i=0; $i<$j; $i++){
	$funcstring .=  '<a href="#!/cirrus/path/files/page/' .$subpage[$i] . 
	'" style="float:left; padding:10px; margin:5px; color:black;">'. $subpage[$i] .'</a>';
						
					}
		$funcstring .= '</div>';
	$funcstring .= ' <div class="clr"></div>';		   
		$funcstring .= '  </div>';
	
			   
			     $funcstring .= ' </div>';
		$funcstring .= '   </div>';
		$funcstring .= '</div>';
			
			


return $funcstring;
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////  
 private function breadcrumbs(){
$page = $this->file_name;

$pathstr = $this->file_path;


//echo '<br /><br /><br /><br /> Test Page: ' . $page;

//echo '    PathString    ' . $pathstr;


$breadcrumblinks = array();
  
$patharr = explode("/", $pathstr);
$ii = 0;
while (sizeof($patharr) > 1 && $ii<100){
         $temparr = $patharr;
          //console.log(patharr);
         // console.log(self.links);
       //  $sliced = $patharr.splice(sizeof($patharr)-1,1).join('/');
        $curpage = $patharr[sizeof($patharr)-1];
      //  echo 'curpage ' . $curpage;
       //  echo 'Size Of $Path Arr ' .sizeof($patharr) . '<br /> Prior to manipulation: ';
        
         
      //   print_r($patharr);
         array_splice($patharr, sizeof($patharr)-1,1);
      //   echo '<br /> Array SPlice FUnc:';
       //  print_r($patharr);
          $sliced = implode('/', $patharr);
       //  echo '<br /> IMplode FUnc:';
       //  echo($sliced);
        // echo '<br />';
       //$sliced =   implode('/', array_splice($patharr, sizeof($patharr)-1,1 ));
      //   echo 'Sliced   ' . $sliced;
       
    //    echo '<br />SIzeo f PAth array 2 : ' . sizeof($patharr) . '<br />';
          
          if ( sizeof($patharr) == 0){
     
          
          $breadcrumblinks[$ii] = array();
          $breadcrumblinks[$ii]['path'] =  ' ';
          $breadcrumblinks[$ii]['page'] = $curpage;
         
          }else{
    
          
    //      print_r($patharr);
          $breadcrumblinks[$ii] = array();
          $breadcrumblinks[$ii]['path'] =  implode('/', $patharr);
          $breadcrumblinks[$ii]['page'] = $curpage;
          }
       $ii++;
  //     echo 'Patharray At ENd ' .  print_r($patharr);
       
 }
         
 $breadcrumblinks = array_reverse($breadcrumblinks );  
// echo '<br /><br />' . print_r($breadcrumblinks); 


$funcstring = '';
$funcstring .= '<ul class="breadcrumb">';
$funcstring .= '<li><a href="#!/cirrus">CirrusIdeas</a></li>'; 


  for($i=1; $i<$ii; $i++){
	$funcstring .= '<li>';
	$funcstring .=  '<a href="#!/cirrus/path' .  
       $breadcrumblinks[$i]['path']  . '/page/' . 
       $breadcrumblinks[$i]['page'] .'">' . $breadcrumblinks[$i]['page']  . '</a>';
	$funcstring .=  '</li>';
  }
 


$funcstring .=  '<li class="active">'.$page. '</li>';
$funcstring .= '</ul>';

return $funcstring;
}  

private function ideaslist(){

$idealistpath = $this->file_path;
$idealistpage = $this->file_name;

$funcstring = '';

$queryidealist = "SELECT * FROM ideas WHERE file_private != 1 AND file_path = '" .$idealistpath. "/" . $idealistpage . "'";
$dataidealist = mysqli_query($this->dbc, $queryidealist);
$j = 0;
while($rowidealist = mysqli_fetch_array($dataidealist)){
$subpage[$j] = $rowidealist['file_name'];
$j++;
}
 
		
$funcstring .= '<div class="panel panel-default">';
$funcstring .= '<div class="panel-body">';
$funcstring .= '<h5>CirrusIdeas</h5>';
	$funcstring .= '<div>';
						
					
			for($i=0; $i<$j; $i++){
	$funcstring .=  '<a href="#!/cirrus/path'. 
	$idealistpath. "/" . $idealistpage  .'/page/' .$subpage[$i] . 
	'" style="float:left; padding:10px; margin:5px; color:black;">'. $subpage[$i] .'</a>';
						
					}
		$funcstring .= '</div>';
	$funcstring .= ' <div class="clr"></div>';		   
		$funcstring .= '  </div>';
	
			   
			     $funcstring .= ' </div>';
		$funcstring .= '   </div>';
		$funcstring .= '</div>';
			
			


return $funcstring;
}


private function thoughts(){

$funcstring = '
<!-- ---------------------------------------------------------------  -->
<div class="panel panel-success">
<div class="panel-heading">
<!--  --------------------------------------------------------------------
 --------------------------------------------------------------------------------
 ----------------------------Donation Facts -->
<div class="container">
   <div class="row">
  <div class="col-sm-5">
    <p style="padding:5px"><b>';
    
    
$funcstring .= $this->file_name;

    
$funcstring .= '</b> has <span class="badge">$';


///Getting Project Data.
  $path = $this->file_path;
  $page = $this->file_name;
    
$fundsData = array();
$fundsData['funds'] = 0;

 $query = "SELECT * FROM ideas WHERE file_path = '".$this->file_path."' AND file_name = '".$this->file_name."'";
 $data =  mysqli_query($this->dbc, $query);
 $row = mysqli_fetch_array($data);

 $idea_id = $row['file_id'];
  
 if($row['funds'] == 1){
  
     $query1 = "SELECT * FROM donations WHERE idea_id = '". $idea_id ."' AND paid IS NULL";
     $data1 =  mysqli_query($this->dbc, $query1);
     $money = 0;
     
    while($row1 = mysqli_fetch_array($data1)){
   
        $money = $money + $row1['amount'];
      
    } 
  $fundsData['funds'] = $money;
 }
 
 $query = "SELECT * FROM ideapayout WHERE idea_id = '".$row['file_id']."'";
 $data =  mysqli_query($this->dbc, $query);
 
 $payout = 0;
 $morethoughts = 0;
 $total = 0;
  while($row = mysqli_fetch_array($data)){
      if($row['vote'] == 1){
         $payout = $payout + 1;
      }else{
      $morethoughts = $morethoughts +1;
      }
  $total = $total + 1;
  }	

if($total > 0){
	$fundsData['payoutpercent'] = round($payout /$total * 100,0);
	$fundsData['payoutpercentstyle']['width'] = $fundsData['payoutpercent'] . '%';

      $fundsData['moredevneededpercent'] = 100-$fundsData['payoutpercent'];
      $fundsData['moredevneededpercentstyle']['width'] =  $fundsData['moredevneededpercent'] . '%';
      $fundsData['payoutvotes'] = $total; 
  }else{

  $fundsData['payoutpercent'] = 0;
  $fundsData['payoutpercentstyle']['width'] =  '0%';
          
     $fundsData['moredevneededpercent'] = 0;
     $fundsData['moredevneededpercentstyle']['width'] =  '0%';
     $fundsData['payoutvotes'] = 0;
 }     
       

	 $query = "SELECT * FROM ideapayout WHERE idea_id = '".$idea_id ."' AND member_id = '".$_SESSION['user_id']."' ORDER by date DESC LIMIT 1";
	 $data =  mysqli_query($this->dbc, $query);
	 $row = mysqli_fetch_array($data);
	 
	 $date1 = $row['date'];
	  
	     
	$date2 = date("Y-m-d H:i:s");   
	
	$diff = abs(strtotime($date2) - strtotime($date1));
	
	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	$hours = floor(($diff / (60*60)));
	$hoursDec = $diff / (60*60);
	//echo 'Hours Since last Vote';
//	echo $hours;
//	exit();
	
	 if($hours > 1 && $total >22) {
	  $fundsData['usercanVote'] = true;
	  }else{
	  $fundsData['timetoVote'] = round(1 - $hoursDec,2);
	 $fundsData['usercanVote'] = false;
	 }
	 if($hours > -$total  + 24 && $total < 23){  
	$fundsData['usercanVote'] = true;
	 }elseif($total < 23){
	  $fundsData['timetoVote'] = round((-$total  + 24) - $hours,0);  
	 $fundsData['usercanVote'] = false;	
	 }
	 
		
$funcstring .=   round($fundsData['funds'],2);    			
 $funcstring .=  '</span> in donations!</p>';
 $funcstring .= '</div>';
   
 $funcstring .= '   <div class="col-sm-7">';
 if($fundsData['payoutvotes'] > 10 && $fundsData['funds'] > 0){
  $funcstring .= '  <div style="margin:5px"> Payout Poll: ';
$funcstring .= ' <div id="PayoutPoll" class="progress" style="position: relative; height:40px;';
$funcstring .= ' background-image: url(\'images/postcred.png\'); background-size: 30px 30px; background-repeat: no-repeat; background-position: right;">';
	     
$funcstring .= 	 '<span id="payoutPointDollarLeft" class="glyphicon glyphicon-usd" style="position:absolute; top:20px;"></span>';
$funcstring .=   '<i id="payoutPoint" class="fa fa-arrow-down" style="position:absolute; top:27px;"></i>';
$funcstring .=   '<span id="payoutPointDollarRight" class="glyphicon glyphicon-usd" style="position:absolute; top:20px;"></span>';
$funcstring .=  ' <div  style="opacity: 0.4; filter: alpha(opacity=40);" >';
$funcstring .= 	' <div style="position:absolute; padding-left:5px; color:black;">Payout- '.$fundsData['funds'].'% </div>';
$funcstring .= 	'</div>';
$funcstring .=  ' <div style="opacity: 0.4; filter: alpha(opacity=40);"  >';

if($fundsData['moredevneededpercent'] > 60){

$funcstring .=  '<div style="position:absolute; padding-left:5px; top:40px; color:black;">Needs Thought - ';
$funcstring .=   $fundsData['moredevneededpercent'];
$funcstring .=  '%</div>';

}else{

$funcstring .= '<div style="position:absolute; padding-left:5px; color:black;" ng-if="cirrusideaPageCtrl.fundsdata.moredevneededpercent<60">Needs Thought - ';
$funcstring .=  $fundsData['moredevneededpercent'];

$funcstring .= '%</div>';

}

$funcstring .= '</div>';	    	  
$funcstring .='</div>';
	     }   
$funcstring .= '</div>';
         
$funcstring .= '<script>';

$funcstring .= '$("#payoutPoint").css("left", ($("#PayoutPoll").width()*0.6+7) + "px");';
$funcstring .= '$("#payoutPointDollarLeft").css("left", ($("#PayoutPoll").width()*0.55+7) + "px");';
$funcstring .= '$("#payoutPointDollarRight").css("left", ($("#PayoutPoll").width()*0.65+7) + "px");';
$funcstring .= '</script>';   
   
if($fundsData['funds'] > 0){     
$funcstring .= '<div style="margin:5px">';
$funcstring .= '<span class="badge" >Payout Votes: ' . $fundsData['payoutvotes'] . '</span>';
$funcstring .= '</div>';
}

$funcstring .= '</div> <!-- end Col sm -->';
   
$funcstring .= '</div> <!-- end Row -->';
  
$funcstring .= '</div>  <!-- end container -->';


$funcstring .= ' <!--  --------------------------------------------------------------------
 --------------------------------------------------------------------------------
 ----------------------------  -->  ';
    
   
$funcstring .= '<div class="container">';
$funcstring .= '<div class="row">';
  
  
$funcstring .= '<div class="col-sm-12">';
$funcstring .= ' <div style="margin:5px; float:left;">';

$specialPath = preg_replace('/files/', 'CirrusIdeas', $this->file_path, 1); 

$funcstring .= '  <small>' . $specialPath .'/</small> <b>'. $this->file_name .'</b>';
 $funcstring .= '</div>';
$funcstring .= '<div class="clr"></div>';
$funcstring .= '</div>';
$funcstring .= '</div> <!-- End Row -->';
$funcstring .= '</div> <!-- Container -->';
$funcstring .= $this->payoutStats();
$funcstring .= '<div class="clr"></div>';
$funcstring .= $this->ideaRundownStats();
$funcstring .= '<div class="clr"></div>';
$funcstring .= '</div> <!-- End panel header-->';
$funcstring .= '<div class="panel-body">';
$funcstring .= '<div class="clr"></div>';


$funcstring .= '<!-- -------------------------------------------------------------------------------------------------  -->';
$funcstring .= '<!-- -------------------------------------------------------------------------------------------------  -->';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////Generate Though Array/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$thoughtarray = array();

 $getmodelOK = false;

   $query = "SELECT * FROM ideas WHERE file_path = '".$this->file_path."' AND file_name = '".$this->file_name."'";
   
   $data = mysqli_query($this->dbc, $query);
   $row = mysqli_fetch_array($data);
       if($row['file_private'] == 1){
     
    header('Location: http://cirrusidea.com/');
       exit();
             	 
             }else{
             $getmodelOK = true;
             }



    
          if($getmodelOK){
          
  

$query = "SELECT * FROM thoughts WHERE path = '".$this->file_path.'/'.$this->file_name."' ORDER by date DESC";

        $data = mysqli_query($this->dbc, $query);


  $showcase = 0;
         $i = 0;
       
$videocount = 0;
         
         while ($row = mysqli_fetch_array($data)){
          
             	 
    //         	  id: 1,
   //      	 date: '1/15/15',
   //      	 headline: 'This is an example post',
   ///      	 file_name: 'something.mpg4',
   //      	 file_type: 'video',
   //      	 file_size: 12392398,
   //      	 path: '/files/Engineering',
   //      	 member_id: 1,
  //         	 owner: false,
//		 private: true,
//		 rating: 10   
                 
                  $thoughtarray[$i]['id'] = $row['id'];
	          $thoughtarray[$i]['date'] = $row['date']; //(string)(strtotime($row['date']));
	          $thoughtarray[$i]['headline'] = $row['headline'];
	          $thoughtarray[$i]['file_name'] = $row['filename'];
	          
	          $path_parts = pathinfo($row['filename']);

	          
	          switch ($path_parts['extension']){
	            case 'mpg':
	              $thoughtarray[$i]['file_type'] = 'video';
	              $videocount++;
	               break;
	               
	             case 'MPG':
	              $thoughtarray[$i]['file_type'] = 'video';
	               $videocount++;
	               break;
	            case 'mp4':
	              $thoughtarray[$i]['file_type'] = 'video';
	               $videocount++;
	               break;
                    case 'mp3':
	              $thoughtarray[$i]['file_type'] = 'audio';
	               break;
	               
	            case 'oog':
	             $thoughtarray[$i]['file_type'] = 'video';
	              $videocount++;
	               break;
	               
	             case 'OOG':
	             $thoughtarray[$i]['file_type'] = 'video';
	              $videocount++;
	             
	               break;
	            case 'webm':
	              $thoughtarray[$i]['file_type'] = 'video';
	               $videocount++;
	               break;
	             case 'avi':
	             $thoughtarray[$i]['file_type'] = 'video';
	              $videocount++;
                       break;
	            case 'mov':
	             $thoughtarray[$i]['file_type'] = 'video';
	              $videocount++;
	           
	               break;
	               
	            case 'MOV':
	             $thoughtarray[$i]['file_type'] = 'video';
	              $videocount++;
	             
	               break;
	               
	            case 'jpg':
	            $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	              
	            
                               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 

                                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] .  'thum63820.'.$path_parts['extension'], '/'); 
                            

	               
	               	  break;     
	            case 'JPG':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	                 
                                 
                                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] .  'thum63820.'.$path_parts['extension'], '/'); 
                        
                               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 
                          
                             
                        
                             
                           break;  
                       case 'jpeg':
	            $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	              

                                 
                                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'], '/'); 

                               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 
                       
	               
	               	  break;   
	             case 'JPEG':
	            $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	              
	         
                                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'], '/'); 
       

                               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 
                         
	               
	               	  break;   

	            case 'png':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	                   
                                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'], '/'); 

                               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 
                           
                             
                   
	               	      break;   
	            case 'PNG':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	       
                                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'], '/'); 
                          

   				$thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 
                             
	               	      break;   
	               	      
	             case 'gif':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	                      $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'], '/'); 
                                    $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 
                          
	               	      break;   
	            case 'GIF':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	                          $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'], '/'); 
                                    $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 
                            	  break;           
	             default:
	               $thoughtarray[$i]['file_type'] = 'other';
	              
	           }
	          
	          $thoughtarray[$i]['file_size'] = $row['filesize'];
	           $thoughtarray[$i]['path'] =  ltrim ($row['path'] . '/' . $row['filename'], '/');   
	          $thoughtarray[$i]['member_id'] = $row['member_id'];
	          
	         $query5 = "SELECT username FROM users WHERE user_id = '". $row['member_id']."'";
                 $data5 = mysqli_query($this->dbc, $query5);
                 $row5 = mysqli_fetch_array($data5);
                   $thoughtarray[$i]['membername'] = $row5['username'];


	          
	          
	      
	          $thoughtarray[$i]['owner'] = false;

	           
	          $querypp = "SELECT file_private FROM ideas WHERE file_path = '".$this->file_path."' AND file_name = '".$this->file_name."'";
                  $datapp = mysqli_query($this->dbc, $querypp);
                  $rowpp = mysqli_fetch_array($datapp);
                  
                  if($rowpp['file_private'] == 1){
                  
	            	           $thoughtarray[$i]['private'] = true;
	            	           
	            	            header('Location: http://cirrusidea.com/');
                   			 exit();

	            }else{
	            
	            	            	           $thoughtarray[$i]['private'] =false;
	            }           
	            	           
	           $thoughtarray[$i]['rating'] = $row['rating'];
             
                  $queryrr = "SELECT rating FROM thoughts WHERE path = '".$this->file_path.'/'.$this->file_name."' ORDER by rating DESC LIMIT 1";
                  $datarr = mysqli_query($this->dbc, $queryrr);
                  $rowrr = mysqli_fetch_array($datarr);
                  if($rowrr['rating']>0){
                 $ideapeakrating = $rowrr['rating'];
                 $thoughtarray[$i]['percentratingstyle']['width']  = round($thoughtarray[$i]['rating']/$rowrr['rating']*100) . '%';
                   }else{
                   $ideapeakrating = 0;
                   $thoughtarray[$i]['percentratingstyle']['width']  = '0%';
                   }
                   
                   
                      
			 $query1 = "SELECT * FROM ratingvote WHERE thought_id = '". $row['id'] ."' AND member_id= '".$_SESSION['user_id']."' ORDER by date DESC LIMIT 1";
			 $data1 = mysqli_query($this->dbc, $query1);
			
			 $row1 = mysqli_fetch_array($data1);
			 
			 
			$date1 = $row1['date'];
			$date2 = date("Y-m-d H:i:s");   
						
			$diff = abs(strtotime($date2) - strtotime($date1));
			
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			$hours = floor(($diff / (60*60)));
			
			//printf("%d years, %d months, %d days\n, %d hours", $years, $months, $days, $hours);
			 if($hours > 24){
			                  $thoughtarray[$i]['credvote'] = true;  
			        }else{
			         $thoughtarray[$i]['credvote'] = false; 
			        
			        }           

                  
			        $querycc = "SELECT * FROM postcomments WHERE ref_post_id = '". $row['id'] . "' ORDER by postcomment_date DESC";
			        $datacc = mysqli_query($this->dbc, $querycc);
			        
			        $j = 0;

			        while ($rowcc = mysqli_fetch_array($datacc)){
			          
			                 $thoughtarray[$i]['thoughtcomments'][$j]['com_date'] = $rowcc['postcomment_date'];
				                 
				                  $query5m = "SELECT username FROM users WHERE user_id = '".$rowcc['post_member_id']."'";
	               				  $data5m = mysqli_query($this->dbc, $query5m);
	                			  $row5m = mysqli_fetch_array($data5m);
	                			  
                  			 $thoughtarray[$i]['thoughtcomments'][$j]['commenter_name'] = $row5m['username'];
			                 
			                 $thoughtarray[$i]['thoughtcomments'][$j]['comment'] = $rowcc['comment'];
			           
			                            $j++;
			                            
			            }
			            
			        $thoughtarray[$i]['thoughtcomment_toggle'] = 0;  
			        $thoughtarray[$i]['thoughtcomment_togglestyle']['glyphicon glyphicon-plus'] = 1; 
				  $thoughtarray[$i]['thoughtcomment_togglestyle']['glyphicon glyphicon-menu-up'] = 0;        
	           $i++;
	           
	          // if( $videocount > 4){
	          // break;
	          // }
	           }
	           
   }
       
         
            
                           
$thoughts= array();
   
           if($showcase > 1){
             $thoughts['showcase'] = 1;
            }
   $thoughts['ideapeakrating'] = $ideapeakrating;
   $thoughts['current'] = 1;
   $thoughts['numPages'] = $num_pages;
   $thoughts['thoughtarray'] =   $thoughtarray;
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

foreach($thoughts['thoughtarray'] as $thought){
$funcstring .= '<div>';
$funcstring .= '<div id="thought_id_"'.$thought['id'].'">';

$funcstring .= '<!-- -------------------------------------------------------------------------------------------------  -->';
$funcstring .= '<!-- Thought Actions -->';


$funcstring .= '<div>Post Date: '.$thought['date'] . '</div>';
   
$funcstring .= '<span class="label label-info pull-right">'. $thought['membername'] . '</span>';



$funcstring .= '<div style="padding:5px;">';

   
$funcstring .= '<label for="comment">Thought:</label><div style="overflow:auto;">'.$thought['headline'].'</div>';

$funcstring .= '</div>';


   
 
	switch ($thought['file_type']){
	case 'image':
	
	$funcstring .= '<div><a href="'.$thought['path'].'"><img src="'.$thought['thumbnail'] . '" width="100%"/></a></div>';
	
	break;
	
	
	case 'audio':
	
	$funcstring .= '<div class="clr"></div>';
   	$funcstring .= '<br />';
    	$funcstring .= '<div style="width:80%; margin-left:auto; margin-right:auto;">';
      	$funcstring .= '<audio controls style="width:100%;">';
	   	$funcstring .= '<source src="'.$thought['path'].'"  type="audio/mp3">';
	 	$funcstring .= '</audio>'; 
    	$funcstring .= '</div>';
    	$funcstring .= '<br />';
    	if(isset($thought['file_name'])){
    	$funcstring .= '<a href="'.$thought['path'].'">'.$thought['file_name']. '</a> <small>Size:  '. $thought['file_size']/1024 . 'Kb</small>';
	}
	break;
	
	
	
	case 'video':
	
	 $funcstring .= '<div style="width:100%; margin-left:auto; margin-right:auto; margin-top:25px;">';
				
	$funcstring .= '<video width="100%" height="360" controls>';
	
			$funcstring .= '<source src="'.$thought['path'].'" type="video/mp4" /><!-- Safari / iOS video    -->';
	$funcstring .= '</video>';
	$funcstring .= '<p>  <strong>Download Video:</strong>';
		
	if(isset($thought['file_name'])){
    	$funcstring .= '<a href="'.$thought['path'].'">'.$thought['file_name']. '</a> <small>Size:  '. $thought['file_size']/1024 . 'Kb</small>';
	}
		$funcstring .= '</p>';				
		$funcstring .= '</div>';

	
	break;
	
	
	default:
	if(isset($thought['file_name'])){

	$funcstring .= '<a href="'.$thought['path'].'">'.$thought['file_name']. '</a> <small>Size:  '. $thought['file_size']/1024 . 'Kb</small>';

         }
	break;
	}


$funcstring .= '<div class="progress pull-right" style="width:150px; margin:5px; height:30px; background-image: 
url(\'images/postcred.png\'); background-size: 20px 20px; background-repeat: no-repeat; background-position: right;">';

$funcstring .= '<div style="padding-top:8px; padding-left:3px; color:black; position:absolute;">Cred: '. $thought['rating'] . '</div>';
$funcstring .= '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="opacity: 0.4; filter: alpha(opacity=40);" >';
$funcstring .= '</div>';
$funcstring .= '</div>';
            

if(isset($thought['thoughtcomments']) && sizeof($thought['thoughtcomments'])>0){

$funcstring .= '<hr></hr>';
$funcstring .= '<div class="clr"></div>';
	     
foreach($thought['thoughtcomments'] as $thoughtcomment){
$funcstring .= '<div>';
$funcstring .= ' <div style="padding:5px;">';
$funcstring .= ' <div class="cirrus_thoughtcomment">';
$funcstring .= ' <div>Date: '. $thoughtcomment['com_date'] . '</div>';
$funcstring .= '  <span class="label label-info pull-right">'. $thoughtcomment['commenter_name'] . '</span>';
$funcstring .= ' <blockquote>';
$funcstring .= ' <small>';
$funcstring .=  $thoughtcomment['comment'];
$funcstring .= '  </small>';
$funcstring .= '  </blockquote>';
	         
$funcstring .= ' </div>';
$funcstring .= ' </div>';
$funcstring .= ' </div>';
	    }
} 
	 
  
$funcstring .= '<div class="clr"></div>';
  
  
$funcstring .= '</div> <!-- End of Thought -->';
		 
$funcstring .= '</div> <!-- End of repeat -->';

$funcstring .= '<div class="clr"></div>';



}




$funcstring .= '<!-- ------------------------------------------------------  -->';
 $funcstring .= '</div>  <!-- ---------------------------------------------------------------  END PANEL BODY ---->';

$funcstring .= '<!-- ------------------------------------------------------  -->';


$funcstring .= '<div class="panel-footer">';


$funcstring .= '<div class="clr"></div>';
$funcstring .= '<hr></hr>';

$funcstring .= 'Viewable By:
<div id="viewablebydiv">
<div>The World</div></div>';

$funcstring .= '</div>  <!------ END PANEL FOOTER  ----- -->';

  
$funcstring .= '</div>  <!------ END PANEL  ----- -->';



return $funcstring;
}




private function p_file_type($filename){

 $path_parts = pathinfo($filename);

	          
	          switch ($path_parts['extension']){
	            case 'mpg':	               
	            case 'MPG':
                    case 'mp4':
                    case 'oog':
                    case 'OOG':
                    case 'webm':
                    case 'avi':
                    case 'mov':
                    case 'MOV':
	              return 'video';
	              	           
                    case 'mp3':
	              return 'audio';
	               
	            	               
	            case 'jpg':
	            case 'JPG':
	            case 'png':
	            case 'PNG':
	            case 'gif':
	            case 'GIF':
	             return 'image';	              
	           
	           default:
	               return 'other';
	              
	           }

}



private function payoutStats(){


//$GLOBALS['total'];	

$GLOBALS['total'] = 0;
 
require_once('api/Classes/PayOut.php');

$payOutStats = new PayOut(ltrim($this->file_path,'/'), $this->file_name);	
$payoutstats = $payOutStats->getSubMRData();


$funcstring .= '<h1>Pay Out Stats </h1>';
$funcstring .= '<br />';
$funcstring .= '<div class="content_underline"></div>';

 $funcstring .= ' <div class="container">';
 $funcstring .= '   <div class="row">';
  $funcstring .= '  <div class="col-sm-6">';

 /////////////////////////////////////////// ///////////////////////////////////////////    
   /////////////////////////////////////////// ///////////////////////////////////////////
   
   if(sizeof($payoutstats['contribs'])>0 ){
   /////////////////////////////////////////// ///////////////////////////////////////////
   /////////////////////////////////////////// /////////////////////////////////////////// 
    
   $funcstring .= '<div class="payOutStats" style="margin-top:15px; margin-bottom:15px;">';
  $funcstring .= '              <table >';
  $funcstring .= '                  <tr>';
   $funcstring .= '                     <td>';
   $funcstring .= '                         Member';
   $funcstring .= '                       </td>';
    $funcstring .= '                    <td >';
    $funcstring .= '                        Percent Contribution ';
     $funcstring .= '                   </td>';
    $funcstring .= '                    <td>';
     $funcstring .= '                       Value Share ';
    $funcstring .= '                    </td>';
    $funcstring .= '                </tr>';

 foreach($payoutstats['contribs'] as $po){
    $funcstring .= '                <tr ng-repeat="po in cirrusideaPageCtrl.payoutstats.tabledata.contribs">';
   $funcstring .= '    <td >';
  $funcstring .=            $po['member'];
   $funcstring .= '       </td>';
   $funcstring .= '            <td>';
   $funcstring .=   $po['percent']  .'%';

   $funcstring .= '          </td>';
  $funcstring .= '           <td>';
  $funcstring .= ' $' . $po['cashval'];

  $funcstring .= '              </td>';
$funcstring .= '     </tr>';
  }
   $funcstring .= '       <tr>';
    $funcstring .= '           <td colspan="2" style="text-align:right;">';
              
  $funcstring .= '            Total:';
   $funcstring .= '            </td>';
    $funcstring .= '            <td>';
  $funcstring .= '$' . $payoutstats['total'];
     $funcstring .= '                    </td>';
   $funcstring .= '             </tr>';
  
   $funcstring .= '              </table>';
    $funcstring .= '         </div>';
               
    }
    $funcstring .= ' </div>';
  
  
 $funcstring .= '  </div>';
 $funcstring .= ' </div>';

 $funcstring .= '  <div class="clr"></div>';


return $funcstring;
}

private function ideaRundownStats(){

$ideadataarray = array();
$ideadataarray['isOwner'] = false;


 $query = "SELECT * FROM ideas WHERE file_path = '/".$this->file_path."' AND file_name = '".$this->file_name."'";
 $data =  mysqli_query($this->dbc, $query);
  $row = mysqli_fetch_array($data);
 $ideadataarray['headline'] = $row['p_heading'];
  $ideadataarray['synopsis'] = $row['p_descript'];
   $ideadataarray['slogan'] = $row['p_slogan'];
   
   
   
   $ideadataarray['isuptodate'] = false;
   

     ///////////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////////////////////////////////////////////////////////////
      
      for ($i=0; $i<6; $i++){
      $ideadataarray['p_files'][$i]['iter'] = $i;
     
      
     $ideadataarray['p_files'][$i]['fname'] = $row['p_file'.($i+1)];

     $path_parts = pathinfo($row['p_file'.($i+1)]);

     $ideadataarray['p_files'][$i]['ftype'] =  $this->p_file_type($row['p_file'.($i+1)]);
     
      if($ideadataarray['p_files'][$i]['ftype'] == 'image'){  
     $ideadataarray['p_files'][$i]['fthumb'] = $this->file_path."/". $this->file_name . "/". $path_parts['filename'] .'thum63820.' . $path_parts['extension'];
        
     $ideadataarray['p_files'][$i]['fpath'] = $this->file_path."/". $this->file_name . "/". $row['p_file'.($i+1)];
     $ideadataarray['p_files'][$i]['fsize'] =  filesize($ideadataarray['p_files'][$i]['fpath']); 
       
       }
       
       }
     
   ///////////////////////////////////////////////////////////////////////////////////////    
     ///////////////////////////////////////////////////////////////////////////////////////   
        ///////////////////////////////////////////////////////////////////////////////////////   
                  
     
     
     
         if(empty($row['p_file1']) || empty($row['p_file2']) ||  empty($row['p_file3']) || empty($row['p_file4'])  || empty($row['p_file5'])  || empty($row['p_file6']) ){
         $ideadataarray['empty_p_files'] = true;
         }else{
          $ideadataarray['empty_p_files'] = false;
         }
         
         

$funcstring = '<br />';
$funcstring .= '<div class="clr"></div>';
$funcstring .= '<div class="content_underline"></div>';
$funcstring .= '<div class="clr"></div>';
$funcstring .= ' <br />';
$funcstring .= ' <br />';
 

$funcstring .= '<div class="clr"></div>';

foreach( $ideadataarray['p_files'] as $pf){
$funcstring .= '<div>'; //// Repeat p_files 

if(!empty($pf['fname'])){
$funcstring .= '<div class="cirrus_rundown_file">' . $pf['fname'];         


switch ($pf['ftype']){
case 'image':
$funcstring .= '<a href="'.$pf['fpath'].'"><img src="'.$pf['fthumb'].'" width="100%"/></a>';
break;
case 'audio':
			          
	$funcstring .= ' <div class="clr"></div>';
	$funcstring .= ' <br />';
	$funcstring .= ' <div style="width:80%; margin-left:auto; margin-right:auto;">';
	$funcstring .= ' <audio controls style="width:100%;">';
	$funcstring .= ' <source src="'.$pf['fpath'] . '"  type="audio/mp3">';
	$funcstring .= ' 			   </audio> ';
	$funcstring .= ' 		         </div>	'; 
	$funcstring .= ' 		        <br />';
	$funcstring .= ' 		          <a ng-if="thought.file_name" ng-click="thoughtCtrl.downloadThoughtFile(pf.fpath)"> ';
	$funcstring .= 	 $pf['fname'];
	$funcstring .= ' </a> <small>Size:  '.$pf['fsize']/1024 .'Kb</small>';
			        

break;

case 'video':
		
	
	 $funcstring .= '<div style="width:100%; margin-left:auto; margin-right:auto; margin-top:25px;">';
				
	$funcstring .= '<video width="100%" height="360" controls>';
	
			$funcstring .= '<source src="'.$pf['fpath'].'" type="video/mp4" /><!-- Safari / iOS video    -->';
	$funcstring .= '</video>';
	$funcstring .= '<p>  <strong>Download Video:</strong>';
		$funcstring .= '<a href="'.$pf['fpath'] .'"> '. $pf['fname'] . '</a>';
		if(isset($pf['fname'])){
    	$funcstring .= '<a href="'.$pf['fpath'].'">'.$pf['fname']. '</a> <small>Size:  '. $pf['fsize']/1024 . 'Kb</small>';
	}
		$funcstring .= '</p>';				
		$funcstring .= '</div>';

				 
	break;
	
default:
			 
	 
$funcstring .= ' <a href="'.$pf['fpath'].'">'.$pf['fname'].'</a> <small>Size:  '. $pf['fsize']/1024 .'Kb</small>';
		 		 
break;

}
		
$funcstring .= '<div class="clr"></div>';
$funcstring .= '</div>';
       } // End if p_file !empty
$funcstring .= '</div>';
  
  }

 $funcstring .= '</div>';

$funcstring .= '</div>';

$funcstring .= '<h2 class="pull-left">'.$ideadataarray['headline'].'</h2>';
$funcstring .= '<h4 class="pull-right"><b>'.$ideadataarray['slogan'] . '</b></h4>';
$funcstring .= '<div class="clr"></div>';
$funcstring .= '<p>';
$funcstring .= $ideadataarray['synopsis'];
$funcstring .= '</p>';

$funcstring .= '</div>';
$funcstring .= '</div> <!------------- END Show Idea Rundown --------------->';
$funcstring .= '<div class="clr"></div>';



return $funcstring;


}



/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
private function home1(){

   $funcstring = file_get_contents('seo/views/home1.php');
 return  $funcstring; 
}


private function homePics(){

  $query = "SELECT * FROM thoughts WHERE (filename LIKE '%.jpg' OR filename LIKE '%.JPG' OR filename LIKE '%.png' OR filename LIKE '%.PNG' OR filename LIKE '%.gif') ORDER BY RAND()";
     $data = mysqli_query($this->dbc, $query);

$i = 0;



     while ($row = mysqli_fetch_array($data)) {

           $query1 = "SELECT * FROM ideas WHERE file_path ='".dirname($row['path'])."' AND file_name ='".basename($row['path'])."' LIMIT 1";
     $data1 = mysqli_query($this->dbc, $query1);

     $isPub = false;
     $row1 = mysqli_fetch_array($data1);
            if($row1['file_private'] != 1){
               $isPub = true;
             }
      
         if($isPub){
          $file_info = pathinfo($row['filename']);
    
             if(file_exists(ltrim($row['path']  .'/' . $file_info['filename'].'gallery4434.' . $file_info['extension'], '/') )  ){
                 $src[$i] = ltrim($row['path']  .'/' . $file_info['filename'].'gallery4434.' . $file_info['extension'], '/');
              $i++;
             }

           } 
        
          if($i>30){
            break;
            }

       }
  
  

          
            foreach ($src as $img ){
          
            $funcstring = '';
            $funcstring .=  '<div>';
            $funcstring .=  '<img  data-u="image"  src="';
             $funcstring .= $img;
             $funcstring .= '" style="position: relative;"/>';
            $funcstring .= '</div>';
           
         
            }
            

           return  $funcstring; 
}



private function home2(){

   $funcstring = file_get_contents('seo/views/home2.php');
 return  $funcstring; 
}


/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////Main Public MEthod /////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function serve_crawlpage(){
 
 $crawlpage =  $this->get_top().$this->get_head() . $this->get_body() . $this->get_footer();
 
 $getpage = str_replace('#!', 'https://cirrusidea.com/#!', $crawlpage );
 
     

    return ($getpage);
    
    
        
 }  

//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////Main Public MEthod /////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////   
} 







?>