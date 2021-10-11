<?php
require ' connect-db.php';
if (isset($_POST['connect']))
{
    $dbLink = $_POST['$dbLink'];
    $mail = $_POST['login_mail'];
    $mdp = $_POST['login_mdp'];

    if(empty($mdp))
        array_push($error, 'Mot de Passe non remplie');
    if(empty($mail))
        array_push($error, 'Mail non rempli');


    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    $query_mdp = "SELECT MDP FROM USER WHERE '$mail' = MAIL";
    $result = mysqli_query($dbLink, $query_mdp);

    if ($result == $mdp_hash)
    {

    }
    else
    {

    }
}