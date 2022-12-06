<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {   
        header('Location: index.php');
    }
    // Informations de la connnexion à la base
    require('_connect.php');

    // On vérifie si les informations du patient et la salle existent et ont été saisis
    if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['sexe']) && isset($_POST['datenaissance']) && isset($_POST['numsecu'])
        && isset($_POST['service']) && isset($_POST['metier']) && isset($_POST['personnel']) && isset($_POST['salle']) && isset($_POST['dureerdv'])
        && isset($_POST['daterdv']) && isset($_POST['heurerdv'])
        && (!empty($_POST['nom'])) && (!empty($_POST['prenom'])) && (!empty($_POST['sexe'])) && (!empty($_POST['datenaissance'])) && (!empty($_POST['numsecu']))
        && (!empty($_POST['service'])) && (!empty($_POST['metier'])) && (!empty($_POST['personnel'])) && (!empty($_POST['salle'])) && (!empty($_POST['dureerdv']))
        && (!empty($_POST['daterdv'])) && (!empty($_POST['heurerdv'])) )
    {
        // Initialisation des variables
        $id_patient = $_POST['id_patient'];
        $nom_patient = $_POST['nom'];
        $prenom_patient = $_POST['prenom'];
        $sexe_patient = $_POST['sexe'];
        $datenaissance_patient = $_POST['datenaissance'];
        $numsecu_patient = $_POST['numsecu'];
        $service_id = $_POST['service'];
        $metier_id = $_POST['metier'];
        $personnel_id = $_POST['personnel'];
        $salle_id = $_POST['salle'];
        $duree_rdv = $_POST['dureerdv'];
        $date_rdv = $_POST['daterdv'];
        $heure_rdv = $_POST['heurerdv'];
        $observation_rdv = $_POST['observation'];   

        // Définition du fuseau horaire de Paris
        date_default_timezone_set('Europe/Paris');
        // Récupération de la date du jour
        $date_creation_rdv = date('Y-m-d H:i:s');
        // Création de la datetime du début du RDV
        $datetime_debut_rdv = $date_rdv.' '.$heure_rdv;
        $datetime_debut_rdv = strtotime($datetime_debut_rdv);
        // Création de la datetime de la fin du RDV
        $datetime_fin_rdv = $date_rdv.' '.$heure_rdv;
        $datetime_fin_rdv = strtotime($datetime_fin_rdv);
        $datetime_fin_rdv = strtotime("+{$duree_rdv} minute", $datetime_fin_rdv);

        // Requête
        $sql = "SELECT *
                FROM rendezVous
                WHERE rendezVous.renDateRdv = '".$date_rdv."'
                AND (rendezVous.renHeureDebutRdv BETWEEN '".date('Y-m-d H:i:s', $datetime_debut_rdv)."' AND '".date('Y-m-d H:i:s', $datetime_fin_rdv)."'
                    OR rendezVous.renHeureFinRdv BETWEEN '".date('Y-m-d H:i:s', $datetime_debut_rdv)."' AND '".date('Y-m-d H:i:s', $datetime_fin_rdv)."')
                AND rendezVous.idPersonnel = ".$personnel_id."
                AND rendezVous.idService = ".$service_id."
                AND rendezVous.renRdvEstAnnule = 0";

        // Résultat de la requête
        $result = $connexion_db->query($sql) or die(header('Location: accueil.php'));
        // On vérifie si une ligne n'est pas présente dans le résultat de la requête 
        if ( ($result->num_rows) == 0)
        {
            // Requête
            $sql = "SELECT *
                    FROM rendezVous
                    WHERE rendezVous.renDateRdv = '".$date_rdv."'
                    AND ( rendezVous.renHeureDebutRdv BETWEEN '".date('Y-m-d H:i:s', $datetime_debut_rdv)."' AND '".date('Y-m-d H:i:s', $datetime_fin_rdv)."'
                          OR rendezVous.renHeureFinRdv BETWEEN '".date('Y-m-d H:i:s', $datetime_debut_rdv)."' AND '".date('Y-m-d H:i:s', $datetime_fin_rdv)."')
                    AND rendezVous.idSalle = ".$salle_id."
                    AND rendezVous.renRdvEstAnnule = 0";

            // Résultat de la requête
            $result = $connexion_db->query($sql) or die(header('Location: accueil.php'));
            // On vérifie si une ligne n'est pas présente dans le résultat de la requête 
            if ( ($result->num_rows) == 0)
            {
                /* Construction de la requête */
                $sql = "INSERT INTO rendezVous (renDateRdv,	renHeureDebutRdv, renHeureFinRdv, renDateCreation,
                            renRdvEstAnnule, renObservation, idPersonnel, idService, idSalle, idPatient)
                        VALUES ('".$date_rdv."','".date('Y-m-d H:i:s', $datetime_debut_rdv)."','".date('Y-m-d H:i:s', $datetime_fin_rdv)."',
                        '".$date_creation_rdv."',0,'".$observation_rdv."',".$personnel_id.",".$service_id.",".$salle_id.",".$id_patient.")";

                /* Insertion des données */
                $result = $connexion_db->query($sql) or die(header('Location: rendezvous.php'));

                // On réinitialise la variable de session du message d'erreur du RDV
                $_SESSION['erreurRDV'] = '';
                header('Location: rendezvous.php');
            }
            else
            {   
                // On affiche la variable de session du message d'erreur du RDV
                $_SESSION['erreurRDV'] = 'Attention ! Un RDV existe déjà dans la salle sélectionnée pour l\'heure demandée.';
                header('Location: rendezvous.php');
            }
        }
        else
        {   
            // On affiche la variable de session du message d'erreur du RDV
            $_SESSION['erreurRDV'] = 'Attention ! Un RDV existe déjà avec le membre du personnel choisi pour l\'heure demandée.';
            header('Location: rendezvous.php');
        }
    }
    else
    {
        header('Location: '. $_SESSION['page']['protocole'] . $_SESSION['page']['adresse'] . '');
    }
?>