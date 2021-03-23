<?php

    /** Fonction permettant de prevenir des données saisies par un utilisateur récuperer dans une page web
     * @param mixed $data
     * Argument prennant une donnée à traiter
     * @return $data
     * Retourne une donnée de n'importe quelle type
     */
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
     * @param array $data
     * Argument de type tableau nécessaire ayant pour jeu de données :
     * Un nom : ayant pour clé 'name'
     * Une date : ayant pour clé 'date', il faudra potentiellement convertir la date autrement dit la formater !!!
     * Un étage : ayant pour clé 'floor'
     */
    function createIntervention(PDO $db, array $data) {
        $tableName = DB_CREDIENTIAL['interventionsTable'];

        try {
            $db->beginTransaction();

            $query = $db->prepare("INSERT INTO $tableName (`name`,`date`,`floor`) VALUES (:nameItv, :dateItv, :floorItv)");
            
            $query->bindParam(':nameItv', $data['name'], PDO::PARAM_STR);
            $query->bindParam(':dateItv', $data['date']);
            $query->bindParam(':floorItv', $data['floor']);

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
        $tableName = DB_CREDIENTIAL['interventionsTable'];

        try {
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

    /** Fonction de lecture d'une intervention seule par rapport à un identifiant
     * @param PDO $db
     * Argument de connexion à la base de données
     * @param int $id
     * Argument permettant à la requete de récuperer selon l'identifiant d'une intervention 
     */
    function readIntervention (PDO $db, int $id) {
        $tableName = DB_CREDIENTIAL['interventionsTable'];

        try {
            $db->beginTransaction();

            $query = $db->prepare("SELECT * FROM $tableName WHERE id = :idItv");
            
            $query->bindParam(':idItv', $id);

            $query->execute();

            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $db->commit();
            
            $query = null;

            return $result;

        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    /** Fonction de lecture de base de donnée permettant de récuperer les differents noms des interventions
     * @param PDO $db
     * Argument de connexion à la base de données
     */
    function readAllNamesExist(PDO $db) {
        $tableName = DB_CREDIENTIAL['interventionsTable'];
        
        try {
            $db->beginTransaction();

            $query = $db->prepare("SELECT DISTINCT `name` FROM $tableName");
            $query->execute();

            $result = $query->fetchAll(PDO::FETCH_COLUMN,0);
            $query = null;

            $db->commit();

            return $result;

        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    /** Fonction permettant de vérifier si un identifiant correspond à une donnée
     * @param PDO $db
     * Argument de connexion à la base de données
     */
    function checkIfIdExist(PDO $db, int $id) {
        $tableName = DB_CREDIENTIAL['interventionsTable'];

        try {
            $db->beginTransaction();

            $query = $db->prepare("SELECT * FROM $tableName WHERE id = $id");
            $query->execute();

            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $query = null;

            $db->commit();

            return $result;

        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    /** Fonction de modification d'une intervention dans la base de données
     * @param PDO $db
     * Argument de connexion de la base de données
     * @param array $data
     * Argument de type tableau permettant de récuperer les données modifiées
     */
    function modifyIntervention (PDO $db, array $data, int $actualID) {
        try {
            $id = dataProcessing((int)$data['id']);
            $name = dataProcessing($data['name']);
            $date = dataProcessing($data['date']);
            $floor = dataProcessing($data['floor']);

            $tableName = DB_CREDIENTIAL['interventionsTable'];

            $db->beginTransaction();

            $query = $db->prepare("UPDATE $tableName SET `id` = :idItv, `name` = :nameItv, `date`= :dateItv, `floor`= :floorItv WHERE id = $actualID");
            
            $query->bindParam(':idItv', $id);
            $query->bindParam(':nameItv', $name);
            $query->bindParam(':dateItv', $date);
            $query->bindParam(':floorItv', $floor);

            $query->execute();

            $db->commit();

        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
            $db->rollBack();
        }
    }


    /** Fonction de suppression d'une intervention
     * @param PDO $db
     * Argument de connexion à la base de données
     * @param $data
     */
    function deleteIntervention(PDO $db, $data) {
        $tableName = DB_CREDIENTIAL['interventionsTable'];

        try {
            $db->beginTransaction();

            $query = $db->prepare("DELETE FROM $tableName WHERE id = :idItv");
            
            $query->bindParam(':idItv', $data);

            $query->execute();

            $db->commit();

        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
            $db->rollBack();
        }
    }