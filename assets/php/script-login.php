<?php
echo "ok !";
    // Include du fichier de conf de la bdd
    include('../data/params.php');

    // Create connection
    $conn = new mysqli($_SESSION['server'], $_SESSION['username'], $_SESSION['password'], $_SESSION['dbname']);
    // Check connection
    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }
    else
    { echo "conn ok !"; }

    $sql = "SELECT idPersonnel, idMetier FROM personnel WHERE personnel.perIdentifiant = 'g.brochard' and personnel.perPassword = 'gabin'"; // $_POST['username'] $_POST['password']
    $result = $conn->query($sql);

    if ($result->num_rows = 1) // Si nombre de résultat > à 0 alors il existe un compte avec ces identifiant:
        {
            echo "ok";
            while($row = $result->fetch_assoc())
            {
                // $_SESSION['idPersonnel'] = $row["idPersonnel"];
                // $_SESSION['perAdmin'] = $row["perAdmin"];
                // $_SESSION['idMetier'] = $row["idMetier"];
                // $_SESSION['idService'] = $row["idService"];
            } 
            header("Location: ../../index.html");
    else // Si nb de résultat < à 0 alors :
    {
        echo "erreur";
        $_SESSION['msg-con-compte'] = "Identifiant ou mot de passe erronée !";
        header("Location: ../../login.html");
    }
    $conn->close();
?>
