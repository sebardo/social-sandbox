<?php

header("Content-type: image/jpeg");
include 'JpegThumbnail.php';
if (isset($_GET['src'])) {
    $src = $_GET['src'];
    if (isset($_GET['w'])) {
        $an = $_GET['w'];
    }
    if (isset($_GET['h'])) {
        $al = $_GET['h'];
    }
    if (isset($_GET['x1'])) {
        $coords['x1'] = $_GET['x1'];
    }
    if (isset($_GET['x2'])) {
        $coords['x2'] = $_GET['x2'];
    }
    if (isset($_GET['y1'])) {
        $coords['y1'] = $_GET['y1'];
    }
    if (isset($_GET['y2'])) {
        $coords['y2'] = $_GET['y2'];
    }
}else{
    $src='defautltThumb.jpg';
}

$img = new JpegThumbnail($an, $al);
imagejpeg($img->recorta($src, $coords));
//imagejpeg($img->generate($src));
?>