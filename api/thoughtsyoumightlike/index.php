<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(!isset($_SESSION['user_id'])){
exit();
}  
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
 

  $interest = $request->interest;
  $page = $request->page;
  $sort = $request->sort;



  $thoughtarray = array();

    // Calculate pagination information
  $cur_page = $page;
  $results_per_page = 20;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);
 

if(empty($interst)){

// Query to get the total results 
  $query11 =  "SELECT * FROM users WHERE user_id != '".$_SESSION['user_id']."'";  
  
}else{
  // Query to get the total results 
  $query11 =  "SELECT * FROM users WHERE interest = '".$interest ."' AND user_id != '".$_SESSION['user_id']."'";    
}
  $data11 = mysqli_query($dbc, $query11);
  
  $viewabletotal = 0;
  
   while ($row11 = mysqli_fetch_array($data11)) {
 
   if(!isset($sort)){
    // Query to get the total results 
  $query =  "SELECT * FROM thoughts WHERE member_id = '".$row11['user_id'] ."'";  
  }else{
    $query =  "SELECT * FROM thoughts WHERE member_id = '".$row11['user_id'] ."' ORDER BY " . $sort;  
  }  
  $data = mysqli_query($dbc, $query);
 
     while ($row = mysqli_fetch_array($data)) {

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
   
    }
  
  
  
  

  
  $num_pages = ceil($viewabletotal  / $results_per_page);


if(!isset($sort)){
$sort = 1;  /// No Sort////
}
 switch ($sort){
 case 'date DESC':
 
 
  $n = $i;
    do {
          $swapped = false;
       for ($i = 1; $i<$n; $i++){
          if ($thoughtarray[$i-1]['date'] < $thoughtarray[$i]['date']){
            
               $tempstyle =  $thoughtarray[$i]['percentratingstyle']['width'];
               $temprating = $thoughtarray[$i]['rating'];
               $tempidea = $thoughtarray[$i]['idea'];
               $tempisCat = $thoughtarray[$i]['isCategory'];
               $tempideapath = $thoughtarray[$i]['ideapath'];
               $tempmemname = $thoughtarray[$i]['membername'];
               $tempmemID =  $thoughtarray[$i]['member_id'];
               $temppath =  $thoughtarray[$i]['path'];
               $tempfilesize =  $thoughtarray[$i]['file_size'];
               $tempfiletype =   $thoughtarray[$i]['file_type'];
               $tempgallery =    $thoughtarray[$i]['gallery'];
               $tempthumbnail =    $thoughtarray[$i]['thumbnail'];
               $tempid =    $thoughtarray[$i]['id'];
               $tempdate =    $thoughtarray[$i]['date'];
               $tempheadline =    $thoughtarray[$i]['headline'];
               $tempfilename =    $thoughtarray[$i]['file_name'];
                   
                   
                   
               $thoughtarray[$i]['percentratingstyle']['width'] = $thoughtarray[$i-1]['percentratingstyle']['width'];
               $thoughtarray[$i]['rating'] =  $thoughtarray[$i-1]['rating'];
               $thoughtarray[$i]['idea'] = $thoughtarray[$i-1]['idea'];
               $thoughtarray[$i]['isCategory'] = $thoughtarray[$i-1]['isCategory'];
               $thoughtarray[$i]['ideapath'] =  $thoughtarray[$i-1]['ideapath'];
               $thoughtarray[$i]['membername'] =  $thoughtarray[$i-1]['membername'];
               $thoughtarray[$i]['member_id'] = $thoughtarray[$i-1]['member_id'];
               $thoughtarray[$i]['path'] = $thoughtarray[$i-1]['path'];
               $thoughtarray[$i]['file_size'] =  $thoughtarray[$i-1]['file_size'];
               $thoughtarray[$i]['file_type'] = $thoughtarray[$i-1]['file_type'];
               $thoughtarray[$i]['gallery'] = $thoughtarray[$i-1]['gallery'];
               $thoughtarray[$i]['thumbnail'] = $thoughtarray[$i-1]['thumbnail'];
               $thoughtarray[$i]['id'] = $thoughtarray[$i-1]['id'];
               $thoughtarray[$i]['date'] = $thoughtarray[$i-1]['date'];
               $thoughtarray[$i]['headline'] =       $thoughtarray[$i-1]['headline'];
               $thoughtarray[$i]['file_name']   =  $thoughtarray[$i-1]['file_name'];
                   
                     
               $thoughtarray[$i-1]['percentratingstyle']['width'] =  $tempstyle;
               $thoughtarray[$i-1]['rating'] =  $temprating;
               $thoughtarray[$i-1]['idea'] = $tempidea;
               $thoughtarray[$i-1]['isCategory'] =  $tempisCat;
               $thoughtarray[$i-1]['ideapath'] =   $tempideapath;
               $thoughtarray[$i-1]['membername'] =  $tempmemname;
               $thoughtarray[$i-1]['member_id'] = $tempmemID;
               $thoughtarray[$i-1]['path'] = $temppath;
               $thoughtarray[$i-1]['file_size'] =  $tempfilesize;
               $thoughtarray[$i-1]['file_type'] = $tempfiletype;
               $thoughtarray[$i-1]['gallery'] =  $tempgallery;
               $thoughtarray[$i-1]['thumbnail'] = $tempthumbnail;
               $thoughtarray[$i-1]['id'] = $tempid;
               $thoughtarray[$i-1]['date'] = $tempdate;
               $thoughtarray[$i-1]['headline'] =      $tempheadline;
               $thoughtarray[$i-1]['file_name']   = $tempfilename;           
                       
          
           
                                      
                                      
                $swapped = true;
          }
       }
        $n = $n-1;

   }while($swapped);


 
 
 break;
 case  'date ASC':
 
 
  $n = $i;
    do {
          $swapped = false;
       for ($i = 1; $i<$n; $i++){
          if ($thoughtarray[$i-1]['date'] > $thoughtarray[$i]['date']){
            
               $tempstyle =  $thoughtarray[$i]['percentratingstyle']['width'];
               $temprating = $thoughtarray[$i]['rating'];
               $tempidea = $thoughtarray[$i]['idea'];
               $tempisCat = $thoughtarray[$i]['isCategory'];
               $tempideapath = $thoughtarray[$i]['ideapath'];
               $tempmemname = $thoughtarray[$i]['membername'];
               $tempmemID =  $thoughtarray[$i]['member_id'];
               $temppath =  $thoughtarray[$i]['path'];
               $tempfilesize =  $thoughtarray[$i]['file_size'];
               $tempfiletype =   $thoughtarray[$i]['file_type'];
               $tempgallery =    $thoughtarray[$i]['gallery'];
               $tempthumbnail =    $thoughtarray[$i]['thumbnail'];
               $tempid =    $thoughtarray[$i]['id'];
               $tempdate =    $thoughtarray[$i]['date'];
               $tempheadline =    $thoughtarray[$i]['headline'];
               $tempfilename =    $thoughtarray[$i]['file_name'];
                   
                   
                   
               $thoughtarray[$i]['percentratingstyle']['width'] = $thoughtarray[$i-1]['percentratingstyle']['width'];
               $thoughtarray[$i]['rating'] =  $thoughtarray[$i-1]['rating'];
               $thoughtarray[$i]['idea'] = $thoughtarray[$i-1]['idea'];
               $thoughtarray[$i]['isCategory'] = $thoughtarray[$i-1]['isCategory'];
               $thoughtarray[$i]['ideapath'] =  $thoughtarray[$i-1]['ideapath'];
               $thoughtarray[$i]['membername'] =  $thoughtarray[$i-1]['membername'];
               $thoughtarray[$i]['member_id'] = $thoughtarray[$i-1]['member_id'];
               $thoughtarray[$i]['path'] = $thoughtarray[$i-1]['path'];
               $thoughtarray[$i]['file_size'] =  $thoughtarray[$i-1]['file_size'];
               $thoughtarray[$i]['file_type'] = $thoughtarray[$i-1]['file_type'];
               $thoughtarray[$i]['gallery'] = $thoughtarray[$i-1]['gallery'];
               $thoughtarray[$i]['thumbnail'] = $thoughtarray[$i-1]['thumbnail'];
               $thoughtarray[$i]['id'] = $thoughtarray[$i-1]['id'];
               $thoughtarray[$i]['date'] = $thoughtarray[$i-1]['date'];
               $thoughtarray[$i]['headline'] =       $thoughtarray[$i-1]['headline'];
               $thoughtarray[$i]['file_name']   =  $thoughtarray[$i-1]['file_name'];
                   
                     
               $thoughtarray[$i-1]['percentratingstyle']['width'] =  $tempstyle;
               $thoughtarray[$i-1]['rating'] =  $temprating;
               $thoughtarray[$i-1]['idea'] = $tempidea;
               $thoughtarray[$i-1]['isCategory'] =  $tempisCat;
               $thoughtarray[$i-1]['ideapath'] =   $tempideapath;
               $thoughtarray[$i-1]['membername'] =  $tempmemname;
               $thoughtarray[$i-1]['member_id'] = $tempmemID;
               $thoughtarray[$i-1]['path'] = $temppath;
               $thoughtarray[$i-1]['file_size'] =  $tempfilesize;
               $thoughtarray[$i-1]['file_type'] = $tempfiletype;
               $thoughtarray[$i-1]['gallery'] =  $tempgallery;
               $thoughtarray[$i-1]['thumbnail'] = $tempthumbnail;
               $thoughtarray[$i-1]['id'] = $tempid;
               $thoughtarray[$i-1]['date'] = $tempdate;
               $thoughtarray[$i-1]['headline'] =      $tempheadline;
               $thoughtarray[$i-1]['file_name']   = $tempfilename;           
                       
          
           
                                      
                                      
                $swapped = true;
          }
       }
        $n = $n-1;

   }while($swapped);



 break;
 
 case 'rating DESC':
 
 
  $n = $i;
    do {
          $swapped = false;
       for ($i = 1; $i<$n; $i++){
          if ($thoughtarray[$i-1]['rating'] < $thoughtarray[$i]['rating']){
            
               $tempstyle =  $thoughtarray[$i]['percentratingstyle']['width'];
               $temprating = $thoughtarray[$i]['rating'];
               $tempidea = $thoughtarray[$i]['idea'];
               $tempisCat = $thoughtarray[$i]['isCategory'];
               $tempideapath = $thoughtarray[$i]['ideapath'];
               $tempmemname = $thoughtarray[$i]['membername'];
               $tempmemID =  $thoughtarray[$i]['member_id'];
               $temppath =  $thoughtarray[$i]['path'];
               $tempfilesize =  $thoughtarray[$i]['file_size'];
               $tempfiletype =   $thoughtarray[$i]['file_type'];
               $tempgallery =    $thoughtarray[$i]['gallery'];
               $tempthumbnail =    $thoughtarray[$i]['thumbnail'];
               $tempid =    $thoughtarray[$i]['id'];
               $tempdate =    $thoughtarray[$i]['date'];
               $tempheadline =    $thoughtarray[$i]['headline'];
               $tempfilename =    $thoughtarray[$i]['file_name'];
                   
                   
                   
               $thoughtarray[$i]['percentratingstyle']['width'] = $thoughtarray[$i-1]['percentratingstyle']['width'];
               $thoughtarray[$i]['rating'] =  $thoughtarray[$i-1]['rating'];
               $thoughtarray[$i]['idea'] = $thoughtarray[$i-1]['idea'];
               $thoughtarray[$i]['isCategory'] = $thoughtarray[$i-1]['isCategory'];
               $thoughtarray[$i]['ideapath'] =  $thoughtarray[$i-1]['ideapath'];
               $thoughtarray[$i]['membername'] =  $thoughtarray[$i-1]['membername'];
               $thoughtarray[$i]['member_id'] = $thoughtarray[$i-1]['member_id'];
               $thoughtarray[$i]['path'] = $thoughtarray[$i-1]['path'];
               $thoughtarray[$i]['file_size'] =  $thoughtarray[$i-1]['file_size'];
               $thoughtarray[$i]['file_type'] = $thoughtarray[$i-1]['file_type'];
               $thoughtarray[$i]['gallery'] = $thoughtarray[$i-1]['gallery'];
               $thoughtarray[$i]['thumbnail'] = $thoughtarray[$i-1]['thumbnail'];
               $thoughtarray[$i]['id'] = $thoughtarray[$i-1]['id'];
               $thoughtarray[$i]['date'] = $thoughtarray[$i-1]['date'];
               $thoughtarray[$i]['headline'] =       $thoughtarray[$i-1]['headline'];
               $thoughtarray[$i]['file_name']   =  $thoughtarray[$i-1]['file_name'];
                   
                     
               $thoughtarray[$i-1]['percentratingstyle']['width'] =  $tempstyle;
               $thoughtarray[$i-1]['rating'] =  $temprating;
               $thoughtarray[$i-1]['idea'] = $tempidea;
               $thoughtarray[$i-1]['isCategory'] =  $tempisCat;
               $thoughtarray[$i-1]['ideapath'] =   $tempideapath;
               $thoughtarray[$i-1]['membername'] =  $tempmemname;
               $thoughtarray[$i-1]['member_id'] = $tempmemID;
               $thoughtarray[$i-1]['path'] = $temppath;
               $thoughtarray[$i-1]['file_size'] =  $tempfilesize;
               $thoughtarray[$i-1]['file_type'] = $tempfiletype;
               $thoughtarray[$i-1]['gallery'] =  $tempgallery;
               $thoughtarray[$i-1]['thumbnail'] = $tempthumbnail;
               $thoughtarray[$i-1]['id'] = $tempid;
               $thoughtarray[$i-1]['date'] = $tempdate;
               $thoughtarray[$i-1]['headline'] =      $tempheadline;
               $thoughtarray[$i-1]['file_name']   = $tempfilename;           
                       
          
           
                                      
                                      
                $swapped = true;
          }
       }
        $n = $n-1;

   }while($swapped);



 
 break;
 
 case  'rating ASC':
  
   $n = $i;
    do {
          $swapped = false;
       for ($i = 1; $i<$n; $i++){
          if ($thoughtarray[$i-1]['rating'] > $thoughtarray[$i]['rating']){
            
               $tempstyle =  $thoughtarray[$i]['percentratingstyle']['width'];
               $temprating = $thoughtarray[$i]['rating'];
               $tempidea = $thoughtarray[$i]['idea'];
               $tempisCat = $thoughtarray[$i]['isCategory'];
               $tempideapath = $thoughtarray[$i]['ideapath'];
               $tempmemname = $thoughtarray[$i]['membername'];
               $tempmemID =  $thoughtarray[$i]['member_id'];
               $temppath =  $thoughtarray[$i]['path'];
               $tempfilesize =  $thoughtarray[$i]['file_size'];
               $tempfiletype =   $thoughtarray[$i]['file_type'];
               $tempgallery =    $thoughtarray[$i]['gallery'];
               $tempthumbnail =    $thoughtarray[$i]['thumbnail'];
               $tempid =    $thoughtarray[$i]['id'];
               $tempdate =    $thoughtarray[$i]['date'];
               $tempheadline =    $thoughtarray[$i]['headline'];
               $tempfilename =    $thoughtarray[$i]['file_name'];
                   
                   
                   
               $thoughtarray[$i]['percentratingstyle']['width'] = $thoughtarray[$i-1]['percentratingstyle']['width'];
               $thoughtarray[$i]['rating'] =  $thoughtarray[$i-1]['rating'];
               $thoughtarray[$i]['idea'] = $thoughtarray[$i-1]['idea'];
               $thoughtarray[$i]['isCategory'] = $thoughtarray[$i-1]['isCategory'];
               $thoughtarray[$i]['ideapath'] =  $thoughtarray[$i-1]['ideapath'];
               $thoughtarray[$i]['membername'] =  $thoughtarray[$i-1]['membername'];
               $thoughtarray[$i]['member_id'] = $thoughtarray[$i-1]['member_id'];
               $thoughtarray[$i]['path'] = $thoughtarray[$i-1]['path'];
               $thoughtarray[$i]['file_size'] =  $thoughtarray[$i-1]['file_size'];
               $thoughtarray[$i]['file_type'] = $thoughtarray[$i-1]['file_type'];
               $thoughtarray[$i]['gallery'] = $thoughtarray[$i-1]['gallery'];
               $thoughtarray[$i]['thumbnail'] = $thoughtarray[$i-1]['thumbnail'];
               $thoughtarray[$i]['id'] = $thoughtarray[$i-1]['id'];
               $thoughtarray[$i]['date'] = $thoughtarray[$i-1]['date'];
               $thoughtarray[$i]['headline'] =       $thoughtarray[$i-1]['headline'];
               $thoughtarray[$i]['file_name']   =  $thoughtarray[$i-1]['file_name'];
                   
                     
               $thoughtarray[$i-1]['percentratingstyle']['width'] =  $tempstyle;
               $thoughtarray[$i-1]['rating'] =  $temprating;
               $thoughtarray[$i-1]['idea'] = $tempidea;
               $thoughtarray[$i-1]['isCategory'] =  $tempisCat;
               $thoughtarray[$i-1]['ideapath'] =   $tempideapath;
               $thoughtarray[$i-1]['membername'] =  $tempmemname;
               $thoughtarray[$i-1]['member_id'] = $tempmemID;
               $thoughtarray[$i-1]['path'] = $temppath;
               $thoughtarray[$i-1]['file_size'] =  $tempfilesize;
               $thoughtarray[$i-1]['file_type'] = $tempfiletype;
               $thoughtarray[$i-1]['gallery'] =  $tempgallery;
               $thoughtarray[$i-1]['thumbnail'] = $tempthumbnail;
               $thoughtarray[$i-1]['id'] = $tempid;
               $thoughtarray[$i-1]['date'] = $tempdate;
               $thoughtarray[$i-1]['headline'] =      $tempheadline;
               $thoughtarray[$i-1]['file_name']   = $tempfilename;           
                       
          
           
                                      
                                      
                $swapped = true;
          }
       }
        $n = $n-1;

   }while($swapped);




  
 break;
 
 default:
 }

/////Bubble Sort ////

  
$num_pages = ceil($viewabletotal  / $results_per_page);
$resp['numpages'] = $num_pages;
$resp['ideaarray'] = array();
$j = 0;
 $respthoughtarray = array();
  
if($viewabletotal > 0){
    for ($i=$skip; $i<$skip+$results_per_page; $i++){     
              if(isset($thoughtarray[$i])){
 		$respthoughtarray[$j] = $thoughtarray[$i];
 		$j++; 	
 		}
 			
   } 
  }
 
 
 
                            
$thoughts= array();

 
   $thoughts['current'] = 1;
   $thoughts['numPages'] = $num_pages;
   $thoughts['thoughtarray'] =   $respthoughtarray;
 
  
            
echo json_encode($thoughts); 
  
   
  
 
  
 ?>