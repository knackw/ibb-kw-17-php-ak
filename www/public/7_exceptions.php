<?php

declare (strict_types=1);

require_once 'inc/tools.inc.php';


class ExPage extends Page {
    
    public function __construct() {
        parent::__construct('Exceptions', 'Ausnahmesweise');
    }
    
    protected function viewContent() {

        // 
        // Exceptions / Ausnahmen
        // 
        
        
        /*
         *  Errors                      vs      Exceptions
         *      Fehler                              Ausnahme
         *      - Programm wird                     - Programm(fluss)
         *        weiter ausgeführt                   wird beendet
         *        (Warning/Notice)
         * 
         *                                          ... werden geworfen (throw)
         *                                          und
         *                                          ... können aufgefangen werden (catch)
         * 
         *                                          ... sind Objekte (Exception)
         * 
         * ---------------------------------------------------------------------
         * 
         *      Die Klassen  Exception  und  Error  implementieren
         *      das Interface  Throwable
         * 
         *      class Exception implements Throwable { ... }
         * 
         *      class Error implements Throwable { ... }
         */
        
        
//        try {
//            // Fatal error: Uncaught Error: Class "PKW" not found
//            $pkw = new PKW();
//            
//        } catch (Throwable $thr) {
//            echo 'ohh - kein PKW vorhanden', BRNL;
//            
////        } catch (Error $err) {
////            echo 'ohh - kein PKW vorhanden', BRNL;
//        }
        
        //  Error (ist Throwable) kann man auffangen (catch) - sollte man aber NICHT !!!
        //      --> offensichtlicher Programmierfehler          Error
        //      --> unvorhersehbare Situationen                 Exception
        
        
        // 
        // squareRoot()
        // 
        try {
            $eingabe = 25;
            $r = $this->squareRoot($eingabe);
            echo "Die Wurzel von $eingabe ist $r", BRNL;
        } catch (Exception $ex) {
            echo 'oops', BRNL;
        }

        try {
            $eingabe = -25;
            $r = $this->squareRoot($eingabe);
            echo "Die Wurzel von $eingabe ist $r", BRNL;
        } catch (Exception $ex) {
            echo 'oops', BRNL;
            echo 'Message: ', $ex->getMessage(), BRNL;
            echo 'Code: ', $ex->getCode(), BRNL;
            echo 'File: ', $ex->getFile(), BRNL;
            echo 'Line: ', $ex->getLine(), BRNL;
//            printData($ex->getTrace());
            
//            return;
//            throw $ex;
//            throw new Exception('Message', 815, $ex);
            
        } finally {
            echo 'etwas abschliessendes', BRNL;
        }

        try {
            $eingabe = 0;
            $r = $this->squareRoot($eingabe);
            echo "Die Wurzel von $eingabe ist $r", BRNL;
            
        } catch (Exception $ex) {
            echo 'oops', BRNL;
        }
        
        
        // 
        // getData()
        // 
        try {
            $this->getData();
            
        } catch (DatabaseException $ex) {
            echo 'DatabaseException', BRNL;
            echo 'Message: ', $ex->getMessage(), BRNL;
            echo 'Code: ', $ex->getCode(), BRNL;
            echo 'File: ', $ex->getFile(), BRNL;
            echo 'Line: ', $ex->getLine(), BRNL;
            
            echo 'Host: ', $ex->getHost(), BRNL;
            echo 'User: ', $ex->getUser(), BRNL;
            echo 'DB: ', $ex->getDb(), BRNL;
            
//        } catch (Exception $ex) {
//            echo 'Exception', BRNL;
//            echo 'Message: ', $ex->getMessage(), BRNL;
//            echo 'Code: ', $ex->getCode(), BRNL;
//            echo 'File: ', $ex->getFile(), BRNL;
//            echo 'Line: ', $ex->getLine(), BRNL;
        }
        
        
        // 
        // getDataPDO()
        // 
        try {
            $this->getDataPDO();
        } catch (PDOException $ex) {
            echo 'PDOException', BRNL;
            echo 'Message: ', $ex->getMessage(), BRNL;
            echo 'Code: ', $ex->getCode(), BRNL;
            echo 'File: ', $ex->getFile(), BRNL;
            echo 'Line: ', $ex->getLine(), BRNL;
        }
        
    }
    
    
    function getDataPDO(): void {
        
        $host = 'localhost';
        $user = 'root';
        $pass = 'toor';
        $db = 'test';
        
        $dsn = "mysql:host=$host;dbname=$db";
        $connection = new PDO($dsn, $user, $pass);
        
        echo 'verbindung aufgebaut - PDO', BRNL;
        
        // aufwändige datenabfrage und auswertung ...
        
    }
    
    function getData(): void {
        
        $host = 'localhost';
        $user = 'rootx';
        $pass = 'toor';
        $db = 'test';
        
        $connection = new Mysqli($host, $user, $pass, $db);
        if ($connection->connect_error) {
            // hartes Ende - nicht zu empfehlen
//            echo 'fehler beim Verbindungsaufbau', BRNL;
//            exit;
            
//            // besser: Exception
//            throw new Exception('Fehler beim Verbindungsaufbau - ' . $connection->connect_error, $connection->connect_errno);
            
            // noch besser: DatabaseException
            throw new DatabaseException($host, $user, $db, 'Fehler beim Verbindungsaufbau - ' . $connection->connect_error, $connection->connect_errno);
        }
        
        echo 'Verbindung aufgebaut', BRNL;
        
        // aufwändige Daten abfrage und Auswertung...
        
        $connection->close();
    }
    
    
    function squareRoot(int $value): float {
        // $value muss positiv sein
        if ($value < 0) {
            // $value ist negativ - aufruf nicht entsprechend der Vorgabe
            
//            // 1. Möglichkeit - spezielle Rückgabewert
//            //  Problem: Der Rückgawert kann auch ein korrektes Ergebnis darstellen
//            return 0.0;
            
//            // 2. Möglichkeit - Fehlermeldung / Programmende
//            //  Problem: UNelegant, eine Methode/Funktion sollte NICHT über den generellen Programmablauf entscheiden
//            echo 'fehlerhafter Aufruf', BRNL;
//            exit;
            
            // 3. Möglichkeit - Exception
            //      throw throwable;
            
            //                  string $message                      int $code, Throwable $previous
            throw new Exception("value must be positive, is $value", 4711);
        }
        
        return sqrt($value);
    }
     
    

}

(new ExPage())->view();
