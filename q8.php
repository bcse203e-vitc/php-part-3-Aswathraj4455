<?php

$image_url = "https://hips.hearstapps.com/hmg-prod/images/ferrari-e-suv-2-copy-680287cac36b2.jpg?crop=1.00xw:0.838xh;0,0.0673xh";

// Get max dimensions from URL, or use defaults
$max_width = isset($_GET['w']) && is_numeric($_GET['w']) ? (int)$_GET['w'] : 300;
$max_height = isset($_GET['h']) && is_numeric($_GET['h']) ? (int)$_GET['h'] : 300;

$image_data = @file_get_contents($image_url);

if ($image_data === FALSE) {
    die("Error: Could not retrieve image from the URL.");
}

$src_image = @imagecreatefromstring($image_data);

if ($src_image === FALSE) {
    die("Error: Could not process image data from the URL.");
}

$original_width = imagesx($src_image);
$original_height = imagesy($src_image);

$ratio = $original_width / $original_height;

if ($original_width > $max_width || $original_height > $max_height) {
    if ($max_width / $max_height > $ratio) {
        $new_height = $max_height;
        $new_width = (int)($max_height * $ratio);
    } else {
        $new_width = $max_width;
        $new_height = (int)($max_width / $ratio);
    }
} else {
    $new_width = $original_width;
    $new_height = $original_height;
}

$new_image = imagecreatetruecolor($new_width, $new_height);

imagecopyresampled(
    $new_image,
    $src_image,
    0, 0, 0, 0,
    $new_width,
    $new_height,
    $original_width,
    $original_height
);

header("Content-type: image/jpeg");
imagejpeg($new_image, NULL, 90);

imagedestroy($src_image);
imagedestroy($new_image);
?>
