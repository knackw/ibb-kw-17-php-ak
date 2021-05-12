<?php

require_once 'inc/tools.inc.php';

$title = 'Objekte';
$headline = 'Objektorientierte Programmierung (OOP)';
include 'html/header.html.php';


// hier kommt der seitenindividuelle Inhalt

// 
// Was ist objektorientierte Programmierung (OOP)?
// 

// Programmier-Paradigmen
//      prozedurale Programmierung / imperative Programmierung      (Trennung von Daten und Funktionalität)
//      objektorientierte Programmierung                            (Zusammenfassung von Daten und Funktionalität)
//      funktionale Programmierung
//      logische Programmierung
//  

// Warum OO-Programmierung?
//  
//      Objekte sind Dinge des täglichen Lebens!
//      
//      Objekte haben Eigenschaften     ==> Attribute   |   Variable
//      Objekte haben Verhalten         ==> Operation   |   Methode (function)
//      
//      - wir programmieren KEINE Objekte
//      - wir programmieren KLASSEN
//      
//      Klassen
//          ... beschreiben Objekte
//          ... sind in sich geschlossene Einheiten
//          ... haben immer EINEN exakt definierten (begrenzt) Funktionsumfang
//  

// Vorteile der OO-Programmierung?
//      Sicherheit (Kapselung) - Attribute sind nur innerhalb der Klasse verfügbar
//      Wiederverwendbarkeit (dry) - geringe Fehleranfälligkeit, verbesserte Wartbarkeit
//      Erweiterbarkeit - Vererbung
//      Polymorphie (poly - viel, morph - form)
//

// -----------------------------------------------------------------------------
// - wir programmieren KLASSEN

// Klassen sind Datentypen
class Auto {
    
    // Zugriffsrechte / Access-Level / Sichtbarkeit
    //      private         nur INNERHALB der Klasse sichtbar
    //      protected       nur innerhlab der Klasse und zusätzlich in SUB-CLASSES
    //      public          KEINE Einschränkung des Zugriffs - JEDER hat Zugriff
    //      
    //      ohne weitere Deklaration ins (in PHP) alles public
    //
    
    // 1. Objekte haben Eigenschaften - Attribute
    private $marke;
    private $speed;     // gültige Werte von -50 - 300
    
    // 2. Objekte haben Verhalten - Operation
    
    // 2a. Konstruktor
    //  ... wird zum Zeitpunkt der Objekt-Erzeugung ausgeführt
    //  ... sorgt für die Initialisierung des Objektes
    function __construct($marke, $speed=0) {
        $this->marke = $marke;
        $this->setSpeed(0);
        $this->setSpeed($speed);
    }
    
    
    // 2b. Business Methoden - definieren das Verhalten des Objektes
    function beschleunigen($diff=10) {
//        $this->speed += $diff;
        $this->setSpeed($this->getSpeed() + $diff);
    }
    
    
    // 2c. technische Hilfsmethoden
    // accessors
    //      - getter    - liefern den Wert eines Attributes zurück (return)
    //      - setter    - wird benutzt, um den Wert eines Attributes zu ändern
    //      Attribute => Property
    function getMarke() {
        return $this->marke;
    }
    
    // KEIN setter für $marke - $marke ist immutable / unveränderlich
    
    function getSpeed() {
        return $this->speed;
    }
    
    function setSpeed($speed) {
        // Möglichkeit der Plausibilitäts-Prüfung
        if ($speed >= -50 and $speed <= 300) {
            $this->speed = $speed;
        }
    }
    
    
    // 2d. vordefinierte Methoden (magic methods)
    function __toString() {
        return 'Auto: ' . $this->marke . '/' . $this->speed;
    }
    
    // Destruktor wird ausgeführt, wenn ein Objekt gelöscht wird (kurz davor)
    // ist zum aufräumen gedacht
    function __destruct() {
        echo 'Tschüss ', $this->marke, BRNL;
    }
}

// Ende der Klassendefinition
//  ----------------------------------------------------------------------------
// Verwendung der Klasse


// mit dem Schlüsselwort 'new' wird ein Objekt einer Klasse erzeugt
$a1 = new Auto('BMW', 1500);
echo 'Das Auto, das über die Variable $a1 erreichbar ist, ist ein ', $a1->getMarke(), ' und fährt ', $a1->getSpeed(), ' km/h', BRNL;

// Der Objekt-Operator '->'
//$a1->marke = 'BMW';
//$a1->speed = 150;

$a2 = new Auto('Mercedes');

//$a2->marke = 'Mercedes';
//$a2->speed = 120;

echo 'Das Auto, das über die Variable $a1 erreichbar ist, ist ein ', $a1->getMarke(), ' und fährt ', $a1->getSpeed(), ' km/h', BRNL;
echo 'Das Auto, das über die Variable $a2 erreichbar ist, ist ein ', $a2->getMarke(), ' und fährt ', $a2->getSpeed(), ' km/h', BRNL;

// Aufruf der Business-Methoden
$a2->beschleunigen(50);
echo 'Das Auto, das über die Variable $a2 erreichbar ist, ist ein ', $a2->getMarke(), ' und fährt ', $a2->getSpeed(), ' km/h', BRNL;

$a2->beschleunigen(50);
echo 'Das Auto, das über die Variable $a2 erreichbar ist, ist ein ', $a2->getMarke(), ' und fährt ', $a2->getSpeed(), ' km/h', BRNL;


// Unsinnige Werte können - dank setter - nicht mehr im Objekt landen
$a2->setSpeed(9999);
echo 'Das Auto, das über die Variable $a2 erreichbar ist, ist ein ', $a2->getMarke(), ' und fährt ', $a2->getSpeed(), ' km/h', BRNL;

for ($i = 0; $i < 5; $i++) {
    $a2->beschleunigen(50);
    echo 'Das Auto, das über die Variable $a2 erreichbar ist, ist ein ', $a2->getMarke(), ' und fährt ', $a2->getSpeed(), ' km/h', BRNL;
}


// Object of class Auto could not be converted to string
// Lösung: __toString() implementieren
echo $a2, BRNL;
//printData($a2);
//printData($a2, true);


// Wann wird ein Objekt gelöscht?
//  Wenn es seine Referenzierbarkeit verliert!
$a1 = new Auto('Renault');                  // Auto aus 124 verliert seine Referenzierbarkeit

$a3 = $a2;                                  // Auto aus 131 ist nun über 2 Variablen ($a2 und $a3) referenzierbar
$a2 = null;
echo $a3->getMarke(), BRNL;

$a3 = 42;                                   // Auto aus 131 verliert seine Referenzierbarkeit


// -----------------------------------------------------------------------------
// eine weitere Klasse

// eine Klasse erweitert eine andere (Vererbung)
//      Auto        - Super-Klasse  Eltern-Klasse   (Ober-Klasse)
//      Cabrio      - Sub-Klasse    Kind-Klasse     (Unter-Klasse)

//            IS-A?
class Cabrio extends Auto {
    
    private $verdeckFarbe;
    private $verdeckGeoeffnet;
    
    // Auto-Konstruktor: function __construct($marke, $speed=0) {
    function __construct($verdeckFarbe, $marke, $speed=0) {
        // :: - Gültigkeitsbereichsoperator
        parent::__construct($marke, $speed);
        $this->verdeckFarbe = $verdeckFarbe;
    }
    
    function verdeckOeffnen() {
        if ($this->getSpeed() < 30) {
            echo 'Das Verdeck wird geöffnet', BRNL;
            $this->verdeckGeoeffnet = true;
        } else {
            echo 'Ooops - zu schnell!!!', BRNL;
        }
    }
    
    function verdeckSchliessen() {
        if ($this->getSpeed() < 30) {
            echo 'Das Verdeck wird geschlossen', BRNL;
            $this->verdeckGeoeffnet = false;
        } else {
            echo 'Ooops - zu schnell!!!', BRNL;
        }        
    }
    
    public function getVerdeckFarbe() {
        return $this->verdeckFarbe;
    }

    public function setVerdeckFarbe($verdeckFarbe): void {
        $this->verdeckFarbe = $verdeckFarbe;
    }

    public function isVerdeckGeoeffnet() {
        return $this->verdeckGeoeffnet;
    }

}

// -----------------------------------------------------------------------------

$c1 = new Cabrio('blau', 'Audi');
echo 'Das Cabrio, das über die Variable $c1 erreichbar ist, ist ein ', $c1->getMarke(), ' und fährt ', $c1->getSpeed(), ' km/h, Verdeckfarbe: ', $c1->getVerdeckFarbe(), BRNL;

$c1->beschleunigen();
echo 'Das Cabrio, das über die Variable $c1 erreichbar ist, ist ein ', $c1->getMarke(), ' und fährt ', $c1->getSpeed(), ' km/h, Verdeckfarbe: ', $c1->getVerdeckFarbe(), BRNL;

if ($c1->isVerdeckGeoeffnet()) {
    echo 'Das Verdeck ist geöffnet', BRNL;
} else {
    echo 'Das Verdeck ist NICHT geöffnet', BRNL;
}

$c1->verdeckOeffnen();
if ($c1->isVerdeckGeoeffnet()) {
    echo 'Das Verdeck ist geöffnet', BRNL;
} else {
    echo 'Das Verdeck ist NICHT geöffnet', BRNL;
}

$c1->beschleunigen(50);

$c1->verdeckSchliessen();
if ($c1->isVerdeckGeoeffnet()) {
    echo 'Das Verdeck ist geöffnet', BRNL;
} else {
    echo 'Das Verdeck ist NICHT geöffnet', BRNL;
}

$c1->beschleunigen(-40);

$c1->verdeckSchliessen();
if ($c1->isVerdeckGeoeffnet()) {
    echo 'Das Verdeck ist geöffnet', BRNL;
} else {
    echo 'Das Verdeck ist NICHT geöffnet', BRNL;
}


include 'html/footer.html.php';
