<?php
include_once "inc/utils.inc.php";
start_page('Login');
?>

<body>
<form action="inc/login.inc.php" method="post" class="formLog">
    <input name="pseudo" type="text" placeholder="Pseudo/Mail">
    <input name="mdp" type="password" placeholder="Mot de Passe">
    <button type="submit" name="submit">Se Connecter</button>
</form>

</body>
<?php
if(isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyinput') {
        echo '<p> Vous n\'avez pas tous rempli </p>';
    }
    if ($_GET['error'] == 'login') {
        echo '<p> Les identifiants ne sont pas bon</p>';
    }
}

