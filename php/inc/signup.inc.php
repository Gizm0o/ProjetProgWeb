<?php

//script permettant de s'inscire sur le site
if (isset($_POST['submit'])) {

    $mail = $_POST['mail'];
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $vmdp = $_POST['vmdp'];

    require_once 'connectdb.inc.php';
    require_once 'utils.inc.php';

    $connect = connect_db();

    if (emptyInputSignup($mail, $pseudo, $mdp, $vmdp) !== false) {
        header('location: ../signup.php?error=emptyinput');
        exit();
    }
    if (invalidMail($mail) !== false) {
        header('location: ../signup.php?error=invalidmail');
        exit();
    }
    if (mdpTest($mdp, $vmdp) !== false) {
        header('location: ../signup.php?error=mdpTest');
        exit();
    }
    if (exist($connect, $pseudo, $mail) !== false) {
        header('location: ../signup.php?error=existpseudo');
        exit();
    }
    createUser($connect, $pseudo, $mail, $mdp);
}
else {
    header('location: ../signup.php');
    exit();
}
