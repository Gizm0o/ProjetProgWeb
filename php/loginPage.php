<?php
include_once "utils.inc.php";
start_page();
?>

<body>
<form action="inc/login.inc.php" method="post">
    <input name="pseudo" type="text" placeholder="Pseudo/Mail">
    <input name="mdp" type="password" placeholder="Mot de Passe">
    <button type="submit" name="submit">Se Connecter</button>
</form>
</body>
