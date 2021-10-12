<?php
    include '../index.php';
    start_page('Supprimer');

if(isset($_POST['id']) AND !empty($_POST['id'])) {
    
    $suppr_id = htmlspecialchars($_POST['id']); 

    $suppr = mysqli_prepare($connect, 'DELETE * FROM MSG WHERE id = ?');
    mysqli_stmt_bind_param($suppr,'s',$suppr_id);
    mysqli_stmt_execute($suppr);

    header('Location: http://vanestarremaurel.alwaysdata.net/index.php');
}
?>