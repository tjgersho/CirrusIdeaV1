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
<style>
body { padding: 30px }
form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }

.progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }

</style>
<script type="text/javascript" src="../scripts/vendors/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="./jquery.form.min.js"></script>


</head>
<body>
<form action="./upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="myfile"><br>
        <input type="submit" value="Upload File to Server">
    </form>
    
    <div class="progress">
        <div class="bar"></div >
        <div class="percent">0%</div >
    </div>
    
    <div id="status"></div>
<script>
console.log("HELLO");

	
(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
   
$('form').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(resp) {
    console.log(resp)
     
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
	complete: function(xhr) {
		status.html(xhr.responseText);
	}
}); 






})();       


</script>
</body>
</html>

