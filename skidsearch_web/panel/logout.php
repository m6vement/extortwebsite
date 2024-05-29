<?php
error_reporting(0);
session_start();
session_destroy();
// Redirect to the login page:
header('Location: login.php');
?>
