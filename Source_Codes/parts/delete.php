<?php
    require_once '../parts/conf.php';
    
    require_once '../inc/basics_functions.php';
    require_once '../inc/databases_functions.php';
    
    $titleWebPage = 'Edition Intervention';
    require_once '../parts/header.php';

    $db = connectDB(DB_CREDIENTIAL);
    if (!empty($_GET['id']) && $_GET['id'] !== 0) {
        $id = (int)$_GET['id'];
        if ($_GET['confirm'] !== null && $_GET['confirm'] == 'yes') {
            deleteIntervention($db, $id);
            header('Location: ../index.php');
        }
        elseif ($_GET['confirm'] == 'no') {
            header('Location: ../index.php');
        }
    }
    else {
        echo 'L\'identifiant que vous avez essayer d\'atteindre est incorrect';
    }
?>

    <main id="mainContent">
        Vous etes sur le point de supprimer la donnée dans la base de données !

        Voulez-vous confirmer cette action ?

        <a href="delete.php?id=<?=$id?>&confirm=yes">Je Confirme</a>
        <a href="delete.php?id=<?=$id?>&confirm=no">J'annule</a>
    </main>

<?php require_once '../parts/footer.php' ?>