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

        // Tableau avec les noms des colonnes sélectionnées de la table 'Metier'
        $metier_colonnes = ['idMetier','metLibelle'];
        // Requête
        $sql = "SELECT *
                FROM metier, service, metier_service
                WHERE service.idService = ".$filtre_service."
                AND service.idService = metier_service.idService
                AND metier_service.idMetier = metier.idMetier
                ORDER BY metier.metLibelle";

        // Résultat de la requête
        $result = $connexion_db->query($sql) or die('Select - Erreur SQL ! '.$connexion_db->error );
        // On vérifie si une ligne est présente dans le résultat de la requête 
        if ( ($result->num_rows) > 0)
        {
            // On affiche le début de la liste
            echo '<select name="metier" id="metier">';
            // On boucle tant que l'on trouve une ligne dans le résultat de la requête
            while ($row = $result->fetch_assoc())
            {  
                // On affiche la ligne en cours de la liste
                echo '<option value="' . $row[$metier_colonnes[0]] . '">' . $row[$metier_colonnes[1]] . '</option>';
            }
            // On ferme la liste
            echo '</select>';
        }
        else
        {
            // Si la requête ne renvoie aucun résultat, on affiche le message et on arrête le traitement.
            echo '<select name="metier" id="metier"><option value=0>Aucune métier répertorié.</option></select>';
        }
    }
    else // Le filtre n'existe pas et est vide. On affiche un message.
    {
        echo '<select name="metier" id="metier"><option value=0>Aucune métier répertorié.</option></select>';
    }
?>