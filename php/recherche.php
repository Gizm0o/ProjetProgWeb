<?php
require_once 'php/inc/connectdb.inc.php';
require_once 'php/inc/utils.inc.php';
start_page('Recherche');
require_once 'php/message.php';
$connect = connect_db();

$tag = $_POST['tag'];

var_dump($tag);

//première requete ou on recupere le contenu des tag recherché ainsi que l'id des messages associées
$query = 'SELECT * FROM TAG WHERE ? = NTAG';
$stmt = mysqli_stmt_init($connect);
if (!mysqli_stmt_prepare($stmt, $query)){
    header('location: ../index.php?error=stmterror');
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $tag );
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
var_dump($result);
mysqli_stmt_close($stmt);

//on recupere le contenu des messages associés au tag de la premiere requete
$query2 = 'SELECT IDM, CONT FROM MSG ORDER BY date_time_publication DESC';
$stmt2 = mysqli_stmt_init($connect);
if (!mysqli_stmt_prepare($stmt2, $query)){
    header('location: ../index.php?error=stmterror2');
    exit();
}
mysqli_stmt_execute($stmt2);

//afichage des messages (marche pas)
?>
<div class="Publi">
    <ul>
        <?php
        mysqli_stmt_bind_result($stmt2, $result, $cont);
        while($p = mysqli_stmt_fetch($stmt2)) { ?>

            <li>
                <?= '*', $cont, '*'?>
                <a class="button" href="php/message.php?edit=<?= $idm ?> "> <button>Modifier</button> </a>
                <a class="button" href="php/suppr.php?edit=<?= $idm ?> "> <button>Supprimer</button> </a> </br>
            </li>

        <?php }

        if (isset($_SESSION['user_id']) && $_SESSION['role'] == 1)
        {

        }
        ?>
        <ul>
</div>

