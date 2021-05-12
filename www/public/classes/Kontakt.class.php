<?php

declare (strict_types=1);

/*
 * dto - data transfer object
 * entity-class
 * business-object
 * Datensatz-Klasse
 * 
 * ein Objekt der Klasse Kontakt repräsentiert einen Datensatz der Tabelle `kontakt`
 * 
 */
class Kontakt {
    
    private int $id;
    private string $anrede;
    private string $vorname;
    private string $nachname;
    private string $strasse;
    private string $plz;
    private string $stadt;
    private string $telefon;
    
    // Too few arguments to function Kontakt::__construct(), 0 passed and at least 7 expected
    // Die Parameter-Liste, die für jedes Attribute einen Argument erwartet, ist NICHT fetchObject()-Kompatible
    // wenn fetchObject() genutzt werden soll, müssen alle Parameter optional sein
    public function __construct(string $anrede='', string $vorname='', string $nachname='', string $strasse='', string $plz='', string $stadt='', string $telefon='', int $id=0) {
        // fetchObject() füllt die Attribut-Werte VOR dem Konstruktor-Aufruf
        if (isSet($this->id)) {
            // fetchObject() hat die Attribute bereits gefüllt => KEINE Verarbeitung der Parameterliste
            return;
        }
        $this->id = $id;
        $this->anrede = $anrede;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->strasse = $strasse;
        $this->plz = $plz;
        $this->stadt = $stadt;
        $this->telefon = $telefon;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getAnrede(): string {
        return $this->anrede;
    }

    public function getVorname(): string {
        return $this->vorname;
    }

    public function getNachname(): string {
        return $this->nachname;
    }

    public function getName(): string {
        return $this->getVorname() . ' ' . $this->getNachname();
    }
    
    public function getStrasse(): string {
        return $this->strasse;
    }

    public function getPlz(): string {
        return $this->plz;
    }

    public function getStadt(): string {
        return $this->stadt;
    }

    public function getTelefon(): string {
        return $this->telefon;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setAnrede(string $anrede): void {
        $this->anrede = $anrede;
    }

    public function setVorname(string $vorname): void {
        $this->vorname = $vorname;
    }

    public function setNachname(string $nachname): void {
        $this->nachname = $nachname;
    }

    public function setStrasse(string $strasse): void {
        $this->strasse = $strasse;
    }

    public function setPlz(string $plz): void {
        $this->plz = $plz;
    }

    public function setStadt(string $stadt): void {
        $this->stadt = $stadt;
    }

    public function setTelefon(string $telefon): void {
        $this->telefon = $telefon;
    }

    function __toString() {
        return $this->getName();
    }
}