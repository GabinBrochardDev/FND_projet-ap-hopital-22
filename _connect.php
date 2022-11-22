<?php
    // Connexion BDD Developpement

    $servername = "172.16.193.254";
    $username = "hopital-user";
    $password = "bKmKTazcwWl3emRc";
    $db = "hopital-data";

    // Create connection
    $connexion_db = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($connexion_db->connect_error) {
        die("Connection failed: " . $connexion_db->connect_error);
    }
    

    
    /* Connexion BDD WSL

    $servername = "localhost";
    $username = "root";
    $password = '$SrvLudo+00!';
    $db = "hopital-data";

    // Create connection
    $connexion_db = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($connexion_db->connect_error) {
        die("Connection failed: " . $connexion_db->connect_error);
    }
    */
?>