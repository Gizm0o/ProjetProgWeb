<?php
include_once "inc/utils.inc.php";
start_page('Sign Up');
?>

    <body>
        <form action="inc/signup.inc.php" method="post" class="formLog">
            <input name="mail" type="text" placeholder="Adresse Mail">
            <input name="pseudo" type="text" placeholder="Pseudo">
            <input name="mdp" type="password" placeholder="Mot de Passe">
            <input name="vmdp" type="password" placeholder="Verifier Mot de Passe">
            <button type="submit" name="submit"> S'inscrire</button>
        </form>
    </body>

<?php
    if(isset($_GET['error'])){
        if($_GET['error'] == 'emptyinput') {
            echo '<p> Vous n\'avez pas tous rempli </p>';
        }
        if($_GET['error'] == 'invalidmail') {
            echo '<p> Votre addresse mail n\'est pas valide </p>';
        }
        if($_GET['error'] == 'mdpTest') {
            echo '<p> Les mots de passes ne sont pas les mêmes</p>';
        }
        if($_GET['error'] == 'existpseudo') {
            echo '<p> L\'addresse mail ou votre pseudo est déja utilisé</p>';
        }
    }