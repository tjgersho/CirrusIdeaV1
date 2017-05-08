<?php

require_once('../startsession.php');
require_once('../connectvars.php');

require_once 'cirrusIdeaAPI.class.php';
// Requests from the same server don't have a HTTP_ORIGIN header

if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}


try {

//echo $_REQUEST[''];
//echo $_SERVER['HTTP_ORGIN'];

echo "[{page: 'neet',  isOwner: 1,";
echo "type: {'publicidea': 0, 'privateidea': 1},";
echo "type1: {'btn btn-success': 0, 'btn btn-info': 1}}]";

exit();




    $API = new CirrusIdeaAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    
    echo $API->processAPI();
    
} catch (Exception $e) {

    echo json_encode(Array('error' => $e->getMessage()));
    
}


?>