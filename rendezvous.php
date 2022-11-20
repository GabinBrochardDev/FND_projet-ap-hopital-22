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

          <h3>Sélectionnez un patient pour lui affecter un rendez-vous</h3><br>
          <div class="gille_patient">
            <div>
                <?php
                    // Requête
                    $sql = "SELECT * FROM patient ORDER BY patient.patNom ASC, patient.patPrenom ASC";
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
                    }
                    else // La requête renvoie aucun résultat. On affiche un message.
                    {
                        echo "Aucun patient trouvé.";
                    }
                ?>
            </div>
            <div>
              <form action="patient_nouveau.php">
                <button type="submit">Ajouter<br>un patient</button>
              </form>
            </div>
          </div>
          <form action="" method="post">
            <div class="gille_nouveau_rendezvous">
                <div class="cellule_nouveau_rendezvous">
                    <label>Nom</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_patient" id="nom" disabled>
                    <input type="hidden" name="nom" id="nom_hidden" >
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Prénom</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_patient" id="prenom" disabled>
                    <input type="hidden" name="prenom" id="prenom_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Sexe</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_patient" id="sexe" disabled>
                    <input type="hidden" name="sexe" id="sexe_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Date de naissance</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_patient" id="datenaissance" disabled>
                    <input type="hidden" name="datenaissance" id="datenaissance_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>N° Sécurité Sociale</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_patient" id="numsecu" disabled>
                    <input type="hidden" name="numsecu" id="numsecu_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Adresse</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_patient" id="adresse" disabled>
                    <input type="hidden" name="adresse" id="adresse_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Code Postal</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_patient" id="codepostal" disabled>
                    <input type="hidden" name="codepostal" id="codepostal_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Ville</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_patient" id="ville" disabled>
                    <input type="hidden" name="ville" id="ville_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Pays</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="text" class="informations_patient" id="pays" disabled>
                    <input type="hidden" name="pays" id="pays_hidden">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Date du RDV</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <input type="date" class="informations_patient" name="date" id="date">
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Salle</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <?php
                        // Tableau avec les noms des colonnes sélectionnées de la table 'Salle'
                        $salle_colonnes = ['idSalle','salLibelle'];
                        // Requête
                        $sql = "SELECT * FROM salle";
                        // Résultat de la requête
                        $result = $connexion_db->query($sql) or die(header('Location: accueil.php'));
                        // On vérifie si une ligne est présente dans le résultat de la requête 
                        if ( ($result->num_rows) > 0)
                        {
                            // On affiche le début de la liste
                            echo '<select name="salle" id="salle">';
                            // On boucle tant que l'on trouve une ligne dans le résultat de la requête
                            while ($row = $result->fetch_assoc())
                            {  
                                // On affiche la ligne en cours de la liste
                                echo '<option value=\'' . $row[$salle_colonnes[0]] . '\'>' . $row[$salle_colonnes[1]] . '</option>';
                            }
                            // On ferme la liste
                            echo '</select>';
                        }
                        else
                        {
                            echo '<label>Aucune salle répertoriée.</label>';
                        }
                    ?>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <label>Observation</label>
                </div>
                <div class="cellule_nouveau_rendezvous">
                    <textarea type="textarea" class="observation_patient" placeholder="Informations complémentaires sur le patient" name="observation" id="observation"></textarea>
                </div>
            </div>
            <br>
            <button type="submit">Ajouter le RDV</button>
        </form>
        <br>
        <br>
        </main>
      </div>
    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/patient.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    </body>
</html>