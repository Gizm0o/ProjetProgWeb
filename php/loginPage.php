<?php
include_once "php/inc/utils.inc.php";
start_page('Login');
?>

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="formLog">
        <form action="php/inc/login.inc.php" method="post" class="formLog">
            <input class="field" name="pseudo" type="text" placeholder="Pseudo/Mail"  maxlength = "20">
            <input class="field" name="mdp" type="password" placeholder="Mot de Passe"  maxlength = "20">
            <button class="submit" type="submit" name="submit">Se Connecter</button>
        </form>
    </div>
</body>

//affichage des erreurs
<?php
if(isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyinput') {
        echo '<p class="error"> Vous n\'avez pas tous rempli </p>';
    }
    if ($_GET['error'] == 'login') {
        echo '<p class="error"> Les identifiants ne sont pas bon</p>';
    }
}

