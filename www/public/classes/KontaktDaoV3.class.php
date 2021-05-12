<?php

declare (strict_types=1);

/*
 * dao - data access object
 *  OO-Version der Funktions-Bibliothek kontakt.inc.php
 * 
 * V1 - hier internen Funktions-Aufrufe sind immer noch prozedural
 * V2 - jetzt auch intern objektorientiert (Mysqli)
 * V3 - Zugriff nicht mehr via Mysqli, sondern PDO (inkl. Prepared Statement, fetchObject())
 * 
 */

class KontaktDaoV3 {
    
    /*
     * PDO besteht aus 2 Klassen
     *      PDO
     *      PDOStatement
     *      (PDOStatement enthält auch das Result)
     */
    
    private PDO $connection;
    private ?PDOStatement $readAllStatement = null;
    private ?PDOStatement $readOneStatement = null;
    private ?PDOStatement $createStatement = null;
    private ?PDOStatement $updateStatement = null;
    private ?PDOStatement $deleteStatement = null;
    
    public function __construct() {
        $this->connection = DbConnection::getInstance()->getConnection();
    }

    function readKontakte(): array {

        if ($this->readAllStatement == null) {
            $sql = 'SELECT * FROM `kontakt`';
            $this->readAllStatement = $this->connection->prepare($sql);
        }
        
        $this->readAllStatement->execute();

        $kontakte = [];
        
//        // fetch(): array - liefert ein Datensatz-Array (sowohl numerisch indiziert, als auch assoziativ)
//        while ($kontaktDatensatzarray = $this->readAllStatement->fetch()) {
////            printData($kontaktDatensatzarray);
//            $k = new Kontakt(
//                    $kontaktDatensatzarray['anrede'],
//                    $kontaktDatensatzarray['vorname'],
//                    $kontaktDatensatzarray['nachname'],
//                    $kontaktDatensatzarray['strasse'],
//                    $kontaktDatensatzarray['plz'],
//                    $kontaktDatensatzarray['stadt'],
//                    $kontaktDatensatzarray['telefon'],
//                    intval($kontaktDatensatzarray['id']),
//            );

//        // fetchObject(): object - liefert ein Objekt der Klasse stdClass
//        while ($kontaktDatensatzobject = $this->readAllStatement->fetchObject()) {
//            printData($kontaktDatensatzobject);
//            $k = new Kontakt(
//                    $kontaktDatensatzobject->anrede,
//                    $kontaktDatensatzobject->vorname,
//                    $kontaktDatensatzobject->nachname,
//                    $kontaktDatensatzobject->strasse,
//                    $kontaktDatensatzobject->plz,
//                    $kontaktDatensatzobject->stadt,
//                    $kontaktDatensatzobject->telefon,
//                    intval($kontaktDatensatzobject->id),
//            );
            
        // fetchObject('classname'): object - liefert ein Objekt der Klasse classname
        while ($kontakt = $this->readAllStatement->fetchObject('Kontakt')) {
            $kontakte[] = $kontakt;
        }

        return $kontakte;
    }

    function readKontakt(int $id): ?Kontakt {

        if ($this->readOneStatement == null) {
            $sql = "SELECT * FROM `kontakt` WHERE `id`=:id";
            $this->readOneStatement = $this->connection->prepare($sql);
        }
        
        $this->readOneStatement->execute(['id' => $id]);

        $kontakt = $this->readOneStatement->fetchObject('Kontakt');
        return $kontakt ? $kontakt : null;
    }

    function createKontakt(Kontakt $kontakt): bool {

        if ($this->createStatement == null) {
            $sql = "INSERT INTO `kontakt` (`anrede`, `vorname`, `nachname`, `strasse`, `plz`, `stadt`, `telefon`) "
                    . "VALUES (:anrede, :vorname, :nachname, :strasse, :plz, :stadt, :telefon)";
            $this->createStatement = $this->connection->prepare($sql);
        }
        
        $array = [
            'anrede' => $kontakt->getAnrede(),
            'vorname' => $kontakt->getVorname(),
            'nachname' => $kontakt->getNachname(),
            'strasse' => $kontakt->getStrasse(),
            'plz' => $kontakt->getPlz(),
            'stadt' => $kontakt->getStadt(),
            'telefon' => $kontakt->getTelefon(),
        ];

        $this->createStatement->execute($array);
        $kontakt->setId(intval($this->connection->lastInsertId()));
        return $this->createStatement->rowCount() == 1;
    }

    function updateKontakt(Kontakt $kontakt): bool {

        if ($kontakt->getId() == 0) {
            return false;
        }
        
        if ($this->updateStatement == null) {
            $sql = "UPDATE `kontakt` SET `anrede`=:anrede, `vorname`=:vorname, "
                    . "`nachname`=:nachname, `strasse`=:strasse, `plz`=:plz, "
                    . "`stadt`=:stadt, `telefon`=:telefon WHERE `id`=:id";
            $this->updateStatement = $this->connection->prepare($sql);
        }
        
        $array = [
            'anrede' => $kontakt->getAnrede(),
            'vorname' => $kontakt->getVorname(),
            'nachname' => $kontakt->getNachname(),
            'strasse' => $kontakt->getStrasse(),
            'plz' => $kontakt->getPlz(),
            'stadt' => $kontakt->getStadt(),
            'telefon' => $kontakt->getTelefon(),
            'id' => $kontakt->getId(),
        ];

        $this->updateStatement->execute($array);
        return $this->updateStatement->rowCount() == 1;
    }

    function deleteKontakt($kontakt) {
        
        if ($kontakt->getId() == 0) {
            return false;
        }
        
        if ($this->deleteStatement == null) {
            $sql = "DELETE FROM `kontakt` WHERE `id`=:id";
            $this->deleteStatement = $this->connection->prepare($sql);
        }
        
        $array = [
            'id' => $kontakt->getId(),
        ];

        $this->deleteStatement->execute($array);
        return $this->deleteStatement->rowCount() == 1;
    }

}
