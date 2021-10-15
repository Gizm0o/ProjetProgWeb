<?php
//script permettant de se déconnecter du site
    session_start();
    session_unset();
    session_destroy();

    header('location: ../../index.php');
    exit();
