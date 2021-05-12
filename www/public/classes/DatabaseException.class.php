<?php

declare (strict_types=1);

class DatabaseException extends Exception {
    
    private string $host;
    private string $user;
    private string $db;
        
    public function __construct(string $host, string $user, string $db, string $message = "", int $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->host = $host;
        $this->user = $user;
        $this->db = $db;
    }
    
    public function getHost(): string {
        return $this->host;
    }

    public function getUser(): string {
        return $this->user;
    }

    public function getDb(): string {
        return $this->db;
    }

}