<?php
// Etape 1 : config database
$DB_HOST = "localhost";
$DB_NAME = "tincat";
$DB_USER = "root";
$DB_PASSWORD = "";
$pseudo = $_POST['pseudo'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$pagesuivante = false;


// Etape 2 : Connexion to database
try {
    $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
var_dump($_POST);

if("$pagesuivante"){
    header("Location: ../register.php");
}


// Avant d'insérer en base de données faire les vérifications suivantes

    // Vérifier si le pseudo ou le mot de passe est vide 
if(empty($pseudo) || empty($password)) {
    echo "Votre mot de passe ou votre pseudo est vide ! ";
    $pagesuivante = true;
}


// Ici je selectionne les varriables utilisé pour l'envoie de la base de donné mais dans mon cas mon mot de passe est toujours égal à zero et mon identifiant à  'root'
//if(empty($DB_NAME) || empty($DB_PASSWORD)) {
//    echo " Votre mot de passe ou votre pseudo est vide"
//exit();$
//}
// Autre manière de verifier si le mot de passe ou le nom est vide 
//if($DB_NAME === "" || $DB_PASSWORD === ""){
//    echo "Votre mot de passe ou votre pseudo est vide"
//}


    // Ajouter un input confirm password et vérifier si les deux sont égaux
// j'ai ajouté un <input type="password" placeholder="Verification mot de passe" name="password2">
if($password === $password2) {
    echo "Bienvenue ! ";
}else if($password !== $password2){
    echo "veuillez mettre les mêmes mot de passe";
    $pagesuivante = true;
}


    // Ajouter un champ email
// j'ai placé dans le register : <input type="text" placeholder="Email" name="email">



// Etape 3 : prepare request
$req = $db->prepare("INSERT INTO users (pseudo, password) VALUES(:pseudo, :password)");
$req->bindParam(":pseudo", $_POST["pseudo"]);
$req->bindParam(":password", $_POST["password"]);
$req->execute();