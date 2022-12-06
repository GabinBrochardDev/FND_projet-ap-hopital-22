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

        // Tableau avec les noms des colonnes sélectionnées de la table 'Salle'
        $salle_colonnes = ['idSalle','salLibelle'];
        // Requête
        $sql = "SELECT *
                FROM salle, service
                WHERE salle.idService = ".$filtre_service."
                AND salle.idService = service.idService";

        // Résultat de la requête
        $result = $connexion_db->query($sql) or die('Select - Erreur SQL ! '.$connexion_db->error );
        // On vérifie si une ligne est présente dans le résultat de la requête 
        if ( ($result->num_rows) > 0)
        {
            // On affiche le début de la liste
            echo '<select class="informations_rendezvous" name="salle" id="salle">';
            // On boucle tant que l'on trouve une ligne dans le résultat de la requête
            while ($row = $result->fetch_assoc())
            {  
                // On affiche la ligne en cours de la liste
                echo '<option value="' . $row[$salle_colonnes[0]] . '">' . $row[$salle_colonnes[1]] . '</option>';
            }
            // On ferme la liste
            echo '</select>';
        }
        else
        {
            echo '<select class="informations_rendezvous" name="salle" id="salle"><option value="0">Aucune salle répertoriée.</option></select>';
        }
    }
    else // Le filtre n'existe pas et est vide. On affiche un message.
    {
        echo '<select class="informations_rendezvous" name="salle" id="salle"><option value="0">Aucune salle répertoriée.</option></select>';
    }
?>