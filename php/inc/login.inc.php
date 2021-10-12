<?php

if (isset($_POST['submit'])){
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    //a enlever
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

    if (emptyInputLogin($pseudo, $mdp) !== false) {
        header('location: ../loginPage.php?error=emptyinput');
        exit();
    }

    userLogin($connect, $pseudo, $mdp);

}
else{
    header('location: ../loginPage.php');
    exit();
}