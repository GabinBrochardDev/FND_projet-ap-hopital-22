Requêtes SQL pour le client léger Web-PHP
===

- ## ajax_patient.php
```php
// Requête - Sélection des patients avec un filtre sur le nom ou le prénom pour affecter un RDV à un patient
$sql = "SELECT *
        FROM patient
        WHERE patient.patNom LIKE '%".$filtre."%'
        OR patient.patPrenom LIKE '%".$filtre."%'
        ORDER BY patient.patNom ASC, patient.patPrenom ASC";
```
<br>

- ## ajax_service_duree.php
```php
// Requête - Sélection du service selon son ID pour récupérer et modifier l'affichage de la durée du service lors d'un RDV
$sql = "SELECT *
        FROM service
        WHERE service.serPrendRDV = 1
        AND service.idService = ".$filtre_service;
```
<br>

- ## ajax_service_metier_personnel.php
```php
// Requête - Sélection des membres du personnel selon leur service et leur metier pour modifier l'affichage de la liste 
$sql = "SELECT *
        FROM personnel
        WHERE personnel.idService = ".$filtre_service."
        AND personnel.idMetier = ".$filtre_metier."
        ORDER BY personnel.perNom, personnel.perPrenom ASC";
```
<br>

- ## ajax_service_metier.php
```php
// Requête - Sélection des métiers selon le premier service obtenu pour modifier l'affichage de la liste des métiers
$sql = "SELECT *
        FROM metier, service, metier_service
        WHERE service.idService = ".$filtre_service."
        AND service.idService = metier_service.idService
        AND metier_service.idMetier = metier.idMetier
        ORDER BY metier.metLibelle";
```
<br>

- ## ajax_service_salle.php
```php
// Requête - Sélection des salles selon le premier service obtenu pour modifier l'affichage de la liste des salles
$sql = "SELECT *
        FROM salle, service
        WHERE salle.idService = ".$filtre_service."
        AND salle.idService = service.idService";
```
<br>

- ## authentification.php
```php
// Requête - Sélection d'un membre du personnel avec son login et son mot de passe
$sql = "SELECT *
        FROM personnel
        WHERE (personnel.perIdentifiant = '".$login."')
        AND (personnel.perPassword = '".$hashage_password."')";
```
<br>

- ## motdepasse_nouveau.php
```php
// Requête - Sélection d'un membre du personnel avec son login et son ancien mot de passe
$sql = "SELECT *
        FROM personnel
        WHERE (personnel.perIdentifiant = '".$login."')
        AND (personnel.perPassword = '".$ancien_password."')";

// Requête - Modification du mot de passe d'un membre du personnel
$sql = "UPDATE personnel
        SET personnel.perPassword = '" . $password . "', personnel.perPremiereConnexion = 1
        WHERE (personnel.perNom = '" . $nom . "')
        AND (personnel.perPrenom = '" . $prenom . "')
        AND (personnel.perIdentifiant = '" . $login . "')";
```
<br>

- ## patient_ajout.php
```php
// Requête - Ajout d'un nouveau patient
$sql = "INSERT INTO patient (patNom, patPrenom, patSexe, patDateDeNaissance, 
        patNumSecuriteSocial, patAdresse, patVille, patCodePostal, patPays)
        VALUES ('".$nom_patient."', '"$prenom_patient."', '".$sexe_patient."', 
        '".$datenaissance_patient."', '".$numsecu_patient."', '".
        $adresse_patient."', '".$ville_patient."', '" .$codepostal_patient."', 
        '" .$pays_patient."');
```
<br>

- ## personnel_ajout.php
```php
// Requête - Sélection des membres du personnel pour récupérer tous les identifiants selon la valeur du filtre demandé
$sql = "SELECT *
        FROM personnel
        WHERE personnel.perIdentifiant
        LIKE '%".$identifiant_personne."%'";

// Requête - Ajout d'un nouveau membre du personnel
$sql = "INSERT INTO personnel (perIdentifiant, perPassword, perNom, perPrenom,
        perSexe, perAdmin, idMetier, idService)
        VALUES ('".$identifiant_personne."', '".$password_personne."',
        '".$nom_personne."', '".$prenom_personne."', '".$sexe_personne."',
        ".$admin_personne.", '".$metier_personne."', '" .$service_personne."')";
```
<br>

- ## personnel.php
```php
// Requête - Sélection des services des membres du personnel pour afficher la liste des services
$sql = "SELECT *
        FROM service
        ORDER BY service.serLibelle ASC";

// Requête - Sélection des métiers selon le premier service obtenu pour afficher la liste des métiers
$sql = "SELECT service.idService, service.serLibelle, metier.idMetier,
        metier.metLibelle FROM metier, service, metier_service
        WHERE service.idService = ".$services_ID[0]."
        AND service.idService = metier_service.idService
        AND metier_service.idMetier = metier.idMetier
        ORDER BY metier.metLibelle";
```
<br>

- ## rendezvous_ajout.php
```php
// Requête - Sélection des RDV avec une date-heure, uun membre du personnel et un RDV qui n'est pas annulé pour vérifier s'il y a une disponibilité
$sql = "SELECT *
        FROM rendezVous
        WHERE rendezVous.renDateRdv = '".$date_rdv."'
        AND (rendezVous.renHeureDebutRdv BETWEEN '".date('Y-m-d H:i:s',
            $datetime_debut_rdv)."' AND '".date('Y-m-d H:i:s', $datetime_fin_rdv)."'
            OR rendezVous.renHeureFinRdv BETWEEN '".date('Y-m-d H:i:s' 
            $datetime_debut_rdv)."' AND '".date('Y-m-d H:i:s', $datetime_fin_rdv)."')
        AND rendezVous.idPersonnel = ".$personnel_id."
        AND rendezVous.idService = ".$service_id."
        AND rendezVous.renRdvEstAnnule = 0";

// Requête - Sélection des RDV avec une date-heure, une salle et un RDV qui n'est pas annulé pour vérifier s'il y a une disponibilité
$sql = "SELECT *
        FROM rendezVous
        WHERE rendezVous.renDateRdv = '".$date_rdv."'
        AND ( rendezVous.renHeureDebutRdv BETWEEN '".date('Y-m-d H:i:s', 
            $datetime_debut_rdv)."' AND '".date('Y-m-d H:i:s', $datetime_fin_rdv)."'
            OR rendezVous.renHeureFinRdv BETWEEN '".date('Y-m-d H:i:s', 
            $datetime_debut_rdv)."' AND '".date('Y-m-d H:i:s', 
            $datetime_fin_rdv)."')
        AND rendezVous.idSalle = ".$salle_id."
        AND rendezVous.renRdvEstAnnule = 0";

// Requête - Ajout d'un RDV
$sql = "INSERT INTO rendezVous (renDateRdv,	renHeureDebutRdv,
        renHeureFinRdv, renDateCreation, renRdvEstAnnule, renObservation,
        idPersonnel, idService, idSalle, idPatient)
        VALUES ('".$date_rdv."','".date('Y-m-d H:i:s', $datetime_debut_rdv)."',
        '".date('Y-m-d H:i:s', $datetime_fin_rdv)."', '".$date_creation_rdv."',0,
        '".$observation_rdv."',".$personnel_id.",".$service_id.",".$salle_id.",
        ".$id_patient.")";
```
<br>

- ## rendezvous_annulation.php
```php
// Requête - Séélection d'un RDV selon son ID pour modifier son état d'annulation
$sql = "SELECT *
        FROM rendezVous
        WHERE rendezVous.idRendezVous = ".$id_rdv;

// Requête - Modification de l'état d'annulation du RDV
$sql = "UPDATE rendezVous
        SET rendezVous.renRdvEstAnnule = 1
        WHERE rendezVous.idRendezVous = ".$id_rdv;
```
<br>

- ## rendezvous_gestion.php
```php
// Requête - Sélection des RDV sans annulation pour les afficher dans un tableau
$sql = "SELECT rendezVous.idRendezVous, rendezVous.renDateRdv,
        DATE_FORMAT(rendezVous.renHeureDebutRdv, '%H:%i') AS 'HeureDebut',
        DATE_FORMAT(rendezVous.renHeureFinRdv, '%H:%i') AS 'HeureFin',
        salle.salLibelle,
        CONCAT(personnel.perNom, ' ', personnel.perPrenom) AS 'NomPersonnel',
        CONCAT(patient.patNom, ' ', patient.patPrenom) AS 'NomPatient'
        FROM rendezVous, patient, salle, personnel
        WHERE rendezVous.idPatient = patient.idPatient
        AND rendezVous.idPersonnel = personnel.idPersonnel
        AND rendezVous.idSalle = salle.idSalle
        AND rendezVous.renRdvEstAnnule = 0
        ORDER BY rendezVous.renDateRdv ASC, rendezVous.renHeureDebutRdv ASC";
```
<br>

- ## rendezvous.php
```php
// Requête - Sélection des services de l'hôpital qui prennent des RDV pour afficher la liste des services
$sql = "SELECT *
        FROM service
        WHERE service.serPrendRDV = 1
        ORDER BY service.serLibelle ASC";

// Requête - Sélection des métiers selon le premier service obtenu pour afficher la liste des métiers
$sql = "SELECT *
        FROM metier, service, metier_service
        WHERE service.idService = ".$service_ID[0]."
        AND service.idService = metier_service.idService
        AND metier_service.idMetier = metier.idMetier
        ORDER BY metier.metLibelle";

// Requête - Sélection du membre du personnel selon le premier métier obtenu et et selon le premier service obtenu pour afficher la liste des membres du personnel
$sql = "SELECT *
        FROM personnel
        WHERE personnel.idService = ".$service_ID[0]."
        AND personnel.idMetier = ".$metier_ID[0]."
        ORDER BY personnel.perNom, personnel.perPrenom ASC";

// Requête - Sélection de la salle selon le premier service obtenu pour afficher la liste des salles
$sql = "SELECT *
        FROM salle, service
        WHERE salle.idService = ".$service_ID[0]."
        AND salle.idService = service.idService";

// Requête - Sélection du premier service obtenu pour afficher la durée du service
$sql = "SELECT *
        FROM service
        WHERE service.serPrendRDV = 1
        AND service.idService = ".$service_ID[0];
```