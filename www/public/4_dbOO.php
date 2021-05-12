<?php

declare (strict_types=1);

require_once 'inc/tools.inc.php';


class DbPage extends Page {
    
    public function __construct() {
        parent::__construct('Datenbank | OO', 'Alle Kontakte');
    }
    
    protected function init(): void {
        if (isSet($_POST['new'])) {
            headerLocation('5_einKontakt.php?id=0');
        }
        if (isSet($_POST['old'])) {
            headerLocation('5_einKontakt.php?id=' . $_POST['old']);
        }
    }
    
    protected function viewContent() {

        // mehrere Tabellen in einem Projekt sind die REGEL
        // 
        //  Problem: Jedes DAO öffnet seine eigene DB-Verbindung ($connection): ineffizient
        //      $userDao = new UserDao();
        //      $terminDao = new TerminDao();
        //      
        //  Lösung: zentrale Klasse DbConnection mit dem Verbindungsaufbau
        //      DAOs nutzen diese EINE Verbindung
        //      $dbconn = new DbConnection();
        //      $userDao = new UserDao($dbconn);
        //      $terminDao = new TerminDao($dbconn);
        //      
        //  Problem: aufruf auch so möglich!
        //      $dbconn = new DbConnection();
        //      $userDao = new UserDao(new DbConnection());
        //      $terminDao = new TerminDao(new DbConnection());
        //      
        //  Lösung: es darf nur EIN Objekt der Klasse DbConnection geben!
        //      $userDao = new UserDao(DbConnection::getInstance());
        //      $terminDao = new TerminDao(DbConnection::getInstance());
        //      
        //  warum dann nicht gleich so?
        //      $userDao = new UserDao();
        //      $terminDao = new TerminDao();
        //
        
        // 
        // Datenbank
        // 
        try {
            $kontaktDao = new KontaktDao();
            $kontakte = $kontaktDao->readAll();
            include 'html/kontakte.html.php';

            $k = $kontaktDao->readOne(15);
            printData($k);

            $k = $kontaktDao->readOne(16);
            printData($k);
        } catch (PDOException $ex) {
            echo 'daten fehler', BRNL;
        }
        
        // 
        // Singleton
        // 
        
        // Ist die Klasse DbConnection ein Singleton?
//        $dbc1 = new DbConnection();
//        $dbc2 = new DbConnection();
//        $dbc3 = new DbConnection();
//        $dbc4 = new DbConnection();
        
//        $dbc1 = DbConnection::getInstance();
//        $dbc2 = DbConnection::getInstance();
//        $dbc3 = DbConnection::getInstance();
//        $dbc4 = DbConnection::getInstance();
//        
//        echo $dbc1->getValue(), BRNL;
//        echo $dbc2->getValue(), BRNL;
//        echo $dbc3->getValue(), BRNL;
//        echo $dbc4->getValue(), BRNL;
        
    }

}

(new DbPage())->view();

/*
 * In X Schritten zum objektorientierten Datenbank-Zugriff
 * 
 *  Schritt 1
 *      Status Quo aus dem Basics-Kurs: Funktionsbibliothek kontakt.inc.php
 *      Kommunikationsweg ist das Datensatz-Array (data transfer array)
 * 
 *  Schritt 2
 *      dta (data transfer array) => dto (data transfer object)
 *      Klasse Kontakt <- Table-Name
 * 
 *  Schritt 3
 *      Funktions-Bibliothek kontakt.inc.php => dao (data access object)
 *      Klasse KontaktDaoV1 (intern noch prozedural)
 * 
 *  Schritt 4
 *      dao intern objektorientiert aufbauen
 *      mysqli_connect()    => new Mysqli()
 *      Klasse KontaktDaoV2 (intern oo via Mysqli)
 * 
 *  Schritt 5
 *      dao auf PDO umstellen, inkl. PreparedStatements
 *      PDO - PHP Data Objects
 *      Schnittstelle für beliebige DB-Systeme
 * 
 *  Schritt 6
 *      DB-Verbindungs-Aufbau in eine zentrale Klasse auslagern
 *      DbConnection
 * 
 *  Schritt 7
 *      nur EIN Objekt der Klasse DbConnection 
 *      => Singelton (Einzelstück)
 * 
 *  Schritt 8
 *      fetch(): array => fetchObject(): object
 * 
 *  Schritt 9
 *      kompletter Test mit ALLEN Kontakten / EINEM Kontakt
 *      4_dbOO.php / 5_einKontakt.php
 * 
 *  Schritt 10
 *      Was, wenn mehrere Tabellen im Projekt vorhanden sind?
 *      Je Tabelle ein dto (data transfer object)
 *      Je Tabelle ein dao... da wird viel Redundanz kopiert
 *      => GenericDao mit allgemeingültiger Funktionalität
 *      => KonkretesDao mit tabellen-spezifischen Ergänzungen
 * 
 */

