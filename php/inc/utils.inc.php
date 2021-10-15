<?php
//fonction permettant
// de générer le header
function start_page($title)
{
    session_start();
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <meta name="description" content="Bonjour, je m'appelle Vanessa Maurel. Voici mon premier Réseau Social."> 
    <meta name="keywords" content="Vanessa Maurel">
    <nav class="menu">
        <input type="image" class="Logo" onclick="window.location.href = '../../index.php';" alt="Accueil"
               src="images/Vanestarre.png">
        <?php
            if (isset($_SESSION['user_id'])){
                echo '<li class="menu_li"  > <a class="menu_a" href="php/inc/logout.inc.php"> Se déconnecter</a> </li>';
            }
            else{
               echo '<li class="menu_li" > <a class="menu_a"  href="loginPage.php"> Se connecter</a> </li>';
                echo '<li class="menu_li" > <a class="menu_a"  href="signup.php"> S\'inscrire</a> </li>';
            }
        ?>
        <form action="recherche.php" method="post">
            <input class="tag" type="text" maxlength="30" placeholder="Recherche par Tag" name="tag" >
            <button class="submit" type="submit" name="submit">Rechercher</button>
        </form>
    </nav>
</head>
<body>
<?php
}

 ?>
//fonction permettant de générer le header
<?php function end_page () { ?>
</body>
</html>
<?php
}
?>
<?php
//fonction vérifiant si les inputs sont remplis
// de la page d'Inscription
function emptyInputSignup($mail, $pseudo, $mdp, $vmdp): bool
{
    if (empty($mail) || empty($pseudo)  || empty($mdp) || empty($vmdp)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
//fonction vérifiant si les inputs sont
// remplis de la page de connection
function emptyInputLogin($pseudo, $mdp): bool
{
    if (empty($pseudo)  || empty($mdp)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
//fonction vérifiant si l"input est bien un mail
function invalidMail($mail): bool
{
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
//fonction vérifiant si les deux champs de mot de passe corresponde
function mdpTest($mdp, $vmdp): bool
{
    if ($mdp !==  $vmdp){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
//fonction vérifiant si le pseudo et le mail existent déja la base de donnée
function exist($connect, $pseudo, $mail) {
    $query = 'SELECT * FROM USER WHERE PSEUDO = ? OR MAIL = ? ;';
    $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)){
        header('location: ../signup.php?error=existerror');
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $pseudo, $mail);
    mysqli_stmt_execute($stmt);

    $result_query = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result_query)){
        return $row;
    }
    else{
        return false;
    }
    mysqli_stmt_close($stmt);
}
//fonction créeant un nouvel utilisateur dans la base de donnée
function createUser($connect, $pseudo, $mail, $mdp, $role = 2) {
    $query = 'INSERT INTO USER (PSEUDO, MAIL, MDP, ROLE) VALUES (?, ?, ?, ?)';
    $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)){
        header('location: ../signup.php?error=stmterror');
        exit();
    }
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssi", $pseudo, $mail, $mdp_hash, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $pseudo_exist = exist($connect, $pseudo, $pseudo);

    $_SESSION['user_id'] = $pseudo_exist['IDU'];
    $_SESSION['pseudo_id'] = $pseudo_exist['PSEUDO'];
    $_SESSION['role'] = $pseudo_exist['ROLE'];
    session_start();

    header('location: ../../index.php');
}
//fonction permettant de connecter
// l'utilisateur si les informations qu'il a rentré correspondent aux infos de la base
// de données
function userLogin($connect, $pseudo, $mdp){
    $pseudo_exist = exist($connect, $pseudo, $pseudo);

    if ($pseudo_exist === false){
        header('location: ../loginPage.php?error=login');
        exit();
    }

    $mdp_hash = $pseudo_exist['MDP'];
    $verif = password_verify($mdp, $mdp_hash);

    if ($verif === false){
        header('location: ../loginPage.php?error=login');
        exit();
    }
    else {
        session_start();
        $_SESSION['user_id'] = $pseudo_exist['IDU'];
        $_SESSION['pseudo_id'] = $pseudo_exist['PSEUDO'];
        $_SESSION['role'] = $pseudo_exist['ROLE'];
        header('location: ../../index.php');
    }
}


