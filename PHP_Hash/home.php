<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        // si je suis connecté
        if(isset($_SESSION["user"])) { ?>
            <a href="traitement.php?action=logout">Se déconnecter</a>
            <a href="traitement.php?action=profile">Mon profil</a>

        <?php

        } else { ?>
            <a href="traitement.php?action=login">Se connecter</a>
            <a href="traitement.php?action=register">S'inscire</a>

        <?php }
    ?>

    <h1>ACCUEIL</h1>

    <?php // message d'accueil personnalisé si succès connexion
        if(isset($_SESSION["user"])) {
            echo "<p>Bienvenue ".$_SESSION["user"]["pseudo"]. "</p>";
        }
            ?>
    


</body>
</html>