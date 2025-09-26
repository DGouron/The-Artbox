<?php
include 'oeuvres.php';

$id = $_GET['id'] ?? 0;

$oeuvre_actuelle = null;
foreach ($oeuvres as $oeuvre) {
    if ($oeuvre['id'] == $id) {
        $oeuvre_actuelle = $oeuvre;
        break;
    }
}

if (!$oeuvre_actuelle) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>The ArtBox</title>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <article id="detail-oeuvre">
        <div id="img-oeuvre">
            <img src="<?= $oeuvre_actuelle['image'] ?>" alt="<?= $oeuvre_actuelle['titre'] ?>">
        </div>
        <div id="contenu-oeuvre">
            <h1><?= $oeuvre_actuelle['titre'] ?></h1>
            <p class="description"><?= $oeuvre_actuelle['artiste'] ?></p>
            <p class="description-complete">
                <?= $oeuvre_actuelle['description'] ?>
            </p>
        </div>
    </article>
</main>
<?php include 'footer.php'; ?>
</body>
</html>