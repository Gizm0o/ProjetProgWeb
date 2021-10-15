<?php
require_once 'connectdb.inc.php';
require_once 'utils.inc.php';
start_page('Recherche');


require_once 'inc/connectdb.inc.php';
require_once 'inc/utils.inc.php';
start_page('Recherche');
$connect = connect_db();
$tag = $_POST['tag'];

$query = 'SELECT IDM FROM TAG WHERE NTAG = ?';
$stmt = mysqli_stmt_init($connect);
if (!mysqli_stmt_prepare($stmt, $query)){
    header('location: ../index.php?error=stmterror');
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $tag );
mysqli_stmt_execute($stmt);

$result_query = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result_query)){
    return $row;
}
else{
    return false;
}

?>
<div class="Publi">
    <ul>
        <?php
        mysqli_stmt_bind_result($stmt, $row, $cont);
        while($p = mysqli_stmt_fetch($stmt)) { ?>

            <li>
                <?= '*', $cont, '*'?>
                <a class="button" href="php/message.php?edit=<?= $idm ?> "> <button>Modifier</button> </a>
                <a class="button" href="php/suppr.php?edit=<?= $idm ?> "> <button>Supprimer</button> </a> </br>
            </li>

        <?php } ?>
        <ul>
</div>