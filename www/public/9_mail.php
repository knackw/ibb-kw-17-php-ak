<?php

declare (strict_types=1);
require_once 'inc/tools.inc.php';


class MailPage extends Page {
    
    public function __construct() {
        parent::__construct('Bibliotheken | sendmail', 'Email versenden');
    }
    
    protected function viewContent() {

        // 
        // Emails versenden mit sendmail
        // 
        
        // sendmail - in Betrieb nehmen
        // 
        //      1.  php.ini
        //          [mail function]
        //          sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"
        //          
        //          sendmail erwartet einen konfigurierten Mail-Server auf dem System
        //          
        //      2.  sendmail.ini
        //          [sendmail]
        //          smtp_server=
        //          smtp_port=
        //          smtp_ssl=
        //          auth_username=
        //          auth_password=
        //          
        
        // email konfigurieren
        $to = 'marco.kirschberger@viona-trainer.com';
        $subject = 'Betreff!';
        $message = 'Das ist eine gannz <b>wichtige</b> Nachricht von Jörg';
        $headers = "From: php2021@javafish.de\r\n";
        
        // Email sind standardmäßig TEXT-Emails
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
//        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        if (mail($to, $subject, $message, $headers)) {
            echo 'SUCCESS', BRNL;
        } else {
            echo 'ERROR', BRNL;
        }
        
    }

}

(new MailPage())->view();
