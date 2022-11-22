<?php
    session_start(); // Démarrage ou suite de la session
    // Si une connexion de session n'existe pas, on redirige à la page 'index.php'
    if ( !isset($_SESSION['connexion']) || ($_SESSION['connexion'] == 0) )
    {   
        header('Location: index.php');
    }
    // Si la variable de session de la connexion existe et le mot de passe a été modifié, on affiche la page 'index.php'.
    if ( isset($_SESSION['user']['connexion']) && ($_SESSION['user']['connexion'] == 1) )
    {
        header('Location: index.php');
    }
    // Récupération de l'adresse du site Internet
    $_SESSION['page']['adresse'] = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // Informations de la connnexion à la base
    require('_connect.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2"> -->
    <title>Signin Template · Bootstrap v5.2</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/"> -->

    

    

<link href="./assets/css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/css/styles.css" rel="stylesheet"> 
    
    <!-- Custom styles for this template -->
    <link href="./assets/css/login.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">
  <form action="motdepasse_nouveau.php" method="post" name="nouveau_motdepasse">
    <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" fill="currentColor" class="bi bi-hospital" viewBox="0 0 16 16">
      <path d="M8.5 5.034v1.1l.953-.55.5.867L9 7l.953.55-.5.866-.953-.55v1.1h-1v-1.1l-.953.55-.5-.866L7 7l-.953-.55.5-.866.953.55v-1.1h1ZM13.25 9a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Zm.25 1.75a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5Zm-11-4a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5A.25.25 0 0 0 3 9.75v-.5A.25.25 0 0 0 2.75 9h-.5Zm0 2a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM2 13.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Z"/>
      <path d="M5 1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1V1Zm2 14h2v-3H7v3Zm3 0h1V3H5v12h1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm0-14H6v1h4V1Zm2 7v7h3V8h-3Zm-8 7V8H1v7h3Z"/>
    </svg>
    <h1 class="h3 mb-3 fw-normal">Hopital La Rochelle</h1>
    <h1 class="h3 mb-3 fw-normal">Connexion personel</h1>

    <div class="form-floating">
      <input type="text" value="<?php echo $_SESSION['user']['utilisateur']; ?>" class="form-control" id="floatingInput" disabled>
      <label for="floatingInput">Identifiant</label>
      <input type="hidden" name="login" value="<?php echo $_SESSION['user']['utilisateur']; ?>">
    </div>
    <div class="form-floating">
      <input type="password" name="password" id="password" class="form-control" id="floatingPassword">
      <label for="floatingPassword">Nouveau mot de passe</label>
    </div>
    <input type="hidden" name="ancien_password" value="<?php echo $_SESSION['motdepasse']; ?>">
    <img style="width: 20px;" src="eye.svg" id="eye">

    <div class="checkbox mb-3">
        <input type="checkbox" value="remember-me">
        <label>Rester connecté</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Connexion</button>
  </form>
</main>
    <script src="assets/js/motdepasse.js"></script>
  </body>
</html>
