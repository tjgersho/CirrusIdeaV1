<?php
session_start();
$key = 'upload_progress_' . ini_get("session.upload_progress.name");

$updata = $_SESSION[$key];

$bytes_processed = $updata['bytes_processed'];
$total_bytes = $updata['content_length'];

$percent_complete = round($bytes_processed/$total_bytes*100);

echo $percent_complete;

?>