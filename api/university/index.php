<?php
require_once('../startsession.php');



// Grab the user-entered log-in data
if($_SERVER['REQUEST_METHOD']=='POST'){
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
}


if(isset($request->code)){

$code = $request->code;

$subcourses = array();
////Select from database.. subcourses..

switch($code){

case 'NetGiving':

$subcourses[0]['name'] = 'Net-Giving 1';
$subcourses[0]['code'] = 'NetGiving1';
$subcourses[0]['order'] = 1;

$subcourses[0]['useraccess'] = 1;   //// Set user access with database////  1 has access 0 does not..

$subcourses[1]['name'] = 'Net-Giving 2';
$subcourses[1]['code'] = 'NetGiving2';
$subcourses[1]['order'] = 2;
$subcourses[1]['useraccess'] = 0;

break;

case 'SellToHelp':

$subcourses[0]['name'] = 'Sell-To-Help 1';
$subcourses[0]['code'] = 'SellToHelp1';
$subcourses[0]['order'] = 1;
$subcourses[0]['useraccess'] = 1;

$subcourses[1]['name'] = 'Sell-To-Help 2';
$subcourses[1]['code'] = 'SellToHelp2';
$subcourses[1]['order'] = 2;
$subcourses[1]['useraccess'] = 0;

$subcourses[2]['name'] = 'Sell-To-Help 3';
$subcourses[2]['code'] = 'SellToHelp3';
$subcourses[2]['order'] = 3;
$subcourses[2]['useraccess'] = 1;

$subcourses[3]['name'] = 'Sell-To-Help 4';
$subcourses[3]['code'] = 'SellToHelp4';
$subcourses[3]['order'] = 4;
$subcourses[3]['useraccess'] = 0;


break;

default:
$subcourses[0]['name'] = $code;
$subcourses[0]['code'] = $code;
$subcourses[0]['order'] = 1;
$subcourses[0]['useraccess'] = 1;

break;
}



$jsn = json_encode($subcourses);

print_r($jsn);

exit();

}else{



$courses = array();

$courses[0]['name'] = 'Goals';
$courses[0]['code'] = 'Goals';
$courses[0]['order'] = 1;
$courses[0]['descrip'] = 'Design your life with Goal Setting!';
$courses[0]['useraccess'] = 1;


$courses[1]['name'] = 'Attitude';
$courses[1]['code'] = 'Attitude';
$courses[1]['order'] = 2;
$courses[1]['descrip'] = "It's the way you look at your life!";
$courses[1]['useraccess'] = 1;

$courses[2]['name'] = 'Discipline';
$courses[2]['code'] = 'Discipline';
$courses[2]['order'] = 3;
$courses[2]['descrip'] = "Stay focused!";
$courses[2]['useraccess'] = 1;


$courses[3]['name'] = 'Net Giving';
$courses[3]['code'] = 'NetGiving';
$courses[3]['order'] = 4;
$courses[3]['descrip'] = "It's all about Generosity";
$courses[3]['useraccess'] = 1;


$courses[4]['name'] = 'Sell-To-Help';
$courses[4]['code'] = 'SellToHelp';
$courses[4]['order'] = 5;
$courses[4]['descrip'] = "The Science of <del>Selling</del> Helping";
$courses[4]['useraccess'] = 0;


$courses[5]['name'] = 'Creating Loyalty';
$courses[5]['code'] = 'CreatingLoyalty';
$courses[5]['order'] = 6;
$courses[5]['descrip'] = "Descrip";
$courses[5]['useraccess'] = 0;

$courses[6]['name'] = 'Develop Your Plan';
$courses[6]['code'] = 'DevelopYourPlan';
$courses[6]['order'] = 7;
$courses[6]['descrip'] =  "Descrip";
$courses[6]['useraccess'] = 0;


$courses[7]['name'] = 'Positive Business Communication';
$courses[7]['code'] = 'PBC';
$courses[7]['order'] = 8;
$courses[7]['descrip'] =  "Descrip";
$courses[7]['useraccess'] = 0;


$courses[8]['name'] = 'Business Etiquette/ Ethics';
$courses[8]['code'] = 'BEE';
$courses[8]['order'] = 9;
$courses[8]['descrip'] =  "Descrip";
$courses[8]['useraccess'] = 0;


$courses[9]['name'] = 'Servant Leadership';
$courses[9]['code'] = 'ServantLeadership';
$courses[9]['order'] = 10;
$courses[9]['descrip'] =  "Descrip";
$courses[9]['useraccess'] = 0;



$courses[10]['name'] = 'Basics Business Boardroom';
$courses[10]['code'] = 'BBB';
$courses[10]['order'] = 11;
$courses[10]['descrip'] =  "Descrip";
$courses[10]['useraccess'] = 0;

$courses[11]['name'] = 'Entrepreneuship';
$courses[11]['code'] = 'Entrepreneuship';
$courses[11]['order'] = 12;
$courses[11]['descrip'] =  "Descrip";
$courses[11]['useraccess'] = 0;


$courses[12]['name'] = 'Time Management';
$courses[12]['code'] = 'TimeManagement';
$courses[12]['order'] = 13;
$courses[12]['descrip'] =  "Descrip";
$courses[12]['useraccess'] = 0;










$jsn = json_encode($courses);

print_r($jsn);

exit();

}

?>
