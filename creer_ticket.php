<?php
require_once('co_bdd.php');
session_start(); // Assurez-vous de démarrer la session

if(isset($_POST['boutton-valider'])){ 
    if(isset($_POST['titre']) && isset($_POST['desc']) && isset($_POST['categorie'])) { // les issests servent à verifier que l'utilisateur à bien rempli un login, un mot de passe et qu'il a bien valider ceci
        $titre = htmlspecialchars($_POST['titre']);
        $desc = htmlspecialchars($_POST['desc']);
        $cate = $_POST['categorie'];
        $dateCrea = "04-06-2024";
        //$id = $_SESSION['id'];
        //$Email = $_SESSION['mail'];
        //$nom = $_SESSION['nom'];
        
        //selectionner le bon créateur du ticket
        //$selectUti = $lien->prepare("SELECT idUtilisateur FROM utilisateur WHERE email = ?");
        //$selectUti->execute(array($Email));

        // Requête d'insertion des données dans la table ticket
        $creerTicket = $lien->prepare('INSERT INTO ticket (idCat, titre, description, dateCreation) VALUES (?, ?, ?, ?)');
        $creerTicket->execute(array($cate, $titre, $desc, $dateCrea));

        header('Location: http://localhost:8080/#/creerTicket');
    }
}
?>