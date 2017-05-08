<?php
//$tempDir = __DIR__ . DIRECTORY_SEPARATOR . 'temp';
//if (!file_exists($tempDir)) {
//	mkdir($tempDir);
//}

//if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//	$chunkDir = $tempDir . DIRECTORY_SEPARATOR . $_GET['flowIdentifier'];
//	$chunkFile = $chunkDir.'/chunk.part'.$_GET['flowChunkNumber'];
//	if (file_exists($chunkFile)) {
//		header("HTTP/1.0 200 Ok");
//	} else {
//		header("HTTP/1.1 204 No Content");
//	}
//}

if(!empty($_FILES)) {
if(is_uploaded_file($_FILES['userFile']['tmp_name'])) {
$sourcePath = $_FILES['userFile']['tmp_name'];
$targetPath = "temp/".$_FILES['userFile']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
echo json_encode([
    'success' => true,
    'files' => $_FILES,
    'get' => $_GET,
    'post' => $_POST,
    //optional
    'flowTotalSize' => isset($_FILES['file']) ? $_FILES['file']['size'] : $_GET['flowTotalSize'],
    'flowIdentifier' => isset($_FILES['file']) ? $_FILES['file']['name'] . '-' . $_FILES['file']['size']
        : $_GET['flowIdentifier'],
    'flowFilename' => isset($_FILES['file']) ? $_FILES['file']['name'] : $_GET['flowFilename'],
    'flowRelativePath' => isset($_FILES['file']) ? $_FILES['file']['tmp_name'] : $_GET['flowRelativePath']
]);

}
}
}



