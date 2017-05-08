<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


  
  // This function builds a search query from the search keywords and sort setting
  function build_query($user_search, $sort = 'username ASC') {
    $search_query = "SELECT * FROM users";

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
        $where_list[] = "username LIKE '%".$word."%'";
         $where_list[] = "first_name LIKE '%".$word."%'";
          $where_list[] = "last_name LIKE '%".$word."%'";
          $where_list[] = "email LIKE '%".$word."%'";
      }
    }
     
    $where_clause = implode(' OR ', $where_list);

    // Add the keyword WHERE clause to the search query
    if (!empty($where_clause)) {
      $search_query .= " WHERE (" . $where_clause . ") AND privateprofile != '1'";
    }
   
    // Sort the search query using the sort setting
    switch ($sort) {
    case 'username DESC':
      $search_query .= " ORDER BY username DESC";
      break;
  
    case 'username ASC':
      $search_query .= " ORDER BY username ASC";
      break;
      
    case 'cred DESC':
      $search_query .= " ORDER BY cred DESC";
      break;
      
    case 'cred ASC':
      $search_query .= " ORDER BY cred ASC";
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
 

  // Query to get the total results 
  $query = build_query($searchterm, $sort);
   
   $resp['query'] = $query;
  
  
  $initialresult = mysqli_query($dbc, $query);
  
  $initresp['memberarray'] = array();
  $viewabletotal = 0;
   $i=0;
   while ($row = mysqli_fetch_array($initialresult)) {
       
		if ($row['privateprifile']=='1'){

		$query99 = "SELECT * FROM userprivacy WHERE user_id ='".$row['user_id']."' AND user_name ='"  . $_SESSION['username'] . "'";
  		$data99 = mysqli_query($dbc, $query99);
	                if(mysqli_num_rows($data99)>0){
	 		$viewabletotal =$viewabletotal +1; 
	 		$initresp['memberarray'][$i]['membername'] = $row['username']; 
	 		$initresp['memberarray'][$i]['interest'] = $row['interest']; 
	 		$initresp['memberarray'][$i]['cred'] = $row['cred']; 
	 		
	 		$query56 = "SELECT cred FROM users ORDER BY cred DESC LIMIT 1";
  		         $data56 = mysqli_query($dbc, $query56);
  		         $row56 = mysqli_fetch_array($data56);
  		         
	 		$percentcred = round($row['cred']/$row56['cred']*100,0);
	 		
	 		$initresp['memberarray'][$i]['percentcredstyle']['width'] = $percentcred . '%';
	 		
	 					
		 	$i++;
		 		
	 				
	 		 }
	 		
                 }else{
		$viewabletotal =$viewabletotal +1;
		$initresp['memberarray'][$i]['membername'] = $row['username']; 
	 		$initresp['memberarray'][$i]['interest'] = $row['interest']; 
	 		$initresp['memberarray'][$i]['cred'] = $row['cred']; 
	 		$query56 = "SELECT cred FROM users ORDER BY cred DESC LIMIT 1";
  		         $data56 = mysqli_query($dbc, $query56);
  		         $row56 = mysqli_fetch_array($data56);
  		         
	 		$percentcred = round($row['cred']/$row56['cred']*100,0);
	 		$initresp['memberarray'][$i]['percentcredstyle']['width'] = $percentcred . '%';
	 	  $i++;

		}
   
    }
  
  
  
  

  
  $num_pages = ceil($viewabletotal  / $results_per_page);
$resp['numpages'] = $num_pages;
$resp['memberarray'] = array();
$j = 0;

if($viewabletotal > 0){
    for ($i=$skip; $i<$skip+$results_per_page; $i++){     
          if(isset($initresp['memberarray'][$i])){
 		$resp['memberarray'][$j] = $initresp['memberarray'][$i];
 		$j++; 	
 		}	
   } 
   }
  
  $resp['i_totalvieable_check'] = $i . ' To ' . $viewabletotal;
  
   
  
  
  
  echo json_encode($resp);
  
  
   
  
 ?>