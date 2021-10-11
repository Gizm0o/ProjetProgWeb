<?php
    include 'utils.php';
    start_page("Connexion/Inscription");
    ?>


    <body>
        <form action="login.php" method="post">
            <input name="login_mail" type="text"/> Adresse Mail <br/>
            <input name="login_mdp" type="password"/> Mot de Passe <br/>
            <input name="connecter" type="submit" value="connect"> Se Connecter <br/>
        </form>
        <form action="inscription.php" method="post">
            <input name="ins_mail" type="text"> Adresse Mail <br/>
            <input name="ins_pseudo" type="text"> Pseudo <br/>
            <input name="ins_mdp" type="password"> Mot de Passe <br/>
            <input name="ins_vmdp" type="password"> Vérifier Mot de Passe<br/>
            <input name="inscrire" type="submit" value="inscript"> S'inscrire <br/>
        </form>
    </body>
