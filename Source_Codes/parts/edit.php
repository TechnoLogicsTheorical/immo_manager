<?php

    require_once '../parts/conf.php';

    require_once '../inc/basics_functions.php';
    require_once '../inc/databases_functions.php';

    $titleWebPage = 'Edition Intervention';
    require_once '../parts/header.php';

    if (!empty($_GET['id']) && $_GET['id'] !== 0) {
        $id = $_GET['id'];
        $db = connectDB(DB_CREDIENTIAL);

        $dataIntervention = readIntervention($db, $id);
        $dataEntitled = readAllNamesExist($db);
    } else {
        die('Une erreur est survenue');
    }
?>

    <main id="mainContent">
        <fieldset>
            <legend>Edition d'une intervention:</legend>
            <form method="POST">
                <label for="id">Identifiant</label>
                <input type="number" name="idItv" id="id" value="<?= $dataIntervention[0]['id'] ?>">

                <label for="name">Intutilé</label>
                <input list="popular-interventions" type="text" name="nameItv" id="name" value="<?= $dataIntervention[0]['name'] ?>">

                <datalist id='popular-interventions'>
                    <?php foreach ($dataEntitled as $dataName): ?>
                        <option value="<?= $dataName['name'] ?>"></option>
                    <?php endforeach ?>
                </datalist>
                
                <label for="date">Date</label>
                <input type="date" name="dateItv" id="date" value="<?= $dataIntervention[0]['date'] ?>">

                <label for="floor">Etage</label>
                <input type="number" name="floorItv" id="floor" value="<?= $dataIntervention[0]['floor'] ?>">
                
                <input type="submit" value="Editer">
            </form> 
        </fieldset>
    </main>

<?php require_once '../parts/footer.php'; ?>