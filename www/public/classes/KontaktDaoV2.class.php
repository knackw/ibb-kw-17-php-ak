<?php

declare (strict_types=1);

/*
 * dao - data access object
 *  OO-Version der Funktions-Bibliothek kontakt.inc.php
 * 
 * V1 - hier internen Funktions-Aufrufe sind immer noch prozedural
 * V2 - jetzt auch intern objektorientiert (Mysqli)
 * 
 */

class KontaktDaoV2 {
    
    /*
     * Mysqli besteht aus 3 Klassen
     *      Mysqli
     *      MysqliStatement
     *      MysqliResult
     */
    
    private Mysqli $connection;
    private ?MysqliStatement $createStatement;
    
    public function __construct() {
           
        $host = 'localhost';            // '127.0.0.1', 'google.com'
        $user = 'root';
        $pass = 'toor';                 // $pass = '';
        $db = 'test';

//        $this->connection = @mysqli_connect($host, $user, $pass, $db);        // P
        $this->connection = @new Mysqli($host, $user, $pass, $db);              // OO
        
//        if (mysqli_connect_error()) {                                         // P
//            echo 'Fehler beim Verbindungs-Aufbau', BRNL;
//            echo mysqli_connect_error(), BRNL;
//            echo mysqli_connect_errno(), BRNL;
//            exit;   // das wird im AK noch besser !!!
//        }
        if ($this->connection->connect_error) {                                 // OO
            echo 'Fehler beim Verbindungs-Aufbau', BRNL;
            echo $this->connection->connect_error, BRNL;
            echo $this->connection->connect_errno, BRNL;
            exit;   // das wird im AK noch besser !!!
        }
        
//        mysqli_set_charset($this->connection, 'utf8');                        // P
        $this->connection->set_charset('utf8');                                 // OO
    }

    function readKontakte(): array {

        $sql = 'SELECT * FROM `kontakt`';
//        $result = mysqli_query($this->connection, $sql);                      // P
        $result = $this->connection->query($sql);                               // OO

        $kontakte = [];
//        while ($kontaktDatensatzarray = mysqli_fetch_assoc($result)) {        // P
        while ($kontaktDatensatzarray = $result->fetch_assoc()) {               // OO
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
//        $result = mysqli_query($this->connection, $sql);                      // P
        $result = $this->connection->query($sql);                               // OO

//        $kontaktDatensatzarray = mysqli_fetch_assoc($result);                 // P
        $kontaktDatensatzarray = $result->fetch_assoc();                        // OO
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
//            $this->createStatement = mysqli_prepare($this->connection, $sql); // P
            $this->createStatement = $this->connection->prepare($sql);          // OO
        }

        $anrede = $kontakt->getAnrede();
        
        //                     PreparedStatement        Datentypen für jeden Platzhalten: s-string, i-integer, d-double
//        mysqli_stmt_bind_param($this->createStatement, 'sssssss',             // P
        $this->createStatement->bind_param('sssssss',                           // OO
                // alle weiteren Parameter als Referenz!
                $anrede,
                $kontakt->getVorname(),
                $kontakt->getNachname(),
                $kontakt->getStrasse(),
                $kontakt->getPlz(),
                $kontakt->getStadt(),
                $kontakt->getTelefon(),
        );

//        mysqli_stmt_execute($this->createStatement);                          // P
        $this->createStatement->execute();                                      // OO
        
//        $kontakt->setId(mysqli_insert_id($this->connection));                 // P
        $kontakt->setId($this->connection->insert_id);                          // OO
        
//        return mysqli_stmt_affected_rows($this->createStatement) == 1;        // P
        return $this->createStatement->affected_rows == 1;                      // OO
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
//        mysqli_close($this->connection);                                      // P
        $this->connection->close();                                             // OO
    }
}
