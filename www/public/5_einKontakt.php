<?php

declare (strict_types=1);

require_once 'inc/tools.inc.php';


class KontaktPage extends Page {
    
    private ?KontaktDao $kontaktDao;
    private ?Kontakt $kontakt;
    private string $message;
    
    public function __construct() {
        parent::__construct('Datenbank | OO', 'Ein Kontakt');
        $this->message = '';
    }
    
    protected function init(): void {
        if (isSet($_POST['back'])) {
            headerLocation('4_dbOO.php');
        }
    }
    
    protected function viewContent() {
        
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            echo 'fehlerhafter Aufruf', BRNL;
            return;
        }
        $id = intval($id);
        
        $this->kontaktDao = new KontaktDao();
        $this->kontakt = $this->kontaktDao->readOne($id);
        if ($this->kontakt == null) {
            $this->kontakt = new Kontakt();
        }
        
        if (isSet($_POST['save'])) {
            // Speichern-Button wurde gedrückt
            $this->save();
        }
        
        if (isSet($_POST['delete'])) {
            // Löschen-Button wurde gedrückt
            $this->delete();
        }
        
        $kontakt = $this->kontakt;
        $message = $this->message;
        include 'html/kontakt.html.php';
    }
    
    
    private function save(): void {
        $this->kontakt->setAnrede($_POST['anrede']);
        $this->kontakt->setVorname($_POST['vorname']);
        $this->kontakt->setNachname($_POST['nachname']);
        $this->kontakt->setStrasse($_POST['strasse']);
        $this->kontakt->setPlz($_POST['plz']);
        $this->kontakt->setStadt($_POST['stadt']);
        $this->kontakt->setTelefon($_POST['telefon']);

        if ($this->kontakt->getId() == 0) {
            // neuer Datensatz - hinzufügen
            $this->message = $this->kontaktDao->create($this->kontakt)
                    ? 'Kontakt hinzugefügt'
                    : 'Kontakt NICHT hinzugefügt';
        } else {
            // vorhandener Datensatz - aktualisieren
            $this->message = $this->kontaktDao->update($this->kontakt)
                    ? 'Kontakt gespeichert'
                    : 'Kontakt NICHT gespeichert';
        }
    }
    

    private function delete(): void {
        if ($this->kontaktDao->delete($this->kontakt)) {
            $this->message = 'Kontakt gelöscht';
            $this->kontakt = new Kontakt();
        } else {
            $this->message = 'Kontakt NICHT gelöscht';
        }
    }

}

(new KontaktPage())->view();
