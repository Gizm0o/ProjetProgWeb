<?php 
    require_once 'php/inc/utils.inc.php'; 
    require_once 'php/inc/connectdb.inc.php';
    require_once 'php/message.php';
    require_once 'php/suppr.php';
    start_page ('Vanestarre');

    $connect = connect_db();
     //permet de trier les messages par date de publication
    $stmt = mysqli_prepare($connect, 'SELECT IDM, CONT FROM MSG ORDER BY date_time_publication DESC');
    mysqli_stmt_execute($stmt);
    
?>

<div class="Bloc">
    <nav>
        <a class="Logo" ><img class="logo" src="images/Vanestarre.png" height="60px" width="110px" ></a>
    </nav>
    <div class="Publi">
        <header>
            <h1 class="name">Vanestarre</h1>
        </header>
        <ul>
            <?php 
            mysqli_stmt_bind_result($stmt, $idm, $cont);
            while($p = mysqli_stmt_fetch($stmt)) { ?>
            
                <li>
                    <?= '*', $cont, '*'?>
                    <a class="button" href="php/message.php?edit=<?= $idm ?> "> <button>Modifier</button> </a> |
                    <a class="button" href="php/suppr.php?edit=<?= $idm ?> "> <button>Supprimer</button> </a>
                </li>
            
            <?php } ?>
        <ul>
    </div>
</div>

<?php 
    end_page();
?>