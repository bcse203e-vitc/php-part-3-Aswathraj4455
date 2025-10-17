<?php
if(isset($_COOKIE['visits'])) {
 $count = $_COOKIE['visits'] + 1;
} else {
 $count = 1;
}
setcookie('visits', $count, time() + 3600);
echo "Welcome! You have visited this page $count times.";
?>
