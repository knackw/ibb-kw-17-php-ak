<?php

declare (strict_types=1);

session_start();

// wenn alle - oder zumindest die meisten - PHP-Programme unter Sitzungs-Kontrolle laufen:
// session_start();

// Konstanten-Deklaration mit dem Schlüsselwort 'const'
const BR = '<br>';
const NL = "\n";

// Konstanten-Deklaration mit der Funktion 'define'
define('BRNL', BR . NL);


function printData($data, $varDump=false) {
    echo '<pre>';
    if ($varDump) {
        var_dump($data);
    } else {
        print_r($data);
    }
    echo '</pre>';
}

function headerLocation($url) {
    header("Location: $url");
    exit;
}



// AutoLoad-Mechanismus
function myOwnAutoloader($classname) {
//    echo $classname, BRNL;
    $classfile = "classes/$classname.class.php";
//    echo $classfile, BRNL;
    if (file_exists($classfile)) {
        require_once $classfile;
    }
}
spl_autoload_register('myOwnAutoloader');


// 
// Error-Handling
// 
function meineEigeneFehlerbehandlung($fehlerNr, $fehlerText, $datei, $zeile, $context='removed in PHP 8.0') {
    echo 'meine <b>eigene</b> Fehlerbehandlung', BRNL;
    echo "Fehler-Nr. $fehlerNr", BRNL;
    echo "Fehler-Text $fehlerText", BRNL;
    echo "Datei $datei", BRNL;
    echo "Zeile $zeile", BRNL;
    printData($context);
    // bis PHP 7.4 ein assoziatives Array mit den definierten Variablen
}

function meineZweiteFehlerbehandlung($fehlerNr, $fehlerText, $datei, $zeile, $context='') {
    echo 'meine <b>zweite</b> Fehlerbehandlung', BRNL;
    echo "Fehler-Nr. $fehlerNr", BRNL;
    echo "Fehler-Text $fehlerText", BRNL;
    echo "Datei $datei", BRNL;
    echo "Zeile $zeile", BRNL;
}

function meineDritteFehlerbehandlung($fehlerNr, $fehlerText, $datei, $zeile, $context='') {
    echo 'meine <b>dritte</b> Fehlerbehandlung', BRNL;
    echo "Fehler-Nr. $fehlerNr", BRNL;
    echo "Fehler-Text $fehlerText", BRNL;
    echo "Datei $datei", BRNL;
    echo "Zeile $zeile", BRNL;
}

//set_error_handler('meineEigeneFehlerbehandlung');