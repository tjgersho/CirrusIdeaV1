<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


 ///Model Prototype ///      
  //Create Model Thoughts Model///
 //       self.thoughts = {current: 1,
         	
  //       	thoughtarray: [{
   //      	 id: 1,
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
 //        	},
  //       	{
   //      	 id: 2,
    //     	 date: '2/15/15',
    //     	 headline: 'This is an example post',
    //     	 file_name: 'something.mpg4',
    //     	 file_type: 'other',
    //     	 file_size: 12392398,
    //     	 path: '/files/Engineering',
    //     	 member_id: 1,
//		 private: false,
//		 rating: 1         	
 //        	},
  //       	{
   //      	 id: 3,
    //     	 date: '8/15/15',
    //     	 headline: 'This is an example post be last!',
     //    	 file_name: 'something.mpg4',
      //   	 file_type: 'video',
      //   	 file_size: 12392398,
       //  	 path: '/files/Engineering',
        // 	 member_id: 1,
//		 private: true,
//		 rating: 11        	
  //       	},
    //    	{
      //   	 id: 4,
        // 	 date: '5/15/15',
     //    	 headline: 'This is an example post',
      //   	 file_name: 'something.jpg',
     //    	 file_type: 'image',
      //   	 file_size: 12392398,
     //    	 path: '/files/Engineering',
      //   	 member_id: 1,
//		 private: false,
//		 rating: 1150         	
  //       	}
        	
//         	]

     //    	};



// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


$user_id = $request->user_id;
$username = $request->username;
$page = $request->viewpag;

if($_SESSION['username'] == $username && $_SESSION['user_id'] == $user_id){
  
    ///// First Check to see if the file if public exists ///
 
$thoughtarray = array();
$query = "SELECT * FROM thoughts WHERE member_id = '".$user_id ."'";
$data = mysqli_query($dbc, $query);
 $total  = mysqli_num_rows($data);
      


  
   $cur_page = $page;
  $results_per_page = 20;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);
 
  
  $num_pages = ceil($total  / $results_per_page);
  
  
$query = "SELECT * FROM thoughts WHERE member_id = '".$user_id ."' ORDER BY date DESC LIMIT ".$skip.", ".$results_per_page;
$data = mysqli_query($dbc, $query);
        
 
  $i = 0;
       

         
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
	          
	          $thoughtarray[$i]['membername'] = $username;
	          
	       
	          

	          
                  $thoughtarray[$i]['ideapath'] =  dirname(ltrim ($row['path'], '/')); 
                  if($thoughtarray[$i]['ideapath'] == 'files'){
                     $thoughtarray[$i]['isCategory'] = true;
                  }else{
                     $thoughtarray[$i]['isCategory'] = false;
                  }
                 
                  
                   
                  $thoughtarray[$i]['idea'] =  basename($row['path']);  
                  
	          
	         	           
	
	          $thoughtarray[$i]['rating'] = $row['rating'];
                   
                  $queryrr = "SELECT rating FROM thoughts WHERE path = '".$path.'/'.$page."' ORDER by rating DESC LIMIT 1";
                  $datarr = mysqli_query($dbc, $queryrr);
                  $rowrr = mysqli_fetch_array($datarr);
                  if($rowrr['rating']>0){
                 $thoughtarray[$i]['percentratingstyle']['width']  = round($thoughtarray[$i]['rating']/$rowrr['rating']*100) . '%';
                   }else{
                   $thoughtarray[$i]['percentratingstyle']['width']  = '0%';
                   }
                   
                   
                   $thoughtarray[$i]['pag'] = $pag;
                  
                    	          
	           $i++;
	           }
	           
   
       
         
            
                           
$thoughts= array();
   $thoughts['query'] = $query; 
   $thoughts['current'] = 1;
   $thoughts['numPages'] = $num_pages;
   $thoughts['thoughtarray'] =   $thoughtarray;
     
            
echo json_encode($thoughts); 

 }

?>