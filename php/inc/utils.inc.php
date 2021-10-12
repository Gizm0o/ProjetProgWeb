<?php
function start_page($title)
{
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <link id="css" rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <meta name="description" content="Bonjour, je m'appelle Vanessa Maurel. Voici mon premier Réseau Social."> 
    <meta name="keywords" content="Vanessa Maurel">
</head>
<body>
<?php
}
?>
<?php function end_page () { ?>
</body>
</html>
<?php
}
?>
<?php
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
function invalidMail($mail): bool
{
    if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
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
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
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
    header('location: ../signup.php?error=none');
}



