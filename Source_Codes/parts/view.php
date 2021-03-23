<?php
    require_once '../parts/conf.php';
    
    require_once '../inc/basics_functions.php';
    require_once '../inc/databases_functions.php';
    
    $titleWebPage = 'Edition Intervention';
    require_once '../parts/header.php';

    if (!empty($_GET['id']) && $_GET['id'] !== 0) {
        $actualId = (int)$_GET['id'];
        $db = connectDB(DB_CREDIENTIAL);

        $dataIntervention = readIntervention($db, $actualId);

    } else {
        die('Une erreur est survenue');
    }
?>

    <main id="mainContent">
        <fieldset>
            <legend>Detail de l'intervention:</legend>
            <form method="POST">
                <label for="id">Identifiant</label>
                <input  disabled type="number" name="idItv" id="id" value="<?= $dataIntervention[0]['id'] ?>">

                <label for="name">Intutilé</label>
                <input  disabled type="text" name="nameItv" id="name" value="<?= $dataIntervention[0]['name'] ?>">
                
                <label for="date">Date</label>
                <input disabled type="date" name="dateItv" id="date" value="<?= $dataIntervention[0]['date'] ?>">

                <label for="floor">Etage</label>
                <input disabled type="number" name="floorItv" id="floor" value="<?= $dataIntervention[0]['floor'] ?>">

            </form>
        </fieldset>
        <p>Que souhaitez vous faire ?</p>
        <a href="edit.php?id=<?= $actualId ?>">Editer</a><a href="delete.php?id=<?= $actualId ?>">Supprimer</a>
    </main>

<?php require_once '../parts/footer.php'; ?>