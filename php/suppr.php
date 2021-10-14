<?php
    require_once 'inc/connectdb.inc.php';
    
    $connect = connect_db();

if(isset($_POST['IDM']) AND !empty($_POST['IDM'])) {
    
    $suppr_id = htmlspecialchars($_POST['IDM']); 

    $suppr = mysqli_prepare($connect, 'DELETE * FROM MSG WHERE IDM = ?');
    mysqli_stmt_bind_param($suppr,'s',$suppr_id);
    mysqli_stmt_execute($suppr);

    header('Location: https://www.youtube.com/watch?v=I9RBJOtaUno&t=470s');
}
?>