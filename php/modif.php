
<!DOCTYPE HTML>
<html>
<head>
    <title>Restore your password</title>
    <meta charset="utf-8"/>
</head>
<body>

<h1>Procurez-vous un nouveau mot de passe !</h1>
<?php
    //connexion à la base de donnée
    $dbLink = mysqli_connect('mysql-vanestarremaurel.alwaysdata.net', '245082', 'vanestarre!0')
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink, 'vanestarremaurel_admin')
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));


    if($_POST["modification"] == 'oui')
    {
        ?>  <p>Nom d'utilisateur :<br/>
        input type="password" name="nouveau mot de passe"/>
    </p><?php
        // $query = 'UPDATE USER SET MDP = '$mdp' WHERE MAIL = '$mail'
    }
    else
    {
        echo 'Parfait ! Alors bonne navigation.';
    }

    ?>
</body>
</html>