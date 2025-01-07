<?php

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "register":
            // Connexion BDD
            $pdo = new PDO("mysql:host=localhost;dbname=forum_ledlev;charset=utf8", "root", "");

            // Filtrer la saisie des champs du formulaire d'inscription
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Vérifier la validité des champs
            if ($pseudo && $email && $pass1 && $pass2) {
                    // var_dump("ok"); die;
                    $requete = $pdo->prepare("SELECT * FROM membre WHERE email = :email");
                    $requete->execute(["email" => $email]);
                    $user = $requete->fetch(); // résultat de la requete (si le user existe)
                    // si l'utilisateur (user) existe : redirection vers la page register.php
                    if($user) {
                        header("location: register.php"); exit;
                    // si l'utilisateur n'existe pas
                    } else {
                        // var_dump("Utilisateur inexistant"); die;
                    // insertion de l'utilisateur dans la BDD
                        if($pass1 == $pass2 && strlen($pass1) >= 5) {    // vérifier que les mdp sont identiques + dépasse 5 char.
                        $insertUser = $pdo->prepare("INSERT INTO user (pseudo, email, password) VALUES (:pseudo, :email, :password)");
                        $insertUser->execute([
                            "pseudo" => $pseudo,
                            "email" => $email,
                            "password" => $password_hash($pass1, PASSWORD_DEFAULT)
                        ]);
                        header("Location: login.php"); exit;
                    } else {
                        // message d'erreur "les mdp ne sont pas identiques"
                    }
            } 
        } else {
            // problème de saisie dans les champs de formulaire
        }

            break;

            case "login":
                // connexion à l'application
            break;
    }
}