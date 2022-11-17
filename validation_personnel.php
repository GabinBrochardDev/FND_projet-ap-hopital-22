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
    if( isset($_POST['nom']) && isset($_POST['prenom']) && (!empty($_POST['nom'])) && (!empty($_POST['prenom'])) )
    {
        // Initialisation des variables
        $nom_personne = $_POST['nom'];
        $prenom_personne = $_POST['prenom'];
        $sexe_personne = $_POST['sexe'];
        $admin_personne = $_POST['admin'];
        $metier_personne = $_POST['metier'];
        $service_personne = $_POST['service'];
        $identifiant_personne = strtolower($prenom_personne.'.'.$nom_personne);
        $password_personne = '';

        $sql = "SELECT * FROM personnel WHERE personnel.perIdentifiant LIKE '%".$identifiant_personne."%'";
        $result = $connexion_db->query($sql) or die(header('Location: ajout_personnel.php'));

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
            $identifiant_personne = $identifiant_personne.$cpt_ID;
        }

        // Affectation d'un mot de passe aléatoire à la variable $password_personne
        require('_motdepasse_aleatoire.php');

        /* Construction de la requête */
        $sql = "INSERT INTO personnel (perIdentifiant, perPassword, perNom, perPrenom, perSexe, perAdmin, idMetier, idService)
                VALUES ('".$identifiant_personne."', '".$password_personne."', '".$nom_personne."', '".$prenom_personne."', '".
                $sexe_personne."',".$admin_personne.", '".$metier_personne."', '" .$service_personne."')";

        /* Insertion des données */
        $result = $connexion_db->query($sql) or die(header('Location: ajout_personnel.php'));

        header('Location: ajout_personnel.php');
    }
    else
    {
        header('Location: ajout_personnel.php');
    }

?>