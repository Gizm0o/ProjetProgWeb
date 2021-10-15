<?php
    require_once 'php/inc/utils.inc.php'; 
    require_once 'php/inc/connectdb.inc.php';
    start_page ('Vanestarre');
    if (isset($_SESSION['user_id']) && $_SESSION['role'] == 1)
        {
            require_once 'php/message.php';
            require_once 'php/suppr.php';
        }

    require_once 'php/pagination.php';
    $connect = connect_db();
     //permet de trier les messages par date de publication
    $stmt = mysqli_prepare($connect, 'SELECT IDM, CONT FROM MSG ORDER BY date_time_publication DESC');
    mysqli_stmt_execute($stmt);

?>

<div class="Bloc">
    <div class="Publi">
        <ul>
            <?php
                if (isset($_SESSION['user_id']) && $_SESSION['role'] == 1)
                { 
                mysqli_stmt_bind_result($stmt, $idm, $cont);
                while($p = mysqli_stmt_fetch($stmt)) { ?>
            
                <li>
                    <?=  'Contenu :  ','   "', $cont, '"'?>
                    <a class="button" href="php/message.php?edit=<?= $idm ?> "> <button>Modifier</button> </a> 
                    <a class="button" href="php/suppr.php?edit=<?= $idm ?> "> <button>Supprimer</button> </a> </br>
            </li>
            <?php }
            } ?>

        <ul>
    </div>
</div>

<?php 
    end_page();
?>