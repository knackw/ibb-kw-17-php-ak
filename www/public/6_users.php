<?php

declare (strict_types=1);

require_once 'inc/tools.inc.php';


class UsersPage extends Page {
    
    public function __construct() {
        parent::__construct('Datenbank | OO', 'Alle Users');
    }
    
    protected function viewContent() {
        
        try {
            $userDao = new UserDao();
            $users = $userDao->readAll();
            printData($users);
        } catch (PDOException $ex) {
            echo 'daten fehler', BRNL;
        }
        
    }

}

(new UsersPage())->view();
