<?php
    header("Content-type:image/png");
    $im= imagecreatetruecolor(300, 200);
    $bg_color=  imagecolorallocate($im, 0, 0, 0);
    $text_color= imagecolorallocate($im, 23, 14, 91);
    imagestring($im, 1, 5, 5,"A Simple Text String", $text_color);
    imagepng($im);
    imagedestroy($im);
?>