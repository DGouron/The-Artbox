<?php
require_once __DIR__ . '/../../infrastructure/bdd.php';
require_once __DIR__ . '/../services/oeuvreValidator.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    try {
        $validator = new OeuvreValidator();
        $validatedData = $validator->validate($_POST);

        $pdo = connexion();

        $sql = "INSERT INTO oeuvres (titre, artiste, image, description) VALUES (:titre, :artiste, :image, :description)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':titre' => $validatedData['titre'],
            ':artiste' => $validatedData['artiste'],
            ':image' => $validatedData['image'],
            ':description' => $validatedData['description']
        ]);

        // Redirect to homepage on success
        header('Location: ../../index.php');
        exit;
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }

}
