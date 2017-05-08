<?php
  session_start();
//echo ' From Start Session.php -- Session U-ID' . $_SESSION['user_id'];
//echo   ' From Start Session.php -- Cookie U-ID' . $_COOKIE['user_id'];
  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }


?>