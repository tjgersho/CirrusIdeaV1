<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="CirrusIdea">
<head>
<title>CirrusIdea</title>
<meta name="description" content="beamSolver is a 1D FEM for solving Beams with Euler-Bernoulli formulation.">
<meta name="keywords" content="Engineering Beam Solver" />
<meta name="robots" content="index, follow" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Mobile Specific Metas  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body{width:610px;}
#uploadForm {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
#uploadForm label {margin:2px; font-size:1em; font-weight:bold;}
.demoInputBox{padding:5px; border:#F0F0F0 1px solid; border-radius:4px; background-color:#FFF;}
#progress-bar {background-color: #12CC1A;height:20px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
.btnSubmit{background-color:#09f;border:0;padding:10px 40px;color:#FFF;border:#F0F0F0 1px solid; border-radius:4px;}
#progress-div {border:#0FA015 1px solid;padding: 5px 0px;margin:30px 0px;border-radius:4px;text-align:center;}
#targetLayer{width:100%;text-align:center;}

</style>
<script type="text/javascript" src="../scripts/vendors/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="./jquery.form.min.js"></script>

<script type="text/javascript">
console.log("HELLO");

$(document).ready(function() { 
	
	$('#uploadForm').submit(function(){
	    
		if($('#fileupload').val()) {
		  
			//e.preventDefault();
			$('#loader-icon').show();
			$(this).ajaxSubmit({
			        method: 'POST',
			        url: 'upload.php', 
				target:   '#targetLayer', 
				beforeSubmit: function() {
				 
				  $("#progress-bar").width('0%');
				},
				uploadProgress: function (event, position, total, percentComplete){
				     console.log(event);
					$("#progress-bar").width(percentComplete + '%');
					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
				},
				success:function (res){
				    console.log(res);
					$('#loader-icon').hide();
				},
				resetForm: true 
			}); 
			return false; 
		}
	});
}); 

</script>
</head>
<body>
<form id="uploadForm">
<input type="hidden" name="test" value="TEST" />
<div>
<label>Upload Image File:</label>
<span class="btn btn-file btn-warning">Upload<input class="input-large" id="fileupload" name="fileupload[]" type="file"  multiple/></span>   
<input type="submit" id="submit" value="Submit"/>
</div>
</form>
<!--<div><input type="submit" id="btnSubmit" value="Submit" class="btnSubmit" /></div>-->
<div id="progress-div"><div id="progress-bar"></div></div>
<div id="targetLayer"></div>

<div id="loader-icon" style="display:none;"><img src="LoaderIcon.gif" /></div>

</body>
</html>

