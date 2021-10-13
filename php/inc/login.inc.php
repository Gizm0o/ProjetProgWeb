<?php

if (isset($_POST['submit'])){
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];

    require_once 'connectdb.inc.php';
    require_once 'utils.inc.php';

    $connect = connect_db();

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