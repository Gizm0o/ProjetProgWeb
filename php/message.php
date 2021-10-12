<?php 
    include 'connect-db.php';
    include 'utils.inc.php';


if(isset($_POST['contents'], $_POST['image'])){ //On regarde si ces variables sont déclarée et diff de null
    if(!empty($_POST['contents']) AND !empty($_POST['tag'])){ //On regarde si ces variables sont vides
       
        $contents = htmlspecialchars($_POST['contents']);
        $tag = htmlspecialchars($_POST['tag']); //htmlspecialchars permets de sécuriser et transformer certains caractères spéciaux en entités html.

        $ins = mysqli_prepare($db_Link,'INSERT INTO MSG (CONT, date_time_publication)
                VALUES (?, NOW())'); //Insertion de données

        mysqli_stmt_bind_param($ins,'ss',$contents,$tag);

        mysqli_stmt_execute($ins); 

        $message = 'Votre article a bien été posté';

    } else{
        $message = 'Veuillez remplir tous les champs';
    }
}

?>

<form method="POST"> <!--Création d'un "formulaire pour créer les publications" -->
    <textarea type="text" name="contents" placeholder="Votre message"></textarea> <br/>
    <input type="text" name="tag" placeholder="Votre TAG"/> <br/>
    <input type="file" name="image" accept="image/png, image/jpeg" /> <br/>
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