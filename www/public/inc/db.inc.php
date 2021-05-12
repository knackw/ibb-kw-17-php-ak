<?php


function createConnection() {
    
    $host = 'database';            // '127.0.0.1', 'google.com'
    $user = 'user';
    $pass = 'user';                 // $pass = '';
    $db = 'app_db';

    $connection = @mysqli_connect($host, $user, $pass, $db);
    if (mysqli_connect_error()) {
        echo 'Fehler beim Verbindungs-Aufbau', BRNL;
        echo mysqli_connect_error(), BRNL;
        echo mysqli_connect_errno(), BRNL;
        exit;   // das wird im AK noch besser !!!
    }
    mysqli_set_charset($connection, 'utf8');
    
    return $connection;
}


function modify($sql) {
        
    $connection = createConnection();
    mysqli_query($connection, $sql);
    $ar = mysqli_affected_rows($connection) == 1;
    mysqli_close($connection);
    return $ar;

}