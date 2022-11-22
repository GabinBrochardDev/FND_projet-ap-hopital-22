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
    if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['numsecu'])
        && isset($_POST['adresse']) && isset($_POST['codepostal']) && isset($_POST['ville']) && isset($_POST['pays'])
        && isset($_POST['daterdv']) && isset($_POST['heurerdv']) && isset($_POST['salle']) && isset($_POST['observation'])
        && (!empty($_POST['nom'])) && (!empty($_POST['prenom'])) && (!empty($_POST['datenaissance'])) && (!empty($_POST['numsecu']))
        && (!empty($_POST['adresse'])) && (!empty($_POST['codepostal'])) && (!empty($_POST['ville'])) && (!empty($_POST['pays']))
        && (!empty($_POST['daterdv'])) && (!empty($_POST['heurerdv'])) && (!empty($_POST['salle'])) && (!empty($_POST['observation'])) )
    {
        // Initialisation des variables
        $nom_patient = $_POST['nom'];
        $prenom_patient = $_POST['prenom'];
        $sexe_patient = $_POST['sexe'];
        $datenaissance_patient = $_POST['datenaissance'];
        $numsecu_patient = $_POST['numsecu'];
        $adresse_patient = $_POST['adresse'];
        $codepostal_patient = $_POST['codepostal'];
        $ville_patient = $_POST['ville'];
        $pays_patient = $_POST['pays'];
        $date_rdv = $_POST['daterdv'];
        $heure_rdv = $_POST['heurerdv'];
        $salle_rdv = $_POST['salle'];
        $observation_rdv = ['observation'];        

        /* Construction de la requête */
        $sql = "INSERT INTO rendezVous (renDateRdv,	renHeureRdv, renDateCreation, renRdvEstAnnule,
                                        renObservation, idPersonnel, idService, idSalle, idPatient)
                VALUES ()";

        /* Insertion des données */
        $result = $connexion_db->query($sql) or die(header('Location: patient_nouveau.php'));

        header('Location: rendezvous.php');
    }
    else
    {
        header('Location: '. $_SESSION['page']['protocole'] . $_SESSION['page']['adresse'] . '');
    }
?>