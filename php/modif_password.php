<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Nouveau mot de passe</title>
    </head>
    <body>
    <body>
        <h1>Modification du mot de passe actuel:</h1>


        <div id="mdp_modif">
            <form method="post" action=modif.php >
                  <input type="checkbox" name="modificaion" id="oui" />
                  Je souhaite modifier ce mot de passe.<br/>
                  <input type="checkbox" name="modification" id="non" />
                  Je ne souhaite pas modifier ce nouveau mot de passe.<br/>
                  <input type=submit value=Envoyer>
            </form>
        </div>
    </body>
</html>