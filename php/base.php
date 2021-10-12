/*<?php start_page('base')?>
<?php
    $dbLink = mysqli_connect('mysql-vanestarremaurel.alwaysdata.net', '245082', 'vanestarre!0')
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    ?>
<?php mysqli_select_db($dbLink , 'vanestarremaurel_admin')
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
?>
<?php
    $query = 'SELECT IDU, MAIL, date FROM USER';
    ?>
<?php
    if (!($dbResult = mysqli_query($dbLink, $query))){
        echo 'Erreur de requete<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requete : ' . $query . '<br/>';
        $_SESSION['error'];
        exit();
    }
?>
<?php
    while ($dbRow = mysqli_fetch_assoc($dbResult))
    {
        echo $dbRow['IDU'] . '<br/>';
        echo $dbRow['MAIL'] . '<br/>';
        echo $dbRow['date'] . '<br/>';
        echo '<br/><br/>';
    }
?>
<?php
    $today = date('Y-m-d');
    echo date('d.m.Y', strtotime($dbRow['date']));
    $query = 'INSERT INTO USER (date, MAIL) VALUES (\'' . NOW() . '\')';
    echo 'Bonjour, 
    Votre inscription a bien été enregistrée, merci!'
?>
<?php end_page(); ?>*/
