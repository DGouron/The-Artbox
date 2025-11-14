<?php

/**
 * Retrieves all artworks from the database
 * This file fetches the artworks and makes them available in the $oeuvres variable
 */

require_once __DIR__ . '/../../infrastructure/bdd.php';

try {
    $pdo = connexion();

    $sql = "SELECT id, titre, artiste, image, description FROM oeuvres ORDER BY id";

    $stmt = $pdo->query($sql);

    $oeuvres = $stmt->fetchAll();

} catch (PDOException $e) {
    error_log("Erreur lors de la récupération des œuvres : " . $e->getMessage());
    echo "Erreur lors de la récupération des œuvres. Veuillez réessayer plus tard.";
    $oeuvres = [];
}
