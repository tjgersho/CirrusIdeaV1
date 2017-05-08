<?php

require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $path = $request->path;
  $page = $request->page;
  $focusthought_id = $request->focusthought_id;

  $getmodel = $request->get;
  $order = $request->order;

 
 
   // Calculate pagination information

  $results_per_page = 20;  // number of results per page
    
          if($getmodel == 1){
       
  
$query = "SELECT * FROM thoughts WHERE path = '".$path.'/'.$page."' ORDER by " . $order;
$data = mysqli_query($dbc, $query);

$viewabletotal = mysqli_num_rows($data);

  $num_pages = ceil($viewabletotal  / $results_per_page);

$itsOnPage = 1;
$iter = 0;


while($row = mysqli_fetch_array($data)){

if($row['id'] == $focusthought_id){


echo $itsOnPage;
exit();
}

 $iter++;
 
 if ($iter >19){
 $iter = 0;
 $itsOnPage ++;
 
 }

}
      }      

header(' ', true, 400);
	    	$arr = array('msg' => "The Thought ID was not found..", 'error' => '');
                $jsn = json_encode($arr);

	    	
		  print_r($jsn);
               exit();


?>