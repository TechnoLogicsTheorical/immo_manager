<?php
    /* @var array 
    Variable Constante permettant d'accueillir les données nécessaires à la base de données
    */
    const DB_CREDIENTIAL = [
        'databaseName' => 'immo_manager',
        'adressIP' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'interventionsTable' => 'im_interventions',
    ];

    function dataProcessing (mixed $data) {
        // Prévient les failles XSS
        $data = htmlentities($data);
        $data = strip_tags($data);

        return $data;
    }

    /** Fonction de connexion à une base de données par le biais de l'objet abstrait de PDO
     * @param array $crediential
     * Argument de fonction nécessaire à l'execution de cette dernière utilisant les informations de connexion pour la BDD
     * @return PDO
     * Retourne un objet pour le stocker dans une variable
     */
    function connectDB( array $crediential ) {
        try {
            $db = new PDO('mysql:host='. $crediential['adressIP'] . '; dbname=' . $crediential['databaseName'], $crediential['user'], $crediential['pass'], [PDO::ATTR_PERSISTENT => true] );
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo 'Erreur Critique: ' . $e -> getMessage() . '<br/>';
            die();
        }
    }

    /** Fonction pour déconnexion à la base de données
     * @param PDO $db
     * Argument nécessaire, base de données étant un objet de PDO
    */
    function disconnectDB( PDO $db ) {
        if ( isset($db) && is_object($db))  {
            $db = null;
        } else {
            echo 'Erreur : Ce n\'est pas un objet PDO ou est déjà vide';
        }
    }

    /** Fonction de création d'une intervention dans la base de données permettant l'insertion dans la table des interventions
     * @param PDO $db
     * Argument de base de données connectée nécessaire
     * @param array $infosHTML
     * Argument de type tableau nécessaire ayant pour jeu de données :
     * Un nom : ayant pour clé 'name'
     * Une date : ayant pour clé 'date', il faudra potentiellement convertir la date autrement dit la formater !!!
     * Un étage : ayant pour clé 'floor'
     */
    function createIntervention(PDO $db, array $infosHTML) {
        try {
            $tableName = DB_CREDIENTIAL['interventionsTable'];
            
            $db->beginTransaction();

            $query = $db->prepare("INSERT INTO $tableName (`name`,`date`,`floor`) VALUES (:nameItv, :dateItv, :floorItv)");
            
            $query->bindParam(':nameItv', $infosHTML['name'], PDO::PARAM_STR);
            $query->bindParam(':dateItv', $infosHTML['date']);
            $query->bindParam(':floorItv', $infosHTML['floor']);

            $query->execute();
            
            $db->commit();
            $query = null;
        } catch (Exception $e) {
            $db->rollBack();
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    /** Fonction de lecture des données de la table des interventions permettant de traiter les données et les affichées.
     * @param PDO $db
     * Argument de fonction nécessaire à l'execution de la réquete SQL
     */
    function readInterventions (PDO $db) {
        try {
            $tableName = DB_CREDIENTIAL['interventionsTable'];
            $db->beginTransaction();

            $query = $db->prepare("SELECT * FROM $tableName");
            
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $db->commit();
            
            $query = null;

            return $result;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    // Code non terminée
    function modifyIntervention (PDO $db, array $data) {
        try {
            $tableName = DB_CREDIENTIAL['interventionsTable'];
            $db->beginTransaction();

            dataProcessing($data);

            $query = $db->prepare("UPDATE $tableName 
            SET `name` = ,
            `date`= ,
            `floor`=  
            WHERE id = ");

        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
            $db->rollBack();
        }
    }

    

?>