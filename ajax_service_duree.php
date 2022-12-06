<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {
        header('Location: index.php');
    }
    // Informations de la connnexion à la base
    require('_connect.php');

    // Analyse du filtre
    if (isset($_GET['service_selectionne']) && (!empty($_GET['service_selectionne'])))
    {
        // Initialisation du filtre du service
        $filtre_service = $_GET['service_selectionne'];

        // Tableau avec les noms des colonnes sélectionnées de la table 'Service'
        $service_colonnes = ['idService','serLibelle','serDuree'];
        // Requête
        $sql = "SELECT *
                FROM service
                WHERE service.serPrendRDV = 1
                AND service.idService = ".$filtre_service;

        // Résultat de la requête
        $result = $connexion_db->query($sql) or die(header('Location: accueil.php'));
        // On vérifie si une ligne est présente dans le résultat de la requête 
        if ( ($result->num_rows) > 0)
        {
            // On récupère les informations de la requête si le fetch est possible
            if ($row = $result->fetch_assoc())
            {  
                // On affiche la durée du premier service de la liste
                echo $row[$service_colonnes[2]];
            }
        }
        else
        {
            // On affiche le champ 'input' vide
            echo '0';
        }
    }
    else // Le filtre n'existe pas et est vide. On affiche un message.
    {
        echo '0';
    }
?>