<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {
        header('Location: index.php');
    }
    // Informations de la connnexion à la base
    require('_connect.php');

    // On vérifie si le 'mot de passe' existen et a été saisi par l'utilisateur
    if( isset($_GET['id_rdv']) && (!empty($_GET['id_rdv'])) )
    {
        // Initialisation des variables
        $id_rdv = $_GET['id_rdv'];

        // Requête
        $sql = "SELECT * FROM rendezVous WHERE rendezVous.idRendezVous = ".$id_rdv;

        // Résultat de la requête
        $result = $connexion_db->query($sql) or die(header('Location: motdepasse.php'));
        // On vérifie si une ligne est présente dans le résultat de la requête 
        if ( ($result->num_rows) > 0)
        {
            // Requête
            $sql = "UPDATE rendezVous SET rendezVous.renRdvEstAnnule = 1 WHERE rendezVous.idRendezVous = ".$id_rdv;
            // Résultat de la requête
            $result = $connexion_db->query($sql) or die(header('Location: motdepasse.php'));
            // Redirection à la page 'rendezvous_gestion.php'
            header('Location: rendezvous_gestion.php');
        }
        else // La requête ne fonctionne pas. On affiche la page 'rendezvous_gestion.php'.
        {
            header('Location: rendezvous_gestion.php');
        }
    }
    else // Les variables et données n'existent pas. On affiche la dernière page de l'utilisateur.
    {
        header('Location: '. $_SESSION['page']['protocole'] . $_SESSION['page']['adresse'] . '');
    }
?>