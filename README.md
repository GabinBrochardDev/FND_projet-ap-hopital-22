# projet-ap-hopital-22

## authentification.php

- Ajouter la variable de session liée à la première connexion de l'utilisateur. Il faudra ajouter la rubrique '**perConnexion**' dans la table associée '**personnel**'

````php
// Affectation de la variable de session avec les informations de la personne connectée
$_SESSION['user'] = [
                'nom' => $row['perNom'],
                'prenom' => $row['perPrenom'],
                'utilisateur' => $row['perIdentifiant'],
                'connexion' => $row['perConnexion'],
                'admin' => $row['perAdmin']
            ];

// On vérifie si l'utilisateur n'a pas modifié son mot de passe. On redirige vers la page de modification 'motdepasse.php'.
if ($_SESSION['user']['connexion'] == 0)
{
    // Affectation du mot de passe pour le modifier
    $_SESSION['motdepasse'] = $row['perPassword'];
    header('Location: motdepasse.php');
}
else // On affiche la page de l'atelier
{
    header('Location: atelier.php');
}
````

- [Dev] Création de la fonction JS 'rendezvous_ajax.js' pour afficher le tableau avec les patients
- [Dev] Création de la page PHP 'rendezvous_ajax_patient.php' éxécutée par la fonction 'rendezvous_ajax.js'
- [Dev] Création de la fonction 'service_metier.js' pour rafraichir la liste des metiers
- [Dev] Création de la page PHP 'personnel_ajax_service_metier.php' éxécutée par la fonction 'service_metier.js'