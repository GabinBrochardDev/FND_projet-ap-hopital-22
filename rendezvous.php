<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {   
        header('Location: index.php');
    }
    // Si la variable de session de la connexion n'existe pas ou le mot de passe n'a pas été modifié, on affiche la page 'index.php'.
    if ( !isset($_SESSION['user']['connexion']) || ($_SESSION['user']['connexion'] == 0) )
    {
        header('Location: index.php');
    }
    // Récupération de l'adresse du site Internet
    $_SESSION['page']['adresse'] = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // Informations de la connnexion à la base
    require('_connect.php');
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <!-- <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors"> -->
    <meta name="generator" content="Hugo 0.104.2">
    <title>Dashboard Template · Bootstrap v5.2</title>


    <!-- <link href="./css/bootstrap.rtl.min.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/dashboard.css" rel="stylesheet">
    <link href="./assets/css/styles.css" rel="stylesheet">
  </head>
  <body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Hopital La Rochelle</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3" href="deconnexion.php">Sign out</a>
        </div>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row">
        <!-- Menu de navigation -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3 sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">
                  <span data-feather="home" class="align-text-bottom"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file" class="align-text-bottom"></span>
                  Gestion des patients
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="rendezvous.php">
                  <span data-feather="shopping-cart" class="align-text-bottom"></span>
                  Nouveau rendez-vous
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="rendezvous_gestion.php">
                  <span data-feather="users" class="align-text-bottom"></span>
                  Gestion des rendez-vous
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                  Reports
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="layers" class="align-text-bottom"></span>
                  Integrations
                </a>
              </li> -->
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
              <span>Mon espace</span>
              <!-- <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle" class="align-text-bottom"></span>
              </a> -->
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                  Planning personnel
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                  Planning de service
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                  Social engagement
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                  Year-end sale
                </a>
              </li> -->
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
              <span>Administration</span>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                  Gestion du personnel
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="personnel.php">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                  Nouveau membre du personnel
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                  Social engagement
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                  Year-end sale
                </a>
              </li> -->
            </ul>
          </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

          <h3>Sélectionnez un patient pour lui affecter un rendez-vous</h3><br>
          <span>Recherche : </span><input type="text" class="informations_rendezvous" placeholder="Nom ou prénom du patient" name="recherche_patient" id="recherche_patient">
          <br>
          <br>
          <div class="gille_patient">
            <div id="tableau_patients">
              Aucune suggestion.
            </div>
            <div>
              <form action="patient_nouveau.php">
                <button type="submit">Ajouter<br>un patient</button>
              </form>
            </div>
          </div>
          <form action="rendezvous_ajout.php" method="post">
            <input type="hidden" name="id_patient" id="id_patient">
            <div class="gille_nouveau_rendezvous">
                <div class="cellule_nouveau_rendezvous">
                    <label>Nom</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_rendezvous" id="nom" disabled>
                    <input type="hidden" name="nom" id="nom_hidden" >
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Prénom</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_rendezvous" id="prenom" disabled>
                    <input type="hidden" name="prenom" id="prenom_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Sexe</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_rendezvous" id="sexe" disabled>
                    <input type="hidden" name="sexe" id="sexe_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Date de naissance</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_rendezvous" id="datenaissance" disabled>
                    <input type="hidden" name="datenaissance" id="datenaissance_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>N° Sécurité Sociale</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_rendezvous" id="numsecu" disabled>
                    <input type="hidden" name="numsecu" id="numsecu_hidden">
                </div>
                <div class="cellule_nouveau_personnel">
                  <label>Service</label>
                </div>
                <div class="cellule_nouveau_personnel">
                <?php
                    // Tableau avec les noms des colonnes sélectionnées de la table 'Service'
                    $service_colonnes = ['idService','serLibelle','serDuree'];
                    // Tableau avec les ID des services
                    $service_ID = [];
                    // Tableau avec les durées des services
                    $service_duree = [];
                    // Requête
                    $sql = "SELECT *
                            FROM service
                            WHERE service.serPrendRDV = 1
                            ORDER BY service.serLibelle ASC";
                    // Résultat de la requête
                    $result = $connexion_db->query($sql) or die('Select - Erreur SQL ! '.$connexion_db->error );

                    // On vérifie si une ligne est présente dans le résultat de la requête 
                    if ( ($result->num_rows) > 0)
                    {
                        // On affiche le début de la liste
                        echo '<select class="informations_rendezvous" name="service" id="service">';
                        // On boucle tant que l'on trouve une ligne dans le résultat de la requête
                        while ($row = $result->fetch_assoc())
                        {  
                            // On affiche la ligne en cours de la liste
                            echo '<option value="' . $row[$service_colonnes[0]] . '">' . $row[$service_colonnes[1]] . '</option>';
                            // Affectation de l'ID en cours dans le tableau
                            array_push($service_ID, $row[$service_colonnes[0]]);
                            // Affectation de l'ID en cours dans le tableau
                            array_push($service_duree, $row[$service_colonnes[2]]);
                        }
                        // On ferme la liste
                        echo '</select>';
                    }
                    else
                    {
                        echo '<select class="informations_rendezvous" name="service" id="service"><option value="0"Aucune service répertorié.</option></select>';
                    }
                ?>
                </div>
                <div class="cellule_nouveau_personnel">
                  <label>Métier</label>
                </div>
                <div class="cellule_nouveau_personnel">
                <?php
                      // Tableau avec les noms des colonnes sélectionnées de la table 'Metier'
                      $metier_colonnes = ['idMetier','metLibelle'];
                      // Tableau avec les ID des métier
                      $metier_ID = [];
                      // Requête
                      $sql = "SELECT *
                              FROM metier, service, metier_service
                              WHERE service.idService = ".$service_ID[0]."
                              AND service.idService = metier_service.idService
                              AND metier_service.idMetier = metier.idMetier
                              ORDER BY metier.metLibelle";

                      // Résultat de la requête
                      $result = $connexion_db->query($sql) or die('Select - Erreur SQL ! '.$connexion_db->error );
                      // On vérifie si une ligne est présente dans le résultat de la requête 
                      if ( ($result->num_rows) > 0)
                      {
                          // On affiche le début de la liste
                          echo '<select class="informations_rendezvous" name="metier" id="metier">';
                          // On boucle tant que l'on trouve une ligne dans le résultat de la requête
                          while ($row = $result->fetch_assoc())
                          {  
                              // On affiche la ligne en cours de la liste
                              echo '<option value="' . $row[$metier_colonnes[0]] . '">' . $row[$metier_colonnes[1]] . '</option>';
                              // Affectation de l'ID en cours dans le tableau
                              array_push($metier_ID, $row[$metier_colonnes[0]]);
                          }
                          // On ferme la liste
                          echo '</select>';
                      }
                      else
                      {
                          echo '<select class="informations_rendezvous" name="metier" id="metier"><option value="0">Aucune métier répertorié.</option></select>';
                      }
                ?>
                </div>
                <div class="cellule_nouveau_rendezvous">
                  <label>Personnel</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                <?php
                        // Tableau avec les noms des colonnes sélectionnées de la table 'Personnel'
                        $personnel_colonnes = ['idPersonnel','perNom','perPrenom'];
                        // Requête
                        $sql = "SELECT *
                                FROM personnel
                                WHERE personnel.idService = ".$service_ID[0]."
                                AND personnel.idMetier = ".$metier_ID[0]."
                                ORDER BY personnel.perNom, personnel.perPrenom ASC";

                        // Résultat de la requête
                        $result = $connexion_db->query($sql) or die(header('Location: accueil.php'));
                        // On vérifie si une ligne est présente dans le résultat de la requête 
                        if ( ($result->num_rows) > 0)
                        {
                            // On affiche le début de la liste
                            echo '<select class="informations_rendezvous" name="personnel" id="personnel">';
                            // On boucle tant que l'on trouve une ligne dans le résultat de la requête
                            while ($row = $result->fetch_assoc())
                            {  
                                // On affiche la ligne en cours de la liste
                                echo '<option value="' . $row[$personnel_colonnes[0]] . '">' . $row[$personnel_colonnes[1]] . ' ' . $row[$personnel_colonnes[2]] . '</option>';
                            }
                            // On ferme la liste
                            echo '</select>';
                        }
                        else
                        {
                            echo '<select class="informations_rendezvous" name="personnel" id="personnel"><option value="0">Aucune salle répertoriée.</option></select>';
                        }
                    ?>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Salle</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <?php
                        // Tableau avec les noms des colonnes sélectionnées de la table 'Salle'
                        $salle_colonnes = ['idSalle','salLibelle'];
                        // Requête
                        $sql = "SELECT *
                                FROM salle, service
                                WHERE salle.idService = ".$service_ID[0]."
                                AND salle.idService = service.idService";
                        // Résultat de la requête
                        $result = $connexion_db->query($sql) or die(header('Location: accueil.php'));
                        // On vérifie si une ligne est présente dans le résultat de la requête 
                        if ( ($result->num_rows) > 0)
                        {
                            // On affiche le début de la liste
                            echo '<select class="informations_rendezvous" name="salle" id="salle">';
                            // On boucle tant que l'on trouve une ligne dans le résultat de la requête
                            while ($row = $result->fetch_assoc())
                            {  
                                // On affiche la ligne en cours de la liste
                                echo '<option value="' . $row[$salle_colonnes[0]] . '">' . $row[$salle_colonnes[1]] . '</option>';
                            }
                            // On ferme la liste
                            echo '</select>';
                        }
                        else
                        {
                            echo '<select class="informations_rendezvous" name="salle" id="salle"><option value="0">Aucune salle répertoriée.</option></select>';
                        }
                    ?>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Durée du RDV</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <?php
                      // Tableau avec les noms des colonnes sélectionnées de la table 'Metier'
                      $metier_colonnes = ['idMetier','metLibelle'];
                      // Tableau avec les ID des métier
                      $metier_ID = [];
                      // Requête
                      $sql = "SELECT *
                              FROM service
                              WHERE service.serPrendRDV = 1
                              AND service.idService = ".$service_ID[0];

                      // Résultat de la requête
                      $result = $connexion_db->query($sql) or die(header('Location: accueil.php'));
                      // On vérifie si une ligne est présente dans le résultat de la requête 
                      if ( ($result->num_rows) > 0)
                      {
                          // On récupère les informations de la requête si le fetch est possible
                          if ($row = $result->fetch_assoc())
                          {  
                              // On affiche le champ 'input' avec la durée du premier service de la liste
                              echo '<input type="text" class="informations_rendezvous" id="dureerdv" value="'.$row[$service_colonnes[2]].' minutes" disabled>
                                  <input type="hidden" name="dureerdv" id="dureerdv_hidden" value="'.$row[$service_colonnes[2]].'">';
                          }
                      }
                      else
                      {
                          // On affiche le champ 'input' vide
                          echo '<input type="text" class="informations_rendezvous" id="dureerdv" value="" disabled>
                              <input type="hidden" name="dureerdv" id="dureerdv_hidden" value="">';
                      }
                    ?>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Date du RDV</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <?php
                      // Définition du fuseau horaire de Paris
                      date_default_timezone_set('Europe/Paris');
                      // Récupération de la date du jour
                      $date_debut = date('Y-m-d');
                      // Récupération de la date du jour + 1 année
                      $date_fin = date('Y-m-d', strtotime('+1 year'));
                      // Affichage des variables dans la ligne suivante pour le type 'date'
                    ?>
                    <input type="date" class="informations_rendezvous" value="<?php echo $date_debut; ?>" min="<?php echo $date_debut; ?>" max="<?php echo $date_fin; ?>" name="daterdv" id="daterdv">
                </div>
                <div class="cellule_nouveau_personnel">
                    <label>Heure du RDV</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <?php
                      // Définition du fuseau horaire de Paris
                      date_default_timezone_set('Europe/Paris');
                      // Récupération de l'heure en cours
                      $heure = date('H:i');
                      // Affichage de la variable dans la ligne suivante pour le type 'time'
                    ?>
                    <input type="time" value="<?php echo $heure; ?>" class="informations_rendezvous" name="heurerdv" id="heurerdv">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Observation</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <textarea type="textarea" class="observation_rendezvous" placeholder="Informations complémentaires sur le patient" name="observation" id="observation"></textarea>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <button type="submit">Ajouter le RDV</button>
                </div>
                    <?php
                    // On vérifie si le message d'erreur existe
                      if (isset($_SESSION['erreurRDV']) && (strlen($_SESSION['erreurRDV']) > 0))
                      {
                        echo '<div class="cellule_nouveau_rendezvous"><div class="informations_rendezvous erreur_rendezvous">'.$_SESSION['erreurRDV'].'</div></div>';
                      }
                    ?>
            </div>
        </form>
        <br>
        <br>
        </main>
      </div>
    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/patient.js"></script>
    <script src="assets/js/ajax_patient.js"></script>
    <script src="assets/js/ajax_service.js"></script>
    <script src="assets/js/ajax_metier.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    </body>
</html>