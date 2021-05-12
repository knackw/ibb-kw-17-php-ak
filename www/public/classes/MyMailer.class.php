<?php

declare (strict_types=1);

// Einbinden der PHPMailer-Bibliothek
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'classes/PHPMailer/src/Exception.php';
require_once 'classes/PHPMailer/src/PHPMailer.php';
require_once 'classes/PHPMailer/src/SMTP.php';
// Einbinden der PHPMailer-Bibliothek - beendet

class MyMailer extends PHPMailer {
    
    public function __construct() {
        parent::__construct(true);
        
        // 1. Grundkonfiguration
        $this->isSMTP();
        $this->CharSet = 'UTF-8';
        $this->SMTPSecure = 'ssl';
        $this->SMTPAuth = true;
        $this->Host = 'smtp.strato.de';
        $this->Port = 465;                  // 587
        $this->Username = 'php2021@javafish.de';
        $this->Password = 'php2021-php2021';
        $this->setFrom('php2021@javafish.de');
        $this->isHTML();
    }
    
    function getSubject(): string {
        return $this->Subject;
    }
    
    function getBody(): string {
        return $this->Body;
    }
    
    function getAltBody(): string {
        return $this->AltBody;
    }
    
    function setSubject(string $subject): void {
        $this->Subject = $subject;
    }
    
    function setBody(string $body): void {
        $this->Body = $body;
    }
    
    function setAltBody(string $altBody): void {
        $this->AltBody = $altBody;
    }
    
}