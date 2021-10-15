<?php 
    require_once 'inc/connectdb.inc.php';
    require_once 'inc/function.inc.php';


    $connect = connect_db();
    $mode_edition = 0;

//premier if pour associer chaque table à l'IDM
if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
    $mode_edition = 1;

    $edit_id = htmlspecialchars($_GET['edit']); 
    
    $edit_tag = tag();//fonction TAG
    
    $edit_img = img();//fonction IMG


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


if(isset($_POST['contenu'], $_POST['tag'], $_POST['publier'])){ //On regarde si ces variables sont déclarée et diff de null
    if(!empty($_POST['contenu']) AND !empty($_POST['tag'])){ //On regarde si ces variables sont vides

        $contents = htmlspecialchars($_POST['contenu']);
        $tag = htmlspecialchars($_POST['tag']); //htmlspecialchars permets de sécuriser et transformer certains caractères spéciaux en entités html.

        if($mode_edition == 0) {//Pour insérer chaque valeurs dans leurs table respectives
            $ins = mysqli_prepare($connect,'INSERT INTO MSG (CONT, date_time_publication) VALUES (?, NOW())'); //Insertion de données
            mysqli_stmt_bind_param($ins,'s',$contents);
            mysqli_stmt_execute($ins); 
            
            $idm = mysqli_insert_id($connect); //prend le dernier ID
            $ins = mysqli_prepare($connect,'INSERT INTO TAG (IDM, NTAG) VALUES (?, ?)'); 
            mysqli_stmt_bind_param($ins,'is',$idm,$tag);
            mysqli_stmt_execute($ins); 

            $ins = mysqli_prepare($connect,'INSERT INTO IMAGE (IDM, IMG) VALUES (?, ?)'); 
        mysqli_stmt_bind_param($ins,'ib',$idm,/*file_get_contents(*/$_FILES['image']['error']/*)*/); //Lit le fichier en string
            mysqli_stmt_execute($ins);

            $message = 'Votre article a bien été posté';

        } else {//pour modifier chaque table si besoin
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

<form method="POST" name="mess" entype="multipart/form-data"> <!--Création d'un "formulaire pour créer les publications"--> 
    <input type="text" name="contenu" placeholder="Votre message" <?php 
        if($mode_edition == 1) { ?> 
    <?= $edit_publication['CONT'] ?><?php } ?>/> <br/>
    
    <input type="text" name="tag" placeholder="Votre TAG" <?php 
        if($mode_edition == 1) { ?> 
    value="<?= $edit_tag['NTAG'] ?>"<?php } ?>/> <br/>
    
    <input type="file" name="image" accept=" image/jpeg" <?php 
        if($mode_edition == 1) { ?> 
    value="<?= $edit_img['IMG'] ?>"<?php } ?>/> <br/>
    
    <input class="submit" type="submit" name="publier" value="Publier"/><br/>
</form>

<?php 
    if(isset($message)) {echo $message;}
?>
