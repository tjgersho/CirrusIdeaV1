<?php
if(!empty($_FILES)) {
                $fileCount = count($_FILES['fileupload']["name"]);

                for ($i = 0; $i < $fileCount; $i++) {

		
			if(is_uploaded_file($_FILES['fileupload']['tmp_name'][$i])) {
			$sourcePath = $_FILES['fileupload']['tmp_name'][$i];
			$targetPath = "images/".$_FILES['fileupload']['name'][$i];
				if(move_uploaded_file($sourcePath,$targetPath)) {
				?>
				<img src="<?php echo $targetPath; ?>" width="100px" height="100px" />
				<?php
				}
			}
		}

}
?>