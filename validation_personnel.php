<?php

  $servername = "172.16.193.254";
  $username = "hopital-user"; // Later : "UserRugby"
  $password = "bKmKTazcwWl3emRc"; // Later : +StadeRochelais+17000€
  $db = "hopital-data";

  // Create connection
  $connexion_db = new mysqli($servername, $username, $password, $db);

  // Check connection
  if ($connexion_db->connect_error) {
    die("Connection failed: " . $connexion_db->connect_error);
  }

?>


<?php


if( (!empty($_POST['nom'])) && (!empty($_POST['prenom'])) && isset($_POST['nom']) && isset($_POST['prenom']) )
{
    $perIdentifiant = "10555511";
    $perPassword = "Ok";
    $nom_personne = $_POST['nom'];
    $prenom_personne = $_POST['prenom'];
    $sexe_personne = $_POST['sexe'];
    $metier_personne = $_POST['metier'];
    $service_personne = $_POST['service'];

    $sql = "INSERT INTO personnel (perIdentifiant, perPassword, perNom, perPrenom, perSexe, idMetier, idService) VALUES ('$perIdentifiant', '$perPassword', '$nom_personne', '$prenom_personne', '$sexe_personne', '$metier_personne', '$service_personne')";

    $result = $connexion_db->query($sql) or die('Select - Erreur SQL ! '.$connexion_db->error );
    echo "<html><body onload='pageIndex()'><script> function pageIndex() { location.replace('index.html') } </script></body></html>";
    //$result->free();
}
else
{
    echo "AJOUT DU PRODUIT IMPOSSIBLE !";
}

?>