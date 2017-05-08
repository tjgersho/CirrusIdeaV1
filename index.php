<?php
//ini_set('display_errors', 1);

//ini_set('display_startup_errors', 1);

//error_reporting(E_ALL);
//echo '<h1>Site Maintenance</h1>';
//exit();
require_once("api/startsession.php");


$link = $_GET['_escaped_fragment_'];

if(isset($link)){

require_once('seo/SEO.php');



$WebCrawl = new SEO($link);

echo $WebCrawl->serve_crawlpage();

exit();
}


//////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="en"  ng-app="CirrusIdea">
<head>
 <base href="/"></base>
<meta name="google-site-verification" content="wdbLaMMoh3Al9cITDvGNNDHcwWpPVvGuSBHcYuemS60" />
<meta name="fragment" content="!">

<meta charset="UTF-8">
<meta name="viewport" id="viewPort" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> 
<link rel="stylesheet" href="styles/select2.css"> 
<link rel="stylesheet" href="styles/main.css"> 


<link href="styles/flexslider.css" rel="stylesheet">
<link href="styles/font-awesome.min.css" rel="stylesheet">
<!-- <link href="styles/prettyPhoto.css" rel="stylesheet"> -->
  <link href="styles/specialstyle.css" rel="stylesheet">
  
    <!--[if IE]>
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->




<title>CirrusIdea</title>
</head>
<body ng-controller="MainCtrl as mainCtrl">
<cirrus-navbar></cirrus-navbar>
<cirrus-content></cirrus-content>
<cirrus-footer></cirrus-footer>




<script src="scripts/vendors/jquery-1.11.2.min.js"></script>
<script src="scripts/vendors/jquery.form.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="scripts/vendors/jssor.js"></script>
<script src="scripts/vendors/jssor.slider.js"></script>
<script src="scripts/vendors/angular.min.js"></script>
<script src="scripts/vendors/angular-sanitize.min.js"></script>
<script src="scripts/vendors/angular-route.min.js"></script>
<script src="scripts/vendors/angular-animate.min.js"></script>
<script src="scripts/vendors/ui-bootstrap-custom-tpls-0.13.3.min.js"></script>

<script src="scripts/app.min.js"></script>


<script src="scripts/services.min.js"></script>
<script src="scripts/controllers.min.js"></script>
<script src="scripts/directives.min.js"></script>
<script src="scripts/filters.min.js"></script>

<script src="scripts/vendors/highcharts.js"></script>

<script src="scripts/vendors/highcharts-3d.js"></script>

<!-- <script src="scripts/vendors/jquery.mixitup.min.js"></script> -->
<!-- <script src="scripts/vendors/jquery.prettyPhoto.js"></script> -->
<!-- <script src="scripts/vendors/jquery.parallax-1.1.3.js"></script> -->
 <!-- <script src="scripts/vendors/jquery.flexslider-min.js"></script> -->
<!-- <script src="scripts/vendors/retina-1.1.0.min.js"></script> -->
<script src="scripts/vendors/select2.min.js"></script>
<script src="scripts/vendors/toTop.min.js"></script> 

 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69117706-1', 'auto');
  ga('send', 'pageview');

</script>


<a id="toTop" style="background-color:#5CE62E; color: rgb(247,146,29); padding:2px;">Top &uarr;</a>
<script>
       jQuery(function($){
           // Plugin activation (basic - with all default values)
           // $('.to-top').toTop();

           // Plugin activation with options
           $('#toTop').toTop({
               //options with default values
               autohide: true,  //boolean 'true' or 'false'
               offset: 420,     //numeric value (as pixels) for scrolling length from top to hide automatically
               speed: 500,      //numeric value (as mili-seconds) for duration
               position:true,   //boolean 'true' or 'false'. Set this 'false' if you want to add custom position with your own css
               right: 15,       //numeric value (as pixels) for position from right. It will work only if the 'position' is set 'true'
               bottom: 30       //numeric value (as pixels) for position from bottom. It will work only if the 'position' is set 'true'
           });
       });
   </script>

</body>
</html> 


