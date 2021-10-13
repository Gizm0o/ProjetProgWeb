<?php
// Connection BD
$dbLink = mysqli_connect('mysql-vanestarremaurel.alwaysdata.net', '245082', 'vanestarre!0')
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

mysqli_select_db($dbLink, 'vanestarremaurel_admin')
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

// Post incrementation
$query = 'SELECT LOVE  FROM MSG WHERE IDM = 1';
$result = mysqli_query($dbLink, $query);
$dbRow = mysqli_fetch_assoc($result);
echo $dbRow['LOVE'] . '</br>';

// Incrementation
$query = 'Update MSG Set LOVE=LOVE+1 where IDM = 1';
$result = mysqli_query($dbLink, $query);

$query = 'SELECT LOVE  FROM MSG WHERE IDM = 1';
$result = mysqli_query($dbLink, $query);
$dbRow = mysqli_fetch_assoc($result);
echo $dbRow['LOVE'] . '</br>';

$max = $dbRow['LOVE'];
$min = $dbRow['LOVE'];
$bingoMessage = rand($min, $max);

if ($bingoMessage == $dbRow['LOVE']){
    if (1 == $dbRow['LOVE']){
        $message='Bravo tu est le 1er a avoir lover mon message ! Ton compte Bitcoin sera crédité de 10 bitcoins !';
        echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
    }
    else $message='Bravo tu est le ' . $dbRow['LOVE'] . 'eme a avoir lover mon message ! Ton compte Bitcoin sera crédité de 10 bitcoins !';
    echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
}
else{
    $message='Merci';
    echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
}