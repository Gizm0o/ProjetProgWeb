<?php 
    require 'login.php';
    include 'utils.inc.php';

if(isset($_POST['contenu'], $_POST['image'])){
    if(!empty($_POST['contenu']) AND !empty($_POST['tag'])){
        $contenu = htmlspecialchars($_POST['contenu']);
        $tag = htmlspecialchars($_POST['tag']);
        

    } else{
        $erreur = 'Veuillez remplir tous les champs';
    }
}

?>

<form method="POST">
    <textarea type="text" name="contenu" placeholder="Votre message"></textarea> <br/>
    <input type="text" name="tag" placeholder="Votre TAG"/> <br/>
    <input type="file" name="image" accept="image/png, image/jpeg" /> <br/>
    <input type="submit" value="Publier"/><br/>
</form>

<?php 
    if(isset($erreur)) {echo $erreur;}
?>
/*$contents = mysqli_query ('SELECT * FROM MSG 
    WHERE MSG.IDM = IMAGE.IDM ')

while($mess = mysql_fetch_assoc($contents))
{
    $id = $mess['IDM']
    $texte = utf8_encode($mess['CONT'])
    $img = $mess['IMG']
}β*/