<?php
    // Connexion BDD SRV 172.16.193.254

    // Information d'identification
    $servername = '127.0.0.1';
    $username   = 'hopital-user';
    $password   = 'bKmKTazcwWl3emRc';
    $db         = 'hopital-data';

    // Initialisation de la connexion (<IP>, <username>, <password>, <bdd_name>)
    $connexion_db = new mysqli($servername, $username, $password, $db);

    // On vérifie si la connexion est réussie
    if ($connexion_db->connect_error)
    {
        // La connexion a la BDD ne ces pas correctement initialisés 
        die("Connection failed: " . $connexion_db->connect_error);
    }
?>