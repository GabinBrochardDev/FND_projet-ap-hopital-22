<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {
        header('Location: index.php');
    }
    // Déconnexion de la session
    $_SESSION['connexion'] = 0;
    // Redirection à la page de connexion
    header('Location: index.php');
?>