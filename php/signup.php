<?php
include_once "inc/utils.inc.php";
start_page(Signup);
?>

    <body>
        <form action="inc/signup.inc.php" method="post">
            <input name="mail" type="text" placeholder="Adresse Mail">
            <input name="pseudo" type="text" placeholder="Pseudo">
            <input name="mdp" type="password" placeholder="Mot de Passe">
            <input name="vmdp" type="password" placeholder="Verifier Mot de Passe">
            <button type="submit" name="submit"> S'inscrire</button>
        </form>
    </body>
