<?php
session_start();
if(!isset($_SESSION['name'])) $_SESSION['name'] = "Student";
echo "Hello, ".$_SESSION['name']."! Welcome to the PHP lab.";
?>
