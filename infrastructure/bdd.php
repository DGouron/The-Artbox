<?php

/**
 * Establishes a connection to the MySQL database
 *
 * @return PDO Instance of the PDO connection to the database
 * @throws PDOException If there is an error connecting to the database
 */
function connexion(): PDO
{
    $host = getenv('MYSQL_HOST') ?: 'mysql';
    $database = getenv('MYSQL_DATABASE') ?: 'artbox';
    $user = getenv('MYSQL_USER') ?: 'artbox_user';
    $password = getenv('MYSQL_PASSWORD') ?: 'artbox_password';

    $dataSourceName = "mysql:host=$host;dbname=$database;charset=utf8mb4";

    try {
        $pdo = new PDO($dataSourceName, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        return $pdo;
    } catch (PDOException $e) {
        throw new PDOException(
            "Erreur de connexion à la base de données : " . $e->getMessage(),
            (int)$e->getCode()
        );
    }
}
