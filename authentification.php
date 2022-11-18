<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {
        header('Location: index.php');
    }
    // Informations de la connnexion à la base
    require('_connect.php');

    // On vérifie si le 'login' et le 'mot de passe' existent et ont été saisi par l'utilisateur
    if( isset($_POST['login']) && isset($_POST['password'])  && (!empty($_POST['login'])) && (!empty($_POST['password'])) )
    {
        // Initialisation des variables
        $login = $_POST['login'];
        $password = $_POST['password'];
        // Chiffrage du mot de passe de l'utilisateur en SHA-256
        $hashage_password = crypt($password, '$5$HasHpWdHOpitALlr$');
        // Requête
        $sql = "SELECT * FROM personnel WHERE (personnel.perIdentifiant = '".$login."') AND (personnel.perPassword = '".$password."') OR (personnel.perPassword = '".$hashage_password."')";
        // Résultat de la requête
        $result = $connexion_db->query($sql) or die(header('Location: index.php'));
        if ($row = $result->fetch_assoc())
        {
            // Affectation de la variable de session de connexion 
            $_SESSION['connexion'] = 1;
    
            // Affectation du message d'erreur lié à l'authentification
            $_SESSION['erreur_authentification'] = "";        

            // Affectation de la variable de session avec les informations de la personne connectée
            $_SESSION['user'] = [
                                    'nom' => $row['perNom'],
                                    'prenom' => $row['perPrenom'],
                                    'utilisateur' => $row['perIdentifiant'],
                                    'connexion' => $row['perPremiereConnexion'],
                                    'admin' => $row['perAdmin']
                                ];

            // On vérifie si l'utilisateur n'a pas modifié son mot de passe. On redirige vers la page de modification 'motdepasse.php'.
            if ($_SESSION['user']['connexion'] == 0)
            {
                // Affectation du mot de passe pour le modifier
                $_SESSION['motdepasse'] = $row['perPassword'];
                header('Location: motdepasse.php');
            }
            else // On affiche la page 'accueil.php'.
            {
                header('Location: accueil.php');
            }
        }
        else // La requête ne fonctionne pas. On affiche la page 'index.php'.
        {
            // Affectation du message d'erreur lié à l'authentification
            $_SESSION['erreur_authentification'] = "Le login ou le mot de passe est incorrect.";
            header('Location: index.php');
        }
    }
    else // Les variables et données n'existent pas. On affiche la dernière page de l'utilisateur.
    {
        // Affectation du message d'erreur lié à l'authentification
        $_SESSION['erreur_authentification'] = "Le login ou le mot de passe n'a pas été saisi.";
        header('Location: '. $_SESSION['page']['protocole'] . $_SESSION['page']['adresse'] . '');
    }
?>