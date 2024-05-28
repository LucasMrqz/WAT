<?php
require_once('co_bdd.php');
session_start(); // Assurez-vous de démarrer la session

if(isset($_POST['boutton-valider'])){ 
    if(isset($_POST['titre']) && isset($_POST['desc'])) { // les issests servent à verifier que l'utilisateur à bien rempli un login, un mot de passe et qu'il a bien valider ceci
        $titre = htmlspecialchars($_POST['mail']);
        $desc = htmlspecialchars($_POST['desc']);
        $dateCrea = NOW();
        $id = $_SESSION['id'];
        $Email = $_SESSION['mail'];
        $nom = $_SESSION['nom'];
        
        //selectionner le bon créateur du ticket
        $selectUti = $lien->prepare("SELECT idUtilisateur FROM utilisateur WHERE email = ?");
        $selectUti->execute(array($Email));

        // Requête d'insertion des données dans la table ticket
        $creerUtilisateur = $lien->prepare('INSERT INTO ticket (ticket, description, dateCreation, idUtilisateur) VALUES (?, ?, ?, ?)');
        $creerUtilisateur->execute(array($titre, $desc, $dateCrea, $id));
    }
}
?>