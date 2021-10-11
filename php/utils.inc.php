<?php
function start_page($title)
{
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <link id="css" rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <meta name="description" content="Bonjour, je m'appelle Vanessa Maurel. Voici mon premier Réseau Social."> 
    <meta name="keywords" content="Vanessa Maurel">
</head>
<body>
<?php
}
?>
<?php function end_page () { ?>
</body>
</html>
<?php
}
?>