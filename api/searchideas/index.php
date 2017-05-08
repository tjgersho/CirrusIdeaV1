<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


  
  // This function builds a search query from the search keywords and sort setting
  function build_query($user_search, $sort = 2) {
    $search_query = "SELECT * FROM ideas";

    // Extract the search keywords into an array
    $clean_search = str_replace(',', ' ', $user_search);
    $search_words = explode(' ', $clean_search);
    $final_search_words = array();
    if (count($search_words) > 0) {
      foreach ($search_words as $word) {
        if (!empty($word)) {
          $final_search_words[] = $word;
        }
      }
    }

    // Generate a WHERE clause using all of the search keywords
    $where_list = array();
    if (count($final_search_words) > 0) {
      foreach($final_search_words as $word) {
        $where_list[] = "file_path LIKE '%".$word."%'";
         $where_list[] = "file_name LIKE '%".$word."%'";
          $where_list[] = "p_descript LIKE '%".$word."%'";
      }
    }
     
    $where_clause = implode(' OR ', $where_list);

    // Add the keyword WHERE clause to the search query
    if (!empty($where_clause)) {
      $search_query .= " WHERE " . $where_clause;
    }
   
    // Sort the search query using the sort setting
    switch ($sort) {
    case 1:
      $search_query .= " ORDER BY file_id ASC";
      break;
  
    case 2:
      $search_query .= " ORDER BY file_id DESC";
      break;
       default:
      // No sort setting provided, so don't sort the query
    }

    return $search_query;
  }
    
    
    
  
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
 

  $searchterm = $request->searchterm;
  $page = $request->page;
   $sort = $request->sort;
  
  $resp = array();
 $initresp = array();

 // $resp['numpages'] = 100;

  $resp['originalsearchterm'] =  $searchterm;
  
    // Calculate pagination information
  $cur_page = $page;
  $results_per_page = 20;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);
 
   $sort = 2;


  // Query to get the total results 
  $query = build_query($searchterm, $sort);
   
   $resp['query'] = $query;
  
  
  $initialresult = mysqli_query($dbc, $query);
  
  $initresp['ideaarray'] = array();
  $viewabletotal = 0;
   $i=0;
   while ($row = mysqli_fetch_array($initialresult)) {
       
		if ($row['file_private']=='1'){

		$query99 = "SELECT * FROM folderprivacy WHERE folderID ='".$row['file_id']."' AND user_name ='"  . $_SESSION['username'] . "'";
  		$data99 = mysqli_query($dbc, $query99);
	                if(mysqli_num_rows($data99)>0){
	 		$viewabletotal =$viewabletotal +1; 
	 		$initresp['ideaarray'][$i]['file_name'] = $row['file_name']; 
	 		$initresp['ideaarray'][$i]['file_path'] = $row['file_path']; 
	 		$initresp['ideaarray'][$i]['p_descript'] = $row['p_descript']; 
	 		if($row['file_path'] == '/files'){
	 		$initresp['ideaarray'][$i]['isCat'] = 1; 		
	 		}else{
	 		$initresp['ideaarray'][$i]['isCat'] = 0; 
	 		}
	 		  $initresp['ideaarray'][$i]['type']['publicidea'] = 0;
		          $initresp['ideaarray'][$i]['type']['privateidea'] = 1;
		        $initresp['ideaarray'][$i]['type1']['btn btn-success'] = 0;
		          $initresp['ideaarray'][$i]['type1']['btn btn-info'] = 1;
	
		 	$i++;
		 		
	 				
	 		 }
	 		
                 }else{
		$viewabletotal =$viewabletotal +1;
		
		$initresp['ideaarray'][$i]['file_name'] = $row['file_name']; 
 		$initresp['ideaarray'][$i]['file_path'] = $row['file_path']; 
 		$initresp['ideaarray'][$i]['p_descript'] = $row['p_descript']; 
 		if($row['file_path'] == '/files'){
 		$initresp['ideaarray'][$i]['isCat'] = 1; 		
 		}else{
 		$initresp['ideaarray'][$i]['isCat'] = 0; 
 		}
 		 $initresp['ideaarray'][$i]['type']['publicidea'] = 1;
	         $initresp['ideaarray'][$i]['type']['privateidea'] = 0;
	         $initresp['ideaarray'][$i]['type1']['btn btn-success'] = 1;
	          $initresp['ideaarray'][$i]['type1']['btn btn-info'] = 0;
                $i++;

		}
   
    }
  
  
  
  

  
  $num_pages = ceil($viewabletotal  / $results_per_page);
$resp['numpages'] = $num_pages;
$resp['ideaarray'] = array();
$j = 0;

if($viewabletotal > 0){
    for ($i=$skip; $i<$skip+$results_per_page; $i++){     
          if(isset($initresp['ideaarray'][$i])){
 		$resp['ideaarray'][$j] = $initresp['ideaarray'][$i];
 		$j++; 	
 		}	
   } 
   }
  
  $resp['i_totalvieable_check'] = $i . ' To ' . $viewabletotal;
  
   
  
  
  
  echo json_encode($resp);
  
  
   
  
 ?>