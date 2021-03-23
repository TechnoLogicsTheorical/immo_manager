<?php
    require_once '../parts/conf.php';
    
    require_once '../inc/basics_functions.php';
    require_once '../inc/databases_functions.php';
    
    $titleWebPage = 'Edition Intervention';
    require_once '../parts/header.php';

    $db = connectDB(DB_CREDIENTIAL);
    $dataEntitled = readAllNamesExist($db);

    if ( !empty($_POST['nameItv']) && !empty($_POST['dateItv']) && !empty($_POST['dateItv']) ) {
        $dataGoingSubmit = [];
        $dataGoingSubmit['name'] = $_POST['nameItv'];
        $dataGoingSubmit['date'] = $_POST['dateItv'];
        $dataGoingSubmit['floor'] = $_POST['floorItv'];

        createIntervention($db, $dataGoingSubmit);
        header('Location: ../index.php');
            
    }
?>

    <main id="mainContent">
        <fieldset>
            <legend>Ajout d'une intervention:</legend>
            <form method="POST">
                <label for="name">Intutilé</label>
                <input list="exist-interventions" type="text" name="nameItv" id="name">

                <datalist id='exist-interventions'>
                    <?php foreach ($dataEntitled as $dataName): ?>
                        <option value="<?= $dataName ?>"></option>
                    <?php endforeach ?>
                </datalist>
                
                <label for="date">Date</label>
                <input type="date" name="dateItv" id="date">

                <label for="floor">Etage</label>
                <input type="number" name="floorItv" id="floor">
                
                <input type="submit" value="Editer">
            </form> 
        </fieldset>
    </main>

<?php require_once '../parts/footer.php'; ?>