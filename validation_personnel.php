<?php

/* Connexion BDD Developpement

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
*/

//* Connexion BDD WSL

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


?>


<?php


if( (!empty($_POST['nom'])) && (!empty($_POST['prenom'])) && isset($_POST['nom']) && isset($_POST['prenom']) )
{
    $nom_personne = $_POST['nom'];
    $prenom_personne = $_POST['prenom'];
    $sexe_personne = $_POST['sexe'];
    $admin_personne = $_POST['admin'];
    $metier_personne = $_POST['metier'];
    $service_personne = $_POST['service'];
    $perIdentifiant = strtolower($prenom_personne.'.'.$nom_personne);

    $sql = "SELECT * FROM personnel WHERE personnel.perIdentifiant LIKE '%$perIdentifiant%'";
    $result = $connexion_db->query($sql) or die('Select - Erreur SQL ! '.$connexion_db->error );

    /* Détermine le nombre de lignes du jeu de résultats de la requête */
    $nb_lignes = $result->num_rows;
    /* Si le nombre de lignes du jeu de résultats est supérieur à 0, on augmente le numéro de l'identifiant de la personne */
    if ($nb_lignes > 0)
    {
      /* Compteur de boucle */
      $cpt_ID = 0;
      while ($row = $result->fetch_assoc())
      {  
        /* On incrémente le compteur pour chaque ligne du jeu de résultats */
        $cpt_ID++;
      }
      /* On modifie l'identifiant de la personne */
      $perIdentifiant = $perIdentifiant.$cpt_ID;
    }
    $result->free();

    /* Initialisation des chaines contenant les alphabets minuscules et majuscules, les caractères spéciaux et les chiffres */
    $alphabet_min = 'abcdefghijklmnopqrstuvwxyz';
    $alphabet_maj = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $sp_caracteres = '+-&$![]{}=()@#';
    $chiffres = '0123456789';
    /* Boucle pour créer un mot de passe automatique */
    for ($cpt_password = 0; $cpt_password < 3; $cpt_password++)
    {
      /* Ajout d'une lettre minuscule */
      $pos_alphabet_min = rand(0,strlen($alphabet_min)-1); /* Nombre alétoire de la chaine */
      $perPassword = $perPassword . $alphabet_min[$pos_alphabet_min]; /* Ajout du caractère au mot de passe */

      /* Ajout d'une lettre majuscule */
      $pos_alphabet_maj = rand(0,strlen($alphabet_maj)-1); /* Nombre alétoire de la chaine */
      $perPassword = $perPassword . $alphabet_maj[$pos_alphabet_maj]; /* Ajout du caractère au mot de passe */

      /* Ajout d'un caractère spécial */
      $pos_sp_caracteres = rand(0,strlen($sp_caracteres)-1); /* Nombre alétoire de la chaine */
      $perPassword = $perPassword . $sp_caracteres[$pos_sp_caracteres]; /* Ajout du caractère au mot de passe */

      /* Ajout d'un chiffre */
      $pos_chiffres = rand(0,strlen($chiffres)-1); /* Nombre alétoire de la chaine */
      $perPassword = $perPassword . $chiffres[$pos_chiffres]; /* Ajout du caractère au mot de passe */
    } 

    /* On mélange le mot de passe */
    $perPassword = str_shuffle($perPassword);

    /* Construction de la requête */
    $sql = "INSERT INTO personnel (perIdentifiant, perPassword, perNom, perPrenom, perSexe, perAdmin, idMetier, idService) VALUES ('$perIdentifiant', '$perPassword', '$nom_personne', '$prenom_personne', '$sexe_personne', $admin_personne, '$metier_personne', '$service_personne')";
    
    /* Insertion des données */
    $result = $connexion_db->query($sql) or die('Insert - Erreur SQL ! '.$connexion_db->error );
    
    echo "<html><body onload='pageIndex()'><script> function pageIndex() { location.replace('index.html') } </script></body></html>";
    //$result->free();
}
else
{
    echo "AJOUT DU PRODUIT IMPOSSIBLE !";
}

?>