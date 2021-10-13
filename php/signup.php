<?php
include_once "inc/utils.inc.php";
start_page('Sign Up');
?>

    <body>
        <div class="formLog">
            <form action="inc/signup.inc.php" method="post" class="formLog">
                <input class="field" name="mail" type="text" placeholder="Adresse Mail">
                <input class="field" name="pseudo" type="text" placeholder="Pseudo">
                <input class="field" name="mdp" type="password" placeholder="Mot de Passe">
                <input class="field" name="vmdp" type="password" placeholder="Verifier Mot de Passe">
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