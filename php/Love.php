<?php
require_once 'inc/connectdb.inc.php';
$connect = connect_db();
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