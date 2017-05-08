<?php
require_once('../startsession.php');
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


 ///Model Prototype ///      
//      idserv.ideas = {owner: [{path: 'fun/neet', page: 'cool',  isOwner: 0,
//		       type: {'publicidea': 1, 'privateidea': 0},
//		       type1: {'btn btn-success': 1, 'btn btn-info': 0}},                   
  //                   {path: 'fun', page: 'neet',  isOwner: 1,
//		       type: {'publicidea': 0, 'privateidea': 1},
//		       type1: {'btn btn-success': 0, 'btn btn-info': 1}}],
//		      public:  [{path: 'fun/neet', page: 'cool',  isOwner: 0,
//		       type: {'publicidea': 1, 'privateidea': 0},
//		       type1: {'btn btn-success': 1, 'btn btn-info': 0}},                   
  //                   {path: 'fun', page: 'neet',  isOwner: 1,
///		       type: {'publicidea': 0, 'privateidea': 1},
//		       type1: {'btn btn-success': 0, 'btn btn-info': 1}}]};

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


  $idea_id = $request->idea_id;


   
   $query3 = "SELECT * FROM ideas WHERE file_id = '".  $idea_id ."'";
   $data3 = mysqli_query($dbc, $query3);
   $row3 = mysqli_fetch_array($data3);
           if(mysqli_num_rows($data3)<1){
                header(' ', true, 400);
	    	$arr = array('msg' => "You are not the owner", 'error' => '');
                $jsn = json_encode($arr);
		echo $jsn;
                 exit();
                }else{
                
                $arr = array('path' => $row3['file_path'], 'page' =>  $row3['file_name']);

                $jsn = json_encode($arr);
		echo $jsn;
                 exit();

                }
                
         
?>