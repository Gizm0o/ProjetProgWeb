<?php 
    require_once 'inc/connectdb.inc.php';
    require_once 'inc/function.inc.php';

    $connect = connect_db();
$mode_edition = 0;

if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
    $mode_edition = 1;

    $edit_id = htmlspecialchars($_GET['edit']); 
    $edit_tag = tag();

    $edit_publication = mysqli_prepare($connect, 'SELECT IDM, CONT FROM MSG WHERE IDM = ?');
    mysqli_stmt_bind_param($edit_publication,'s',$edit_id);
    mysqli_stmt_execute($edit_publication); 
    $nbr = mysqli_stmt_num_rows($edit_publication);
    
    if($nbr == 0){
        //vérifie si l'article existe
        mysqli_stmt_bind_result($edit_publication, $idm, $cont);
        $edit_publication = mysqli_stmt_fetch($edit_publication);

    } else {
        die('Erreur : la publication n\'existe pas ');
    } 
}

if(isset($_POST['contenu_pub'], $_POST['tag_pub'], $_POST['image_pub'] )){ //On regarde si ces variables sont déclarée et diff de null
    if(!empty($_POST['contenu_pub']) AND !empty($_POST['tag_pub'])){ //On regarde si ces variables sont vides
       
        $contents = htmlspecialchars($_POST['contenu_pub']);
        $tag = htmlspecialchars($_POST['tag_pub']); //htmlspecialchars permets de sécuriser et transformer certains caractères spéciaux en entités html.
        $img = $_POST['image_pub'];

        if($mode_edition == 0) {
            $ins = mysqli_prepare($connect,'INSERT INTO MSG (CONT, date_time_publication) VALUES (?, NOW())'); //Insertion de données
            mysqli_stmt_bind_param($ins,'s',$contents);
            mysqli_stmt_execute($ins); 
            
            $ins = mysqli_prepare($connect,'INSERT INTO TAG (NTAG)
            VALUES (?)'); 
            mysqli_stmt_bind_param($ins,'s',$tag);
            mysqli_stmt_execute($ins); 

            $ins = mysqli_prepare($connect,'INSERT INTO IMAGE (IMG)
            VALUES (?)'); 
            mysqli_stmt_bind_param($ins,'s',$img);
            mysqli_stmt_execute($ins);

            $message = 'Votre article a bien été posté';

        } else {
            $update = mysqli_prepare($connect,'UPDATE MSG SET CONT = ?, 
            date_time_edition = NOW() WHERE IDM =?');
            
            mysqli_stmt_bind_param($update, 'ss', $contents, $edit_id);
            mysqli_stmt_execute($update);

            $update = mysqli_prepare($connect,'UPDATE TAG SET NTAG = ? WHERE IDM =?');
            
            mysqli_stmt_bind_param($update, 'ss', $tag, $edit_id);
            mysqli_stmt_execute($update);
            
            $update = mysqli_prepare($connect,'UPDATE IMAGE SET IMG = ? WHERE IDM =?');
            
            mysqli_stmt_bind_param($update, 'ss', $img, $edit_id);
            mysqli_stmt_execute($update);

            header('Location: http://vanestarremaurel.alwaysdata.net');
            $message = 'Votre article a bien été changé';
        }


    } else{
        $message = 'Veuillez remplir tous les champs';
    }
}

?>

<form method="POST" name="mess"> <!--Création d'un "formulaire pour créer les publications"--> 
    <input type="text" name="contenu_pub" placeholder="Votre message" <?php 
        if($mode_edition == 1) { ?> 
    <?= $edit_publication['CONT'] ?><?php } ?>/> <br/>
    
    <input type="text" name="tag_pub" placeholder="Votre TAG" <?php 
        if($mode_edition == 1) { ?> 
    value="<?= $edit_tag['NTAG'] ?>"<?php } ?>/> <br/>
    
    <input type="file" name="image_pub" accept=" image/jpeg" <?php 
        if($mode_edition == 1) { ?> 
    value="<?= $edit_img['IMG'] ?>"<?php } ?>/> <br/>
    
    <input class="submit" type="submit" value="Publier"/><br/>
</form>

<?php 
    if(isset($message)) {echo $message;}
?>
<!--$contents = mysqli_query ('SELECT * FROM MSG 
    WHERE MSG.IDM = IMAGE.IDM ')

while($mess = mysql_fetch_assoc($contents))
{
    $id = $mess['IDM']
    $texte = utf8_encode($mess['CONT'])
    $img = $mess['IMG']
}β-->