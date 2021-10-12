<?php
include 'connect-db.php';
if (isset($_POST['connect']))
{
    $dbLink = connect_bd();
    $mail = $_POST['login_mail'];
    $mdp = $_POST['login_mdp'];

    if(empty($mdp))
        array_push($error, 'Mot de Passe non remplie');
    if(empty($mail))
        array_push($error, 'Mail non rempli');


    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    $query_mdp = "SELECT MDP FROM USER WHERE '$mail' = MAIL";
    $result = mysqli_query($dbLink, $query_mdp);

    if (password_verify($mdp_hash, $result));
    {
        $query_id = "SELECT ID FROM USER WHERE MAIL = '$mail'";
        $result_id = mysqli_query($dbLink, $query_id);
        $_SESSION['user'] =  $result_id;

        $query_role = "SELECT ROLE FROM USER WHERE MAIL = '$mail'";
        $result_role = mysqli_query($dbLink, $query_role);

        if ($result_role == 1)
        {
            header(vanestarre.php);
        }
        else
        {
            header(membre.php);
        }
    }
}