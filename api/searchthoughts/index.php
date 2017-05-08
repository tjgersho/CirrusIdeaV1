<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



  
  // This function builds a search query from the search keywords and sort setting
  function build_query($user_search, $sortf = 'date DESC') {
    $search_query = "SELECT * FROM thoughts";

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
        $where_list[] = "headline LIKE '%".$word."%'";
         $where_list[] = "filename LIKE '%".$word."%'";
          $where_list[] = "path LIKE '%".$word."%'";
      }
    }
     
    $where_clause = implode(' OR ', $where_list);

    // Add the keyword WHERE clause to the search query
    if (!empty($where_clause)) {
      $search_query .= " WHERE " . $where_clause;
    }
  
  
   
    // Sort the search query using the sort setting
    switch ($sortf) {
    case 'date DESC':
      $search_query .= " ORDER BY date DESC";
      break;
  
    case 'date ASC':
      $search_query .= " ORDER BY date ASC";
      break;
      
     case 'rating DESC':
      $search_query .= " ORDER BY rating DESC";
      break;
      
      case 'rating ASC':
      $search_query .= " ORDER BY rating ASC";
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


    
     $respthoughtarray = array();
  $thoughtarray = array();
  
    // Calculate pagination information
  $cur_page = $page;
  $results_per_page = 20;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);
 



  // Query to get the total results 
  $query = build_query($searchterm, $sort);
   
     
  
  $initialresult = mysqli_query($dbc, $query);
  
  $viewabletotal = 0;
   while ($row = mysqli_fetch_array($initialresult)) {
         $viewable = false;
////////////////
//////// lookup the idea, and determine if it is private.. if so, determine if user has access to view../////
////////////////
     $ideapath = dirname($row['path']);
     if(dirname($ideapath) == "."){
         $ideapath = '/files';
       }   
        $ideapage = basename($row['path']);

      $query55 = "SELECT * FROM ideas WHERE file_path = '".$ideapath."' AND file_name = '".$ideapage."'";
        $data55 = mysqli_query($dbc, $query55);
         $row55 = mysqli_fetch_array($data55);
        

			
		if ($row55['file_private'] == '1'){
                   if(isset($_SESSION['username'])){
		$query99 = "SELECT * FROM folderprivacy WHERE folderID ='".$row55['file_id']."' AND user_name ='"  . $_SESSION['username'] . "'";
  		$data99 = mysqli_query($dbc, $query99);
	                if(mysqli_num_rows($data99)>0){
	 		$viewable = true;		
	 		 }
	 		}           
			}else{
		$viewable = true;
		}




                 if($viewable){
                 $viewabletotal =$viewabletotal +1;
                 
                  $thoughtarray[$i]['id'] = $row['id'];
	          $thoughtarray[$i]['date'] = $row['date']; //(string)(strtotime($row['date']));
	          $thoughtarray[$i]['headline'] = substr($row['headline'],0,164);
	          $thoughtarray[$i]['file_name'] = $row['filename'];
	          
	          $path_parts = pathinfo($row['filename']);

	          
	          switch ($path_parts['extension']){
	            case 'mpg':
	              $thoughtarray[$i]['file_type'] = 'video';
	               break;
	               
	             case 'MPG':
	              $thoughtarray[$i]['file_type'] = 'video';
	               break;
	               
	            case 'oog':
	             $thoughtarray[$i]['file_type'] = 'video';
	               break;
	               
	             case 'OOG':
	             $thoughtarray[$i]['file_type'] = 'video';
	             
	               break;
	               
	           //  case 'avi':
	             //$thoughtarray[$i]['file_type'] = 'video';
                       //break;
	            case 'mov':
	             $thoughtarray[$i]['file_type'] = 'video';
	           
	               break;
	               
	            case 'MOV':
	             $thoughtarray[$i]['file_type'] = 'video';
	             
	               break;
	               
	            case 'jpg':
	            $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	               $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'], '/'); 
	               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 
	               	  break;     
	            case 'JPG':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	               $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'], '/'); 
	               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension'], '/'); 
	               	  break;   
	            case 'png':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'] , '/'); 
	               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension']  , '/'); 
	               	      break;   
	            case 'PNG':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'] , '/'); 
	               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension']  , '/'); 
	               	      break;   
	               	      
	             case 'gif':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'] , '/'); 
	               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension']  , '/'); 
	               	      break;   
	            case 'GIF':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'] , '/'); 
	               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'gallery4434.'.$path_parts['extension']  , '/'); 
	               	      break;           
	             default:
	               $thoughtarray[$i]['file_type'] = 'other';
	              
	           }
	          
	          $thoughtarray[$i]['file_size'] = $row['filesize'];
	          $thoughtarray[$i]['path'] =  ltrim ($row['path'] . '/' . $row['filename'], '/');   
	          $thoughtarray[$i]['member_id'] = $row['member_id'];
	          
	          
                   $query56 = "SELECT username FROM users WHERE user_id = '".$row['member_id']."'";
        $data56 = mysqli_query($dbc, $query56);
         $row56 = mysqli_fetch_array($data56);
         
	          $thoughtarray[$i]['membername'] =  $row56['username'];

	          
	       
	          

	          
                  $thoughtarray[$i]['ideapath'] =  dirname(ltrim ($row['path'], '/')); 
                  if($thoughtarray[$i]['ideapath'] == 'files'){
                     $thoughtarray[$i]['isCategory'] = true;
                  }else{
                     $thoughtarray[$i]['isCategory'] = false;
                  }
                 
                  
                   
                  $thoughtarray[$i]['idea'] =  basename($row['path']);  
                  
	          
	         	           
	
	          $thoughtarray[$i]['rating'] = $row['rating'];
	          
	 
                   
                  $queryrr = "SELECT rating FROM thoughts WHERE path = '".$ideapath .'/'. $ideapage ."' ORDER by rating DESC LIMIT 1";
                  $datarr = mysqli_query($dbc, $queryrr);
                  $rowrr = mysqli_fetch_array($datarr);
                  if($rowrr['rating']>0){
                 $thoughtarray[$i]['percentratingstyle']['width']  = round($thoughtarray[$i]['rating']/$rowrr['rating']*100) . '%';
                   }else{
                   $thoughtarray[$i]['percentratingstyle']['width']  = '0%';
                   }
                   
                   
                        
                    	          
	           $i++;
	           
			}  // End If Viewable IF///

		
   
    }
  
  
  
  

  
  $num_pages = ceil($viewabletotal  / $results_per_page);


  
  $num_pages = ceil($viewabletotal  / $results_per_page);
$resp['numpages'] = $num_pages;
$resp['ideaarray'] = array();
$j = 0;

if($viewabletotal > 0){
    for ($i=$skip; $i<$skip+$results_per_page; $i++){     
              if(isset($thoughtarray[$i])){
 		$respthoughtarray[$j] = $thoughtarray[$i];
 		$j++; 	
 		}	
   } 
  }
 
 
 
                            
$thoughts= array();

     $thoughts['i_totalvieable_check'] = $i . ' To ' . $viewabletotal;
  
   $thoughts['query'] = $query; 
   $thoughts['current'] = 1;
   $thoughts['numPages'] = $num_pages;
   $thoughts['thoughtarray'] =   $respthoughtarray;
    $thoughts['i_totalvieable_check'] = $i . ' To ' . $viewabletotal;
  
   $thoughts['originalsearchterm'] =  $searchterm;
  
  
            
echo json_encode($thoughts); 
  
   
  
 
  
 ?>