<?php
require_once 'verifmail.php';
/*Récupération du mot de pass
Envoi d'un nouveau par email généré aléatoirement
(possibilité d'en générer un nouveau une fois reconnecter*/
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Mot de passe passe oublié</title>
    </head>

    <body>

        <?php
            //connexion à la base de donnée
            $dbLink = mysqli_connect('mysql-vanestarremaurel.alwaysdata.net', '245082', 'vanestarre!0')
            or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

            mysqli_select_db($dbLink, 'vanestarremaurel_admin')
            or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        ?>

        <div id="mdp_oublier">
            <h1>Mot de passe oublié</h1>
                <form method=POST action="verifmail.php" >
                    <p>Identifiez-vous:</p>
                    <label for="mail">Adresse mail :</label>
                    <input type="text" name="mail" id="mail" /><br/>
                    <input type=submit value=Envoyer>
                </form>
        </div>


    </body>

</html>