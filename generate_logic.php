<?php
session_start();
header('Content-type: image/jpeg');

$text = $_SESSION['secure'];
$font_size = 40;

$image_width = 800;
$image_height = 150;

$image = imagecreate($image_width, $image_height);
imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0,0,0);

imagettftext($image, $font_size, 0, 30, 100, $text_color, 'fonts/HennyPenny-Regular.ttf', $text);
imagejpeg($image);
?>
