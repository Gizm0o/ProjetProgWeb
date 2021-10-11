<?php

function connect_bd()
{
    $dbLink = mysqli_connect('mysql-vanessamaurel.alwaysdata.net', '245082',
        'vanestarre!0')
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink, 'vanessamaurel_admin')
    or die('Erreur dans la sélection de la base :' . mysqli_error($dbLink));

    return $dbLink;
}
?>