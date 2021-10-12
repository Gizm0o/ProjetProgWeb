<?php

if (isset($_POST['submit'])) {

    $mail = $_POST['mail'];
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $vmdp = $_POST['vmdp'];
    // a enlever
    $hostname = 'mysql-vanestarremaurel.alwaysdata.net';
    $username = '245082';
    $pwd = 'vanestarre!0';
    $db = 'vanestarremaurel_admin';

    $connect = mysqli_connect($hostname, $username, $pwd, $db);

    if(!$connect){
        die('Problème de connection: ' . mysqli_connect_error());
    }

    require_once 'connectdb.inc.php';
    require_once 'utils.inc.php';

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
