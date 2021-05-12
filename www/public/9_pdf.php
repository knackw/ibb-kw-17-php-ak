<?php

//header('Content-Type: application/pdf');

// 
// Erzeugung von pdf-Dokumenten
//      http://fpdf.org 
//

require_once 'classes/fpdf/fpdf.php';


// ein neues Fpdf-Objekt / pdf-Dokument erzeugen
//              $orientation='P', $unit='mm', $size='A4'
$pdf = new Fpdf();
// $pdf = new Fpdf('L', 'cm', 'A5');


// eine (neue) Seite erzeugen
$pdf->addPage();


// Auswahl einer Schriftart
//            Schriftart: Helvetica, Times, Courier, Symbol, ZapfDingbats
//            |            Schriftschnitt: B-bold, I-italic, U-underline
//            |            |    Schriftgröße [pt]
$pdf->setFont('Helvetica', 'B', 24);


// 
// Inhalt der pdf-Seite 
// 

// cell() zeichnet eine Zelle - mit EINzeiligem Text
//         Größe: breite, höhe
//         |       Inhalt   Rahmen: 0-kein, 1-alle, TLBR-top left bottom right
$pdf->cell(50, 20, 'Hello', 'BR');
$pdf->cell(50, 20, 'Hello', 'BR');
$pdf->ln();
$pdf->cell(50, 20, 'Hello', 'BR');

$text = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.';

//                   R  G  B
$pdf->setTextColor(192, 0, 0);
$pdf->setFontSize(12);

// write() schreibt Fließtext
//          Zeilenabstand
//$pdf->write(12, $text);
$pdf->write(6, $text);
$pdf->ln();
$pdf->cell(50, 20, 'Hello', 'BR');

$x = $pdf->getX();
$y = $pdf->getY();
$pdf->cell(50, 20, "x:$x/y:$y", 'BR');

$pdf->setXY(120, 20);
$pdf->setTextColor(0, 0, 192);
$pdf->setFillColor(192, 192, 192);
$pdf->cell(50, 20, 'Hello', 'BR', 0, '', true);



//$pdf->output();         // direkt zum Browser -> Content-Type
//$pdf->output('I');         // 'I' - inline -> direkt zum Browser
//$pdf->output('I', 'rechnung0815.pdf');         // 'I' - inline, mit Dateiname
$pdf->output('F', 'data/rechnung0815.pdf');         // 'F' - File gespeichert
headerLocation('data/rechnung0815.pdf');


//echo '<a href="data/rechnung0815.pdf" >zum pdf-Dokument</a>', BRNL;
