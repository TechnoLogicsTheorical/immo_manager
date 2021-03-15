<?php
    require_once 'inc/basics_functions.php';
    require_once 'inc/databases_functions.php';

    $db = connectDB(DB_CREDIENTIAL);
    
    // echo $db->getAttribute(PDO::ATTR_CONNECTION_STATUS);

    //Faked data get in HTML FORM
    $infosHTML = [
        'name' => 'Remplacement Ampoule',
        'date' => '2011-02-12',
        'floor' => 1,
    ];

    // createIntervention($db, $infosHTML);
    
    $dataInterventions = readInterventions($db);

    debugHTML($dataInterventions);

    disconnectDB($db);
?>