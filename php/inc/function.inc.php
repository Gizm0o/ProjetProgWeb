<?php
    require_once 'connectdb.inc.php';
    
    function tag(){
        $connect = connect_db();
        $edit_id = htmlspecialchars($_GET['edit']); 

        $edit_tag = mysqli_prepare($connect, 'SELECT IDM, NTAG FROM TAG WHERE IDM = ?');
        mysqli_stmt_bind_param($edit_tag,'s',$edit_id);
        mysqli_stmt_execute($edit_tag);
    }

    function img(){
        $connect = connect_db();
        $edit_id = htmlspecialchars($_GET['edit']); 

        $edit_img = mysqli_prepare($connect, 'SELECT IDM, NTAG FROM TAG WHERE IDM = ?');
        mysqli_stmt_bind_param($edit_img,'s',$edit_id);
        mysqli_stmt_execute($edit_img);
    }
?>