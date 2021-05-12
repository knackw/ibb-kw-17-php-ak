<?php

declare (strict_types=1);

/*
 * dao - data access object
 *  OO-Version der Funktions-Bibliothek kontakt.inc.php
 * 
 * V1 - hier internen Funktions-Aufrufe sind immer noch prozedural
 * 
 */

class KontaktDaoV1 {
    
    private $connection;
    private $createStatement;
    
    public function __construct() {
           
        $host = 'localhost';            // '127.0.0.1', 'google.com'
        $user = 'root';
        $pass = 'toor';                 // $pass = '';
        $db = 'test';

        $this->connection = @mysqli_connect($host, $user, $pass, $db);
        if (mysqli_connect_error()) {
            echo 'Fehler beim Verbindungs-Aufbau', BRNL;
            echo mysqli_connect_error(), BRNL;
            echo mysqli_connect_errno(), BRNL;
            exit;   // das wird im AK noch besser !!!
        }
        mysqli_set_charset($this->connection, 'utf8');
    }

    function readKontakte(): array {

        $sql = 'SELECT * FROM `kontakt`';
        $result = mysqli_query($this->connection, $sql);

        $kontakte = [];
        while ($kontaktDatensatzarray = mysqli_fetch_assoc($result)) {
            $k = new Kontakt(
                    $kontaktDatensatzarray['anrede'],
                    $kontaktDatensatzarray['vorname'],
                    $kontaktDatensatzarray['nachname'],
                    $kontaktDatensatzarray['strasse'],
                    $kontaktDatensatzarray['plz'],
                    $kontaktDatensatzarray['stadt'],
                    $kontaktDatensatzarray['telefon'],
                    intval($kontaktDatensatzarray['id']),
            );
            $kontakte[] = $k;
        }

        return $kontakte;
    }

    function readKontakt(int $id): ?Kontakt {

        $sql = "SELECT * FROM `kontakt` WHERE `id`='$id'";
        $result = mysqli_query($this->connection, $sql);

        $kontaktDatensatzarray = mysqli_fetch_assoc($result);
        if ($kontaktDatensatzarray) {
            return new Kontakt(
                    $kontaktDatensatzarray['anrede'],
                    $kontaktDatensatzarray['vorname'],
                    $kontaktDatensatzarray['nachname'],
                    $kontaktDatensatzarray['strasse'],
                    $kontaktDatensatzarray['plz'],
                    $kontaktDatensatzarray['stadt'],
                    $kontaktDatensatzarray['telefon'],
                    intval($kontaktDatensatzarray['id']),
            );
        } else {
            return null;
        }
    }

    function createKontakt(Kontakt $kontakt): bool {

        if ($this->createStatement == null) {
            $sql = "INSERT INTO `kontakt` (`anrede`, `vorname`, `nachname`, `strasse`, `plz`, `stadt`, `telefon`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $this->createStatement = mysqli_prepare($this->connection, $sql);
        }

        $anrede = $kontakt->getAnrede();
        
        //                     PreparedStatement        Datentypen für jeden Platzhalten: s-string, i-integer, d-double
        mysqli_stmt_bind_param($this->createStatement, 'sssssss',
                // alle weiteren Parameter als Referenz!
                $anrede,
                $kontakt->getVorname(),
                $kontakt->getNachname(),
                $kontakt->getStrasse(),
                $kontakt->getPlz(),
                $kontakt->getStadt(),
                $kontakt->getTelefon(),
        );

        mysqli_stmt_execute($this->createStatement);
        $kontakt->setId(mysqli_insert_id($this->connection));
        return mysqli_stmt_affected_rows($this->createStatement) == 1;
    }

    function updateKontakt($kontakt) {

        if (!isSet($kontakt['id']) or $kontakt['id'] == 0) {
            return false;
        }

        $sql = "UPDATE `kontakt` SET "
                . "`anrede`='" . $kontakt['anrede'] . "', "
                . "`vorname`='" . $kontakt['vorname'] . "', "
                . "`nachname`='" . $kontakt['nachname'] . "', "
                . "`strasse`='" . $kontakt['strasse'] . "', "
                . "`plz`='" . $kontakt['plz'] . "', "
                . "`stadt`='" . $kontakt['stadt'] . "', "
                . "`telefon`='" . $kontakt['telefon'] . "' "
                . "WHERE `id`='" . $kontakt['id'] . "'";
        return modify($sql);
    }

    function deleteKontakt($kontakt) {

        if (!isSet($kontakt['id']) or $kontakt['id'] == 0) {
            return false;
        }

        $sql = "DELETE FROM `kontakt` WHERE `id`='" . $kontakt['id'] . "'";
        return modify($sql);
    }

    function __destruct() {
        mysqli_close($this->connection);
    }
}
