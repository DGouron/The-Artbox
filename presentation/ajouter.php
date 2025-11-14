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

    <main>
        <form action="../application/usecases/createOeuvre.php" method="POST">
            <div class="champ-formulaire">
                <label for="titre">Titre de l'œuvre</label>
                <input type="text" name="titre" id="titre" required>
            </div>
            <div class="champ-formulaire">
                <label for="artiste">Auteur de l'œuvre</label>
                <input type="text" name="artiste" id="artiste" required>
            </div>
            <div class="champ-formulaire">
                <label for="image">URL de l'image</label>
                <input type="url" name="image" id="image" required>
            </div>
            <div class="champ-formulaire">
                <label for="description">Description</label>
                <textarea name="description" id="description" required></textarea>
            </div>

            <input type="submit" value="Valider" name="submit">
        </form>
    </main>

    <?php require 'footer.php'; ?>
</body>
</html>
