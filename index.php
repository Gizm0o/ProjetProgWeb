<?php 
    include 'inc/utils.inc.php'; 
    include 'inc/connectdb.inc.php';
    start_page ('Vanestarre');

    $publication = mysqli_query($connect, 'SELECT * FROM MSG ORDER BY date_time_edition DESC'); //permet de trier les messages par date de publication
    $stmt = mysqli_prepare($connect, '$publication');
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
            <?php while($p = mysqli_stmt_fetch($stmt)) { ?>
            
                <li>
                    <?= $p['contenu'], $p['tag']?>
                    <a href="message.php?edit=<?= $a['id']?> "> Modifier </a> |
                    <a href="suppr.php?edit=<?= $a['id']?> "> Supprimer </a>
                </li>
            
            <?php } ?>
        <ul>
    </div>
</div>

<?php 
    end_page();
?>