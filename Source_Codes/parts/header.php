<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= getTitle($titleWebPage) ?></title>

        <?php 
            $base = $_SERVER['HTTP_HOST'];
            $siteName = 'immo_manager/Source_Codes';

            $_SERVER['DOCUMENT_ROOT'] = 'http://' . $base . '/' . $siteName
        ?>

        <link rel="stylesheet" href="<?= $_SERVER['DOCUMENT_ROOT'] ?>/assets/css/main_style.css">
    </head>
<<<<<<< Updated upstream
    <body>
=======
    <body>

        <header id='mainHeader'>
            <div class="logo">
                <h1>Immo Manager</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="<?= $_SERVER['DOCUMENT_ROOT'] ?>/index.php">Accueil</a></li>
                    <li><a href="#">Ajouter</a></li>
                </ul>
            </nav>
        </header>
>>>>>>> Stashed changes
