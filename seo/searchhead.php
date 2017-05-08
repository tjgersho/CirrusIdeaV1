<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
<link href="styles/select2.css" rel="stylesheet"> 
<link href="styles/main.css" rel="stylesheet"> 

<script src="scripts/vendors/jquery-1.11.2.min.js"></script>

<link href="styles/flexslider.css" rel="stylesheet">
<link href="styles/font-awesome.min.css" rel="stylesheet">
<link href="styles/specialstyle.css" rel="stylesheet">
  
<script src="scripts/vendors/jssor.js"></script>
<script src="scripts/vendors/jssor.slider.js"></script>


</head>
<body class="ng-scope" ng-controller="MainCtrl as mainCtrl">

<cirrus-navbar><nav class="navbar navbar-custom navbar-fixed-top" style="border-bottom-width: 0px;">


  <div class="container" style="margin-bottom: 0px;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#!/"><img height="50" class="pull-left" src="http://cirrusidea.com/images/cirrusidealogo.png"></a>
     </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="collapse-1">
     <ul class="nav navbar-nav navbar-right">
    
      <li class="navbar-alt-color"><a style="padding-top: 16px; padding-bottom: 15px;" href="#!/cirrus">CirrusIdeas</a></li>
      
           </div>
  </div>
</nav>
<div class="clr"></div>
<div style="width: 100%; height: 70px; float: left; display: block;"></div>
<div class="clr"></div>
<script>
$(document).ready(function () {
 $(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a')) {
        $(this).collapse('hide');
    }
});

});



</script></cirrus-navbar>

<cirrus-content>
<div id="maincontent">
	<div id="fullWidth">  
		<div class="view-animate-container">
                      <div class="slide-animation ng-scope" id="cirrusContent">
