<?php
    // Démarrage ou suite de la session
    session_start();
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == false) )
    {
        header('Location: index.php');
    }
    // Démarrage ou suite de la session
    session_start();
    // Déconnexion de la session
    $_SESSION['connexion'] = false;
    // Redirection à la page de connexion
    header('Location: index.php');
?>