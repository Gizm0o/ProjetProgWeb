<?php
include_once "php/inc/utils.inc.php";
start_page('Sign Up');
?>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="formLog">
            <form action="php/inc/signup.inc.php" method="post" class="formLog">
                <input class="field" name="mail" type="text" placeholder="Adresse Mail"  maxlength = "30">
                <input class="field" name="pseudo" type="text" placeholder="Pseudo"  maxlength = "20">
                <input class="field" name="mdp" type="password" placeholder="Mot de Passe" maxlength = "20">
                <input class="field" name="vmdp" type="password" placeholder="Verifier Mot de Passe" maxlength = "20">
                <button class="submit" type="submit" name="submit"> S'inscrire</button>
            </form>
        </div>
    </body>

<?php
    if(isset($_GET['error'])){
        if($_GET['error'] == 'emptyinput') {
            echo '<p class="error"> Vous n\'avez pas tous rempli </p>';
        }
        if($_GET['error'] == 'invalidmail') {
            echo '<p class="error"> Votre addresse mail n\'est pas valide </p>';
        }
        if($_GET['error'] == 'mdpTest') {
            echo '<p class="error"> Les mots de passes ne sont pas les mêmes</p>';
        }
        if($_GET['error'] == 'existpseudo') {
            echo '<p class="error"> L\'addresse mail ou votre pseudo est déja utilisé</p>';
        }
    }