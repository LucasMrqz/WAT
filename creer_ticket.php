<?php
require_once('co_bdd.php');
session_start(); // Assurez-vous de démarrer la session

if(isset($_POST['boutton-valider'])){ 
    if(isset($_POST['idTicket']) && isset($_POST['titre']) && isset($_POST['desc']) && isset($_POST['categorie'])) { 
        $id = htmlspecialchars($_POST['idTicket']);
        $titre = htmlspecialchars($_POST['titre']);
        $desc = htmlspecialchars($_POST['desc']);
        $cate = $_POST['categorie'];
        //$id = $_SESSION['id'];
        //$Email = $_SESSION['mail'];
        //$nom = $_SESSION['nom'];

        //selectionner le bon créateur du ticket
        //$selectUti = $lien->prepare("SELECT idUtilisateur FROM utilisateur WHERE email = ?");
        //$selectUti->execute(array($Email));

        // Requête d'insertion des données dans la table ticket
        $creerTicket = $lien->prepare('INSERT INTO ticket (idCat, numTicket, titre, description, dateCreation, priorite, idStatut, idUtilisateur) VALUES (?, ?, ?, ?, NOW(), "0", "1", "29")');
        $creerTicket->execute(array($id, $cate, $titre, $desc));

        header('Location: http://localhost:8080/#/creerTicket');
        //header('Location: https://wat.alwaysdata.net/#/creerTicket');
    }
}
?>