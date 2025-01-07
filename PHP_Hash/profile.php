<?php session_start(); ?>

<!-- Cette page profil n'existe qu'en cas de connexion de l'utilisateur -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Mon profil</h1>

    <?php
        if(isset($_SESSION["user"])) {
            $infosSession = $_SESSION["user"];
        }
    ?>

        <p>Pseudo: <?= $infosSession["pseudo"] ?></p>
        <p>Email: <?= $infosSession["email"] ?></p>

    
</body>
</html>