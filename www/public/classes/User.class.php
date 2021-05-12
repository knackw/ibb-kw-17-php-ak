<?php

declare (strict_types=1);

/*
 * dto - data transfer object
 */
class User {
    
    private int $id;
    private string $username;
    private string $password;
    private string $vorname;
    private string $nachname;

    public function __construct(string $username='', string $password='', string $vorname='', string $nachname='', int $id=0) {
        if (isSet($this->id)) {
            return;
        }
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getVorname(): string {
        return $this->vorname;
    }

    public function getNachname(): string {
        return $this->nachname;
    }
    
    public function getName(): string {
        return $this->getVorname() . ' ' . $this->getNachname();
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setVorname(string $vorname): void {
        $this->vorname = $vorname;
    }

    public function setNachname(string $nachname): void {
        $this->nachname = $nachname;
    }
        
    function __toString() {
        return $this->getName();
    }
}