<?php

declare (strict_types=1);

/*
 * dao - data access object
 *  OO-Version der Funktions-Bibliothek kontakt.inc.php
 * 
 * V1 - hier internen Funktions-Aufrufe sind immer noch prozedural
 * V2 - jetzt auch intern objektorientiert (Mysqli)
 * V3 - Zugriff nicht mehr via Mysqli, sondern PDO (inkl. Prepared Statement, fetchObject())
 * final:   Ein dao ohne Redundanzen, auch nicht bei meheren Tabellen (daos)
 * 
 */

class KontaktDao extends GenericDao {
    
    
    public function __construct() {
        parent::__construct('kontakt', 'Kontakt');
    }


    protected function getCreateSql(): string {
        return 'INSERT INTO `' . $this->getTableName() . '` (`anrede`, `vorname`, `nachname`, `strasse`, `plz`, `stadt`, `telefon`) '
             . 'VALUES (:anrede, :vorname, :nachname, :strasse, :plz, :stadt, :telefon)';
    }


    protected function getCreateArray(object $kontakt): array {
        return [
            'anrede' => $kontakt->getAnrede(),
            'vorname' => $kontakt->getVorname(),
            'nachname' => $kontakt->getNachname(),
            'strasse' => $kontakt->getStrasse(),
            'plz' => $kontakt->getPlz(),
            'stadt' => $kontakt->getStadt(),
            'telefon' => $kontakt->getTelefon(),
        ];
    }

    protected function getUpdateSql(): string {
        return 'UPDATE `' . $this->getTableName() . '` SET `anrede`=:anrede, `vorname`=:vorname, '
            . '`nachname`=:nachname, `strasse`=:strasse, `plz`=:plz, '
            . '`stadt`=:stadt, `telefon`=:telefon WHERE `id`=:id';
    }

    protected function getUpdateArray($kontakt): array {
        return [
            'anrede' => $kontakt->getAnrede(),
            'vorname' => $kontakt->getVorname(),
            'nachname' => $kontakt->getNachname(),
            'strasse' => $kontakt->getStrasse(),
            'plz' => $kontakt->getPlz(),
            'stadt' => $kontakt->getStadt(),
            'telefon' => $kontakt->getTelefon(),
            'id' => $kontakt->getId(),
        ];
    }

    // -------------------------------------------------------------------------
    
    // hier könnten Tabellen-Spezifisch weitere Methoden stehen
}
