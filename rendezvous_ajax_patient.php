<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {
        header('Location: index.php');
    }
    // Informations de la connnexion à la base
    require('_connect.php');

    // Analyse du filtre
    if (isset($_GET['filtre']) && (!empty($_GET['filtre'])))
    {
        $filtre = $_GET['filtre'];

        // Requête
        $sql = "SELECT * FROM patient WHERE patient.patNom LIKE '%".$filtre."%' OR patient.patPrenom LIKE '%".$filtre."%' ORDER BY patient.patNom ASC, patient.patPrenom ASC";
        // Résultat de la requête
        $result = $connexion_db->query($sql) or die(header('Location: accueil.php'));
        // On vérifie si une ligne est présente dans le résultat de la requête 
        if ( ($result->num_rows) > 0)
        {
            // Construction du tableau
            $tableau = '<table class="table_rendezvous"><tr><th>Nom</th><th>Prénom</th><th>Sexe</th><th>Date de Naissance</th><th>N° Sécurité Sociale</th><th>Adresse</th><th>Code Postal</th><th>Ville</th><th>Pays</th></tr>';
            // On affiche chaque ligne trouvée du résultat de la requête
            while ($row = $result->fetch_assoc())
            {
                // Initialisation de la ligne du tableau
                $ligne_tab = '<tr id="'.$row['idPatient'].'">';
                // Ajout du nom
                $ligne_tab = $ligne_tab . '<td id="nom_'.$row['idPatient'].'">';
                $ligne_tab = $ligne_tab . $row['patNom'];
                $ligne_tab = $ligne_tab . '</td>';
                // Ajout du prénom
                $ligne_tab = $ligne_tab . '<td id="prenom_'.$row['idPatient'].'">';
                $ligne_tab = $ligne_tab . $row['patPrenom'];
                $ligne_tab = $ligne_tab . '</td>';
                // Ajout du sexe
                $ligne_tab = $ligne_tab . '<td id="sexe_'.$row['idPatient'].'">';
                $ligne_tab = $ligne_tab . $row['patSexe'];
                $ligne_tab = $ligne_tab . '</td>';
                // Ajout de la date de naissance
                $ligne_tab = $ligne_tab . '<td id="datenaissance_'.$row['idPatient'].'">';
                $date = date_create($row['patDateDeNaissance']);
                $ligne_tab = $ligne_tab . date_format($date, 'd/m/Y');
                $ligne_tab = $ligne_tab . '</td>';
                // Ajout du N° de Sécurité Sociale
                $ligne_tab = $ligne_tab . '<td id="numsecu_'.$row['idPatient'].'">';
                $ligne_tab = $ligne_tab . $row['patNumSecuriteSocial'];
                $ligne_tab = $ligne_tab . '</td>';
                // Ajout de l'adresse
                $ligne_tab = $ligne_tab . '<td id="adresse_'.$row['idPatient'].'">';
                $ligne_tab = $ligne_tab . $row['patAdresse'];
                $ligne_tab = $ligne_tab . '</td>';
                // Ajout du Code Postal
                $ligne_tab = $ligne_tab . '<td id="codepostal_'.$row['idPatient'].'">';
                $ligne_tab = $ligne_tab . $row['patCodePostal'];
                $ligne_tab = $ligne_tab . '</td>';
                // Ajout de la ville
                $ligne_tab = $ligne_tab . '<td id="ville_'.$row['idPatient'].'">';
                $ligne_tab = $ligne_tab . $row['patVille'];
                $ligne_tab = $ligne_tab . '</td>';
                // Ajout du pays
                $ligne_tab = $ligne_tab . '<td id="pays_'.$row['idPatient'].'">';
                $ligne_tab = $ligne_tab . $row['patPays'];
                $ligne_tab = $ligne_tab . '</td>';
                // Fermeture de la ligne du tableau
                $ligne_tab = $ligne_tab . '</tr>';
                // Ajout de la ligne dans le tableau
                $tableau = $tableau . $ligne_tab;
            }
            // Affichage du tableau
            $tableau = $tableau . '</table>';
            echo $tableau;
            exit;
        }
        else // La requête renvoie aucun résultat. On affiche un message.
        {
            echo "Aucune suggestion.";
            exit;
        }
    }
    else
    {
        // Si le filtre n'exsite pas, on affiche le message et on arrête le traitement
        echo 'Aucune suggestion.';
        exit;
    }

    /*
   // On est sûr que le filtre est bon, on peut effectuer la filtre
   if (($filtre == 'l') ||  ($filtre == 'L')) {
    echo 'ludo';
   }
   else  {
    echo 'papa';
   }
   */

   


?>