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
                <a class="nav-link" href="#">
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

        <h3>Veuillez saisir les informations suivantes pour créer un nouveau membre du personnel</h3><br>
        <form action="personnel_ajout.php" method="post">
          <div class="gille_nouveau_personnel">
          <div class="cellule_nouveau_personnel">
            <label>Nom</label>
          </div>
          <div class="cellule_nouveau_personnel">
            <input type="text" placeholder="Nom" name="nom">
          </div>
          <div class="cellule_nouveau_personnel">
            <label>Prénom</label>
          </div>
          <div class="cellule_nouveau_personnel">
            <input type="text" placeholder="Prénom" name="prenom">
          </div>
          <div class="cellule_nouveau_personnel">
            <label>Mot de passe</label>
          </div>
          <div class="cellule_nouveau_personnel">
            <input type="password" placeholder="Mot de passe" id="password" disabled>
            <input type="hidden" name="password" id="password_hidden">
            <img style="width: 20px;" src="eye.svg" id="eye">
            <input type="button" value="Générer" id="rand_password">
          </div>
          <div class="cellule_nouveau_personnel">
            <label>Sexe</label>
          </div>
          <div class="cellule_nouveau_personnel">
            <label>Femme</label>
            <input type="radio" id="femme" name="sexe" value="Femme" checked>
            <br>
            <label>Homme</label>
            <input type="radio" id="homme" name="sexe" value="Homme">
            <br>
            <label>Non Binaire</label>
            <input type="radio" id="non_binaire" name="sexe" value="Non Binaire">
          </div>
            <div class="cellule_nouveau_personnel">
              <label>Service</label>
            </div>
            <div class="cellule_nouveau_personnel">
              <?php
                  // Tableau avec les noms des colonnes sélectionnées de la table 'Service'
                  $service_colonnes = ['idService','serLibelle'];
                  // Requête
                  $sql = "SELECT * FROM service";
                  // Résultat de la requête
                  $result = $connexion_db->query($sql) or die('Select - Erreur SQL ! '.$connexion_db->error );

                  // On vérifie si une ligne est présente dans le résultat de la requête 
                  if ( ($result->num_rows) > 0)
                  {
                      // On affiche le début de la liste
                      echo '<select name="service" id="service">';
                      // On boucle tant que l'on trouve une ligne dans le résultat de la requête
                      while ($row = $result->fetch_assoc())
                      {  
                          // On affiche la ligne en cours de la liste
                          echo '<option value="' . $row[$service_colonnes[0]] . '">' . $row[$service_colonnes[1]] . '</option>';
                      }
                      // On ferme la liste
                      echo '</select>';
                  }
                  else
                  {
                      echo '<label>Aucune service répertorié.</label>';
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
                    // Requête
                    $sql = "SELECT * FROM metier";
                    // Résultat de la requête
                    $result = $connexion_db->query($sql) or die('Select - Erreur SQL ! '.$connexion_db->error );
                    // On vérifie si une ligne est présente dans le résultat de la requête 
                    if ( ($result->num_rows) > 0)
                    {
                        // On affiche le début de la liste
                        echo '<select name="metier" id="metier">';
                        // On boucle tant que l'on trouve une ligne dans le résultat de la requête
                        while ($row = $result->fetch_assoc())
                        {  
                            // On affiche la ligne en cours de la liste
                            echo '<option value="' . $row[$metier_colonnes[0]] . '">' . $row[$metier_colonnes[1]] . '</option>';
                        }
                        // On ferme la liste
                        echo '</select>';
                    }
                    else
                    {
                        echo '<label>Aucune métier répertorié.</label>';
                    }
                ?>
            </div>
            <div class="cellule_nouveau_personnel">
              <label>Administrateur</label>
            </div>
            <div class="cellule_nouveau_personnel">
              <label>Non</label>
              <input type="radio" id="non" name="admin" value="0" checked>
              <br>
              <label>Oui</label>
              <input type="radio" id="oui" name="admin" value="1">
            </div>
          </div>
          
            <br>
            <button type="submit">Ajouter</button>
        </form>
        </main>
      </div>
    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/motdepasse_aleatoire.js"></script>
    <script src="assets/js/motdepasse.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    </body>
</html>