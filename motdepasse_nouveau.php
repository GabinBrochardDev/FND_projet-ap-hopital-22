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
    if( isset($_POST['login']) && isset($_POST['ancien_password']) && isset($_POST['password']) && (!empty($_POST['login'])) && (!empty($_POST['ancien_password'])) && (!empty($_POST['password'])) )
    {
        // Initialisation des variables
        $login = $_POST['login'];
        $ancien_password = $_POST['ancien_password'];
        $password = $_POST['password'];
        $nom = $_SESSION['user']['nom'];
        $prenom = $_SESSION['user']['prenom'];

        // Requête
        $sql = "SELECT * FROM personnel WHERE (personnel.perIdentifiant = '".$login."') AND (personnel.perPassword = '".$ancien_password."')";
        // Résultat de la requête
        $result = $connexion_db->query($sql) or die(header('Location: motdepasse.php'));
        if ($row = $result->fetch_assoc())
        {
            // Suppression de l'ancien mot de passe de la variable de session
            $_SESSION['motdepasse'] = "";
            // Chiffrage du mot de passe de l'utilisateur en SHA-256
            $password = crypt($password, '$5$HasHpWdHOpitALlr$');

            // Requête
            $sql = "UPDATE personnel SET personnel.perPassword = '" . $password . "', personnel.perPremiereConnexion = 1 WHERE (personnel.perNom = '" . $nom . "') AND (personnel.perPrenom = '" . $prenom . "') AND (personnel.perIdentifiant = '" . $login . "')";
            // Résultat de la requête
            $result = $connexion_db->query($sql) or die(header('Location: motdepasse.php'));
            // Modification de la variable de session indiquant la modification du mot de passe de l'utilisateur
            $_SESSION['user']['connexion'] = 1;
            // Redirection à la page 'index.php' pour se connecter avec le nouveau mot de passe
            header('Location: index.php');
        }
        else // La requête ne fonctionne pas. On affiche la page 'motdepasse.php'.
        {
            header('Location: motdepasse.php');
        }
    }
    else // Les variables et données n'existent pas. On affiche la dernière page de l'utilisateur.
    {
        header('Location: '. $_SESSION['page']['protocole'] . $_SESSION['page']['adresse'] . '');
    }
?>