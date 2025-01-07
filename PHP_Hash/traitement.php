<?php

if(isset($_GET["action"])) {
    switch($_GET["action"]) {
        case "register":     // attribut de l'action "register" de register.php

            // CONNEXION BDD
            $pdo = new PDO("mysql:host=localhost;dbname=forum; charset=urf8", "root", "");

            // FILTRER la saisie des champs du fomulaire d'inscription
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANTIZER_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANTIZER_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANTIZER_FULL_SPECIAL_CHARS);

            // VERIFIER la validité des champs (pas de mails identiques, mdp valides, etc...)
            if($pseudo && $email && $pass1 && $pass2) {
                var_dump("ok");die;

            }

        break;
    }
}