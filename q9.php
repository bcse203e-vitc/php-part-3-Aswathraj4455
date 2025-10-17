<?php

$img = imagecreate(250, 250);

$bg = imagecolorallocate($img, 255, 255, 255);

for ($i = 0; $i < 10; $i++) {
    $color = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
    $shape_type = rand(1, 3);

    switch ($shape_type) {
        case 1:
            imagefilledellipse($img, rand(20, 230), rand(20, 230), rand(30, 80), rand(30, 80), $color);
            break;
        case 2:
            $x1 = rand(10, 200);
            $y1 = rand(10, 200);
            imagefilledrectangle($img, $x1, $y1, rand($x1 + 30, 240), rand($y1 + 30, 240), $color);
            break;
        case 3:
            $points = array(
                rand(10, 240), rand(10, 240),
                rand(10, 240), rand(10, 240),
                rand(10, 240), rand(10, 240)
            );
            imagefilledpolygon($img, $points, 3, $color);
            break;
    }
}

header("Content-type: image/png");
imagepng($img);

imagedestroy($img);
?>
