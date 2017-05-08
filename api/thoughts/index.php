<?php
ignore_user_abort(true);
set_time_limit(0);
////////////////////////////////////////////////////
///////////////////Thumbnail Function////////////////////

function resizepics($pics, $newwidth, $newheight, $gallery=NULL){

$newpicname = basename($pics);
  $pic_parts = pathinfo( $newpicname);
 // echo "hello";
 if($gallery){
     $newpicname = $pic_parts['filename'] . 'gallery4434';
     
 } else{
  $newpicname = $pic_parts['filename'] . 'thum63820';
 }
 
$extension = $pic_parts['extension'];

//$pics = str_replace(" ", "%20" , $pics);
//echo $pics;
list($width, $height) = getimagesize($pics);
  

if (($width/$height) > 1.333)
{  
 $newheight = ($height / $width) * $newwidth;   

}else {
           $newwidth = ($width / $height) * $newheight; 
} 

    if(preg_match("/.jpg/i", basename($pics) )){
    $source = imagecreatefromjpeg($pics);
    }
   
    if(preg_match("/.jpeg/i", basename($pics))){
    $source = imagecreatefromjpeg($pics);
    }
    if(preg_match("/.png/i", basename($pics))){
    $source = imagecreatefrompng($pics);
    imageAlphaBlending( $source, true);
    imageSaveAlpha( $source, true);
    }
    if(preg_match("/.gif/i", basename($pics))){
    $source = imagecreatefromgif($pics);
    }
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
   
   $filedir = dirname($pics);
   //echo 'ECHO THE FILE DIR VARIABLE IN RESIZE PICS ' . $filedir;
   
  if(preg_match("/.jpg/i", basename($pics))){ 
	if(ctype_upper($extension)){
	   return imagejpeg($thumb, $filedir .'/'. $newpicname . '.JPG');
	}
	else {
	     return imagejpeg($thumb, $filedir .'/'. $newpicname . '.jpg');
	} 
    }
   

    if(preg_match("/.jpeg/i", basename($pics))){
    return imagejpeg($thumb, $filedir . '/'.$newpicname . '.jpeg');
   }
    if(preg_match("/.png/i", basename($pics))){
      if(ctype_upper($extension)){  
    return imagepng($thumb, $filedir . '/'.$newpicname . '.PNG');
      
      }else {
    return imagepng($thumb, $filedir . '/'.$newpicname . '.png');
    }
    
   }
    if(preg_match("/.gif/i", basename($pics))){
    return imagegif($thumb, $filedir .'/'. $newpicname . '.gif');
    }
    

}


////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////




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


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $path = $request->path;
  $page = $request->page;
  $new_thought = $request->thought;
  $file_name = $request->filename;
  $getmodel = $request->get;
  $order = $request->order;

 $viewpage = $request->whichpage;
 
 
 
 
 
$thoughtarray = array();

 $getmodelOK = false;

   $query = "SELECT * FROM ideas WHERE file_path = '".$path."' AND file_name = '".$page."'";
   $data = mysqli_query($dbc, $query);
   $row = mysqli_fetch_array($data);
       if($row['file_private'] == 1){
       
           $query1 = "SELECT * FROM folderprivacy WHERE folderID = '".$row['file_id']."' AND user_name = '".$_SESSION['username']."'";
           $data1 = mysqli_query($dbc, $query1);
           if(mysqli_num_rows($data1)>0){
             	 $getmodelOK = true;
             	 }
             	 
             }else{
             $getmodelOK = true;
             }



   // Calculate pagination information
  $cur_page = $viewpage;
  $results_per_page = 20;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);


    
          if($getmodelOK){
          
  
$query = "SELECT * FROM thoughts WHERE path = '".$path.'/'.$page."'";
 $data = mysqli_query($dbc, $query);

$viewabletotal = mysqli_num_rows($data);

  $num_pages = ceil($viewabletotal  / $results_per_page);


$query = "SELECT * FROM thoughts WHERE path = '".$path.'/'.$page."' ORDER by " . $order . " LIMIT ".$skip.", ".$results_per_page;

        $data = mysqli_query($dbc, $query);


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
	            case 'JPG':
	            case 'jpeg':
	            case 'JPEG':
	            case 'png':
	            case 'PNG':
	            case 'gif':
	            case 'GIF':
	             $showcase++;
	               $thoughtarray[$i]['file_type'] = 'image';
	                       if (file_exists('../../'. ltrim ($row['path'] .'/'.  $path_parts['filename'] . 'thum63820.'.$path_parts['extension'], '/'))) {
                                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . '.'.$path_parts['extension'], '/'); 
                             }else{
                             
                                 resizepics('../../'. ltrim ($row['path'] .'/'.  $path_parts['filename'] . '.'.$path_parts['extension'], '/'), 300, 225);
                                 
                                 $thoughtarray[$i]['thumbnail'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . '.'.$path_parts['extension'], '/'); 
                             }

	                if (file_exists('../../'. ltrim ($row['path'] .'/'.  $path_parts['filename'] . '.'.$path_parts['extension'], '/'))) {
	                
                               $thoughtarray[$i]['gallery'] = ltrim ($row['path'] .'/'.  $path_parts['filename'] . '.'.$path_parts['extension'], '/'); 
                             }else{
                             
                              resizepics('../../'. ltrim ($row['path'] .'/'.  $path_parts['filename'] . '.'.$path_parts['extension'], '/'), 1000, 1500,1);

                                 $thoughtarray[$i]['gallery'] =   ltrim ($row['path'] .'/'.  $path_parts['filename'] . '.'.$path_parts['extension'], '/'); 
                             }
                            break;           
	             default:
	               $thoughtarray[$i]['file_type'] = 'other';
	              
	           }
	          
	          $thoughtarray[$i]['file_size'] = $row['filesize'];
	           $thoughtarray[$i]['path'] =  ltrim ($row['path'] . '/' . $row['filename'], '/');  
	            $thoughtarray[$i]['pathurlfriendly'] = str_replace(' ' , '%20' ,$thoughtarray[$i]['path']);
	          // $thoughtarray[$i]['pathurlfriendly'] = rawurlencode($thoughtarray[$i]['pathurlfriendly']);
	         
	          $thoughtarray[$i]['member_id'] = $row['member_id'];
	          
	         $query5 = "SELECT username FROM users WHERE user_id = '". $row['member_id']."'";
                 $data5 = mysqli_query($dbc, $query5);
                 $row5 = mysqli_fetch_array($data5);
                   $thoughtarray[$i]['membername'] = $row5['username'];


	          
	          
	          if($row['member_id'] == $_SESSION['user_id']){
	          $thoughtarray[$i]['owner'] = true;
	          }else{
	          $thoughtarray[$i]['owner'] = false;
	          }
	          
	          
	          
                         
	           
	          $querypp = "SELECT file_private FROM ideas WHERE file_path = '".$path."' AND file_name = '".$page."'";
                  $datapp = mysqli_query($dbc, $querypp);
                  $rowpp = mysqli_fetch_array($datapp);
                  
                  if($rowpp['file_private'] == 1){
                  
	            	           $thoughtarray[$i]['private'] = true;
	            }else{
	            
	            	            	           $thoughtarray[$i]['private'] =false;
	            }           
	            	           
	           $thoughtarray[$i]['rating'] = $row['rating'];
                   
                  $queryrr = "SELECT rating FROM thoughts WHERE path = '".$path.'/'.$page."' ORDER by rating DESC LIMIT 1";
                  $datarr = mysqli_query($dbc, $queryrr);
                  $rowrr = mysqli_fetch_array($datarr);
                  if($rowrr['rating']>0){
                 $ideapeakrating = $rowrr['rating'];
                 $thoughtarray[$i]['percentratingstyle']['width']  = round($thoughtarray[$i]['rating']/$rowrr['rating']*100) . '%';
                   }else{
                   $ideapeakrating = 0;
                   $thoughtarray[$i]['percentratingstyle']['width']  = '0%';
                   }
                   
                   
                      
			 $query1 = "SELECT * FROM ratingvote WHERE thought_id = '". $row['id'] ."' AND member_id= '".$_SESSION['user_id']."' ORDER by date DESC LIMIT 1";
			 $data1 = mysqli_query($dbc, $query1);
			
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
			        $datacc = mysqli_query($dbc, $querycc);
			        
			        $j = 0;

			        while ($rowcc = mysqli_fetch_array($datacc)){
			          
			                 $thoughtarray[$i]['thoughtcomments'][$j]['com_date'] = $rowcc['postcomment_date'];
				                 
				                  $query5m = "SELECT username FROM users WHERE user_id = '".$rowcc['post_member_id']."'";
	               				  $data5m = mysqli_query($dbc, $query5m);
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
     
            
echo json_encode($thoughts); 



?>