<?php
    require_once 'inc/connectdb.inc.php';
    
    $connect = connect_db();

if(isset($_GET['IDM']) AND !empty($_GET['IDM'])) {
    
    $suppr_id = htmlspecialchars($_GET['IDM']); 

    $suppr = mysqli_prepare($connect, 'DELETE * FROM MSG WHERE IDM = ?');
    mysqli_stmt_bind_param($suppr,'s',$suppr_id);
    mysqli_stmt_execute($suppr);

    header('Location: http://vanestarremaurel.alwaysdata.net');
}
?>