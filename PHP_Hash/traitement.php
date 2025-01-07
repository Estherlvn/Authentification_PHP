<?php

session_start();

if (isset($_GET["action"])) {

    switch ($_GET["action"]) {
        case "register":

            if (isset($_POST["submit"])) {  // SI le formulaire est soumis ...alors
                // Connexion à la BDD
                $pdo = new PDO("mysql:host=localhost;dbname=forum_ledlev;charset=utf8", "root", "");

                // Filtrer la saisie des champs du formulaire d'inscription
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Vérifier la validité des champs
                if ($pseudo && $email && $pass1 && $pass2) {
                    $requete = $pdo->prepare("SELECT * FROM membre WHERE email = :email");
                    $requete->execute(["email" => $email]);
                    $user = $requete->fetch(); // résultat de la requête (si le membre existe)

                    // Si l'utilisateur (membre) existe : redirection vers la page register.php
                    if ($user) {
                        header("Location: register.php");
                        exit;
                    } else {
                        // Insertion de l'utilisateur dans la BDD
                        if ($pass1 === $pass2 && strlen($pass1) >= 5) {
                            $insertUser = $pdo->prepare("INSERT INTO membre (pseudo, email, password) VALUES (:pseudo, :email, :password)");
                            $insertUser->execute([
                                "pseudo" => $pseudo,
                                "email" => $email,
                                "password" => password_hash($pass1, PASSWORD_DEFAULT)
                            ]);
                            header("Location: login.php");
                            exit;
                        } else {
                            // Les MDP ne match pas
                        }
                    }
                } else {
                   // Problème de saisie dans les champs du formulaire lors de la soumission
                }
            } else {
                
                // Par défaut, j'affiche le formulaire d'inscription
                header("Location: register.php");
                exit;
            }
            break;

            case "login": // Connexion à l'application

                if($_POST["submit"]) {
                    // Connexion à la BDD
                    $pdo = new PDO("mysql:host=localhost;dbname=forum_ledlev;charset=utf8", "root", "");
                    // on part du principe que la page login ne demande qu'un mail et un mdp
                    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }

                header("Location: login.php"); exit;
            break;

            case "logout":
            exit;
    }
}
