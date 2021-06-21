<?php

function connectPDO(): PDO
{
    $host='localhost';
    $database = 'basic';
    $user = 'user';
    $password = 'password';
    try {
        $dsn = "mysql:host=$host;port=3306;dbname=$database;";

        return new PDO(
            $dsn,
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $db) {
        die($db->getMessage());
    } finally {
        echo 'nice!';
    }
}

return connect();

?>