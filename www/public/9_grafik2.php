<?php

if (!extension_loaded('gd')) {
    // header('Content-Type: text/html');
    echo 'gd-Bibliothek NICHT vorhanden', BRNL;
    return;
}

// muss VOR jeder anderen Ausgabe erfolgen !!!
//header('Content-Type: image/jpeg');
header('Content-Type: image/png');


$img = imageCreate(250, 150);

$red = $_GET['r'] ?? 0;
$green = $_GET['g'] ?? 0;
$blue = $_GET['b'] ?? 0;
$text = $_GET['t'] ?? '---';


$hellgrau = imageColorAllocate($img, 128, 128, 128);
$schwarz = imageColorAllocate($img, 0, 0, 0);
$blau = imageColorAllocate($img, 0, 0, 255);
$textfarbe = imageColorAllocate($img, $red, $green, $blue);

imageFill($img, 0, 0, $hellgrau);


// Text aufs Bild
//                Schriftart / -größe
//                |  X  Y  String         Farbe
imageString($img, 1, 0, 0, 'Hello Image', $schwarz);
imageString($img, 2, 0, 10, 'Hello Image', $schwarz);
imageString($img, 3, 0, 20, 'Hello Image', $schwarz);
imageString($img, 4, 0, 30, 'Hello Image', $schwarz);
imageString($img, 5, 0, 40, 'Hello Image', $schwarz);
imageString($img, 10, 0, 50, 'Hello Image', $schwarz);


$arial = __DIR__ . '/data/fonts/arial.ttf';

// Text in einer (TTF) Schriftart aufs Bild
//                 Schriftgröße
////                 |   Winkel
////                 |   |    X   Y  Farbe  Font    Text
//imageTtfText($img, 20, 0, 100, 50, $blau, $arial, 'waagerecht');
//imageTtfText($img, 20, 90, 200, 150, $blau, $arial, 'vertikal');
//imageTtfText($img, 20, 45, 100, 125, $blau, $arial, 'diagonal');
imageTtfText($img, 20, 0, 100, 50, $textfarbe, $arial, $text);
imageTtfText($img, 20, 90, 200, 150, $textfarbe, $arial, $text);
imageTtfText($img, 20, 45, 100, 125, $textfarbe, $arial, $text);


imagePng($img);     // Direkter Output zum Browser -> Content-Type
imageDestroy($img);
