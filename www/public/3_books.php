<?php

declare (strict_types=1);

require_once 'inc/tools.inc.php';
//require_once 'classes/Book.class.php';
//require_once 'classes/Ebook.class.php';


$title = 'OO | Books';
$headline = 'Wo sind die Bücher?';
include 'html/header.html.php';


// hier kommt der seitenindividuelle Inhalt

// Klassen gehören NICHT ins PHP-(Haupt)-Programm, sondern werden inkludiert
//      1. eigener Ordner für Klassen (classes)
//      2. JEDE Klasse gehört in eine eigene Datei
//      3. Dateiname und Klassenname sollten zusammen gehören

// Autoload-Mechanismus - gehört in die tools.inc.php


// Book::__construct(): Argument #1 ($title) must be of type string, int given
//$b1 = new Book(42);


$b1 = new Book('PHP - das volle Program');
echo $b1->getTitle(), BRNL;

$eb1 = new Ebook('pdf', 'PHP für Fortgeschrittene');
echo $eb1->getTitle(), BRNL;
echo $eb1->getFormat(), BRNL;

// -----------------------------------------------------------------------------


// 
// Dynamische Attribute
// 

printData($eb1);
//echo $eb1->title, BRNL;
//echo $eb1->format, BRNL;
echo $eb1->pages, BRNL;     //  Undefined property: Ebook::$pages

// PHP kann Objekten dynamisch Attribute hinzufügen
//$eb1->pages = 542;
//echo $eb1->pages, BRNL;

printData($eb1);

// -----------------------------------------------------------------------------

// 
// Serialisierung
// 

echo $eb1, BRNL;            // __toString() - erzeugt einen Uder-friendly String
printData($eb1);            // eine sehr technische Ausgabe - Debug-Output
printData($eb1, true);      // eine sehr, sehr technische Ausgabe - Debug-Output

$ebookString = serialize($eb1);     // Serialisierung: erzeugt einen sehr technischen String
echo $ebookString, BRNL;

$eb2 = unserialize($ebookString);   // De-Serialisirung: Macht aus dem String wieder ein Objekt
printData($eb2);

$_SESSION['ebook'] = serialize($eb2);
printData($_SESSION);
$eb3 = unserialize($_SESSION['ebook']);
echo $eb3, BRNL;

// Serialisierung benötigen wir bei Sessions:
// 
// so geht's nämlich nicht!
// 1. Request
//      $_SESSION['ebook'] = $eb1;
//      
// 2. Request
//      $eb2 = $_SESSION['ebook'];          // hier kommt KEIN Objekt zurück
//
//
// BESSER so:
// 1. Request
//      $_SESSION['ebook'] = serialize($eb1);
//      
// 2. Request
//      $eb2 = unserialize($_SESSION['ebook']);   // hier kommt EIN Objekt zurück
//


include 'html/footer.html.php';
