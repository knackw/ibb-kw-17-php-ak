<?php

declare (strict_types=1);


// Der Dateiname und der Klassenname stehen in direkter Verbindung
//      Klasse      Book
//      Datei       Book.class.php

class Book {
    
//    private $title;         // (bis PHP 7.3)
    private string $title;
    
    public function __construct(string $title) {
        $this->setTitle($title);
    }

    
    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }
}


// Typdeklarationen / Typehints
// 
//      Parameter
//      Methoden-(Rückgaben)
//      Attribute (ab PHP 7.4)
// 
//      mögliche Typen
//          self                        - objekt der eigenen Klasse     5.0
//          array                                                       5.1
//          string, float, int, bool    - primitive PHP-Typen           7.0
//          void                        - für Methoden-Rückgaben        7.0
//          object                      - irgendein objekt              7.2
//          
//          alles andere:
//          Klassen-/Interface-Typ
//          
//          ?...                        - nullable                      7.2
//