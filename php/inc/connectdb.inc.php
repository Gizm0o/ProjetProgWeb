<?php
function connect_db() {
    $hostname = 'mysql-vanestarremaurel.alwaysdata.net';
    $username = '245082';
    $pwd = 'vanestarre!0';
    $db = 'vanestarremaurel_admin';

    $connect = mysqli_connect($hostname, $username, $pwd, $db);

    if (!$connect) {
        die('Problème de connection: ' . mysqli_connect_error());
    }

    return $connect;
}
