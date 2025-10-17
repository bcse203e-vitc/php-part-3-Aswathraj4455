<?php

$image_url = "https://i.ytimg.com/vi/zEr-mm8OSGo/sddefault.jpg";
$image_data = @file_get_contents($image_url);

if ($image_data === FALSE) {
    die("Error: Could not retrieve image from the URL.");
}

$img = @imagecreatefromstring($image_data);

if ($img === FALSE) {
    die("Error: Could not process image data from the URL.");
}

$color = imagecolorallocate($img, 255, 255, 255);

imagestring($img, 5, 20, 20, "Car", $color);

header("Content-type: image/jpeg");

imagejpeg($img);

imagedestroy($img);
?>
