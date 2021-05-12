<?php

declare (strict_types=1);
require_once 'inc/tools.inc.php';

class MailerPage extends Page {
    
    public function __construct() {
        parent::__construct('Bibliotheken | PHPMailer', 'Email versenden | via MyMailer');
    }
    
    protected function viewContent() {

        // 
        // Emails versenden mit PHPMailer | via MyMailer
        // 
        
        $mail = new MyMailer();
        try {
            $mail->addAddress('marco.kirschberger@viona-trainer.com');
            $mail->setSubject('MyMailer Betreff');
            $mail->setBody('Was <b>gaanz</b> wichtiges');
            $mail->setAltBody('Was gaannz wichtiges (Text)');
            
            $mail->send();
            echo 'SUCCESS', BRNL;
            
        } catch (Exception $ex) {
            echo 'ERROR', BRNL;

        }
    }
}

(new MailerPage())->view();
