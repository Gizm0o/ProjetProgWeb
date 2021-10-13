<?php
include_once "inc/utils.inc.php";
start_page('Login');
?>

<body>
    <div class="formLog">
        <form action="inc/login.inc.php" method="post" class="formLog">
            <input class="field" name="pseudo" type="text" placeholder="Pseudo/Mail">
            <input class="field" name="mdp" type="password" placeholder="Mot de Passe">
            <button class="submit" type="submit" name="submit">Se Connecter</button>
        </form>
    </div>
</body>

<?php
if(isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyinput') {
        echo '<p class="error"> Vous n\'avez pas tous rempli </p>';
    }
    if ($_GET['error'] == 'login') {
        echo '<p class="error"> Les identifiants ne sont pas bon</p>';
    }
}

