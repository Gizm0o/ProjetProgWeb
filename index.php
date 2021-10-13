<?php
    session_start();
    include_once 'php/inc/utils.inc.php';
    require_once 'php/inc/connectdb.inc.php';
    require_once 'php/message.php';
    start_page ('Vanestarre');

    $connect = connect_db();
     //permet de trier les messages par date de publication
    $stmt = mysqli_prepare($connect, 'SELECT * FROM MSG ORDER BY date_time_publication DESC');
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
            <?php while($p = mysqli_stmt_fetch($stmt)) { ?>
            
                <li>
                    <?= '*', $p['CONT'], '*'?>
                    <a href="php/message.php?edit=<?= $p['IDM']?> "> Modifier </a> |
                    <a href="php/suppr.php?edit=<?= $p['IDM']?> "> Supprimer </a>
                </li>
            
            <?php } ?>
        <ul>
    </div>
</div>

<form method="POST" name="mess"> <!--Création d'un "formulaire pour créer les publications"--> 
    <textarea type="text" name="contenu_pub" placeholder="Votre message" ><?php 
        if($mode_edition == 1) { ?> 
    <?= $edit_publication['CONT'] ?><?php } ?></textarea> <br/>
    
    <input type="text" name="tag_pub" placeholder="Votre TAG" <?php 
        if($mode_edition == 1) { ?> 
    value="<?= $edit_tag['NTAG'] ?>"<?php } ?>/> <br/>
    
    <input type="file" name="image_pub" accept="image/png, image/jpeg" <?php 
        if($mode_edition == 1) { ?> 
    value="<?= $edit_publication['IMG'] ?>"<?php } ?>/> <br/>
    
    <input type="submit" value="Publier"/><br/>
</form>

<?php 
    end_page();
?>