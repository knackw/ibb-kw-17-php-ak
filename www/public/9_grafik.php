<?php

declare (strict_types=1);
require_once 'inc/tools.inc.php';


class GrafikPage extends Page {
    
    public function __construct() {
        parent::__construct('Bibliotheken | Grafik', 'Ein Bild');
    }
    
    protected function viewContent() {

        // 
        // Grafik-Bibliothek: gd (prozedurale Bibliothek)
        // 
        
        if (!extension_loaded('gd')) {
            echo 'gd-Bibliothek NICHT vorhanden', BRNL;
            return;
        }
        
        echo 'gd-Bibliothek vorhanden', BRNL;
        
        // Informationen zur Bibliothek gd
        printData(gd_info());
        
        $arial = __DIR__ . '/data/fonts/arial.ttf';
        echo $arial, BRNL;
        
        // ein Bild erzeugen
        //               breite höhe
        $img = imageCreate(250, 150);
        
        
        // eine Farbe erzeugen
        //                               rot grün blau (RGB)
        $grau = imageColorAllocate($img, 192, 192, 192);
        
        
        // einen rechteckigen Bereich füllen - Hintergrundfarbe
        //              X  Y  Farbe
        imageFill($img, 0, 0, $grau);
        
        
        // das Bild speichern
        imageJpeg($img, 'img/bild.jpg');
        
        echo '<hr>';
        echo '<img src="img/bild.jpg" alt="ein Bild" >', BRNL;
        
        echo '<hr>';
        echo '<img src="9_grafik2.php" alt="noch ein Bild" >', BRNL;
        
        echo '<hr>';
        echo '<img src="9_grafik2.php?r=192&t=text" alt="noch ein Bild" >', BRNL;
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }

}

(new GrafikPage())->view();
