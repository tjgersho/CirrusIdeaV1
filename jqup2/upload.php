<?php
var_dump($_POST);
var_dump($_FILES);

if(!empty($_FILES)) {
if(is_uploaded_file($_FILES['myfile']['tmp_name'])) {
$sourcePath = $_FILES['myfile']['tmp_name'];
$targetPath = "images/".$_FILES['myfile']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<img src="<?php echo $targetPath; ?>" width="100px" height="100px" />
<?php
}
}
}
?>