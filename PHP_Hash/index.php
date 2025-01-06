<?php

$password = "monMotDePasse1234";
$password2 = "monMotDePasse1234";

$user = "Esther";


echo "HACHAGE FAIBLE"."<br><br>";
// algorithme de hachage FAIBLE
$md5 = hash('md5', $password);  // fonction php "hash" + arguments()
$md5_2 = hash('md5', $password2);

echo $md5. "<br>";
echo $md5_2. "<br>";
// dans cet ex., on remarque que des mdp identiques génèrent le même hash

$sha256 = hash('sha256', $password);
$sha256_2 = hash('sha256', $password2);

echo $sha256."<br>";
echo $sha256_2."<br><br>";
// le hash sha256 génère une chaine de carac. plus longue

// le hachage FAIBLE reste fixe au refresh de la page et la chaine de c.
// générée ne change pas en cas de mdp identiques

echo "HACHAGE FORT"."<br><br>";
// algorithme de hachage FORT
$hash = password_hash($password, PASSWORD_DEFAULT);
$hash2 = password_hash($password2, PASSWORD_DEFAULT);

echo $hash."<br>";
echo $hash2."<br>";
// le salt et le hashage changent aléatoirement au refresh
// le hashage des mdp sont différents en cas de mdp identiques

$hash3 = password_hash($password, PASSWORD_BCRYPT);
$hash4 = password_hash($password2, PASSWORD_ARGON2I);

echo $hash3."<br>";
echo $hash4."<br><br>";
// BCRYPT idem à DEFAULT
// ARGON2I génère un hash plus long


echo "Saisie dans le formulaire de login"."<br>";

$saisie = "monMotDePasse1234"; 

$check = password_verify($saisie, $hash);
// var_dump($check); // renvoi un booleen, true or false
if(password_verify($saisie, $hash)) {
    echo "Les mots de passe correspondent ! ";
} else {
    echo "Les mots de passe sont différents !"."<br>";
}

// en cas de succès, connection à la session de l'utilisateur
if(password_verify($saisie, $hash)) {
    // echo "Les mots de passe correspondent !";
    $_SESSION["user"] = $user;
    echo $user. " est connecté !";
} else {
    echo "Les mots de passe sont différents !";
}

