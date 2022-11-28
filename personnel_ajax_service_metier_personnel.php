<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {
        header('Location: index.php');
    }
    // Informations de la connnexion à la base
    require('_connect.php');

    // Analyse des filtres
    if (isset($_GET['service_selectionne']) && isset($_GET['metier_selectionne']) && (!empty($_GET['service_selectionne'])) && (!empty($_GET['metier_selectionne'])))
    {
        // Initialisation des filtres du service et du métier
        $filtre_service = $_GET['service_selectionne'];
        $filtre_metier = $_GET['metier_selectionne'];

        // Tableau avec les noms des colonnes sélectionnées de la table 'Personnel'
        $personnel_colonnes = ['idPersonnel','perNom','perPrenom'];
        // Requête
        $sql = "SELECT *
                FROM personnel
                WHERE personnel.idService = ".$filtre_service."
                AND personnel.idMetier = ".$filtre_metier."
                ORDER BY personnel.perNom, personnel.perPrenom ASC";

        // Résultat de la requête
        $result = $connexion_db->query($sql) or die('Select - Erreur SQL ! '.$connexion_db->error );
        // On vérifie si une ligne est présente dans le résultat de la requête 
        if ( ($result->num_rows) > 0)
        {
            // On affiche le début de la liste
            echo '<select name="personnel" id="personnel">';
            // On boucle tant que l'on trouve une ligne dans le résultat de la requête
            while ($row = $result->fetch_assoc())
            {  
                // On affiche la ligne en cours de la liste
                echo '<option value=\'' . $row[$personnel_colonnes[0]] . '\'>' . $row[$personnel_colonnes[1]] . ' ' . $row[$personnel_colonnes[2]] . '</option>';
            }
            // On ferme la liste
            echo '</select>';
        }
        else
        {
            // Si la requête ne renvoie aucun résultat, on affiche le message et on arrête le traitement.
            echo '<select name="personnel" id="personnel"><option value=0>Aucun membre du personnel associé.</option></select>';
        }
    }
    else
    {
        // Si le filtre n'exsite pas, on affiche le message et on arrête le traitement.
        echo '<select name="personnel" id="personnel"><option value=0>Aucun membre du personnel associé.</option></select>';
    }
?>