<?php

declare (strict_types=1);

require_once 'inc/tools.inc.php';


/*
 * MVC - Model View Controller
 * 
 *      Model       Datenmodel, Geschäftslogik
 * 
 *      View        Darstellungsebene
 * 
 *      Controller  verbindet Model und View
 */


class SafetyPage extends Page {
    
    public function __construct() {
        parent::__construct('Sicherheit', 'Wie schreiben wir möglichst sichere Programme?');
    }
    
    protected function viewContent() {

        /*
         * Sicherheitsrisiken:
         * 
         *      Eingabe-Sicherheit
         * 
         *          SQL-Injections
         *              Problem         unerwünschte SQL-Anweisungen durch User-Input
         *              Lösung          1. PreparedStatement
         *                                  $prepStmt = $mysqli->prepare($sql);
         *                                  $prepStmt->bind_param(...);
         *                                  $prepStmt->execute();
         * 
         *                                  $pdoStmt = $pdo->prepare($sql);
         *                                  $pdoStmt->execute($array);
         * 
         *                              2. Quotes
         *                                  mysqli_real_escape_string($mysqli, $eingabe): string;
         *                                  $mysqli->escape_string($eingabe): string;
         * 
         *                                  $pdo->quote($eingabe): string;
         * 
         *          Formular eingaben
         *              Problem         Inhalt der Formular-Eingaben in der URL sichtbar
         *              Lösung          <form method="post" ... >
         * 
         *              Problem         <input type="hidden" ... > - kann clientseitig manipuliert werden
         *              Lösung          Sessions verwenden
         * 
         *              Problem         clientseitige Validierung - kann clienseitig ausgehebelt werden
         *              Lösung          zusätzlich serverseitig validieren
         * 
         * 
         *      Ausgabe-Sicherheit
         * 
         *          html-Injection
         *              Problem         unerwünschter html-Code durch User-Input
         *              Lösung          htmlSpecialChars($eingabe): string;
         *                                  '<' => &lt;
         *                                  '>' => &gt;
         * 
         *                              htmlEntities($eingabe): string;
         *                                  zus. Umlaute
         *                                  'ö' => &ouml;
         *                                  'Ö' => &Ouml;
         * 
         *          ungewollte Veröffentlichung vomn Programm-Details
         *              Problem         Notice, Warning, Fatal Error, ...
         *              Lösung          error-handling
         *                              exception-handling
         * 
         *              Problem         html-Kommentare
         *              Lösung          PHP-Kommentare
         * 
         * 
         *      innere Sicherheit
         * 
         *          access level - private / protected / public
         *              Problem         protected/public - Attribute
         *              Lösung          private Attribute (Kapselung)
         * 
         *              Problem         Implementierungs-Methoden public
         *              Lösung          Implementireungs-Methoden private/protected
         * 
         *              Überlegung      Sind wirklich alle Setter nötig (immutable Attribute)?
         *                              Müssen alle Getter public sein (oder werden sie evtl. nur in der SubClass benötigt)?
         * 
         *          Typisierung
         *              Problem         PHP ist keine streng typisierte Sprache
         *              Lösung          Typisierungs-Möglichkeiten (je nach PHP-Version) nutzen
         * 
         *          Gültigkeitsbereich (Scope) von Variablen
         *              Problem         Gültigkeitsbereich zu groß
         *              Lösung          lieber lokal als global
         *                              OO: lieber lokal als Attribute  (wenn möglich)
         *                                  lieber Attribute als static (wenn möglich)
         *                              P:  Deklaration(Zuweisung) / Verwendung / unSet()
         * 
         *          Password-Sicherheit
         *              Problem         zu geringe Password-Qualität
         *              Lösung          sicheres Password erwarten
         *                              - mind. 8 Zeichen
         *                              - Zeichenkategorien vorgeben
         *                              (GROSS, klein, Ziffer, Sonderzeichen, mind. 3 Kategorien)
         *                              - zeitlich begrenztes Password
         *                                  * nicht eins der letzten 8 Passwörter
         * 
         *              Problem         im klartext Speichern
         *              Lösung          verschlüsselt speichern (ge-hash-t)
         * 
         *              Problem         im klartext übertragen
         *              Lösung          https (keine PHP-Lösung)
         * 
         *          Software-Versionen
         *              Problem         veraltete Versionen
         *              Lösung          aktuelle Versionen verwenden
         *                              PHP     8.0.5
         *                                      7.4.18
         *                                      7.3.28
         *                                      (Stand: 5.5.2021)
         *                              - auch für verwendete Bibliotheken
         *                              - auch für http/s Server
         * 
         *          XAMPP
         *              Problem         KEINE Produktions-Umgebung
         *              Lösung          in der Produktion eine eigene Server-Installation
         * 
         *          Debugging
         *              Problem         Debugging bietet Angriffsmöglichkeiten
         *              Lösung          KEIN Debugging in der Produktionsumgebung
         * 
         *          => Trennung zwischen Entwicklungs- und Produktionsumgebung
         * 
         */
        
        /*
         *  PHP auf aktuelle Version migireren:
         *      1. xampp/htdocs/php - Ordner sichern
         *      2. Mysql-DB - Datenbank: test sichern
         *      alle Server beenden
         * 
         *      XAMPP ist mit aktueller PHP-Version verfügbar
         *          XAMPP-Ordner löschen
         *          neue XAMPP-Installation starten
         * 
         * 
         *      XAMPP ist (noch) NICHT mit aktueller PHP-Version verfügbar
         *          xampp/php ist der Ordner mit der PHP-Version (Umbenennen mit Versionsnummer)
         *          aktuelle PHP-Version downloaden und entpacken
         *          als PHP-Ordner in XAMPP integrieren
         *          evtl. php.ini anpassen (oder aus dem anderen PHP-Ordner kopieren)
         * 
         */
        
        
        include 'html/formular.html.php';
        if (isSet($_POST['send'])) {
            echo 'Hello ', $_POST['vorname'], ' ', $_POST['nachname'], BRNL;
            echo 'Hello ', htmlSpecialChars($_POST['vorname']), ' ', htmlSpecialChars($_POST['nachname']), BRNL;
            echo 'Hello ', htmlEntities($_POST['vorname']), ' ', htmlEntities($_POST['nachname']), BRNL;
        }
        
    }
    

}

(new SafetyPage())->view();
