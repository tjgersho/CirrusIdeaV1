<?php
// Start the session
require_once('../../startsession.php');



if($_SESSION['username'] == 'tjgersho'){
               header(' ', true, 200);
	        $arr = array('msg' => " " . $request->code . " Course Access Granted", 'error' => '');
                $jsn = json_encode($arr);

	    	 
		 print_r($jsn);


}else{
                 header(' ', true, 400);
	    	$arr = array('msg' => "You do not have access to this page", 'error' => '');
                $jsn = json_encode($arr);

                print_r($jsn);

}

?>