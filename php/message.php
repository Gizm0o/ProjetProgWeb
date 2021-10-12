<?php 
    include '../index.php';
    start_page ('Ecrire / Modifier');

$mode_edition = 0;

if(isset($_POST['edit']) AND !empty($_POST['edit'])) {
    $mode_edition = 1;

    $edit_id = htmlspecialchars($_POST['edit']); 
    $edit_publication = mysqli_prepare($connect, 'SELECT * FROM MSG WHERE id = ?');
    
    mysqli_stmt_bind_param($edit_publication,'s',$edit_id);
    mysqli_stmt_execute($edit_publication); 

    if(mysqli_stmt_num_rows($edit_publication) == 1){
        //vérifie si l'article existe
        $edit_publication = mysqli_stmt_fetch($edit_publication);

    } else {
        die('Erreur : la publication n\'existe pas ');
    }
}

if(isset($_POST['contents'], $_POST['tag'])){ //On regarde si ces variables sont déclarée et diff de null
    if(!empty($_POST['contents']) AND !empty($_POST['tag'])){ //On regarde si ces variables sont vides
       
        $contents = htmlspecialchars($_POST['contents']);
        $tag = htmlspecialchars($_POST['tag']); //htmlspecialchars permets de sécuriser et transformer certains caractères spéciaux en entités html.
        
        if($mode_edition == 0) {
            $ins = mysqli_prepare($connect,'INSERT INTO MSG (CONT, date_time_publication)
            VALUES (?, NOW())'); //Insertion de données

            mysqli_stmt_bind_param($ins,'ss',$contents,$tag);
            mysqli_stmt_execute($ins); 

            $message = 'Votre article a bien été posté';
        } else {
            $update = mysqli_prepare($connect,'UPDATE MSG SET CONT = ?, 
            date_time_edition = NOW() WHERE id =?');
            
            mysqli_stmt_bind_param($update, 'ss', $contents, $edit_id);
            mysqli_stmt_execute($update);
            header('Location: http://vanestarremaurel.alwaysdata.net/index.php' .$edit_id);
            $message = 'Votre article a bien été changé';
        }


    } else{
        $message = 'Veuillez remplir tous les champs';
    }
}

?>

<form method="POST"> <!--Création d'un "formulaire pour créer les publications" -->
    <textarea type="text" name="contenu_publication" placeholder="Votre message" ><?php 
        if($mode_edition == 1) { ?> 
    <?= $edit_publication['contenu'] ?><?php } ?></textarea> <br/>
    
    <input type="text" name="tag_publication" placeholder="Votre TAG" <?php 
        if($mode_edition == 1) { ?> 
    value="<?= $edit_publication['tag'] ?>"<?php } ?>/> <br/>
    
    <input type="file" name="image_publication" accept="image/png, image/jpeg" /> <br/>
    
    <input type="submit" value="Publier"/><br/>
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