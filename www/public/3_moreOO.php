<?php

require_once 'inc/tools.inc.php';

$title = 'Objekte';
$headline = 'Objektorientierung | Polymorphie';
include 'html/header.html.php';


// hier kommt der seitenindividuelle Inhalt


//                          Tier
//
//  Hund            Katze           Vogel           Baer
//  
//                                              Koala   Grizzly
//


// 100% abstract class
interface Fleischfresser {
    function eatMeat();
}


// abstract     - KEINE Objekterzeugung     - NUR Vererbung
// final        - NUR Objekterzeugung       - KEINE Vererbung
abstract class Tier {
    // Klassen können nicht gleichzeitig abstract und final sein
    
    private $name;
    
    // es gibt keine Objekte der Klasse Tier - wofür den Konstruktor?
    //  für die Klassen-Hierachie
    public function __construct($name) {
        $this->name = $name;
    }
    
//    // konkrete eat()-Methode wird ausgeführt, wenn Sub-Class NICHT überschreibt
//    function eat() {
//        echo 'Das Tier ', $this->getName(), ' frisst irgendetwas', BRNL;
//    }
    
    // abstract method - kann NICHT ausgeführt werden - MUSS überschrieben werden
    // abstract method - NUR in abstract class
    abstract function eat();
    
    // final method - kann nicht überschrieben werden
    final function sleep() {
        echo 'Das Tier ', $this->getName(), ' schläft', BRNL;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setName($name): void {
        $this->name = $name;
    }
    
}

final class Hund extends Tier {
    
    private $herrchen;
    
    function __construct($herrchen, $name) {
        parent::__construct($name);
        $this->herrchen = $herrchen;
    }
    
    // überSCHREIBUNG - immer über eine Klassengrenze
    //  Name muss identisch sein
    //  Parameterliste SOLLTE die gleiche sein
    //  RückgabeType SOLLTE die gleiche sein
    //  Access-Level darf nicht eingeschränkt werden
    function eat() {
//        parent::eat();
        echo 'Der Hund ', $this->getName(), ' frisst Knochen', BRNL;
    }
    
    
    // Die OO kennt auch das überLADEN von Methoden
    //      ... eine Methode mit demselben Namen ABER eine alternativen Parameterliste
    // PHP kennt KEINE überLADUNG von Methoden
    //      dafür optionale Parameter
    
    
    // Cannot override final method Tier::sleep()
//    function sleep() {}
    
    public function getHerrchen() {
        return $this->herrchen;
    }

    public function setHerrchen($herrchen): void {
        $this->herrchen = $herrchen;
    }
}

//  Class Terrier may not inherit from final class (Hund)
// class Terrier extends Hund {}



//class Katze extends Tier, Fleischfresser {
// Mehrfachvererbung
//      funktioniert in         C++, ...
//      funktioniert NICHT in   PHP, C#, Java, ...
    
class Katze extends Tier implements Fleischfresser {
    
    private $geraeusch;
    
    function __construct($geraeusch, $name) {
        parent::__construct($name);
        $this->geraeusch = $geraeusch;
    }
    
    function eat() {
        echo 'Die Katze ', $this->getName(), ' schlabbert Milch', BRNL;
    }
    
    function eatMeat() {
        echo 'Die Katze ', $this->getName(), ' frisst Steak', BRNL;
    }
    
    public function getGeraeusch() {
        return $this->geraeusch;
    }

    public function setGeraeusch($geraeusch): void {
        $this->geraeusch = $geraeusch;
    }
}

class Vogel extends Tier {
    
    function eat() {
        echo 'Der Vogel ', $this->getName(), ' pickt Körner', BRNL;
    }
}

// -----------------------------------------------------------------------------

class Pflanze {}

class Sonnentau extends Pflanze implements Fleischfresser {
    
    public function eatMeat() {
        echo 'Die Pflanze Sonnentau frisst Insekten', BRNL;
    }
}

class Auto {}

class Christine extends Auto implements Fleischfresser {
    
    public function eatMeat() {
        echo 'Das Auto Christine frisst Fußgänger', BRNL;
    }
}

// -----------------------------------------------------------------------------


$tiere = [];
//$tiere[] = new Tier('Igor');
$tiere[] = new Hund('Eberhard', 'Waldi');
$tiere[] = new Katze('miau', 'Minka');
$tiere[] = new Vogel('Tweety');

foreach ($tiere as $tier) {
    echo 'Das Tier heißt ', $tier->getName(), BRNL;
    
//    //           IS-A?
//    if ($tier instanceof Katze) {
//        echo 'Die Katze macht ', $tier->getGeraeusch(), BRNL;
//    }
    
    $tier->eat();
    $tier->sleep();
}


$fleischfressers = [];
$fleischfressers[] = new Katze('schschrrr', 'Adelheid');
$fleischfressers[] = new Sonnentau();
$fleischfressers[] = new Christine();

foreach ($fleischfressers as $fleischfresser) {
    $fleischfresser->eatMeat();
}




include 'html/footer.html.php';
