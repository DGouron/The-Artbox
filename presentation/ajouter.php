<?php require '../application/usecases/createOeuvre.php'; ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Ajouter une œuvre - The ArtBox</title>
</head>
<body>
    <?php require 'header.php'; ?>
    <?php
     $title = htmlspecialchars($_POST['titre'] ?? '', ENT_QUOTES, 'UTF-8');
     $artist = htmlspecialchars($_POST['artiste'] ?? '', ENT_QUOTES, 'UTF-8');
     $image = htmlspecialchars($_POST['image'] ?? '', ENT_QUOTES, 'UTF-8');
     $description = htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES, 'UTF-8');
     ?>
    <main>
        <form action="ajouter.php" method="POST">
            <?php require 'errorDisplay.php'; ?>
            <div class="champ-formulaire">
                <label for="titre">Titre de l'œuvre</label>
                <input type="text" name="titre" id="titre" value="<?= $title ?>" required>
            </div>
            <div class="champ-formulaire">
                <label for="artiste">Auteur de l'œuvre</label>
                <input type="text" name="artiste" id="artiste" value="<?= $artist ?>" required>
            </div>
            <div class="champ-formulaire">
                <label for="image">URL de l'image</label>
                <input type="url" name="image" id="image" value="<?= $image ?>" required>
            </div>
            <div class="champ-formulaire">
                <label for="description">Description</label>
                <textarea name="description" id="description" required><?= $description ?></textarea>
            </div>

            <input type="submit" value="Valider" name="submit">
        </form>
    </main>

    <?php require 'footer.php'; ?>
</body>
</html>
