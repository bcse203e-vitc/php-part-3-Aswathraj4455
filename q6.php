<?php

$img = imagecreate(200, 200);

$bg = imagecolorallocate($img, 255, 255, 255);
$red = imagecolorallocate($img, 255, 0, 0);

$points = array(
    100, 20,
    128, 77,
    188, 77,
    140, 117,
    155, 180,
    100, 140,
    45, 180,
    60, 117,
    12, 77,
    72, 77
);

imagepolygon($img, $points, 10, $red);

header("Content-type: image/png");
imagepng($img);

imagedestroy($img);
?>
