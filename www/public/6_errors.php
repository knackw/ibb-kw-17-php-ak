<?php

declare (strict_types=1);

require_once 'inc/tools.inc.php';


class ErrorPage extends Page {
    
    public function __construct() {
        parent::__construct('Errors', 'Fehlerbehandlung');
    }
    
    protected function viewContent() {

        // 
        // es gibt viele verschiedene Arten von Fehlern
        // 
        
        // Parse error: syntax error, unexpected token "echo", expecting "," or ";" 
        echo 'Hello Error', BRNL;
        echo 'Hello Error', BRNL;
        echo 'Hello Error', BRNL;
        echo 'Hello Error', BRNL;
        // syntaktische Programmierfehler können nicht behandelt werden -> müssen weg!
        
        
        // Fatal error: Uncaught Error: Class "PKW" not found
//        $pkw = new PKW();
        // Programm wird (an dieser Stelle) beendet
        
        
        // Warning: mysqli_connect(): (HY000/1045): Access denied for user ''@'localhost'
        mysqli_connect();
        // Programm läuft weiter
        
        
        // Warning: Undefined variable $abc
        echo $abc, BRNL;
        // Programm läuft weiter
        
        
        // logische Fehler => Programm liefert falsche Ergebnisse
        $a = 5;
        $b = 9;
        $c = $a + $b;
        echo "Das Produkt aus $a und $b ist $c", BRNL;
        // durch Test vermeiden
        
        
        
        // 
        // Fehler-Behandlung: Warning/Notice
        // 
        
        // Die Fehlerbehandlungs-Funktionen sind zentral in der Datei tool.inc.php
        // für die gesamte Applikation untergebracht
        
        set_error_handler('meineEigeneFehlerbehandlung');
        
        mysqli_connect();
        echo $abc, BRNL;
        
        
        set_error_handler('meineZweiteFehlerbehandlung');
        
        mysqli_connect();
        echo $abc, BRNL;
        
        
        set_error_handler('meineDritteFehlerbehandlung');
        
        mysqli_connect();
        echo $abc, BRNL;
        
        
        // entfernt die (dritte) Fehlerbehandlung
        restore_error_handler();
        
        mysqli_connect();
        echo $abc, BRNL;
        
        
        // entfernt die (zweite) Fehlerbehandlung
        restore_error_handler();
        
        mysqli_connect();
        echo $abc, BRNL;
        
        
        // entfernt die (eigene) Fehlerbehandlung
        restore_error_handler();
        
        mysqli_connect();
        echo $abc, BRNL;
        
        
        // die PHP-Standard-Fehlerbehandlung kann nicht entfernt werden
        restore_error_handler();
        
        mysqli_connect();
        echo $abc, BRNL;
        
        // Bedeutung der Fehler-Nrn.
        //      E_ERROR         1
        //      E_WARNING       2
        //      E_NOTICE        8
        //      E_STRICT        2048
        //      E_DEPRECATED    8192
        //      
        //      E_ALL           32767
        //      
        //      Entwicklung     E_ALL
        //      Produktion      E_ALL & ~E_DEPRECATED & ~E_STRICT
        //
        
        error_reporting(E_ALL);
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
        

        // löst standardmäßig einen E_USER_NOTICE aus
        trigger_error('huch');
        // E_USER_WARNING, E_USER_DEPRECATED und E_USER_ERROR auch möglich
        
    }

}

(new ErrorPage())->view();
