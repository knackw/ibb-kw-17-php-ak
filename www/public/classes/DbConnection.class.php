<?php

declare (strict_types=1);

class DbConnection {
    
    // Entwurfsmuster Singleton (Einzelstück) - Beginn:
    private static ?DbConnection $instance = null;
    
    // Fabrik-Methode / factory-method
    public static function getInstance(): DbConnection {
        if (self::$instance == null) {
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }
    // Singleton - Ende!
    
    private PDO $connection;
    private int $value;
    
    private function __construct() {
           
        $host = 'database';            // '127.0.0.1', 'google.com'
        $user = 'user';
        $pass = 'user';                 // $pass = '';
        $db = 'app_db';

        // Data Set Name - DB-System spezifisch
        $dsn = "mysql:host=$host;dbname=$db";

        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ];
        $this->connection = new PDO($dsn, $user, $pass, $options);
        
        $this->value = random_int(1, 1000000000);
    }
    
    public function getConnection(): PDO {
        return $this->connection;
    }
    
    public function getValue(): int {
        return $this->value;
    }

}