<?php
require 'connect-db.php';
if (isset($_POST['inscript']))
{
    session_start();
    $dbLink = $_POST['$dbLink'];
    $mail = $_POST('ins_mail');
    $pseudo = $_POST('ins_pseudo');
    $mdp = $_POST('ins_mdp');
    $mdp2 = $_POST('ins_vmdp');

    if(empty($mdp))
        array_push($error, 'Mot de Passe non remplie');
    if(empty($mail))
        array_push($error, 'Mail non rempli');
    if(empty($pseudo))
        array_push($error, 'Pseudo non rempli');

    if($mdp != $mdp2)
        array_push($error, 'Les mots de Passes ne correspondent pas');

    $query_vmail = "SELECT * FROM USER WHERE '$mail' = MAIL LIMIT 1 ";
    $result_query_vmail = mysqli_query($dbLink, $query_vmail);
    $result_vmail = mysqli_fetch_assoc($result_query_vmail);
    if($result_vmail and $result_vmail['MAIL'] == $mail)
        array_push($error, 'L\'addresse e-mail est déjà utilisée');


    $query_vpseudo = "SELECT * FROM USER WHERE '$pseudo' = PSEUDO LIMIT 1";
    $result_query_vpseudo = mysqli_query($dbLink, $query_vpseudo);
    $result_vpseudo = mysqli_fetch_assoc($result_query_vpseudo);
    if($result_vpseudo and $result_vpseudo['PSEUDO'] == $pseudo)
        array_push($error, 'Le Pseudo est déjà utilisé');

    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    $query_insert = "INSERT INTO USER (PSEUDO, MAIL, MDP, ROLE) VALUES ('$pseudo', '$mail', '$mdp_hash', '2')" ;
    mysqli_query($dbLink, $query_insert);

    $user_id = mysqli_insert_id($dbLink);

    $_SESSION['user'] = $user_id;

    $query_role = "SELECT ROLE FROM USER WHERE PSEUDO = '$pseudo'";
    $role = mysqli_connect($dbLink, $query_role);

    if( $role == '1')
    {
        header(vanestarre.php);
    }
    else
    {
        header(membre.php);
    }
}

