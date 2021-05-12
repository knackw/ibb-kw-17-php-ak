<?php

declare (strict_types=1);
require_once 'inc/tools.inc.php';

// Einbinden der PHPMailer-Bibliothek
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'classes/PHPMailer/src/Exception.php';
require_once 'classes/PHPMailer/src/PHPMailer.php';
require_once 'classes/PHPMailer/src/SMTP.php';
// Einbinden der PHPMailer-Bibliothek - beendet


class MailerPage extends Page {
    
    public function __construct() {
        parent::__construct('Bibliotheken | PHPMailer', 'Email versenden');
    }
    
    protected function viewContent() {

        // 
        // Emails versenden mit PHPMailer
        // 
        //      https://github.com/PHPMailer/PHPMailer
        //      
        //      1. PHPMailer-Verzeichnis im classes-Ordner
        //      2. 5 Zeilen im Programm-Kopf einfügen
        
        //                    true - exceptions enabled
        $mail = new PHPMailer(true);
        try {
            
            // Konfiguration des PHPMailer-Objektes
            //      1. Grundkonfiguration
            //      2. Mail-spezifische Konfiguration
            
            // 1. Grundkonfiguration
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.strato.de';
            $mail->Port = 465;                  // 587
            $mail->Username = 'php2021@javafish.de';
            $mail->Password = 'php2021-php2021';
            $mail->setFrom('php2021@javafish.de');
            
            // 2. Mail-spezifische Konfiguration
            $mail->isHTML();
            $mail->addAddress('marco.kirschberger@viona-trainer.com');
//            $mail->addAddress('fiedlerj65@gmail.com');
//            $mail->addAddress('hani-86@hotmail.com');
//            $mail->addAddress('harald.schwankl@gmx.de');
            $mail->Subject = 'PHPMailer Betreff';
            $mail->Body = 'Hier steht wieder was <b>gaaaannz</b> wichtiges Drin!!!';
            $mail->addAttachment('data/rechnung0815.pdf');
            
            $mail->send();
            
            echo 'SUCCESS', BRNL;
            
        } catch (Exception $ex) {
            echo 'ERROR', BRNL;

        }
        
    }
}

(new MailerPage())->view();
