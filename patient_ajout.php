<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {   
        header('Location: index.php');
    }
    // Informations de la connnexion à la base
    require('_connect.php');

    // On vérifie si le nom et le prénom existent et ont été saisis
    if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['numsecu']) && isset($_POST['adresse']) && isset($_POST['codepostal']) && isset($_POST['ville']) && isset($_POST['pays'])
        && (!empty($_POST['nom'])) && (!empty($_POST['prenom'])) && (!empty($_POST['datenaissance'])) && (!empty($_POST['numsecu'])) && (!empty($_POST['adresse'])) && (!empty($_POST['codepostal'])) && (!empty($_POST['ville'])) && (!empty($_POST['pays'])) )
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

        /* Construction de la requête */
        $sql = "INSERT INTO patient (patNom, patPrenom, patSexe, patDateDeNaissance, patNumSecuriteSocial,
                                    patAdresse, patVille, patCodePostal, patPays)
                VALUES ('".$nom_patient."', '".$prenom_patient."', '".$sexe_patient."', '".$datenaissance_patient."', '".
                $numsecu_patient."', '".$adresse_patient."', '".$ville_patient."', '" .$codepostal_patient."', '" .$pays_patient."')";

        /* Insertion des données */
        $result = $connexion_db->query($sql) or die(header('Location: patient_nouveau.php'));

        header('Location: rendezvous.php');
    }
    else
    {
        header('Location: '. $_SESSION['page']['protocole'] . $_SESSION['page']['adresse'] . '');
    }
?>