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
        $dataEntitled = readAllNamesExist($db);

        if (!empty($_POST['idItv']) && !empty($_POST['nameItv']) && !empty($_POST['dateItv']) && !empty($_POST['dateItv']) ) {
            $dataGoingSubmit = [];
            $dataGoingSubmit['id'] = (int)$_POST['idItv'];
            $dataGoingSubmit['name'] = $_POST['nameItv'];
            $dataGoingSubmit['date'] = $_POST['dateItv'];
            $dataGoingSubmit['floor'] = $_POST['floorItv'];

            if ($actualId !== $dataGoingSubmit['id'] ) {
                if( checkIfIdExist($db, $dataGoingSubmit['id']) == null){
                    modifyIntervention($db, $dataGoingSubmit, $actualId);
                    header('Location: ../index.php');
                } else {
                    die('Erreur l\'identifiant que vous souhaitez modifier correspond à un identifiant dans la base de données');
                }
            }
            modifyIntervention($db, $dataGoingSubmit, $actualId);
            header('Location: ../index.php');
        }
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
                <input list="exist-interventions" type="text" name="nameItv" id="name" value="<?= $dataIntervention[0]['name'] ?>">

                <datalist id='exist-interventions'>
                    <?php foreach ($dataEntitled as $dataName): ?>
                        <option value="<?= $dataName ?>"></option>
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