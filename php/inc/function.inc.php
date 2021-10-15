<?php
    require_once 'connectdb.inc.php';
    
    function tag(){
        $connect = connect_db();
        $edit_id = htmlspecialchars($_GET['edit']); 


        $edit_tag = mysqli_prepare($connect, 'SELECT IDM, NTAG FROM TAG WHERE IDM = ?');
        mysqli_stmt_bind_param($edit_tag,'i',$edit_id);
        mysqli_stmt_execute($edit_tag);
    }

    function img(){
        $connect = connect_db();
        $edit_id = htmlspecialchars($_GET['edit']); 
        $edit_idi = htmlspecialchars($_GET['edit']); 


        $edit_img = mysqli_prepare($connect, 'SELECT IDI, IDM, IMG FROM IMAGE WHERE IDI = ? AND IDM = ?');
        mysqli_stmt_bind_param($edit_img,'ii',$edit_idi,$edit_id);
        mysqli_stmt_execute($edit_img);
    }

    /*function tri(){
        $connect = connect_db();
        //permet de trier les messages par date de publication
        $stmt = mysqli_prepare($connect, 'SELECT IDM, CONT FROM MSG ORDER BY date_time_publication DESC');
        mysqli_stmt_execute($stmt);?>
        <ul>
        <?php 
        mysqli_stmt_bind_result($stmt, $idm, $cont);
        while($p = mysqli_stmt_fetch($stmt)) { ?>
        
            <li>
                <?=  'Contenu :  ','   "', $cont, '"'?>
                <a class="button" href="php/message.php?edit=<?= $idm ?> "> <button>Modifier</button> </a> 
                <a class="button" href="php/suppr.php?edit=<?= $idm ?> "> <button>Supprimer</button> </a> </br>
        </li>
        <?php } ?>

        <ul><?php
    }*/
?>

